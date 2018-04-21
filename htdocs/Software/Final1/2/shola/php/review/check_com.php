<?php

$root = $_SERVER['DOCUMENT_ROOT'];
if($root[strlen($root) - 1] != "/")
    $root .= "/";

require_once $root.'shola/php/includes/db_inc.php';
require_once $root.'shola/php/includes/helpers_inc.php';
require_once $root.'shola/php/classes/user.class.php';
require_once $root.'shola/php/review/review_functions.php';

@session_start();

if(!userIsLoggedIn()){
//		header("Location: ".getRootPath());
		exit();
	}

	if(isset($_POST['new_comment'])) {
		$new_com_name = $_SESSION['user']->getUserName();
		$new_com_text = $_POST['comment'];
        $item_id = $_POST['item_id'];
		$rating_value = $_POST['rating_value'];
		$new_com_date = date('Y-m-d H:i:s');
		$new_com_code = generateRandomString();

		if(isset($new_com_text)) {
			
			mysqli_query($con, "INSERT INTO `parents` (`user`, `text`, `date`, `code`, `item_id`, `rating`) VALUES ('$new_com_name', '$new_com_text', '$new_com_date', '$new_com_code', '$item_id', '$rating_value')");
			
			//update the rating of the item - just calculate average of ratings then round
			mysqli_query($con, "update items set rating = (select round(avg(rating)) from parents where item_id=$item_id) where item_id=$item_id;");

            // send the new review back to user after formatting a bit
			echo '<div class="comment" id="' . $new_com_code . '">'
					.'<b><p class="user">'.$new_com_name.'</p></b>&nbsp;'
					.'<p class="time">'.date('M d, Y | H:i:s').'</p>'
					.'<p class="comment-text">'.$new_com_text.'</p><br></div>'
					.'<div class="rating" data-role="rating" id="rating_' . $new_com_code . '" data-score-title="Rating: "></div>'
					.'<script type="text/javascript">$(function(){$("#rating_' . $new_com_code . '").data("rating").value(' . $rating_value . ');});</script>';
		}
		//header("Location: ".getRootPath());
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
		//header("Location: ".getRootPath());
	}
?>