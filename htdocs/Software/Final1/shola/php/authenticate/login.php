<?php
	require_once '../includes/helpers_inc.php';
	require_once getRootPath().'php/includes/db_inc.php';
	require_once getRootPath().'php/classes/user.class.php';
	
	global $pdo;
	$email = htmlspecialchars($_POST['email']);
	$pwd = md5(htmlspecialchars($_POST['password']));

	$sql = "SELECT count(*) FROM customer WHERE email = :e AND password = :p";
	$stm = $pdo->prepare($sql);
	$stm->execute(array(":e"=>$email, ":p"=>$pwd));

	session_start();
	if($stm->fetch()[0] > 0){
		$_SESSION['loggedin'] = true;
		$_SESSION['user'] = new User($email, $pwd);
		header("Location: ".getRootPath(), true, 303);
	}
	else{
		unset($_SESSION['loggedin']);
		unset($_SESSION['user']);
		header("Location: ".getRootPath().'index.php?loginerror=true', true, 303);
	}
?>