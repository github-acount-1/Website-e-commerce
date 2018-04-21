<?php
require_once "helpers.inc.php";
//require_once ROOT_DIR.'connectDB-inc.php';
include_once ROOT_DIR.'item.class.php';
//include_once ROOT_DIR.'item.class2.php';
//include_once 'item.class.php';

//include_once ROOT_DIR.'category.class.php';

//public fuction
$retrievedItems=new itemClass();
$items=$retrievedItems->fetchItems($categoryName);//<img src='$row->ItemImage'/>  <img src='$row->itemimage'/>
$display="<ul>";

while($row=$items->fetchObject()){
        //echo $row;
	$display.="<form action='' method='post'>
			  <li>
				  <img src='$row->itemimage'/>
				<p><a href='someurl'>$row->Itemname</a></p>
				<input type='submit' value='Buy Now' name='buy' />
			  </li>
			  </form>
			  ";
			  //return $display;
			  //$retrievedItems->$coun+=1;
}

return $display;


?>





