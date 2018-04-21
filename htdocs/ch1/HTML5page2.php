<?php
//complete code for index.php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
$title = "Test title";
$content = "<h1>Hello World Again</h1>";
//indicate the relative path to the file to include
$page = include_once ("page.php");
$page2 = include_once ("HTML5page.php");
//echo $page;
echo $page2, $page;