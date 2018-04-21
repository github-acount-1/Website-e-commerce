<?php 
require_once "helpers.inc.php";
include_once ROOT_DIR.'item.class.php';

try{
$catNam='cell phones';
$obj=new itemClass();
echo $obj->displayItems($catNam);
   echo "<br />".$prev. "  ".$nav. "   " .$next;

//Form below is th form that takes the seller's product details for DATABASE submition form 

}
catch(Exception $e){
			echo 'sql error';
		}

?>

<html>
<body>

   <form action="post-form.html.php" method="post">   

	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>


	<input type="submit" name="Submit" value="Post" />  Do you want to post your product? 

	</form>



</body>
</html>