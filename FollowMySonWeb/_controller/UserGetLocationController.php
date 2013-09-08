<?php
if ( isset($_POST['user_id'], $_POST['user_phone'])){
	require_once("../_config/_config.php");
	
	$userDAO = new UserDAO();
	$user = $userDAO->get($_POST['user_id']);
	
	if ( $user->user_phone == $_POST['user_phone']){
		$userLocationDAO = new UserLocationDAO();
		$userLocation = $userLocationDAO->getLastByUser($_POST['user_id']);
		
		if ( $userLocation ){
			echo json_encode($userLocation->toJson());
			exit;
		}
	}
	
	
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	echo "no info";
}
else{
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	echo "error";
}


?>