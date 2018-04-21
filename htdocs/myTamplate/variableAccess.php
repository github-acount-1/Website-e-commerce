<?php
return "
<nav>
	<a href='HTML5.php?page=skills'>My skills and background</a>
	<a href='HTML5.php?page=projects'>Some projects</a>
</nav>";
//<?php
//complete code for index.php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
$pageData = new stdClass();
//changes begin here
$pageData->title = "Thomas Blom Hansen: Portfolio site";
//$pageData->content = include_once "myTamplate/navigation.php";
//end of changes
//changes begin here
$navigationIsClicked = isset($_GET['HTML5page']);//to check, and access url variable
if ($navigationIsClicked ) {
$fileToLoad = $_GET['page'];
$pageData->content .= "<p>Will soon load $fileToLoad.php</p>";
}
//end of changes
$page = include_once "ch1/HTML5page.php";
echo $page;
