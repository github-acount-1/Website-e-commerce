<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';

	if(isset($_POST['SIGN_UP'])){

		$firstName=htmlspecialchars($_POST['firstname']);
		$lastName=htmlspecialchars($_POST['lastname']);
		$userName=htmlspecialchars($_POST['username']);
		$psw = htmlspecialchars($_POST['psw']);
		$psw2 = htmlspecialchars($_POST['psw2']);
		$email= htmlspecialchars($_POST['email']);
		$phonenumber = htmlspecialchars($_POST['phonenumber']);
		// $gender = htmlspecialchars($_POST['gender']);   
		$country = htmlspecialchars($_POST['Country']);
		$city = htmlspecialchars($_POST['city']);

		$input = "fn={$firstName}&ln={$lastName}";

		if(User::userExists($userName)){
			header("Location: ../pages/register.html.php?e=1&id=2&".$input);
			exit();
		}
		$input = $input."&un=".$userName;

		if(User::emailExists($email)){
			header("Location: ../pages/register.html.php?e=1&id=3&".$input);
			exit();
		}
		$input = $input."&em=".$email;

		if(User::phoneExists($phonenumber)){
			header("Location: ../pages/register.html.php?e=1&id=4&".$input);
			exit();
		}
		$input = $input."&ph=".$phonenumber."&ci=".$city;

		if($psw!=$psw2){
			header("Location: ../pages/register.html.php?e=1&id=1&".$input);
			exit();
		}

		$sql = "INSERT INTO customer( first_name,last_name,user_name,password,email,phone_number,country,city,birth_date) 
						VALUES ( :fn,:ln,:un,:pw,:em,:pn,:co,:ci,CURRENT_TIMESTAMP)";
		$values = array(":fn"=>$firstName, ":ln"=>$lastName, ":un"=>$userName, ":pw"=>md5($psw),
						":em"=>$email, ":pn"=>$phonenumber, ":co"=>$country, ":ci"=>$city);
		$statement = $pdo->prepare($sql);
		$statement->execute($values);

		$user_id = $pdo->lastInsertId();

		$sql = "INSERT INTO new_notification_count SET user_id=:i";
		$stm = $pdo->prepare($sql);
		$stm->execute(array(":i"=>$user_id));

		//code for data insertion of user detail

		@session_start();
		$_SESSION['loggedin'] = true;
		$_SESSION['user'] = new User($email, md5($psw));
	}

	header("Location: ../../index.php");
	exit();
?>