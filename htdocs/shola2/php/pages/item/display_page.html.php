<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
	//require_once ROOT_DIR.'connectDB-inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item.class.php';

	$retrievedItems=new ItemClass();
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