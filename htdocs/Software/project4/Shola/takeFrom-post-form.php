<?php
 require_once "helpers.inc.php";
   //require_once ROOT_DIR.'connectDB-inc.php';
include_once ROOT_DIR.'item.class.php';

$toadDB=new itemClass();
$items=$toadDB->postItemMethod($ ?);

?>