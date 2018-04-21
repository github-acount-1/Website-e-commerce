<?php

$root = $_SERVER['DOCUMENT_ROOT'];
if($root[strlen($root) - 1] != "/")
    $root .= "/";

require_once $root.'shola/php/includes/helpers_inc.php';
require_once $root.'shola/php/classes/user.class.php';
require_once $root.'shola/php/includes/db_inc.php';


$item_id=$_GET['id'];
@session_start();
global $pdo;
//$user_id=_$SESSION();
$user_id=$_SESSION['user']->getUserId();



if (isset($_POST["house-number"]) && isset($_POST["places"]) && isset($_POST["street-number"])) {
    $House_Number=$_POST["house-number"];
    $City=$_POST["places"];
    $Street_Number=$_POST["street-number"];
    $tracking_number=rand(10000,99999);
    
    $distance_in_km = 0;

    // POST Distance from the database

      $query=$pdo->query("SELECT * FROM shipping_distance ");
      //set fetch

  while($r=$query->fetch(PDO::FETCH_OBJ)){
        //output
      if($City==$r->subcity){

        $distance_in_km=$r->distance;
        break;

    }

  }
// setting up a tarrif for shipping Service
    $tarriff_per_km=5.00;
// calculating the shipping cost and storing it in the variable cost variable
    $cost=$tarriff_per_km*$distance_in_km;
    echo $cost." Birr";
// calculating the shipping time and storing it in the variable time variable
    if($distance_in_km>0&&$distance_in_km<5){
        $time=2;
    }

    elseif (5<=$distance_in_km&&$distance_in_km<=15) {
      $time=5;
    }

    elseif (15<$distance_in_km&&$distance_in_km<=25) {
      $time=10;
    }
    elseif($distance_in_km>25){
      $time=24;
    }
    else{
      $time=0;
    }
    echo " and ".$time." hours";
  
    
    //header("Location: ".$root.'shola/php/pages/payment/payment.html.php');
 

  }
 
?>
