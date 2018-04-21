<?php 
require_once "helpers.inc.php";
include_once ROOT_DIR.'item.class.php';
//include_once 'item.class.php';
$catNam="Automotives";
$obj=new itemClass();
echo $obj->displayItems($catNam);
