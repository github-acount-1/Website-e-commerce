<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/category.class.php';

//<form id="cat_form" action="<?php echo getRootPath();?
//public 
$category;
	//
	//a method to post the items
	//public function postItemMethod(){//
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
					(:itemName,:itemDescription,CURRENT_TIMESTAMP,:contractPeriod,:quantity,:price,:cat, :userId)";

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
				$statement->bindValue(':userId', $userId);
				//$statement->bindValue(':userId',$userId);
				$statement->execute();	
                        //echo '<h1> Successful !! </h1>';
				$id = $pdo->lastInsertId();
				header('Location: '.getRootPath().'detail_page.html.php?id'.$id, true, 303);
				echo '<h1> Successful !! </h1>';
				
			}
			catch(Exception $e){
				$error=$e->getMessage();
				echo 'Couldnt insert item......sql error,	<br>'.$error;//display the error occured
			}
		}
	//}

//most of the code here is the same as the one before and has ben explained there.....
	

	?>