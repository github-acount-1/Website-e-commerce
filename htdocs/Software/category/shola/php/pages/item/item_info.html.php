
<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item_info.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/review/review_functions.php';
  @session_start();

  $category_list = Category::getCategoryList();

  $id = $_GET['id'];
  $cat_id = $_GET['cid'];
  $item_detail = DisplayDetails::getDetail($id);

  if(isset($_POST['submit_converter'])) {
        global $con;
        $converted_to = $_POST['converter_to'];
        $price_to_be_converted  = isset($_POST['money_amount']) ? $_POST['money_amount'] : null;

        $query="select country_name,rate FROM currencyconvertertable WHERE country_name='".$converted_to."'";
        $result=mysqli_query($con,$query);
        $count = mysqli_num_rows($result);


        if($count > 0){
          while($row = mysqli_fetch_array($result)){
            $converted = $row['rate'] * $price_to_be_converted;
            echo "<script>alert('Converted: ".$converted."')</script>";
          } 
        }
    }
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
        #box
        {
            width:300px;
            height:200px;
            margin:0px auto;
            border:2px solid blue;
            display: none;
        }
        h2{
            text-align: center;
        }
        table{
            margin:0px auto;
        }

        #converted_amount {
            font-size: 20px;
            font-weight: bold;
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
            <input class="button rounded primary place-right place-bottom margin30" value="Add To Wish List"   style="width:150px">
        </div>

      </div>
    </div>



    <div data-role="dialog" id="dialogcurr">
      <div class="login-form padding20 block-shadow">
         <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id.'&cid='.$cat_id;?>" method="post" id="converter_form">
          <input type="hidden" name="money_amount" value="<?php echo $item_detail[2]; ?>">
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

       <div class="cell">
            <a href="<?php echo getRootPath().'php/help_center/askquestion.php?id='.$id?>" method="post">
              <input class="button rounded primary" value="Go To Help Center"   style="width:200px">
            </a>
        </div>

    <hr class="thin">
    <div class="row">

    <h2 class="fg-black">Reviews</h2>
    <br>
    <h2 class="fg-black"></h2>
    <br>
      <?php get_comments();
      ?>
      
     <form action="<?php echo getRootPath().'php/review/review.php'; ?>" method="post" calss="main">
      <br>
      <input type="submit" class="from-submit" name="new-comment" value="Give A Review">
    </form>

    </div> 

    <?php require_once 'related_item_seggustion.php';?>

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
</div>
</div>
  </div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>
