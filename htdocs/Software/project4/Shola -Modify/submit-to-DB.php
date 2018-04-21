<?php
require_once "helpers.inc.php";
require_once ROOT_DIR.'connectDB-inc.php';//includes the db connector

//public function submitItemMethod(){
		global $db;////global variable db to store the pdo object  created on the db connector
		$postFormSubmitted=isset($_POST['post']);//checks if the form has been submitted
		if($postFormSubmitted){
			//assign values to the variables to be posted on to the db
			$itemName=$_POST['Itemname'];
			$itemImage=$_POST['itemimage'];
			$description=$_POST['description'];
			$Category=$_POST['Category'];
			$availability=$_POST['contractPeriod'];
			$quantity=$_POST['quantity'];
			$postDate=$_POST['postdate'];
			$price=$_POST['price'];
			//$type=$_POST['type'];
			//$userId=10;
			//$ItemId=17;
			// a query to be executed with place holders in it....for secuirity purposes..
			$sql="INSERT INTO items(Itemname,description,quantity,Category,itemimage,postdate,contractPeriod,price) VALUES (:itemName,
				:description,:quantity,:Category,:itemImage,:postDate,:availability,:price)";
			try{
				$statement=$db->prepare($sql);//prepares the query to be executed and stores it on the variable statement
				//binding values to the place holders in the query statement
				//$statement->bindValue(':ItemId',$ItemId);
				$statement->bindValue(':itemName',$itemName);
				$statement->bindValue(':itemImage',$itemImage);
				$statement->bindValue(':description',$description);
				$statement->bindValue(':availability',$availability);
				$statement->bindValue(':quantity',$quantity);
				$statement->bindValue(':price',$price);
				$statement->bindValue(':Category',$Category);
				$statement->bindValue(':postDate',$postDate);
				//$statement->bindValue(':userId',$userId);
				$statement->execute();	
				echo 'Inserted succesfully';
			}
			catch(Exception $e){
				$error=$e->getMessage();
				echo 'Couldnt insert item......sql error,	<br>'.$error;//display the error occured
			}
		}
		//cecks and returnss to calling page if posting has been cancelled
		else if(isset($_POST['cancel'])){
			header('Location: .');
		}
	//}


?>