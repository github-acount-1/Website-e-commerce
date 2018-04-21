<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/user.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/item.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/classes/category.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/header.html.php';
?>

<div class ="bg-white">

<?php
	$catNam=Category::getCatName($_GET['id']);
	itemClass::displayItems($catNam);
?>
    
</div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/pages/footer.html.php';
?>