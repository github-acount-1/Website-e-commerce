<?php

  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';

if(isset($_POST['code']) && isset($_POST['disType']) &&  isset($_POST['disAmount']) && isset($_POST['item']) && isset($_POST['date']))
{
    $code =$_POST['code'];
    $disType =$_POST['disType'];
    $disAmount =$_POST['disAmount'];
    $item =$_POST['item'];
    $dateA =$_POST['date'];
    $currTime="";
    function itemsDiscount($discountType , $discountAmount, $price)
    {

        if ($discountType == "Amount")
        { $price = $price - $discountAmount;}
        else if ($discountType =="Percentage")
        {$price =$price - ($price * ($discountAmount/100));}
        return $price;
    }
    try
    {
		
        $readQuery ="SELECT * from item_discount inner join  items on items.item_id=item_discount.item_id ";
  echo "Success!";
        $statement =$pdo ->query($readQuery);
        while($data = $statement -> fetch (PDO::FETCH_OBJ))
        {
            {
                $item_price=$data->price;
                $name=$data->item_name;
                $id=$data->item_id;
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

            $dis=itemsDiscount($disType,$disAmount,$item_price);
           if($name ==$item)
           {
            $itemID =$id;
           }
        }

    }

    catch(PDOException $ex)
    {
        echo "<br>An error occurred ".$ex->getMessage();
    }



}


try{

    $currTime=date('y-m-d',time());

    $createQuery = " INSERT INTO item_discount (discount_code , discount_amount , discount_type , create_date, expiry_date,status,item_id,dicounted_price )
                      values(:code, :disAmount , :disType, :currTime ,:dateA, :stat ,:itemID, :dis ); ";
    $statement =$pdo ->prepare($createQuery);
    $statement-> execute(array(":code"=>$code , ":disType"=>$disType,":disAmount"=>$disAmount, ":stat"=>$stat , ":dis"=>$dis , "itemID" =>$itemID ,":dateA"=>$dateA,":currTime" => $currTime));

}catch (PDOException $ex){
    echo "<br>An error occurred ".$ex->getMessage();
}




