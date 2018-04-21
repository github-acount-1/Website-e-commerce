<?php

$root = $_SERVER['DOCUMENT_ROOT'];
if($root[strlen($root) - 1] != "/")
    $root .= "/";

require_once $root.'shola/php/includes/helpers_inc.php';
require_once $root.'shola/php/includes/db_inc.php';

$readQuery ="SELECT * from  items ";
$statement =$pdo ->query($readQuery);
$rq="SELECT * from  coupon_create ";
$st =$pdo->query($rq);
$menu="";
$name="";

$row=$statement -> fetch (PDO::FETCH_OBJ);
{

  $menu=$row->item_name;
  
}
$row=$st -> fetch (PDO::FETCH_OBJ);
{

  
  $name=$row->free_item_id;

}
try
{

    $readQuery = "SELECT distinct *  FROM coupon_create  ";

    $statement =$pdo ->query($readQuery);
       $output="<tr>";
       
        while($data = $statement -> fetchObject() ) {

            {
                $output .= " 
                        <td><div>$data->offer_id</div></td>
                        <td><div>$menu</div></td>
                       <td><div>$data->item_amount</div></td>
                       <td><div>$name</div></td>
                       <td><div>$data->free_item_amount </div></td>
                       <td><div>$data->expire_date</div></td>
                        <td><div>$data->create_date</div></td>
                            <td><a target='_blank' href='../payment/cart.html.php' class='btn btn-round btn-fill btn-info'>Add to Cart</a></td>
                    </tr>";
          }
                  }
echo $output;
}

catch(PDOException $ex)
{
    echo "<br>An error occurred ".$ex->getMessage();
}
// <td><div style=\"text-decoration: line-through\">$data->price</div></td>
 //                       <td><div>$data->dicounted_price</div></td>
   //                     <td><div>$data->expiry_date</div></td>
     //                   <td><div>$data->status</div></td>
       //                 <td><div> <img src='assets/img/Untitled.png'  </div></td>