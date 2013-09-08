<?php
if ( isset($_POST['user']['phone'])){
	require_once("../_config/_config.php");
	
	$userDAO = new UserDAO();
	
	$searchedUser = $userDAO->getByField("user_phone", $_POST['user']['phone']);
	
	if ( $searchedUser ){
		echo json_encode($searchedUser->toJson());
		exit;
	}
	else{
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		echo $error_message;
	}
}
else{
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	echo "invalid request";
}


?>