<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/notify.class.php';
	@session_start();


	class ReturnPolicy{

		public static function processReturn(){
			$date=getdate();
			$qty=0;
			$item_id=$_GET['id'];
			$user_id=$_SESSION['user']->getUserId();
			global $pdo;
			
			if(isset($_POST['submit'])){
				$currentDate=getdate();
				try{
					$sql="SELECT date_diff($currentDate,arrival_date) FROM shipping WHERE item_id=:itemId";
					$stmt=$pdo->prepare($sql);
					$stmt->bindValue(':itemId',$item_id);
					$stmt->execute();
					$date=$stmt->fetchObject();
				}
				catch(Exception $e){
					echo $e->getMessage();
				}
				if($date<=2){
					$buyerMessage="request denied because item has not been delivered yet!";
					echo 'sds';
					notification::addNotification($user_id,$buyerMessage);
					//send notification to buyer.retrieve buyer id from user class


				}
				else {
					if($_POST['choice']==='replacement'){
						try{
							$sql="SELECT quantity FROM items WHERE item_id=:itemId";
							$stmt=$pdo->prepare($sql);
							$stmt->bindValue(':itemId',$item_id);
							$stmt->execute();
							echo 'replacing';
							$qty=$stmt->fetchObject();
						}
						catch(Exception $e){
							echo $e->getMessage();
						}
						if($qty>=1){
							try{
								$sql="UPDATE items SET quantity=(quantity-1) WHERE item_id=:itemId";
								$stmt=$pdo->prepare($sql);
								$stmt->bindValue(':itemId',$item_id);
								$stmt->execute();
								echo 'replaced';
							}
							catch(Exception $e){
								echo $e->getMessage();
							}
							$buyerMessage="Your item will be replaced and shipped back for you soon";
							$sellerMessage="You have replaced item to a customer because of ".$_POST['problem'] ." problem.";
							//send notification to both seller and buyer.retrieve seller id using item_id and buyer id from user class
							notification::addNotification($user_id,$buyerMessage);
							notification::addNotification($user_id,$sellerMessage);
						}
						else{
							$buyerMessage="Item sold out your money will be paid to back to you";
							$sellerMessage="You have paid back to a customer because of ".$_POST['problem'] ." problem and item has sold out.";
							//send notification to both seller and buyer.retrieve seller id using item_id and buyer id from user class
							notification::addNotification($user_id,$buyerMessage);
							notification::addNotification($seller_id,$sellerMessage);

						}
					}
					else if($_POST['choice']==='refund'){
						$buyerMessage="Request confirmed your money will be paid to back to you soon";
						$sellerMessage="You have paid back to a customer because of ".$_POST['problem'] ." problem and customer requested a refund.";
						//send notification to both seller and buyer.retrieve seller id using item_id and buyer id from user class
						notification::addNotification($user_id,$buyerMessage);
						notification::addNotification($seller_id,$sellerMessage);

					}

				}
				header('Location: '.getRootPath());
			}
		}
}

?>
