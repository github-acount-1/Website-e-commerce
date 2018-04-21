<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    if(!userIsLoggedIn()){
        header('Location: '.getRootPath());
        exit();
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
?>
<div class ="bg-white" >
    <div class="grid">

        <div class="row cells5">
            <div class="cell">
                <h3>Shopping Cart</h3>
            </div>
            <div class="cell">
                <h4 class="fg-grayLight">Price</h4>
            </div>
            <div class="cell">
                <h4 class="fg-grayLight">Quantity</h4>
            </div>
            <div class="cell">
            </div>
            <div class="cell">
                <h4 class="fg-grayLight">Total</h4>
            </div>
        </div>

        <hr class="thin fg-yellow bg-yellow"/>


        <div class="row cells5">
            <div class="cell">
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
            <div class="cell">
                <form>
                    <input type="number" value="1" min="1" >
                </form>
            </div>
            <div class="cell">
                <input class="button rounded   primary" value="Remove"  id="p" style="width:90px">
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
        </div>


        <div class="row cells5">
            <div class="cell">
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
            <div class="cell">
                <form>
                    <input type="number" value="1" min="1" >
                </form>
            </div>
            <div class="cell">
                <input class="button rounded   primary" value="Remove"  id="p" style="width:90px">
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
        </div>


        <div class="row cells5">
            <div class="cell">
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
            <div class="cell">
                <form>
                    <input type="number" value="1" min="1" >
                </form>
            </div>
            <div class="cell">
                <input class="button rounded   primary" value="Remove"  id="p" style="width:90px">
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
        </div>


        <div class="row cells5">
            <div class="cell">
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
            <div class="cell">
                <form>
                    <input type="number" value="1" min="1" >
                </form>
            </div>
            <div class="cell">
                <input class="button rounded   primary" value="Remove"  id="p" style="width:90px">
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
        </div>


        <div class="row cells5">
            <div class="cell">
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
            <div class="cell">
                <form>
                    <input type="number" value="1" min="1" >
                </form>
            </div>
            <div class="cell">
                <input class="button rounded   primary" value="Remove"  id="p" style="width:90px">
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
        </div>



        <div class="row cells5">
            <div class="cell">
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
            <div class="cell">
                <form>
                    <input type="number" value="1" min="1" >
                </form>
            </div>
            <div class="cell">
                <input class="button rounded   primary" value="Remove"  id="p" style="width:90px">
            </div>
            <div class="cell">
                <span>$2378.99</span>
            </div>
        </div>

        <a href = "<?php echo getRootPath().'php/pages/payment/payment.html.php';?>"><h1>Buy</h1></a>


    </div>
</div>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>
