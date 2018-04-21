
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/header.html.php';
?>
	<style type="text/css">

h4{

	color: black;
	font-family:arial;
}
a{
 text-decoration: none;
 color: black;
}
	</style>
<?php 
$data="";
if(isset($_GET['search'])){
    
    $str=$_GET['search'];
    $query="SELECT  item_name, item_id FROM items WHERE  item_name LIKE '%$str%'";
    $result= mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    
      if($count>0){
          $id = array();
          while($row=mysqli_fetch_array($result)){
                $data=$data.'<h4><a href="display.php?item_id='.$row['item_id'].'">'.$row['item_name'].'</a></h4>' ;
          }
    }
    
    else 
        $data = "<h4>threre is no related item </h4>";
}
?>

<?php echo $data ?>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/footer.html.php';
?>