



<?php

//the current  high bidder's high bid, taken from an input
$highBid;
//the bid that triggered the function, taken from input
$thisBid;
//theminimum bid increment , fixed amount



function decideIncrement($highBid){
	$increment;
		if($highBid>0 && $highBid <100){
		$increment=10;
	    return $increment;}
	else if ($highBid>100 && $highBid <1000){
		$increment=100;
		return $increment;}
	else if($highBid>1000 && $highBid <10000){
	$increment=1000;
	return $increment;}
	else if($highBid>10000 && $highBid<100000){
	$increment=5000;
	return $increment;}
	else if($highBid>100000){
	$increment=10000;
	return $increment;}
	
}
function placeBid($highBid,$thisBid){
	  
        if($thisBid > $highBid){
             //Insert $highBid as current Bid, for $currentBidder              
            if($thisBid> $highBid+  decideIncrement($highBid)){
              //insert $thisBid into highbids table
			   //insert $highbid + $increment as current bid, for $thisBidder
                 echo ($highBid+ decideIncrement($highBid));	 
				 }
               else{
                   //Insert $thisBid as current bid, for $thisBidder
                      echo $thisBid;
				   $highBid=$thisBid;
			   }
		}else{
		//Insert $thisBid as current bid for $thisBidder
		
		if($highBid>$thisBid +  decideIncrement($highBid)){
			//Insert $thisBid + $increment as current bid, for $currentBidder
			 echo ($thisBid +  decideIncrement($highBid));			   
		}
		else{
			//Insert $thisBid as current bid, for $currentBidder
			echo $highBid;
		}
		}	
		}?>