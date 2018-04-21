<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
$pageData = new stdClass();
$pageData->title = "Thomas Blom Hansen ADDIS: Portfolio site";
$pageData->content = include_once "navigation.php";
//changes begin here
$navigationIsClicked = isset($_GET['HTML5page']);
if ($navigationIsClicked ) {
$fileToLoad = $_GET['HTML5page'];
$pageData->content .= "<p>Will soon load $fileToLoad.php</p>";
}
//end of changes
$page = include_once "HTML5page.php";
echo $page;