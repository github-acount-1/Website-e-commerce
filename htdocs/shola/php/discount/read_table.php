<?php

    $root = $_SERVER['DOCUMENT_ROOT'];
    if($root[strlen($root) - 1] != "/")
        $root .= "/";

    require_once $root.'shola/php/includes/helpers_inc.php';
    require_once $root.'shola/php/includes/db_inc.php';

try
{

    $readQuery = "SELECT * from item_discount inner join  items on items.item_id=item_discount.item_id";

    $statement =$pdo ->query($readQuery);

        while($data = $statement -> fetch (PDO::FETCH_OBJ) ) {

            {$output = " 
                        <tr>
                        <td><div>$data->item_name</div></td>
                        <td><div style=\"text-decoration: line-through\">$data->price</div></td>
                        <td><div>$data->dicounted_price</div></td>
                        <td><div>$data->expiry_date</div></td>
                        <td><div>$data->status</div></td>
                        <td><div> <img src='../../../images/order.png'  </div></td>
					    <td><a target='_blank' href='../payment/cart.html.php' class='btn btn-round btn-fill btn-info'>Add to Cart</a></td>
                    </tr>";
            echo $output;}
        }
}
catch(PDOException $ex)
{
    echo "<br>An error occurred ".$ex->getMessage();
}