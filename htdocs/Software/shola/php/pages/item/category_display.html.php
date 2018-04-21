<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/category.class.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';

	$catNam=Category::getCatName($_GET['id']);
	echo itemClass::displayItems($catNam);
?>
<body>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>