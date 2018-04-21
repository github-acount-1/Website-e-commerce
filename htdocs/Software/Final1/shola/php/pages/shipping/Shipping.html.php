
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';

@session_start();
global $pdo;
//$user_id=_$SESSION();
$user_id=$_SESSION['user']->getUserId();

$item_id=$_GET['id'];


echo 'this a test';

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
  
    //INSERT, $time, $cost$result=$pdo->prepare($sql);
    $sql="INSERT INTO shipping(user_id,item_id,home_number,arrival_date,date_of_purchase,distance_from_store,shipping_price,tracking_number)VALUES
                              (:uid,:iid,:hn,:at,NOW(),:ds,:sp,:tn)";
        //preparing to insert our data to the databse
        $result=$pdo->prepare($sql);
    echo  'go';
        $result->execute(array(
        // this is binding our data, for the sake of security
            ':uid'=>$user_id,
            ':iid'=>$item_id,
            ':hn'=>$House_Number,
            ':tn'=>$tracking_number,
            ':sp'=>$cost,
            ':at'=>$time,
            ':ds'=>$distance_in_km
            
        ));
    header("Location: ../../../php/pages/payment/payment.html.php?payment_type=0&item_id=".$item_id);
    exit();

  }
 require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
?>


<body>


    <head>
    <script type="text/javascript" src="../../../js/jquery.3.2.1.min.js"></script>
     <script src="../../../js/calculate.js"> </script>    
    </head>
    <div class="bg-white">
       
<div class="grid padding20">
    <h2 class="padding20">Shipping Info</h2>
        <hr class="thin margin20 no-margin-top"/>
        
    <div class="row">
        <span>Address</span>
    <form id="Shipping Service" action="shipping.html.php" method="post">
        <div class="input-control select full-size">
                      <select name="places" id="places">
                          <optgroup label="Cities" >
                       <?php

                          $stmt = $pdo->prepare("SELECT subcity FROM shipping_distance");
                          $stmt->execute();
                          $result = $stmt->fetchAll();

                          foreach ($result as $place) {
                              echo "<option value='" . $place["subcity"] . "'> " . $place["subcity"] . " </option>";
                            }
                          ?>
                          </optgroup>
                      </select>
        
        </div>
        
        
        
        
    
        <div class="row cells2">
            <div class="cell">
        <div class="input-control modern text full-size" data-role="input">
                                      
                                      <input type="text" name="street-number" required="" id="street-number">
                                      <span class="label">Street Number</span>

                                      <span class="placeholder">Enter Street Number</span>
                                </div>
        </div>
            <div class="cell">
            <div class="input-control modern text full-size" data-role="input">
              <input type="text" name="house-number" required="" id="house-number">
                                    <span class="label" >House number</span>

                                    <span class="placeholder">Enter House Number</span>
             </div>
            </div>
            
        </div>
        
        <div class="row">
            
            <button type="button"  class="button primary rounded no-border" name="submit" onclick="calculate()" value="calculate">Calculate</button>
        </div>
        </div> 
       
       <div class="padding20">
        <div class="cell input-control modern text">
                            <span class="label">Shipping Cost</span>
                            <label id="label">Shipping Cost and time </label>
                            <input id="costLabel">
                        </div>
        </div>
      
         
        <div class="row padding30">
        <button class="button rounded place-right primary place-" value="submit" type="submit" style="width:70px">Submit</button>
    
    </form> 
            
                <a href="index.php">             
            <button class="button rounded place-left primary place" type="submit" >Go back </button>
            </a>
        </div>
      
        
        </div>
             
                
    </div>
        <script src="../../../js/jquery.3.2.1.min.js' "></script>      
             

</body>

     
        


</html>

        
        
        <?php
 require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>