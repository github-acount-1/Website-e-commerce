<?php
	session_start();
	require("functions.php");
	require("htmls.php");
    require ('shola/php/includes/db_inc.php');
	headhtml();
?>
  <div id="main_content">
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="home.php" class="nav2">Home</a></li>
        <li class="divider" ></li>
        <li><a href="prodcateg.php" class="nav1">Bidding Items</a></li>
        <li class="divider"></li>
        
        <li class="divider"></li>
		<?php account(); ?>
      </ul>
<script type='text/javascript'>
	jQuery(document).ready( function() {
		jQuery('.nav3').hide();
		jQuery('.nav4').click( function() {
			jQuery('.nav3').toggle('fade');	
		});
	});
</script>
      <div class="right_menu_corner"></div>
    </div>
    <!-- end of menu tab -->
    
    <div class="crumb_navigation"> Navigation: <span class="current">Home</span> </div>
   	<div class="left_content">   
    <?php
		logform(); 
	?>
      
    <!-- end of left content -->
    <div class="center_content">
      <div class="center_title_bar">Categories</div>
     	<?php
	  		categorylist();
		?>
    </div>
    <!-- end of center content -->
    <!-- end of right content -->
  </div>
  <!-- end of main content -->
<?php foothtml(); ?>
