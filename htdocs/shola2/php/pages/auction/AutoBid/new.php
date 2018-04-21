<?php

require_once 'auto.php';

//the current  high bidder's high bid, taken from an input
$highBid=$_POST["currentBid"];

//the current maximum amount
$currentMax=$_POST['currentMax'];

//the maximum amount of money the client is willing to pay
$thisBid=$_POST["maxBid"];

// display the highest bid amount 


//account number of the client, from the input
$accountNo;


if($thisBid<$currentMax){
	echo $currentMax;
}
else{
	$currentMax=placeBid($highBid, $thisBid);

}
return $currentMax;
// calling the auction function to check if the client enters amount greater than the minimum 

//calling the payment system to debate the client a certain amount of money for the system
// i am not sure if it is the right way to call the payment system called payment_type with value 4



//calling the payment system to debate the client's account for the final cost


?>