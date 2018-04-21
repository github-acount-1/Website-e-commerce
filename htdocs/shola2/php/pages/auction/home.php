<?php
	session_start();
	require("functions.php");
	require("htmls.php");
    require ('shola/php/includes/db_inc.php');

	
	$query = mysql_query("SELECT * FROM products WHERE status = 0") or die (mysql_error());
	while($row = mysql_fetch_array($query))
	{
		$datenow = date("Y-m-d");
		$duedate = $row['due_date'];
		$prodid = $row['product_id'];
		if($datenow >= $duedate){
			mysql_query("UPDATE products SET status = 1 WHERE product_id = '$prodid'") or die (mysql_error());
		}
	}
	headhtml();
?>
  <div id="main_content">
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="home.php" class="nav1">Home</a></li>
        <li class="divider" ></li>

        <li class="divider" ></li>
        <li><a href="prodcateg.php" class="nav2">Products</a></li>
        
        <li class="divider"></li>
       
        <li class="divider"></li>
<?php account(); ?>
<script type='text/javascript'>
	jQuery(document).ready( function() {
		jQuery('.nav3').hide();
		jQuery('.nav4').click( function() {
			jQuery('.nav3').toggle('fade');	
		});
	});
</script>
      </ul>
      <div class="right_menu_corner"></div>
    </div>
    <!-- end of menu tab -->
    
    <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
   	<div class="left_content"> 
      
      <ul class="left_menu"> 
    <?php
			//categories();
			logform();
	?>
      <div class="title_box"></div>
      <div class="border_box">
        
        <a href="http://all-free-download.com/free-website-templates/" class="join"></a> </div>
      <div class="banner_adds"> <a href="#"><img src="" alt="" border="0" /></a> </div>
    </div>
    <!-- end of left content -->
    <div class="center_content">
      <div class="center_title_bar">Products On Bid</div>
     	<?php
	  		latest();
		?>
    </div>
    <!-- end of center content -->

 
<a href="http://localhost/a/auto_bid.php" target="_blank"><p style="font-size:300%;" >automatically bid</a>

<a href="http://localhost/onlinebiddingsystem/Administrator/add_prodven.php" target="_blank"><p style="font-size:300%;" >Seller Page</a>


    <!-- end of right content -->
  </div>
  <!-- end of main content -->
<?php foothtml(); ?>
