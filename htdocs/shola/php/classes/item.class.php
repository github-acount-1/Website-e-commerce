<?php
// //require_once "../../helpers.inc.php";
// require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
class itemClass{

	
	public $category;
	
	//a method to post the items
	public function postItemMethod($img){
		$category=new category();
		//$form=include_once ROOT_DIR.'post-form.html.php';//includes the form to fill 
		//echo $form;
		global $pdo;////global variable db to store the pdo object  created on the db connector
		$postFormSubmitted=isset($_POST['post']);//checks if the form has been submitted
		if($postFormSubmitted){
			//assign values to the variables to be posted on to the db
			$itemName=$_POST['itemName'];
			$description=$_POST['description'];
			$availability=$_POST['availability'];
			$quantity=$_POST['quantity'];
			$price=$_POST['price'];
			$bot = $_POST['chatbotset'];
			echo "cat<br>";
			echo "SET: ".isset($_POST['sel_cat_inp'])."<br>";

			if(isset($_POST['sel_cat_inp'])){
				Category::addCategory($_POST['category']);
				$catName = $_POST['category'];
				$cat = $pdo->lastInsertId();
			}
			else{
				$cat = $_POST['category'];
				$catName=Category::getCatName($cat);
			}

			
			
			$userId=$_SESSION['user']->getUserId();
			// a query to be executed with place holders in it....for secuirity purposes..
			$sql="INSERT INTO items(item_name,description,post_date,contract_period,quantity,price,category, uploader_id) VALUES 
					(:itemName,:itemDescription,CURRENT_TIMESTAMP,:contractPeriod,:quantity,:price,:cat, :u)";

			
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

				$sql = $pdo->prepare("INSERT INTO item_image SET item_id=:i, image_url=:iu, main_image=1");
				$sql->execute(array(":i"=>$id, ":iu"=>$img));

				if($bot == 'yes')
					header('Location: '.getRootPath().'php/help_center/savequestion.php?id='.$id, true, 303);
				else
					header('Location: '.getRootPath().'php/pages/item/item_info.html.php?id='.$id.'&cid='.$cat, true, 303);
				exit();
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
			$sql="SELECT * FROM items WHERE category=:categoryName";
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
		//$display="<ul>";

		//while($row=$items->fetch()){
            
            /************************************
            // Previous code for reference purpose
			$display.="<form action='' method='post'>
					  <li>
						<img style='padding-top: 10px; height: 150px' src='".self::getItemImage($row['item_id'])."'/>
						<p><a href='".getRootPath()."php/pages/item/item_info.html.php?cid=".Category::getCatId($name)."&id=".$row['item_id']."'>".$row['item_name']."</a></p>
						 <a href='".getRootPath()."php/payment/add_to_cart.php?id=".$row['item_id']."&cid=".Category::getCatId($name)."' method='post'>
			              <input class='button rounded primary' value='Add To Cart'  style='width:120px'>
			            </a>
					  </li>
					  </form>
					  ";
            }
            ***********************************/
            ?>

            <div class="grid padding30">

            <div> <H1> <?php echo $name ?></H1></div>
              
            <hr class="thin">

            <div class=" row cells4 ">

            <?php
                global $pdo;
                $stmt = $pdo->prepare("SELECT * FROM (SELECT * FROM items JOIN category ON category = category_name) as merged_table WHERE category_name=:categoryName");
                $stmt->execute(["categoryName"=>$categoryName]);
                $items = $stmt->fetchAll();
                $c = 0; foreach ($items as $item) { 
            ?>

                <div class="cell no-margin-top no-margin-bottom">
                    <p class="fg-black">
                        <?php echo "<B>Birr " . $item["price"] . '</B> - (Available: <B>' . $item["quantity"] . '</B>)' ?>
                    </p>
                    <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $item['id']; ?>">
                      <img style="widht: 350; height: 200;" class="no-margin-top no-margin-bottom" src="<?php echo self::getItemImage($item['item_id']); ?>">
                    </a><br/><br/>

                    <p class="fg-black"><i><?php echo $item["description"]; ?></i></p>
                    <p class="fg-black"><i><?php echo $item["color"]; ?></i></p>
                    
                    <div class="rating" data-role="rating"  id="rating_<?php echo $c; ?>" data-score-title="Rating: "></div>

                    <!---- Display Rating ----->
                    <script type="application/javascript">
                        $(function(){
                            var rating = $("#rating_<?php echo $c; ?>").data('rating');
                            rating.value(<?php echo $item['rating']; ?>);
                        });
                    </script>

                      <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $item['id']; ?>">
                          <input class="button rounded primary place-right" value="Shop now" style="width: 120px">
                      </a>
                </div>

            <?php
                $c++;
                if ($c%4 == 0) {
                    echo "</div><hr class='thin'>";
                    echo "<div class='row cells4'>\n";
                }
            }
            if (count($items) == 0) {
                echo "<H3> Currently, No items are found in this category.</H3>";
            }
            ?>

            </div>

            <hr class="thin">
              
        </div>
            
    <?php
//		return $display;

	}
    

	public static function getItemImage($item_id){
		global $pdo;

		$sql = "SELECT image_url from item_image where item_id={$item_id} and main_image=1";
		$stm = $pdo->prepare($sql);
		$stm->execute();

		return getRootPath().$stm->fetch()['image_url'];
	}

	public static function getItemName($item_id){
		global $pdo;

		$sql = "SELECT item_name FROM items where item_id={$item_id}";
		$stm = $pdo->prepare($sql);
		$stm->execute();

		return $stm->fetch()['item_name'];
	}
}