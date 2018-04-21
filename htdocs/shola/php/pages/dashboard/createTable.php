<?php

$root = $_SERVER['DOCUMENT_ROOT'];
if($root[strlen($root) - 1] != "/")
    $root .= "/";

require_once $root.'shola/php/includes/helpers_inc.php';
require_once $root.'shola/php/includes/db_inc.php';

$item =$_POST['item'];
$itemAmount =$_POST['itemamount'];
$freeItem =$_POST['freeitem'];
$freeItemAmount =$_POST['freeitemamount'];
$expireDate =$_POST['date'];
    
$readQuery ="SELECT * from  items ";
$statement =$pdo ->query($readQuery);
$rq="SELECT * from  coupon_create ";
$st =$pdo ->query($rq);
$menu="";
$name="";

while($row=$statement -> fetch (PDO::FETCH_OBJ))
{

  $menu=$row->item_id;
  

}
while($row=$st -> fetch (PDO::FETCH_OBJ))
{

  
  $name=$row->free_item_id;

}


    try{
          $createQuery=" INSERT INTO coupon_create (item_id,item_amount,free_item_id,free_item_amount, expire_date,  create_date)
        values(:item, :itemAmount, :freeItem, :freeItemAmount, :expireDate, now())";
        echo "Success!";
       // $createQuery = " INSERT INTO coupon_create (offer_id,item_id,item_amount,free_item_id,free_item_amount, create_date, expire_date)
       // values(:code, 1 , :itemAmount, 1 ,:freeItemAmount, :createDate ,:expireDate )";
        $statement =$pdo->prepare($createQuery);
        $statement-> execute(array(":item"=>$menu,":itemAmount"=>$itemAmount, ":freeItem"=>$name , ":freeItemAmount"=>$freeItemAmount , ":expireDate" => $expireDate));

    }catch (PDOException $ex){
        echo "<br>An error occurred ".$ex->getMessage();
    }




