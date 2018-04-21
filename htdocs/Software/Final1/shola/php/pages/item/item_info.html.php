
<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item_info.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/review/review_functions.php';
  @session_start();

  $category_list = Category::getCategoryList();

  $id = $_GET['id'];
  $cat_id = $_GET['cid'];
  $item_detail = DisplayDetails::getDetail($id);

	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
?>

<div class ="bg-white padding10" >

  <div class="padding30">
    <h1>Item Description</h1>
      <hr class="thin">
  </div>
    <div class="grid padding20">
      <div class="row cells2" >
      <div class="cell">
         <img class="no-margin-top no-margin-bottom" src="<?php echo itemClass::getItemImage($id); ?>">
      </div>
      <div class="cell">
        <div class="no-margin-top no-margin-bottom">
          <?php
            echo "<h3>Name: ".$item_detail[0]."</h3><br>";
            echo "<p>Description: ".$item_detail[1]."</p><br>";
            echo "<p style='font-weight: bold'>Price: ".$item_detail[2]."</p>";
          ?>
        </div>

        <!------------------------------ ADD TO CART ---------------------------->
          
        <div class="cell">
            
            <script type="text/javascript">
            function addToCart() {
                var url = "<?php echo getRootPath().'php/payment/add_to_cart.php?id='.$id.'&cid='.$cat_id; ?>";
                
                $.get(url, function cb(data) {
                    alert("Added to Cart.");
                });
            }
            </script>
            
            <input class="button rounded primary" value="Add To Cart" style="width:120px" onClick="addToCart();">
            <input class="button rounded primary" value="Currency Converter" onclick="showDialog('#dialogcurr')">
        </div>

        <!------------------------------ END ADD TO CART ---------------------------->
          
        <div class="cell">
            <input class="button rounded primary place-right place-bottom margin30" value="Add To Wish List"   style="width:150px">
        </div>

      </div>
    </div>


    <!---- Currency Conversion ----->

    <div data-role="dialog" id="dialogcurr">
        <script type="text/javascript">
        function convert() {
            var converter_to = document.getElementById("converter_to").value;
            var money_amount = document.getElementById("money_amount").value;
            var url = '<?php echo 'currency_converter.php?'; ?>' + 'converter_to='+converter_to+'&money_amount='+money_amount;

            $.get(url, function cb(data) {
                $("#currResult").text(data);
            });
        }
        </script>
      <div class="login-form padding20 block-shadow">
         <form>
          
             <input type="hidden" id="money_amount" name="money_amount" value="<?php echo $item_detail[2]; ?>">
             
             <h3><center>Currency Converter</center></h3>
            <table>
                <tr>
                    <td>
                        <center>Convert To:</center>
                        <select id="converter_to" name='converter_to'>
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
                            <button type='button' onClick="convert()">Convert Now</button>
                        </center>
                    </td>
                </tr>
                <tr><td><span>Converted value: <p id="currResult">anser here</p></span></td></tr>
            </table>
         </form>
        </div>
    </div>
        
    <!---- End of Currency Conversion ----->
        
       <div class="cell">
            <a href="<?php echo getRootPath().'php/help_center/askquestion.php?id='.$id?>" method="post">
              <input class="button rounded primary" value="Go To Help Center"   style="width:200px">
            </a>
            <a href="<?php echo getRootPath().'php/help_center/faqs.php?id='.$id?>" method="post">
              <input class="button rounded primary" value="FAQ"   style="width:200px">
            </a>
        </div>

    <hr class="thin">
    <div class="row">

    <h2 class="fg-black">Reviews</h2>
    <br>
    <h2 class="fg-black"></h2>
    <br>
    
        <div id="comments_div">
            <?php get_comments($id) ?>
        </div>

       <?php if(userIsLoggedIn()) { ?>
        
		<div class="page-container">

        <div>
         
        <script type="text/javascript">
            
            function reviewItem() {
                var comment = document.getElementById("comment").value;
                var new_comment = 1; //is set
                var post_info = {"comment":""+comment,"new_comment":""+new_comment,"item_id":"<?php echo $id; ?>"};
                var url = "<?php echo getRootPath().'php/review/check_com.php'; ?>";
                
                if (comment.trim() == "")
                    return;
                
                $.post(url, post_info, function cb(data) {
                    var code = $("#comments_div").html();
                    $("#comments_div").html(data+code);
                });
            }
            
        </script>
        
        <form class="main">
            <label>Enter your review:</label><BR/>
            <textarea class="form-text" name="comment" id="comment"></textarea>
            <br />
            <button type="button" class="form-submit" name="new_comment" onClick="reviewItem();">Give a Review</button>
        </form>
			
		</div>
            
        </div>
    
        <?php
            }
        ?>
      
     

    </div> 

    <!---- 
    Not Working
    <?php //require_once 'related_item_seggustion.php';?> ---->
        
    <!---- Related ITEMS ------------------------------------------------------------------------->
        
    <hr class="thin">
    <H1>Related Items</H1>
    <BR/>
        
    <div class=" row cells4 ">
        
    <?php
        //$id, $cat_id
        $cName = Category::getCatName($cat_id);
        global $pdo;
        $stmt = $pdo->prepare("select * from items join item_image on items.item_id=item_image.item_id where items.item_id != :item_id AND category=:cat order by post_date desc limit 0,4");

        $stmt->execute(["item_id"=>$id, "cat"=>$cName]);
        $items = $stmt->fetchAll();

        foreach ($items as $item) {
        ?>
        
        <div class="cell no-margin-top no-margin-bottom">
            <p class="fg-black">
                <?php echo "<B>Birr " . $item["price"] . '</B> - (Available: <B>' . $item["quantity"] . '</B>)' ?>
            </p>
            <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item["item_id"] . '&cid=' . $cat_id; ?>">
              <img style="widht: 350; height: 200;" class="no-margin-top no-margin-bottom" src="<?php echo getRootPath()."img/items/".$item['image_url'];?>">
            </a><br/><br/>

            <p class="fg-black"><i><?php echo $item["description"]; ?></i></p>
            <p class="fg-black"><i><?php echo $item["color"]; ?></i></p>


              <div class="rating" data-role="rating"  id="demo_rating_1" data-score-title="Rating: "></div>

              <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $cat_id; ?>">
                  <input class="button rounded primary place-right" value="Shop now" style="width: 120px">
              </a>
        </div>
            
    <?php
        } 
    ?>
              
    </div>

        <!---- END Related ITEMS ------------------------------------------------------------------------->
        
</div>
</div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>
