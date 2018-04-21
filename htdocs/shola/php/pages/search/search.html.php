<?php
    $title="Search";

    $root = $_SERVER['DOCUMENT_ROOT'];
    if($root[strlen($root) - 1] != "/")
        $root .= "/";

    require_once $root.'shola/php/includes/helpers_inc.php';
    require_once $root.'shola/php/classes/user.class.php';
    require_once $root.'shola/php/classes/category.class.php';
    require_once $root.'shola/php/classes/item.class.php';
    require_once $root.'shola/php/pages/header.html.php';

$data="";
$result=null;

if (isset($_GET['search'])) {
    
    $str=$_GET['search'];
    $query="SELECT * FROM items join item_image on items.item_id=item_image.item_id WHERE item_name LIKE '%$str%'";
    $result= mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    
    /**** previous display code for reference
    
    if($count>0){
          $id = array();
          while($row=mysqli_fetch_array($result)){
                $data = $data
                    .'<h4><a href="'.getRootPath()
                    .'php/pages/item/item_info.php?id='.$row['item_id'].'">'.$row['item_name'].'</a></h4>';
          }
    }
    
    else 
        $data = "<h4>There are no related items.</h4>";
        
    ******/
}
?>

<div class="padding10 bg-white">
        
  <div class="grid padding30">

    <div> <H1> Search Results </H1></div>
        
    <hr class="thin"/>

    <div class=" row cells4 ">
        
    <?php
        $c = 0; 
        $items = $result;
        
        if ($count == 0)
            echo "<H3>No Items were found.</H3>";
        
        foreach ($items as $item) {
             $cid = Category::getCatId($item['category']);
    ?>
      
        <div class="cell no-margin-top no-margin-bottom">
            <p class="fg-black">
                <?php echo "<B>Birr " . $item["price"] . '</B> - (Available: <B>' . $item["quantity"] . '</B>)' ?>
            </p>
            <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $cid; ?>">
              <img style="widht: 350; height: 200;" class="no-margin-top no-margin-bottom" src="<?php echo ItemClass::getItemImage($item['item_id']); ?>">
            </a><br/><br/>

            <p class="fg-black"><i><?php echo $item["description"]; ?></i></p>
            <p class="fg-black"><i><?php echo $item["color"]; ?></i></p>

            <div class="rating" data-role="rating"  id="rating_<?php echo $c; ?>" data-score-title="Rating: "></div>
            
            <!---- Display Rating ----->
            <script type="application/javascript">
                $(function(){
                    var rating = $("#rating_<?php echo $c; ?>").data('rating');
                    rating.value(<?php echo $item['rating']; ?>);
                });
            </script>
            
              <a href="<?php echo getRootPath() . 'php/pages/item/item_info.html.php?id=' . $item['item_id'] . '&cid=' . $cid; ?>">
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
    
</div>

<?php
    require_once $root.'shola/php/pages/footer.html.php';
?>