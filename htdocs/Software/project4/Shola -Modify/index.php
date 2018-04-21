<?php 
require_once "helpers.inc.php";
include_once ROOT_DIR.'item.class.php';
//include_once ROOT_DIR.'item.class2.php';
//include_once 'item.class.php';
$catNam="Automotives";
$obj=new itemClass();
echo $obj->displayItems($catNam);

//echo "\t\n\n";
?>

<html>
<body>
	<form action="post-form.html.php" method="post">
		
	<input type="submit" value="post" name="post"/>


</form>
</body>
</html>