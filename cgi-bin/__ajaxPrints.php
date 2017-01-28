<? 
	require_once '__system.php';

	require_once '__function_prints.php';

	// Request type (insert, update, combine some entity, etc)
	$typeRequest = $_REQUEST['typeRequest'];

	// Data passed for specific action
	$data = $_REQUEST['data'];

	// Query to perform
	$k = "";

	// Output file
	global $fileOutputPrints;

	// Database connection
	$link = connect();

	switch($typeRequest) {

		case('insert'):
			$k = "insert into Settings_prints values ('$data[0]', TRUE)";
			break;

		case('update'):
			$k = "update Settings_prints set active = $data[1] where voice = '$data[0]'";
			break;

		default:
			$fileOutputPrints = "../latex/" . $typeRequest;
			$fileOutputPrints = fopen($fileOutputPrints, 'w+') or die ("Can't create file " . $fileOutputPrints);
            $GLOBALS['fileOutputPrints']=$fileOutputPrints;
			call_user_func($typeRequest);
	}
	if($k != "") {
		if(!mysqli_query($link, $k)) 
			echo "ERROR ". $typeRequest ."\n" . $k;
		else {
			echo $k;
		}
	}
?>