<?php
// //require_once "../../helpers.inc.php";
// require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
class itemClass{

	
	public $category;
	
	//a method to post the items
	public function postItemMethod(){
		$category=new category();
		//$form=include_once ROOT_DIR.'post-form.html.php';//includes the form to fill 
		//echo $form;
		global $pdo;////global variable db to store the pdo object  created on the db connector
		$postFormSubmitted=isset($_POST['post']);//checks if the form has been submitted
		if($postFormSubmitted){
			//assign values to the variables to be posted on to the db
			$itemName=$_POST['itemName'];
			$itemImage=$_POST['itemImage'];
			$description=$_POST['description'];
			$availability=$_POST['availability'];
			$quantity=$_POST['quantity'];
			$price=$_POST['price'];
			$bot = $_POST['chatbotset'];

			if(isset($_POST['new_category'])){
				Category::addCategory($_POST['new_category']);
				$cat = $pdo->lastInsertId();
			}
			else
				$cat = $_POST['category'];

			$catName=Category::getCatName($cat);
			
			$userId=$_SESSION['user']->getUserId();
			// a query to be executed with place holders in it....for secuirity purposes..
			$sql="INSERT INTO items(item_name,description,post_date,contract_period,quantity,price,category, uploader_id) VALUES 
					(:itemName,:itemDescription,CURRENT_TIMESTAMP,:contractPeriod,:quantity,:price,:cat, :u)";

			try{
				$statement=$pdo->prepare($sql);//prepares the query to be executed and stores it on the variable statement
				//binding values to the place holders in the query statement
				$statement->bindValue(':itemName',$itemName);
				//$statement->bindValue(':itemImage',$itemImage);
				$statement->bindValue(':itemDescription',$description);
				$statement->bindValue(':contractPeriod',$availability);
				$statement->bindValue(':quantity',$quantity);
				$statement->bindValue(':price',$price);
				$statement->bindValue(':cat',$catName);
				$statement->bindValue(':u', $userId);
				//$statement->bindValue(':userId',$userId);
				$statement->execute();	

				$id = $pdo->lastInsertId();
				if($bot == 'yes')
					header('Location: '.getRootPath().'php/help_center/savequestion.php?id='.$id, true, 303);
				else
					header('Location: '.getRootPath().'php/pages/item/detail_page.html.php?id='.$id, true, 303);
				exit();
			}
			catch(Exception $e){
				$error=$e->getMessage();
				echo 'Couldnt insert item......sql error,	<br>'.$error;//display the error occured
			}
		}
	}

//most of the code here is the same as the one before and has ben explained there.....
	//general function to delete an item from db
	public function removeItem($itemID){
		global $pdo;
		$sql="DELETE FROM items WHERE itemId=:itemID";
		try{
			$statement=$pdo->prepare($sql);
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
		global $pdo;
		$sql="DELETE FROM items WHERE contractPeriod=0";
		try{
			$statement=$pdo->prepare($sql);
			$statement->execute();
			echo 'removed item';
		}
		catch(Exception $e){
			echo 'sql error';
		}

	}
	//function to decrease the contract period based on the date using mysql built in function called date_diff 
	public function decreaseContract(){
		global $pdo;
		$sql="UPDATE items SET contractPeriod=date_diff(CURRENT_TIMESTAMP,postDate) WHERE contractPeriod>=1";
		try{
			$statement=$pdo->prepare($sql);
			$statement->execute();
			echo 'DECREASED item';
		}
		catch(Exception $e){
			echo 'sql error';
		}
	}	


	public function buyNow($itemId){
		global $pdo;
		$buyClicked=isset($_POST['buy']);
		if($buyClicked){
			$item=$itemId;
		}
		return $item;
	}

	public static function fetchItems($categoryName){
		global $pdo;
		try{
			$sql="SELECT * FROM items WHERE Category=:categoryName";
			$statement=$pdo->prepare($sql);
			$statement->bindValue(':categoryName',$categoryName);
			$statement->execute();
		}
		catch(Exception $e){
			echo 'sql error'. '<br>'.$e->getMessage();
		}
		return $statement;
	}


	public static function displayItems($name){
		$categoryName=$name;
		$items=self::fetchItems($categoryName);
		$display="<ul>";

		while($row=$items->fetch()){
			$display.="<form action='' method='post'>
					  <li>
						<img src=''/>
						<p><a href='".getRootPath()."php/pages/item/item_info.html.php?cid=".Category::getCatId($name)."&id=".$row['item_id']."'>".$row['item_name']."</a></p>
						 <a href='".getRootPath()."php/payment/add_to_cart.php?id=".$row['item_id']."&cid=".Category::getCatId($name)."' method='post'>
			              <input class='button rounded primary' value='Add To Cart'  style='width:120px'>
			            </a>
					  </li>
					  </form>
					  ";
		}
		return $display;

	}
}