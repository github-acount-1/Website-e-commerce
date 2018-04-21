<?php 
require_once "helpers.inc.php";
include_once ROOT_DIR.'item.class.php';
//include_once ROOT_DIR.'item.class2.php';
//include_once 'item.class.php';
$catNam="cell phones";
$obj=new itemClass();
echo $obj->displayItems($catNam);
   echo "<br />".$prev. "  ".$nav. "   " .$next;
//echo "\t\n\n";
?>

<html>
<body>

   <form action="post-form.html.php" method="post">

	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>


	<input type="submit" name="Submit" value="Post" />  Do you want to post your product? 

	</form>



</body>
</html>