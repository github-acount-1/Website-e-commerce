 <?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';    
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/payment/payment_functions.php';
	if(isset($_GET['payment_type']))
        $paymentType = $_GET['payment_type'];/******READ THIS PAYMENT TYPE FROM PARAMETER PASSED WHEN THE PAGE IS CALLED ******/
	if(isset($_GET['item_id']))
        $itemId = $_GET['item_id'];
?>
<div data-role="dialog" id="receipt_popup">
    <div class="login-form padding20 block-shadow">
        <form action = "" method="post">
            <h1 class="text-light">Receipt</h1>
            <hr class="thin"/>
            <br />
            <h1 class="text-light"><?php displayReceipt($paymentType,  $pdo); ?></h1>
            <br />
            <div class="form-actions">
                <button onclick="closeDialog('#receipt_popup')" type="button" class="button link">Cancel</button>
            </div>
        </form>
    </div>