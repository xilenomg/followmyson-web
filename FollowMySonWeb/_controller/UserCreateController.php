<?php
if ( isset($_POST['user']['name'], $_POST['user']['phone'], $_POST['user']['password'])){
	require_once("../_config/_config.php");
	
	$userDAO = new UserDAO();
	
	
	$searchedUser = $userDAO->getByField("user_phone", $_POST['user']['phone']);
	
	$resultUser = null;
	
	if ( $searchedUser && $searchedUser->user_password == $_POST['user']['password'] ){
		$resultUser = $searchedUser;
	}
	else{
		if ( !$searchedUser ){
			$user = new User();
			$user->user_name = $_POST['user']['name'];
			$user->user_phone = $_POST['user']['phone'];
			$user->user_password = $_POST['user']['password'];
			$user_id = $userDAO->create($user);
			$resultUser = $userDAO->get($user_id);
		}
		else{
			$error_message = "Wrong Password";
		}
	}
	
	if ( $resultUser ){
		echo json_encode($resultUser->toJson());
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