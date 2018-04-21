<?php
require_once "helpers.inc.php";
//require_once ROOT_DIR.'connectDB-inc.php';
include_once ROOT_DIR.'item.class.php';
//include_once ROOT_DIR.'item.class2.php';
//include_once 'item.class.php';

//include_once ROOT_DIR.'category.class.php';

//public fuction
$retrievedItems=new itemClass();

try{
$items=$retrievedItems->fetchItems($categoryName);//<img src='$row->ItemImage'/>  <img src='$row->itemimage'/>
$display="<ul>";

//try{
while($row=$items->fetchObject()){  //<img src='$row->itemimage'/>
        //echo $row;
	$display.="<form action='' method='post'>
			  <li>
				  
				<p><a href='someurl'>$row->item_name</a></p>
				<input type='submit' value='Buy Now' name='buy' />
			  </li>
			  </form>
			  ";
			  //return $display;
			  //$retrievedItems->$coun+=1;
    }

return $display;
}
catch(Exception $e){
			echo 'sql error';
		}

?>





