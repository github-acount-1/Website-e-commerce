<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';


class Agent{ // Creating the class for the Agent
	

 public static function getPreferance(){ //A function to get a preference from database
 	//$user=getUserId(); //Assigns a user for trial
 	//@session_start();
 	$user_id =$_SESSION['user']->getUserId(); 
	
	
 	global $pdo; //instantiate a pdo
 	
	 	try{
	 		$sql = "SELECT category FROM user_preference WHERE user_id=:u ORDER BY score DESC LIMIT 2 ";//retrive data(category) from the database user_preferance based of the user
	 		$preferance = $pdo->prepare($sql);//assigns the retrived data
	 		$preferance->bindValue(':u',$user_id);
	 		$preferance->execute();
	 		$row=$preferance->fetchAll();
	 	}catch(Exception $e){  //run exception
	 		print_r($e->getMessage()); //show exception
	 	}
	 	


 	return $row;//returns the itemCategory
	
	
 }
 public static function display(){ // A function to display all items found in the category of user preference
 	global $pdo; // instantiate pdo
 	$items=Agent::getPreferance(); //assign the category from the getPreference function

 	//require_once '../pages/display_page.html.php';
 	$ret = array();

 	try{
 		
 		foreach ($items as $item ) {
 			# code...
 		
 			$sql = "SELECT * FROM items WHERE category = :itemcat LIMIT 2 "; //retrive data(items) from the database items based on user preference category
		 	$display = $pdo->prepare($sql); //assigns the retrived data
		 	$display->bindValue(':itemcat',$item[0]);
		 	$display->execute();
		 	while($row=$display->fetch()){ // using loop to display items name, discription and price 
	 		$itemName=$row['item_name']; // assign an array of items
	 		$desc=$row['description']; // assign an array of discription
	 		$price=$row['price'];
	 		$item_id=$row['item_id'];
	 		$item_image="";
	 		try{
	 		$sql = "SELECT image_url FROM item_image JOIN items ON items.item_id=item_image.item_id WHERE items.item_id=:u ";//retrive data(category) from the database user_preferance based of the user
	 		$preferance = $pdo->prepare($sql);//assigns the retrived data
	 		$preferance->bindValue(':u',$item_id);
	 		$preferance->execute();
	 		$row=$preferance->fetch();
	 		$item_image=$row['image_url'];
	 	}catch(Exception $e){  //run exception
	 		print_r($e->getMessage()); //show exception
	 	}
	 		 // assign an array of price
		 	// echo $itemName ."<br>"; // show item
		 	// echo $desc ."<br>"; // show discribtion
		 	// echo $price."<br>";
		 	// echo $item_image; // show price
		 	$ret[] = array("item_name"=>$itemName, "desc" => $desc,
		 	 "price"=>$price, "img_url"=>$item_image, "id"=>$item_id);
		 }
 		}
 		
	 	 //instantiate and assign the display
	 	
	} 
 	catch(Exception $e){ //run exception
 		print_r($e->getMessage()); // show exception
 	}

 	return $ret;

 }	
 }

 // echo "<pre>";
 // print_r(Agent::display());
 // echo "<pre>";
?>