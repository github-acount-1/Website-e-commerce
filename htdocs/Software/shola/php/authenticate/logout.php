<?php
	require_once '../includes/helpers_inc.php';
	if(isset($_POST['logout'])){
		@session_start();
		unset($_SESSION['loggedin']);
		unset($_SESSION['user']);
	}
	header("Location: ".getRootPath());
?>