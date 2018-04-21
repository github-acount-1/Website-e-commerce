<?php
		require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
        @session_start();
        if(!userIsLoggedIn()){
            header('Location: '.getRootPath());
            exit();
        }
update();
header("Location: viewcart.html.php");
function update()
	{ // updates the quantity to what the customer needs
		global $con;
        $UserID = $_SESSION['user']->getUserId(); 
		$id=$_GET['id'];
		$quantity=$_GET['quantity'];
	    $query="update shopping_cart set quantity=$quantity where item_id=$id and user_id=$UserID";
	    mysqli_query($con,$query);
	}


?>