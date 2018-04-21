
<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item_info.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
  @session_start();

  $category_list = Category::getCategoryList();

  $id = $_GET['id'];
  $cat_id = $_GET['cid'];
  $item_detail = DisplayDetails::getDetail($id);
?>
<html>
<head>
    <title>Item Info</title>
    <link href="<?php echo getRootPath().'css/metro.css'; ?>" rel="stylesheet">
    <link href="<?php echo getRootPath().'css/metro-icons.css'; ?>" rel="stylesheet">
    <script src="<?php echo getRootPath().'js/jquery-2.1.3.min.js'; ?>"></script>
    <script src="<?php echo getRootPath().'js/metro.js'; ?>"></script>
    <style>
        #log_out_but{
            border: none;
            background-color: inherit;
        }
    </style>
</head>
<body class="bg-darker">

<div class ="bg-white" >




  <div class="padding30">
    <h1>Item Description</h1>
      <hr class="thin">
  </div>
    <div class="grid padding20">
      <div class="row cells2" >
      <div class="cell">
         <img class="no-margin-top no-margin-bottom" src="<?php echo $item_detail[3]; ?>">
      </div>
      <div class="cell">
        <div class="no-margin-top no-margin-bottom">
          <?php
            echo "<h3>Name: ".$item_detail[0]."</h3><br>";
            echo "<p>Description: ".$item_detail[1]."</p><br>";
            echo "<p style='font-weight: bold'>Price: ".$item_detail[2]."</p>";
          ?>

        </div>

        <div class="cell">
            <a href="<?php echo getRootPath().'php/payment/add_to_cart.php?id='.$id.'&cid='.$cat_id; ?>" method="post">
              <input class="button rounded primary" value="Add To Cart"   style="width:120px">
            </a>
            <a href="#" onclick="showDialog('#dialogcurr')">
           <input class="button rounded primary place-right" value="Currency Converter"  >
             </a>
        </div>

        <div class="cell">
          <a href="cart.php">
            <input class="button rounded primary place-right place-bottom margin30" value="Add To Wish List"   style="width:150px">
        </div>

      </div>
    </div>



    <div data-role="dialog" id="dialogcurr">
      <div class="login-form padding20 block-shadow">
         <form action="" method="post" id="converter_form">
        <h3><center>Currency Converter</center></h3>
        <table>
            <tr>
                <td>
                    <center>Convert To:</center>
                    <select name='converter_to'>
                        <option value="ETB"selected >Ethiopia Birr(ETB)</option>
                        <option value="USD">US Dollar(USD)</option>
                        <option value="EUR">Euro (EUR)</option>
                        <option value="GBP">British Pound(GBP)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <p id="converted_amount"><?= $converted; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <center>
                        <input type='submit' name='submit_converter' value="CovertNow">
                    </center>
                </td>
            </tr>
        </table>
    </form>    
        </div>
    </div>

    <div class="row cells10" >
    <div class="cell">
       <img class="no-margin-top no-margin-bottom" src="img/car1.jpg">
    </div>
    <div class="cell">
       <img class="no-margin-top no-margin-bottom" src="img/car2.jpg">
    </div>
    <div class="cell">
       <img class="no-margin-top no-margin-bottom" src="img/car1.jpg">
    </div>
    <div class="cell">
       <img class="no-margin-top no-margin-bottom" src="img/car2.jpg">
    </div>
    </div>


          <!--
           <a href="#" onclick="showDialog('#dialog')">Currency Converter</a>
-->



<!-- <hr class="thin">
<h2 class="fg-black">Related Items</h2>
<br>
<div class="row cells4 no left-margin   ">
    <div class="cell no-margin-top no-margin-bottom"   >
      <p class="fg-black">15000 Birr</p>
        <a href="item.php">
          <img class="no-margin-top no-margin-bottom  padding5" src="img/apple.jpg">
        </a>
          <p class="fg-black">iphone apple 4s and tablets</p>
          <p class="fg-black">Black and Gold color</p>
    <div class="rating" data-role="rating"  id="demo_rating_1" data-score-title="Rating: "></div>
    <a href="item.php">
      <input class="button rounded primary place-right" value="Shop now"   style="width:97px">
    <a>
  </div>
  <div class="cell no-margin-top no-margin-bottom no-margin-left margin5"   >
    <p class="fg-black">15000 Birr</p>
      <a href="item.php">
        <img class="no-margin-top no-margin-bottom padding5  " src="img/apple.jpg">
      </a>
      <p class="fg-black">iphone apple 4s and tablets</p>
      <p class="fg-black">Black and Gold color</p>
      <div class="rating" data-role="rating"  id="demo_rating_1" data-score-title="Rating: "></div>
      <a href="item.php">
      <input class="button rounded primary place-right" value="Shop now"   style="width:97px">
    <a>
  </div>
  <div class="cell no-margin-top no-margin-bottom  padding5"   >
    <p class="fg-black">15000 Birr</p>
    <a href="item.php">
      <img class="no-margin-top no-margin-bottom    " src="img/apple.jpg">
    </a>
    <p class="fg-black">iphone apple 4s and tablets</p>
    <p class="fg-black">Black and Gold color</p>
    <div class="rating" data-role="rating"  id="demo_rating_1" data-score-title="Rating: "></div>
    <a href="item.php">
      <input class="button rounded primary place-right" value="Shop now"   style="width:97px">
    <a>
  </div>
  <div class="cell no-margin-top no-margin-bottom padding5"   >
    <p class="fg-black">15000 Birr</p>
    <a href="item.php">
      <img class="no-margin-top no-margin-bottom     " src="img/apple.jpg">
    </a>
    <p class="fg-black">iphone apple 4s and tablets</p>
    <p class="fg-black">Black and Gold color</p>
    <div class="rating" data-role="rating"  id="demo_rating_1" data-score-title="Rating: "></div>
    <a href="item.php">
      <input class="button rounded primary place-right" value="Shop now"   style="width:97px">
    <a>
  </div>

</div> -->






</div>
</div>
  </div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>
