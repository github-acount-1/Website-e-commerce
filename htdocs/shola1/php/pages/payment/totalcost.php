<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
    @session_start();
    if(!userIsLoggedIn()){
        header('Location: '.getRootPath());
        exit();
    }
totalCost();
numOfItems();
function totalCost()
	{
	    // caluclates total cost 
		global $con;
	     $UserID=$_SESSION['user']->getUserId();
	     $sum=0;
         $query="select * from shopping_cart where user_id=$UserID";
         $retrive=mysqli_query($con,$query);
                while($array=mysqli_fetch_array($retrive))
                     {   
                     	 $item_id=$array['item_id'];
                     	 $query1="select price from items where item_id=$item_id";
                         $retrive1=mysqli_query($con,$query1);
                         $array1=mysqli_fetch_array($retrive1);
                            $price=$array1['price'];
                            $qty=$array['quantity'];
                               $sum+=$price*$qty;

                      }

echo "<p align='right'>totalprice= $sum</p>";


	}
function numOfItems(){
	     global $con;
		 $UserID=$_SESSION['user']->getUserId();
	// calculates total no of items in the cart
	     $sum=0;
         $query="select quantity from shopping_cart where user_id=$UserID";
         $retrive=mysqli_query($con,$query);
                 while($array=mysqli_fetch_array($retrive))
						{
                         $qty=$array['quantity'];
                            $sum+=$qty;

						}

echo "<p align='right'>total_no_of_items= $sum</p>";
	}




?>