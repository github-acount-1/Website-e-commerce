<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
    @session_start();

    addtocart();
    header("Location: ".getRootPath()."php/pages/item/category_display.html.php?id=".$_GET['cid']);
//require("viewcart.php");/*includes the viewcart php file this implys when the add button or link is clicked it leads the custemor to view the cart*/

    function addtocart()
	{	
        global $con;
         $UserID=$_SESSION['user']->getUserId();
         
        //gets the item id from the url ,which is passed  during creating add link  
		 $id=$_GET['id'];
		 //selects the item using the item id
         $query2="select * From items WHERE item_id=$id";
         $retrive2=mysqli_query($con,$query2); 
         $row1=mysqli_fetch_array($retrive2); 
         $Item_id=$row1['item_id'];
         
         //checks whether the item is previously added in to the cart or not
         $query="select * From shopping_cart WHERE item_id=$id and user_id=$UserID";   
         $retrive=mysqli_query($con,$query); 
         if(null!=mysqli_fetch_array($retrive))
             { 
         	//if the item is previously added it takes the custemor to the cart and provide him a way to update qantity of tha item

             }

         else
             {
             //if the item is new to the cart it inserts it .
               $query1="INSERT INTO shopping_cart(user_id,item_id,quantity) 
                        VALUES($UserID, $Item_id,1)";

               mysqli_query($con,$query1);
           }
	}

?>