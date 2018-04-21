<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
        @session_start();
        if(!userIsLoggedIn()){
            header('Location: '.getRootPath());
            exit();
        }
	deleteFromCart();
		header("Location: viewcart.html.php");
   
function deleteFromCart()
	{
		global $con;
		$UserID=$_SESSION['user']->getUserId();
	//when delet is clicked it automatically delets it from the list and and displays it to the user this is the reason why the viewcart php file is included
	
	    $id=$_GET['id'];
	    $query4="delete from shopping_cart WHERE item_id=$id and user_id=$UserID";
	    mysqli_query($con,$query4); 
	}	
?>