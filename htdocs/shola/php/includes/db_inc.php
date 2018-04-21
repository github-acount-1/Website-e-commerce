<?php
	define("HOST", "localhost");
	define("PASSWORD", "");//define("PASSWORD", "hogwarts123");
	define("DATABASE_NAME", "shola");
	define("DATABASE_USER", "root");
	/**
	 * This code sets up connection to database using the pdo interface
	 */
	try{
		$pdo = new PDO("mysql:host=".HOST.";dbname=".DATABASE_NAME, DATABASE_USER, PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
		$pdo_bank = new PDO("mysql:host=".HOST.";dbname=bank", DATABASE_USER, PASSWORD);
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
	$con = mysqli_connect(HOST, DATABASE_USER, PASSWORD, DATABASE_NAME)
	or die("<p>Can't connect</p>");

?>