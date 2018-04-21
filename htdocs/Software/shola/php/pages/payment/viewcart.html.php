
	<?php
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
        @session_start();
        if(!userIsLoggedIn()){
            header('Location: '.getRootPath());
            exit();
        }
        require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
	       viewcart();
           require("totalcost.php");
function viewcart()
	{ 
    global $con;
		$UserID=$_SESSION['user']->getUserId();
 	
		
	?>
  <div class ="bg-white" >
	    <table>
    <tr>
        <th>NAME</th>
        
        <th>quantity</th>
    </tr>

	<?php
            //retrives every cart item and echo  (print) it
           $query3="select * From shopping_cart where user_id=$UserID ";
           $retrive3=mysqli_query($con,$query3); 
           while($row2=mysqli_fetch_array($retrive3)) 
	 			{  
	 			
	 				$ItemID=$row2['item_id'];
                    $query8="select * From items where item_id=$ItemID";
                    $retrive8=mysqli_query($con,$query8); 
                    $row8=mysqli_fetch_array($retrive8); 

	?>
	
     <tr>
         <td><?php echo $row8['item_name']?></td>
        
         <td>
         <?php /*enables the user edit quantity and set quantity and itemid  in the url ,then they are accessed by the get method when the update button is clicked*/?>

 			   <form method="post" action="update.php?quntity">
               <input type="text" value=<?php echo $row2['quantity']?> name="quantity" </input>          
               <input type="hidden" value=<?php echo $row2['item_id']?> name="id" </input>
               <input type="submit" value="update"</input>
               </form>
         </td>
         <td>
          <a href="deletefromcart.php?id=<?php echo $row2['item_id']?>">DELETE</a><?php/*links to delete php file and set the itemid accesible by the get method*/?>
         </td>
     </tr>
	<?php 

 				}
 	}
    ?>
         </table>
        </div>
         <a href="">checkout</a></br>
</body>
</html>	