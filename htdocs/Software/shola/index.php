<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Software/shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/Software/shola/php/classes/user.class.php';
    require_once '/php/pages/header.html.php';
?>

<div class ="bg-white" >
    
    <div class="carousel auto" data-role="carousel" data-controls="false" data-height="400" data-effect="fade">
          <div class="slide" >
            <img class="no-margin-top no-margin-bottom" src="<?php echo getRootPath().'img/image alt.jpg';?>"  >
          </div>
          <div class="slide">
            <img class="no-margin-top no-margin-bottom" src="<?php echo getRootPath().'img/macbook.jpg';?>" >
          </div>
          <div class="slide">
            <img class="no-margin-top no-margin-bottom" src="<?php echo getRootPath().'img/apple.jpg';?>" >
          </div>
        </div>
    <div class="padding20">

        <h1>Discover </h1>

    </div>

    <?php
        if(userIsLoggedIn())
            echo "<h1>User: ".$_SESSION['user']->getName()."</h1>";

        if(isset($_GET['loginerror']))
            echo "<script>alert('User Name of Password does not match')</script>";
    ?>


    <div class="grid padding20">

        <div class="row cells4" >
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
        </div>

        <div class="row cells4">
            <div class="cell" >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell"  >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell"  >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/macbook.jpg">
                </a>
            </div>
            <div class="cell"  >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
        </div>


        <div class="row cells4">
            <div class="cell"  >
                <p>iphone apple 4s and tablets</p>
            </div>
            <div class="cell">
                <p>iphone apple 4s and tablets</p>
            </div>
            <div class="cell">
                <p>iphone apple 4s and tablets</p>
            </div>
            <div class="cell"  >
                <p>iphone apple 4s and tablets</p>
            </div>
        </div>
        <hr class="thin">
        <div class="row cells4" >
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
            <div class="cell no-margin-top no-margin-bottom"   >
                <p>$15000 Birr</p>
            </div>
        </div>



        <div class="row cells4">
            <div class="cell"  >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell"  >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/macbook.jpg">
                </a>
            </div>
            <div class="cell"  >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/apple.jpg">
                </a>
            </div>
            <div class="cell"  >
                <a href="item.php">
                    <img class="no-margin-top no-margin-bottom" src="img/macbook.jpg">
                </a>
            </div>

            <div class="row cells4">
                <div class="cell"  >
                    <p>iphone apple 4s and tablets</p>
                </div>
                <div class="cell">
                    <p>iphone apple 4s and tablets</p>
                </div>
                <div class="cell">
                    <p>iphone apple 4s and tablets</p>
                </div>
                <div class="cell"  >
                    <p>iphone apple 4s and tablets</p>
                </div>
            </div>

        </div>

    </div>
</div>

<?php
    require_once ("php/pages/footer.html.php");
?>
