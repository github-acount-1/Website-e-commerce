<?php
try{
	$dbInfo = "mysql:host=localhost;dbname=shola";
	$dbUser = "root";
	$dbPassword = "";
	$db = new PDO( $dbInfo, $dbUser, $dbPassword );
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	//echo '<h1> Connected </h1>';
}
catch(PDOException $e){
	echo '<h1> unnable to connect</h1>';
	exit();
}

?>