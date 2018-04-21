<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/item/category_display.html.php';
@session_start();

class Agent{ // Creating the class for the Agent
	

 public static function getPreferance(){ //A function to get a preference from database
 	//$user=getUserId(); //Assigns a user for trial
 	$user_id = $_SESSION['user']->getUserId(); 
	
	
 	global $pdo; //instantiate a pdo
 	
	 	try{
	 		$sql = "SELECT category,score FROM user_preference WHERE user_id = :u ORDER BY score DESC LIMIT 2";//retrive data(category) from the database user_preferance based of the user
	 		$preferance = $pdo->prepare($sql);//assigns the retrived data
	 		$preferance->bindValue(':u',$user_id);
	 		$preferance->execute();
	 		$row=$preferance->fetch();//
	 		$itemCategory=$row['category'];// assign the itemCategorys name
	 		//$score=$row['score'];
	 	}catch(Exception $e){  //run exception
	 		print_r($e->getMessage()); //show exception
	 	}

 	return $itemCategory;//returns the itemCategory
	
	
 }
 public static function display(){ // A function to display all items found in the category of user preference
 	global $pdo; // instantiate pdo
 	$items=Agent::getPreferance(); //assign the category from the getPreference function

 	require_once '../pages/display_page.html.php';


 	try{
 		for each($items as $item){
 			$sql = "SELECT * FROM items WHERE category = :itemcat "; //retrive data(items) from the database items based on user preference category
		 	$display = $pdo->prepare($sql); //assigns the retrived data
		 	$display->bindValue(':itemcat',$item);
		 	$display->execute();while($row=$display->fetch()){ // using loop to display items name, discription and price 
	 		$itemName=$row['item_name']; // assign an array of items
	 		$desc=$row['description']; // assign an array of discription
	 		$price=$row['price']; // assign an array of price
		 	echo $itemName ."<br>"; // show item
		 	echo $desc ."<br>"; // show discribtion
		 	echo $price."<br>"; // show price
 		}
 		
	 	 //instantiate and assign the display
	 	
	 	}
 	} 
 	catch(Exception $e){ //run exception
 		print_r($e->getMessage()); // show exception
 	}
 }	
 }
?>