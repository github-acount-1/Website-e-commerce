<?php
require_once "helpers.inc.php";
//require_once ROOT_DIR.'connectDB-inc.php';
include_once ROOT_DIR.'item.class.php';
//include_once 'item.class.php';

include_once ROOT_DIR.'category.class.php';
$categoryObject=new category();
$categoryNam=$categoryObject->$categoryName;
//public fuction
$retrievedItems=new itemClass();
$items=$retrievedItems->fetchItems($categoryNam);
 echo '$items';
$display="<ul>";

while($row=$items->fetchObject()){
	$display.="<form action='' method='post'>
			  <li>
				<img src='$row->ItemImage'/>
				<p><a href='someurl'>$row->Itemname</a></p>
				<input type='submit' value='Buy Now' name='buy' />
			  </li>
			  </form>
			  ";
}
return $display;



