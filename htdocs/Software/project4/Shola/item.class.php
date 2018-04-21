<?php
require_once "helpers.inc.php";
require_once ROOT_DIR.'connectDB-inc.php';//includes the db connector
//require_once 'connectDB-inc.php';//includes the db connector
//include_once ROOT_DIR.'post-form.html.php';//includes the form to fill 
include_once ROOT_DIR.'category_class.php';

class itemClass{
public $category;
     //public $coun=0;
	//a method to post the items
	public function postItemMethod(){
		 $category=new category();
		  //$form=include_once ROOT_DIR.'post-form.html.php';//includes the form to fill 
		  //echo $form;

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
			//$type=$_POST['type'];
			$cat=$_POST['category'];
			$catName=$category->setCategoryName($cat);
			$category->addCategory($catName);
			//$userId=0;
			// a query to be executed with place holders in it....for secuirity purposes..
			$sql="INSERT INTO itemtable(itemName,itemPicture,itemDescription,postDate,contractPeriod,quantity,price,itemType,userId) VALUES (:itemName,
				:itemImage,:itemDescription,CURRENT_TIMESTAMP,:contractPeriod,:quantity,:price,:itemType,:userId)";
			try{
				$statement=$db->prepare($sql);//prepares the query to be executed and stores it on the variable statement
				//binding values to the place holders in the query statement
				$statement->bindValue(':itemName',$itemName);
				$statement->bindValue(':itemImage',$itemImage);
				$statement->bindValue(':itemDescription',$description);
				$statement->bindValue(':contractPeriod',$availability);
				$statement->bindValue(':quantity',$quantity);
				$statement->bindValue(':price',$price);
				$statement->bindValue(':itemType',$type);
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
		$sql="DELETE FROM itemtable WHERE itemId=:itemID";
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
		$sql="DELETE FROM itemtable WHERE contractPeriod=0";
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
		$sql="UPDATE itemtable SET contractPeriod=date_diff(CURRENT_TIMESTAMP,postDate) WHERE contractPeriod>=1";
		try{
			$statement=$db->prepare($sql);
			$statement->execute();
			echo 'DECREASED item';
		}
		catch(Exception $e){
			echo 'sql error';
		}
	}	


	public function fetchItems($categoryName){
		global $db,$next,$prev,$nav,$coun;
		//$sql="SELECT * FROM items WHERE Category=:categoryName";
                   //echo $categoryName;
				
					try{
						$rowsPerPage = 2;
						$pageNum = 1;
						if(isset($_GET['page']))
							{
							$pageNum = $_GET['page'];
							}
							$offset = ($pageNum - 1) * $rowsPerPage;

					$qry = $db->prepare('SELECT COUNT(*) FROM items WHERE Category= :categoryName');//'SELECT COUNT(*) FROM items WHERE Category= "Automotives"'
					$qry->bindValue(':categoryName',$categoryName);
					$qry->execute();
					//echo $qry->fetchColumn(), ' rows';
					$numrows=$qry->fetchColumn();
					//echo $numrows;
					$maxPage = ceil($numrows/$rowsPerPage);
					// print the link to access each page
					$self = $_SERVER['PHP_SELF'];
					$nav = '';
					for($page = 1; $page <= $maxPage; $page++)
						{
						if ($page == $pageNum)
							{
							$nav .= " $page "; // no need to create a link to current page
							}
						else
							{
							$nav .= " <a href=\"$self?page=$page\">$page</a> ";							   
                                       $sql="SELECT * FROM items WHERE Category=:categoryName";
							}
						}
                          echo $coun;
					// Creation of navigation links
                     if ($pageNum > 1)
						{
						$page = $pageNum - 1;
						$prev = " <a href=\"$self?page=$page\"><-Prev</a> ";
						             $temp1=($pageNum-1)*$rowsPerPage;
               						 $temp2=$rowsPerPage;
               						   //$sql="SELECT * FROM items WHERE Category=:categoryName LIMIT $temp1,$temp2";
						          $sql="SELECT * FROM items WHERE Category=:categoryName";
								$statement=$db->prepare($sql);
								$statement->bindValue(':categoryName',$categoryName);
								$statement->execute();
								  //echo "<br />".$prev. "  ".$nav. "   " .$next;
								 //echo $statement->rowCount();
								//echo $pageNum.'pages';
								return $statement;


						$first = " <a href=\"$self?page=1\">[First Page]</a> ";
									
						}
					else
						{
						$prev = ' '; // we're on page one, don't print previous link
						$first = ' '; // nor the first page link
						   //echo "<br />".$prev. "  ".$nav. "   " .$next;
						}

					if ($pageNum < $maxPage)
					{
						$page = $pageNum + 1;
						$next = " <a href=\"$self?page=$page\">Next></a> ";
						             $temp1=($pageNum-1)*$rowsPerPage;
               						 $temp2=$rowsPerPage;
               						  //$sql="SELECT * FROM items WHERE Category=:categoryName LIMIT $temp1,$temp2";
						            $sql="SELECT * FROM items WHERE Category=:categoryName";
								$statement=$db->prepare($sql);
								$statement->bindValue(':categoryName',$categoryName);
								$statement->execute();
								  //echo "<br />".$prev. "  ".$nav. "   " .$next;
								  //echo $statement->rowCount();
								 //echo $pageNum.'pages';
								return $statement;							

					$last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
							

					}
				else
					{
					$next = ' '; // we're on the last page, don't print next link
					$last = ' '; // nor the last page link
					  //echo "<br />".$prev. "  ".$nav. "   " .$next;
					}


				//Print the navigation links and close the connection to the database:

				// Print the navigation links
				//echo "<br />".$prev. "  ".$nav. "   " .$next;






		//$statement=$db->prepare($sql);
		//$statement->bindValue(':categoryName',$categoryName);
		//$statement->execute();
		//return $statement;
		}
		catch(Exception $e){
			echo 'sql error '.$e;
		}

		
	}


	public function displayItems($name){
		global $db1;
		$categoryName=$name;
	
		$displayItems=include_once ROOT_DIR.'displayPage.html.php';
		//$displayItems=include_once 'displayPage.html.php';
		return $displayItems;
	}

	
}