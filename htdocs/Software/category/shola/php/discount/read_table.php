<?php
require_once '../../includes/db_inc.php';

try
{

    $readQuery = "SELECT * from item_discount inner join  items on items.item_id=item_discount.item_id";

    $statement =$conn ->query($readQuery);

        while($data = $statement -> fetch (PDO::FETCH_OBJ) ) {

            {$output = " 
                        <tr>
                        <td><div>$data->item_name</div></td>
                        <td><div style=\"text-decoration: line-through\">$data->price</div></td>
                        <td><div>$data->dicounted_price</div></td>
                        <td><div>$data->expiry_date</div></td>
                        <td><div>$data->status</div></td>
                        <td><div> <img src='../../../images/order.png'  </div></td>
                    </tr>";
            echo $output;}
        }
}
catch(PDOException $ex)
{
    echo "<br>An error occurred ".$ex->getMessage();
}