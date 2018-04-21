<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    session_start();
    if(!userIsLoggedIn()){
		header("Location: ".getRootPath());
		exit();
	}

	$tbl_name ="fquestions" ; 
	$topic =$_POST ['topic' ];
	
	$detail =htmlspecialchars($_POST ['detail' ]);
	$name =$_SESSION['user']->getName();
	$email =$_SESSION['user']->getEmail();
	$datetime= date( "d/m/y h:i:s" ); //create datetime
	$sql ="INSERT INTO $tbl_name(topic, detail,
	name, email, datetime)VALUES('$topic', '$detail',
	'$name', '$email', '$datetime')" ;
	echo "SQL ".$sql."<br>";
	$result=$pdo->prepare($sql);
	$result->execute();

	$id = $pdo->lastInsertId();

	if ( $result){
        header('Location: '.getRootPath().'php/pages/forum/view_topic.php?id='.$id);
        exit();
	}
	else {
		header('Location: '.getRootPath());
		exit();
	}
?>
