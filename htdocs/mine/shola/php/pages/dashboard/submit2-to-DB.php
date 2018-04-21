<?php
require_once "helpers.inc.php";
require_once ROOT_DIR.'connectDB-inc.php';//includes the db connector

include_once ROOT_DIR.'category_class.php';
//public function submitItemMethod(){
    //public $category;
     $category;
    $category=new category();
		global $db;////global variable db to store the pdo object  created on the db connector
		$postFormSubmitted=isset($_POST['post']);//checks if the form has been submitted
		if($postFormSubmitted){
			//assign values to the variables to be posted on to the db
			$itemName=$_POST['Itemname'];
			$itemImage=$_POST['itemimage'];
			$description=$_POST['description'];
			//$Category=$_POST['Category'];
			  $cat=$_POST['Category'];
			$availability=$_POST['contractPeriod'];
			$quantity=$_POST['quantity'];
			$postDate=$_POST['postdate'];
			$price=$_POST['price'];
			//$cat=$_POST['category'];
			$catName=$category->setCategoryName($cat);
			$category->addCategory($catName);
			//$type=$_POST['type'];
			//$userId=10;
			//$ItemId=17;
			// a query to be executed with place holders in it....for secuirity purposes..
			$sql="INSERT INTO items(Itemname,description,quantity,Category,itemimage,postdate,contractPeriod,price) VALUES (:itemName,
				:description,:quantity,:cat,:itemImage,:postDate,:availability,:price)";
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
				$statement->bindValue(':cat',$cat);
				$statement->bindValue(':postDate',$postDate);
				//$statement->bindValue(':userId',$userId);
				$statement->execute();	
				echo '<h1> Successful !! </h1>';
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