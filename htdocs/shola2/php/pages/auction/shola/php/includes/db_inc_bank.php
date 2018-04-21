<?php

	/**
	 * This code sets up connection to database using the pdo interface
	 */
	try{
		$pdo_bank = new PDO("mysql:host=".HOST.";dbname="."bank", DATABASE_USER, PASSWORD);
		$pdo_bank->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo_bank->exec('SET NAMES "utf8"');
	}
	catch(PDOException $e){
		$error = 'Error connecting to database: ' . $e->getMessage();
		include 'error_html.php';
		exit();
	}


	/**
	 * This code set up conndection to database using mysql interface
	 */
	//mysqli_connect(HOST, DATABASE_USER, PASSWORD, DATABASE_NAME)
	//or die("<p>Can't connect</p>");

?>