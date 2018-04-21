<?php

require_once '../../includes/db_inc.php';

if(isset($_POST['code']) && isset($_POST['disType']) &&  isset($_POST['disAmount']) && isset($_POST['item']) && isset($_POST['date']))
{
    $code =$_POST['code'];
    $disType =$_POST['disType'];
    $disAmount =$_POST['disAmount'];
    $item =$_POST['item'];
    $dateA =$_POST['date'];

    try
    {
        $readQuery ="SELECT * from item_discount inner join  items on items.item_id=item_discount.item_id ";
        $statement =$conn->query($readQuery);
        while($data = $statement -> fetch (PDO::FETCH_OBJ))
        {
            {
                $item_price=$data->price;
                $date1=date('y-m-d',time());
                $date2=date('y-m-d',strtotime($data->expiry_date));
                $expDate =date_create($date2);
                $todayDate=date_create($date1);
                $diff=date_diff($todayDate,$expDate);
                if($diff->format("%R%a") >0)
                {
                    $stat = "active";
                }
                else
                {
                    $stat = "inactive";
                }
            }

        }
    }

    catch(PDOException $ex)
    {
        echo "<br>An error occurred ".$ex->getMessage();
    }

    function itemsDiscount($discountType , $discountAmount, $price)
    {

        if ($discountType == "Amount")
        {  $new_price = $price - $discountAmount;}
        else if ($discountType =="Percentage")
        {$new_price =$price - ($price * ($discountAmount/100));}
        return $new_price;
    }
    $dis=itemsDiscount($disType,$disAmount,$item_price);
}
try{

    $createQuery = " INSERT INTO item_discount (discount_code , discount_amount , discount_type , create_date, expiry_date,status,item_id,dicounted_price )
                      values(:code, :disAmount , :disType,CURRENT_DATE ,:dateA, :stat ,12, :dis ); ";
    $statement =$conn ->prepare($createQuery);
    $statement-> execute(array(":code"=>$code , ":disType"=>$disType,":disAmount"=>$disAmount, ":stat"=>$stat , ":dis"=>$dis , ":dateA"=>$dateA));

}catch (PDOException $ex){
    echo "<br>An error occurred ".$ex->getMessage();
}




