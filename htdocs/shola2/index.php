<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/Agent.class.php';
    require_once 'php/pages/header.html.php';

    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM items JOIN item_image ON items.item_id = item_image.item_id JOIN category ON category = category_name");
    $stmt->execute();
    $items = $stmt->fetchAll();
?>

<div class ="bg-white" >
    
    <div class="carousel auto" data-role="carousel" data-controls="false" data-height="500" data-width="1500" data-effect="fade">
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
    
  <div class="grid padding30">

    <div> <H1> Discover </H1></div>

    <div class=" row cells4 ">
        
    <?php $c = 0; foreach ($items as $item) { ?>
      
        <div class="cell no-margin-top no-margin-bottom">
            <p class="fg-black">
                <?php echo "<B>Birr " . $item["price"] . '</B> - (Available: <B>' . $item["quantity"] . '</B>)' ?>
            </p>
            <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $item['id']; ?>">
              <img style="widht: 350; height: 200;" class="no-margin-top no-margin-bottom" src="<?php echo getRootPath()."img/items/" . $item['image_url']; ?>">
            </a><br/><br/>

            <p class="fg-black"><i><?php echo $item["description"]; ?></i></p>
            <p class="fg-black"><i><?php echo $item["color"]; ?></i></p>


              <div class="rating" data-role="rating"  id="demo_rating_1" data-score-title="Rating: "></div>

              <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $item['id']; ?>">
                  <input class="button rounded primary place-right" value="Shop now" style="width: 120px">
              </a>
        </div>
            
    <?php
        $c++;
        if ($c%4 == 0) {
            echo "</div><hr class='thin'>";
            echo "<div class='row cells4'>\n";
        }
    }
        if (count($items) == 0) {
            echo "<H2> Currently, No items are on sale.";
        }
    ?>
              
    </div>

    <hr class="thin">
        
</div>


    <?php

        if(isset($_GET['loginerror']))
            echo "<script>alert('User Name of Password does not match')</script>";
    ?>


    <div class="grid padding20">
        <?php
            if(userIsLoggedIn()){

        ?>
            <div class="row cells4" >
            <?php
                $item = Agent::display();
                foreach($item as $i){
                    echo '<div class="cell no-margin-top no-margin-bottom">';
                    echo '<p>'.$i['price'].'</p>';
                    echo '</div>';
                }
            ?>
        </div>

        <div class="row cells4">
             <?php
             $item = Agent::display();
                foreach($item as $i){
                    echo '<div class="cell" >';
                    echo '<a href="'.getRootPath().'php/pages/item/item_info.php?id='.$i['id'].
                    '&cid='.Category::getItemIdCat($i['id']).'">';
                    echo '<img class="no-margin-top no-margin-bottom" src="'.$i['img_url'].'">';
                    echo '</div>';
                }
            ?>
        </div>
        <?php
            }
        ?>

    </div>
    
</div>

<?php
    require_once ("php/pages/footer.html.php");
?>
