<?php 
	$title="Category";

	$root = $_SERVER['DOCUMENT_ROOT'];
	if($root[strlen($root) - 1] != "/")
	    $root .= "/";

	require_once $root.'shola/php/includes/helpers_inc.php';
    require_once $root.'shola/php/classes/user.class.php';
	require_once $root.'shola/php/classes/item.class.php';
	require_once $root.'shola/php/classes/category.class.php';
	require_once $root.'shola/php/pages/header.html.php';
?>

<div class="bg-white">

<?php
	$catNam=Category::getCatName($_GET['id']);
	itemClass::displayItems($catNam);
?>
    
</div>

<?php
    require_once $root.'shola/php/pages/footer.html.php';
?>