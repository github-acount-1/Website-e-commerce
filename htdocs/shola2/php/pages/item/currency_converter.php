<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';

    global $con;

    $converted_to = $_GET['converter_to'];
    $price_to_be_converted  = isset($_GET['money_amount']) ? $_GET['money_amount'] : null;

    $query="select country_name,rate FROM currencyconvertertable WHERE country_name='".$converted_to."'";
    $result=mysqli_query($con,$query);
    $count = mysqli_num_rows($result);


    if($count > 0){
      while($row = mysqli_fetch_array($result)){
        $converted = $row['rate'] * $price_to_be_converted;
        echo $converted;
      }
    }

?>