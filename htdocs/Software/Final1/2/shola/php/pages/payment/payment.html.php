<?php
    $title="Payment";
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';    
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/payment/payment_functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/notify.class.php';
    session_start();

    if(!userIsLoggedIn()){
        header("Location: ".getRootPath());
    }

    if (!isset($item_id) or !isset($payment_type)) {
        header("Location: ".getRootPath());
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/header.html.php';

	$username = $_SESSION['user']->getUserName(); /****** READ THIS USER NAME FROM $_SESSION VARIABLE HAYELOM HAS PROVIDED *******/
	$userId = $_SESSION['user']->getUserId();/*****READ THIS USER ID FROM $_SESSION VARIABLE HAYELOM HAS PROVIDED ****/
    if(isset($_GET['item_id']))
    	$itemId = $_GET['item_id'] ;/*****READ THIS ITEM ID FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ****/
    if(isset($_GET['payment_type']))
        $paymentType = $_GET['payment_type'];/******READ THIS PAYMENT TYPE FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ******/
    if(isset($_GET['resolve_money']))
    	$resolve_money = $_GET['resolve_money'];/******READ THIS MONEY AMOUNT FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ******/
	else $resolve_money =0;
	if(isset($_GET['check_box']))
        $check = $_GET['check_box'];/******READ THIS CHECK BOX STATUS FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ******/
    else $check = false;
	if(isset($_GET['item_quantity']))
		$itemQuantity = $_GET['item_quantity'];/******READ THIS ITEM QUANTITY FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ******/
	else $itemQuantity = 1;
	$forwardPage = false;
	/***********SPLIT PAY CHECK BOX DISABLING*****************/
	//Diable checkbox
	//$checkbox = isset($_POST['mycheckbox']) ? $_POST['mycheckbox']:0; 
	//$disable=true;
	/********************************************************/
	
	function identifyRedirect($payment_type, $destin_id, $resolve_money, $check, $forwardPage, $quantity, $pdo){
		if(1==1){
			$path = getRootPath().'php/pages/payment/payment.html.php?payment_type='.$payment_type.'&item_id='.$destin_id.'&resolve_money='.$resolve_money.'&check_box='.$check.'&item_quantity='.$quantity;
		}
		elseif($payment_type == 0 || $payment_type == 8){
			$id = getItemCategory($destin_id, $pdo);
			//redirect to category page
			$path = getRootPath().'php/pages/item/category_display.html.php?id='.$id;
		}
		elseif($payment_type == 1){
			//redirect to home page
			$path = getRootPath();
		}
		elseif($payment_type == 2 || $payment_type == 3 || $payment_type == 4){
			//redirect to auction page
			$path = getRootPath();
		}
		elseif($payment_type == 5){
			//redirect to notifications page
			$path = getRootPath().'php/pages/dashboard/notifications.html.php';
		}
		elseif($payment_type == 6 || $payment_type == 7){
			$path = getRootPath().'php/pages/dashboard/resolve_debt.html.php';
		}
		return $path;
	}
	
    if (isset($_POST["credit_card"]) and isset($_POST["expiration_date"]) and isset($_POST["security_code"])) {

        $credit_card = $_POST['credit_card'];
        $security_code = $_POST['security_code'];
        $expiration_date = $_POST['expiration_date'];       
		
		switch (verifyCreditCard($credit_card, $expiration_date, $security_code, $pdo_bank)) {
            case 1:
                $err = "Credit Card not found.";
                break;
            case 2:
                $err = "Wrong Expiration Date or Card has expired.";
                break;
            case 3:				  
			  saveCreditCard( $userId, $credit_card, $expiration_date, $pdo);
			  if( !checkItemQuantity($itemId, $pdo)){
				  $err = "This item is sold out.";
				  break;
			  }
			  //IF RESOLVE DEBT IS BEING USED
			  if($paymentType==7){					  
				$money = $resolve_money;
				if(checkBalance($credit_card, $money, $pdo_bank) == 1){
					$err = "Insufficenit Balance.";
					break;
				}
				resolveDebt($money, $credit_card, $itemId, $pdo_bank, $pdo);					
			  }
              // IF SPLIT PAY, REFUND, OR OTHER PAYMENT IS BEING USED
			  else{ 
				/*****CALCULATE MONEY FROM  ADDING SHIPMENT FEE FROM SHIPPING TABLE WITH ITEM PRICE FROM ITEMS TABLE****/
				$money = totalPrice($itemId, $pdo);
				if(checkBalance($credit_card, $money, $pdo_bank) == 1){
					$err = "Insufficenit Balance.";
					break;
				}
				// IF SPLIT PAY IS USED
				if(canSplitPay($itemId,$check,$pdo)){
					//MONEY TRANSACTION HAPPENS BELOW
					splitPay($money, $credit_card, $itemId, $pdo_bank, $pdo);
					//RECEIPT IS MADE AND SYSTEM IS NOTIFIED
					makeReceipt($money, $userId, $itemId, $paymentType, $itemQuantity, $pdo);
				  }
				// IF SPLIT PAY IS NOT BEING USED
				else{
					//MONEY TRANSACTION HAPPENS BELOW
					moneyDistribution($money, $credit_card, $itemId, $paymentType, $itemQuantity, $pdo_bank, $pdo);
					//RECEIPT IS MADE AND SYSTEM IS NOTIFIED
					makeReceipt($money, $userId, $itemId, $paymentType, $itemQuantity, $pdo);
				}
			  }	
				$forwardPage = true;
                $succ = "Payment Successful.";
				//$err = "Wrong Security Code.";
                break;
            case 0:			
                $succ = "Payment Successful.";
                break;
        }
       
    }

?>
    <div class="container">
        <div class="row .payment-dialog-row">
            <div class="col-md-4 col-md-offset-4 col-xs-12">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="panel-title-text">Payment Details </span>
                            <img class="img-responsive panel-title-image" src="<?php echo getRootPath().'img/accepted_cards.png';?>"></h3></div>
                    <div class="panel-body">
                        <form action="<?php echo identifyRedirect($paymentType, $itemId, $resolve_money, $check, $forwardPage, $itemQuantity, $pdo);?>" method="post" id="payment-form">

                                
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="pull-right label-success control-label" for="cardNumber">
                                            <?php if (isset($username)) echo $username; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="<?php if (!isset($err)) echo "hide" ?> row">
                                <div class="col-xs-12">
                                    <div class="alert alert-danger form-group">
                                        <label>
                                            <?php if (isset($err)) echo $err; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="<?php if (!isset($succ)) echo "hide" ?> row">
                                <div class="col-xs-12">
                                    <div class="alert alert-success form-group">
                                        <label>
                                            <?php if (isset($succ)) echo $succ; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="cardNumber">Card number </label>
                                        <div class="input-group">
                                            <input class="form-control" name="credit_card" type="tel" required="" placeholder="Valid Card Number" id="cardNumber" value="<?php echo autoFill($userId, 0, $pdo_bank, $pdo);?>">
                                            <div class="input-group-addon"><span><span class="fa fa-credit-card"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="couponCode">Expiration Date</label>
                                        <input class="form-control" type="date" id="couponCode" name='expiration_date' value='<?php echo autoFill($userId, 1, $pdo_bank, $pdo);?>'>
                                    </div>
                                </div>
								
								
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="couponCode">Security code</label>
                                        <input class="form-control" type="password" id="couponCode" name='security_code'>
                                    </div>
                                </div>
								
								
                            </div>
                            
                            <div class ="row">
								<div class="col-xs-12">
								<?php if(isset($_GET['check_box'])) $checkbox= $_GET['check_box'];
									else $checkbox = false;
								?>
									<div class="<?php if(!$checkbox) echo 'disable';?>">
										<label>
										<!--document.getElementById("checkbox_id").disable = true; -->										
										<input type="checkbox" name="mycheckbox" id='mycheckbox' value="">Use Split pay. 
										<a href="#" onclick="showDialog('#terms_dialog')">Terms of policy</a></label>	
										
									</div>
								</div>
							</div>

                            <div class="row">
                                <div class="col-xs-12">
									<button class="btn btn-success btn-block btn-lg" type="submit">Pay UP</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div data-role="dialog" id="terms_dialog">
    <div class="login-form padding20 block-shadow">
        <form action = "<?php echo getRootPath().'php/pages/payment/payment.html.php?payment_type='.$paymentType.'&item_id='.$itemId.'&check_box=true&resolve_money='.$resolve_money;?>" method="post">
            <h1 class="text-light">Terms of agreement</h1>
            <hr class="thin"/>
            <br />
            <h1 class="text-light">Click agree if you accept the terms</h1>
            <br />
            <div class="form-actions">
				<!--If agree is clicked activate check_box-->
                <button type="submit" class="button primary">Agree</button>
                <button onclick="closeDialog('#terms_dialog')" type="button" class="button link">Cancel</button>
            </div>
        </form>
    </div>	
</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/footer.html.php';
?>