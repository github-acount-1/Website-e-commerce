<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';    
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/payment/payment_functions.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/notify.class.php';
    session_start();

    if(!userIsLoggedIn()){
        header("Location: ".getRootPath());
    }
	if(isset($_GET['item_id']))
    	$itemId = $_GET['item_id'] ;/*****READ THIS ITEM ID FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ****/
    if(isset($_GET['payment_type']))
        $paymentType = $_GET['payment_type'];/******READ THIS PAYMENT TYPE FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ******/
    if(isset($_GET['resolve_money']))
    	$resolve_money = $_GET['resolve_money'];/******READ THIS MONEY AMOUNT FROM PARAMETER PASSED WHEN PAYMENT PAGE IS CALLED ******/

	/***********SPLIT PAY CHECK BOX ENABLING*****************/
	//Enable checkbox
	//$checkbox = isset($_POST['mycheckbox']) ? $_POST['mycheckbox']:0; 
	//$disable=false;
	/********************************************************/
?>
    <div class="container">
        <div class="row .payment-dialog-row">
			<div class="col-xs-6">
				<label><h1>By clicking agree you are willing to take the consiquency of...</h1></label>
			</div>
			<div class="col-xs-12">
			<!--document.getElementById("checkbox_id").disable = false; -->
            <a href="<?php echo getRootPath().'php/pages/payment/payment.html.php?payment_type='.$paymentType.'&item_id='.$itemId.'&resolve_money=1000&check_box=true';?>">
                 <button class="btn btn-success btn-block btn-lg" type="submit">Agree</button></a>
            <a href="<?php echo getRootPath().'php/pages/payment/payment.html.php?payment_type='.$paymentType.'&item_id='.$itemId.'&resolve_money=1000&check_box=false';?>">
                <button class="btn btn-success btn-block btn-lg" type="submit">cancle</button>
            </a>
				 

            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>