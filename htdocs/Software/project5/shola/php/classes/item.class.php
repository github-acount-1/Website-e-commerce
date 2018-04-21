<?php
require_once "../includes/helpers_inc.php";
require_once ROOT_DIR.'../includes/db_inc.php';//includes the db connector
include_once ROOT_DIR.'category.class.php';
class itemClass{

	
	public $category;
	
	//a method to post the items
	public function postItemMethod(){
		$category=new category();
		$form=include_once ROOT_DIR.'post-form.html.php';//includes the form to fill 
		echo $form;
		global $db;////global variable db to store the pdo object  created on the db connector
		$postFormSubmitted=isset($_POST['post']);//checks if the form has been submitted
		if($postFormSubmitted){
			//assign values to the variables to be posted on to the db
			$itemName=$_POST['itemName'];
			$itemImage=$_POST['itemImage'];
			$description=$_POST['description'];
			$availability=$_POST['availability'];
			$quantity=$_POST['quantity'];
			$price=$_POST['price'];
			$cat=$_POST['category'];
			
			$catName=$category->setCategoryName($cat);
			$category->addCategory($catName);
			$userId=1;
			// a query to be executed with place holders in it....for secuirity purposes..
			$sql="INSERT INTO items(ItemId,itemName,itemimage,description,postDate,contractPeriod,quantity,price,Category,userId) VALUES 
					('DDDD',:itemName,:itemImage,:itemDescription,CURRENT_TIMESTAMP,:contractPeriod,:quantity,:price,:cat,:userId)";
			try{
				$statement=$db->prepare($sql);//prepares the query to be executed and stores it on the variable statement
				//binding values to the place holders in the query statement
				$statement->bindValue(':itemName',$itemName);
				$statement->bindValue(':itemImage',$itemImage);
				$statement->bindValue(':itemDescription',$description);
				$statement->bindValue(':contractPeriod',$availability);
				$statement->bindValue(':quantity',$quantity);
				$statement->bindValue(':price',$price);
				$statement->bindValue(':cat',$catName);
				$statement->bindValue(':userId',$userId);
				$statement->execute();	
				echo 'inserted succesfully';
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
	}

//most of the code here is the same as the one before and has ben explained there.....
	//general function to delete an item from db
	public function removeItem($itemID){
		global $db;
		$sql="DELETE FROM items WHERE itemId=:itemID";
		try{
			$statement=$db->prepare($sql);
			$statement->bindValue(':itemID',$itemID);
			$statement->execute();
			echo 'removed item';
		}
		catch(Exception $e){
			echo 'sql error '+'$e';

		}

	}
	//function to remove the item if contract period is over
	public function removeBasedOnContract(){
		global $db;
		$sql="DELETE FROM items WHERE contractPeriod=0";
		try{
			$statement=$db->prepare($sql);
			$statement->execute();
			echo 'removed item';
		}
		catch(Exception $e){
			echo 'sql error';
		}

	}
	//function to decrease the contract period based on the date using mysql built in function called date_diff 
	public function decreaseContract(){
		global $db;
		$sql="UPDATE items SET contractPeriod=date_diff(CURRENT_TIMESTAMP,postDate) WHERE contractPeriod>=1";
		try{
			$statement=$db->prepare($sql);
			$statement->execute();
			echo 'DECREASED item';
		}
		catch(Exception $e){
			echo 'sql error';
		}
	}	


	public function buyNow($itemId){
		global $db;
		$buyClicked=isset($_POST['buy']);
		if($buyClicked){
			$item=$itemId;
		}
		return $item;
	}

	public function fetchItems($categoryName){
		global $db;
		try{
			$sql="SELECT * FROM items WHERE Category=:categoryName";
			$statement=$db->prepare($sql);
			$statement->bindValue(':categoryName',$categoryName);
			$statement->execute();
		}
		catch(Exception $e){
			echo 'sql error'. '<br>'.$e->getMessage();
		}
		return $statement;
	}


	public function displayItems($name){
		$categoryName=$name;
		$displayItems=include_once ROOT_DIR.'displayPage.html.php';
		return $displayItems;
	}

	
}