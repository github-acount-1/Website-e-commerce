<?php
	//require_once '/shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';

	//require_once ROOT_DIR.'connectDB-inc.php';
	//include_once ROOT_DIR.'/shola/php/classes/item.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/item.class.php';
	

	$retrievedItems=new itemClass();
	$items=$retrievedItems->fetchItems($categoryName);
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