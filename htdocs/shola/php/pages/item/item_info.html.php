<?php
    $title="Item Information";

    $root = $_SERVER['DOCUMENT_ROOT'];
    if($root[strlen($root) - 1] != "/")
        $root .= "/";

    require_once $root.'shola/php/includes/helpers_inc.php';
    require_once $root.'shola/php/classes/item_info.class.php';
    require_once $root.'shola/php/classes/item.class.php';
    require_once $root.'shola/php/classes/user.class.php';
    require_once $root.'shola/php/classes/wish_list.class.php';
    require_once $root.'shola/php/classes/category.class.php';
    require_once $root.'shola/php/includes/db_inc.php';
    require_once $root.'shola/php/review/review_functions.php';

    // for updating item rating in the background
    if (isset($_POST["get_rating"])) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT rating FROM items where item_id = :item_id");
        $stmt->execute(["item_id" => $id]);
        $rows = $stmt->fetchAll();
        echo $rows['rating'];
        exit();
    }

    @session_start();

    $category_list = Category::getCategoryList();

    $id = $_GET['id']; // item id
    $cat_id = $_GET['cid']; // category id
    $item_detail = DisplayDetails::getDetail($id);

    $wish_item = new WishList($_SESSION['user']->getUserId(), $id);
    if(isset($_POST['added_to_wl'])){
        $wish_item->addToWishList();
        $name = itemClass::getItemName($id);
        echo "<script>alert('{$name} added to wish list')</script>";
        header("Location: ".$_SERVER['PHP_SELF'].'?id='.$id.'&cid='.$cat_id, true, 303);
    }

    require_once $root.'shola/php/pages/header.html.php';
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
          ?>
            
            <div class="rating" data-role="rating"  id="rating" data-score-title="Rating: "></div>
            <br><br><br>
            
            <!---- Display Rating --- -->
            <script type="application/javascript">
                $(function(){
                    var rating = $("#rating").data('rating');
                    rating.value(<?php echo $item_detail[4]; ?>);
                });
            </script>
            
          <?php
            echo "<p><b>Description:</b> ".$item_detail[1]."</p><br>";
            echo "<p style='font-weight: bold'>Price: ".$item_detail[2]." Birr</p>";
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
          
        <?php 
            if(!$wish_item->inWishList()){
        ?>
                <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id.'&cid='.$cat_id;?>" method="post">
                    <div class="cell">
                        <input type="hidden" name="added_to_wl" value="true">
                        <input class="button rounded primary place-right place-bottom margin30" 
                        type="submit" value="Add To Wish List"   style="width:150px">
                    </div>
                </form>
        <?php
            }
        ?>

      </div>
    </div>


    <!---- Currency Conversion --- -->

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
        
    <!---- End of Currency Conversion --- -->
        
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
            <?php get_comments($id); ?>
        </div>

       <?php if(userIsLoggedIn()) { ?>
        
		<div class="page-container">

       <?php
            global $pdo;
            $stmt = $pdo->prepare("SELECT item_id the_count FROM parents where item_id = :item_id and user = :user");
            $stmt->execute(["item_id" => $id, "user" => $_SESSION['user']->getUserName()]);
            $rows = $stmt->fetchAll();

            if (count($rows) == 0) {
                // Only display review box if the user has not rated this item before
       ?>
        <div id="review_area">
         
        <script type="text/javascript">
            
            function reviewItem() {
                var comment = document.getElementById("comment").value;
                var new_comment = 1; //is set
                var rating_value = $("#rating_review").data('rating').value();
                var post_info = {"rating_value":""+rating_value,"comment":""+comment,"new_comment":""+new_comment,"item_id":"<?php echo $id; ?>"};
                var url = "<?php echo getRootPath().'php/review/check_com.php'; ?>";

                if (comment.trim() == "") {
                    alert ("Please enter a review.");
                    return;
                } else if (rating_value == 0) {
                    alert ("Please rate the item first.");
                    return;
                }
                
                $.post(url, post_info, function cb(data) {
                    var code = $("#comments_div").html();
                    $("#comments_div").html(data+code);
                    $("#review_area").hide();
                    $("#review_first").hide();
                });
            }
            
        </script>
        
        <div>
        <form method="post">
            <label>Enter your review:</label><BR/>
            <textarea class="form-text" name="comment" id="comment"></textarea>
            <br /><br />
            <div class="rating" data-role="rating"  id="rating_review" data-score-title="Rating: "></div>
            <br /><br />
            <button type="button" class="form-submit" name="new_comment" onClick="reviewItem();">Give a Review</button>
        </form>
        </div>
        <?php } ?>
	
        </div>
    
        <?php
            }
        ?>
     

    </div> 

    <!---- 
    Not Working related item suggestion.php
    <?php //require_once 'related_item_seggustion.php';?> -- -->
        
    <!---- Related ITEMS ----------------------------------------------------------------------- -->
        
    <hr class="thin">

    <?php
        //$id, $cat_id
        $cName = Category::getCatName($cat_id);
        global $pdo;
        $stmt = $pdo->prepare("select * from items join item_image on items.item_id=item_image.item_id where items.item_id != :item_id AND category=:cat order by rating desc limit 0,4");

        $stmt->execute(["item_id"=>$id, "cat"=>$cName]);
        $items = $stmt->fetchAll();
        
        if (count($items) != 0)
            echo "<h2 class='fg-black'>Related Items</h2>";
    ?>

    <div class="row padding30 cells4">
        
    <?php
        $c = 0;
        foreach ($items as $item) {
        ?>
        
        <div class="cell no-margin-top no-margin-bottom">
            <p class="fg-black">
                <?php echo "<B>Birr " . $item["price"] . '</B> - (Available: <B>' . $item["quantity"] . '</B>)' ?>
            </p>
            <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item["item_id"] . '&cid=' . $cat_id; ?>">
              <img style="widht: 350; height: 200;" class="no-margin-top no-margin-bottom" src="<?php echo ItemClass::getItemImage($item['item_id']); ?>">
            </a><br/><br/>

            <p class="fg-black"><i><?php echo $item["description"]; ?></i></p>
            <p class="fg-black"><i><?php echo $item["color"]; ?></i></p>

            <div class="rating" data-role="rating"  id="rating_<?php echo $c; ?>" data-score-title="Rating: "></div>
            
            <!---- Display Rating --- -->
            <script type="text/javascript">
                $(function(){
                    var rating = $("#rating_<?php echo $c; ?>").data('rating');
                    rating.value(<?php echo $item['rating']; ?>);
                });
            </script>
            
              <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $cat_id; ?>">
                  <input class="button rounded primary place-right" value="Shop now" style="width: 120px">
              </a>
        </div>
            
    <?php
        $c++;
        }
    ?>
              
    </div>

        <!---- END Related ITEMS ----------------------------------------------------------------------- -->
        
</div>
</div>

<?php
    require_once $root.'shola/php/pages/footer.html.php';
?>
