<?php
	// new comment
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/review/review_functions.php';
@session_start();
	if(isset($_POST['new_comment'])) {
		$new_com_name = $_SESSION['user']->getUserName();
		$new_com_text = $_POST['comment'];
		$new_com_date = date('Y-m-d H:i:s');
		$new_com_code = generateRandomString();

		if(isset($new_com_text)) {
			mysqli_query($con, "INSERT INTO `parents` (`user`, `text`, `date`, `code`) VALUES ('$new_com_name', '$new_com_text', '$new_com_date', '$new_com_code')");
		}
		header("Location: ".getRootPath());
	}
	// new reply
	if(isset($_POST['new_reply'])) {
		$new_reply_name = $_SESSION['user'];
		$new_reply_text = $_POST['new-reply'];
		$new_reply_date = date('Y-m-d H:i:s');
		$new_reply_code = $_POST['code'];

		if(isset($new_reply_text)) {
			mysqli_query($connect, "INSERT INTO `children` (`user`, `text`, `date`, `par_code`) VALUES ('$new_reply_name', '$new_reply_text', '$new_reply_date', '$new_reply_code')") or die(mysqli_error());
		}
		header("Location: ".getRootPath());
	}
?>