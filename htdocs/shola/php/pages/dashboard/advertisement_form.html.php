<?php
	$title="Advertisement Form";
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';    
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/notify.class.php';
    session_start();

    if(!userIsLoggedIn()){
        header("Location: ".getRootPath());
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/header.html.php';

	$username = $_SESSION['user']->getUserName();
	$userId = $_SESSION['user']->getUserId();
	
	if(isset($_GET['item_id']))
    	$itemId = $_GET['item_id'] ;
	else $itemId = null;
	//fetch advertisment_price 
	$stmt = $pdo->prepare("SELECT cost_per_hour from shola_info");
	$stmt->execute([]);
	$costperHour = $stmt->fetchAll();
	$price= $costperHour[0]["cost_per_hour"];
		if (isset($_POST["item_id"]) and isset($_POST["show_date"]) and isset($_POST["end_date"])){
						
			$itemId = $_POST['item_id'];
			$showDate = $_POST['show_date'];  
			$endDate = $_POST['end_date'];
			
			
			//insert ad into table
			$stmt = $pdo->prepare("INSERT INTO advertisement( user_id, item_id, show_date, end_date, advertisement_price) 
									VALUES(\"$userId\", \"$itemId\",\"$showDate\",\"$endDate\",
									\"$price\" )");
			$stmt->execute([]);		
		
		}
	
?>
<div class="container">
        <div class="row .payment-dialog-row">
            <div class="col-md-4 col-md-offset-4 col-xs-12">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading">
						<div class="panel-body">
							
							<form method="post" action="<?php getRootPath().'php/pages/payment/payment.html.php?payment_type=1&item_id='.$itemId;?>">
							<div class="<?php if (!isset($err)) echo "hide" ?> row">
                                <div class="col-xs-12">
                                    <div class="alert alert-danger form-group">
                                        <label>
                                            <?php if (isset($err)) echo $err; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
                                        <label class="pull-right label-success control-label" for="cardNumber">
                                            <?php if (isset($username)) echo $username; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
							<p>Price Per Day: <?php echo $price; ?></p>
							<p>Item:<?php
								$stmt = $pdo->prepare("SELECT item_id, item_name from items where uploader_id=:user_id");
								$stmt->execute(["user_id"=>$userId]);
								$items = $stmt->fetchAll();
								if($items == null){
									$err = "You don't own an item currently.";
								}
								else{
								//List the following items in a drop down selection input
									for($i=0; $i<count($items);$i++){
										$items[$i]["item_name"];
										$items[$i]["item_id"];
									}
								}
								?></p>
							<p>Item image:<?php //browse the image?></p>
							<div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="cardNumber">Item text</label>
                                        <div class="input-group">
                                            <input class="form-control" name="credit_card" type="tel" required="" placeholder="ad image rapper text" id="cardNumber" value="">
                                            <div class="input-group-addon"><span><span class="fa fa-credit-card"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="couponCode">Start Date</label>
                                        <input class="form-control" type="date" id="couponCode" name='expiration_date' value=''>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="couponCode">End Date</label>
                                        <input class="form-control" type="date" id="couponCode" name='expiration_date' value=''>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">
                                        <label class="pull-right label-success control-label" for="cardNumber">
                                            <?php $price=$price*2;//REPLACE THIS HARD CODE WITH DURATION OF AD(END_DATE-START_DATE)
												echo $price; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-xs-12">
									<button class="btn btn-success btn-block btn-lg" type="submit">Continue</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/footer.html.php';
?>