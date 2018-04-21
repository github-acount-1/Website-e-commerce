<?php
//complete code for index.php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
$title = "Test title";
$content = "<h1>Hello World</h1>";
//indicate the relative path to the file to include
$page = include_once "templates/page.php";
echo $page;