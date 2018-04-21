<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/payment/payment_functions.php';
	
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
            <a href="<?php echo getRootPath().'php/pages/payment/payment.html.php?check_box=true';?>">
                 <button class="btn btn-success btn-block btn-lg" type="submit">Agree</button></a>
            <a href="<?php echo getRootPath().'php/pages/payment/payment.html.php?check_box=false';?>">
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