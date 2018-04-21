<?php

include("header.html");
require "new.php";

?>
<html>
   
    <head>
	     
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
       
               <link   rel="stylesheet" href="css/bootstrap.css" >
			   <script src="jquery/jquery-1.11.3.js"></script>
	           <script src="js/bootstrap.js" ></script> 
	
	</head>

<body>
<div class ="  bg-white" >
 

      	<div class="container">
			   <div class="row">
			      <div class="col-md-6">
				     <a href=""><img src="Shola.gif"></a>
				  </div>
				   <div class="col-md-6">
				         
						   <h1>Bid on this item</h1>
						      <h3>Rolex-SR 7 Watch</h3>
							  <span><h3 id="demo"></h3></span>
				     <div class="box">
				       <form role="form" action="new.php" method="POST">						   										 								    
								   <div class="form-group">
								   
								   <div class="table -responsive">
								      <table class="table">
									       
										   <tr>
										      <td><label>Current price :</label></td>
											  <td></label><span><input type="text" name="currentMax" hidden/><?php $currentMax ?></span><br></td>
										   </tr>
									       <tr>
										        <td><label>Minimum  Bid :</label></td>
											    <td></label><span>$32</span></td>
										   </tr>
										   <tr>
										       <td><label>Enter your bid:</label></td>
												<td></label><span><input type="text" name="currentBid"></span></td>
										   </tr>
										   <tr>
										        <td> <label>Enter your maximum bid <br>with Autobid </label</td>
											    <td><span><input type="text" name="maxBid"></span></td>
										   </tr>
										   <tr>
										        <td><label>Place Bid:</label></td>
											    <td><span><button class="btn btn-deafult "type="submit" name="btn">Add Bid</button></span</td>
										   </tr>
									  </table> 
				
									 </div>	
								   </div>	
								
								</form>
				   
				   
				      </div>
				   </div>
			   </div>
			   
			    <div class="row">
				    <div class="col-md-6">
					
					    <div class="spec">
						  
						  <ul>
						       <h4>Size</h4>
						     <li><label>weight:</label><span>45kg</span></li>
							 <li><label>weight:</label><span>45kg</span></li>
							 <li><label>weight:</label><span>45kg</span></li>
							
						  </ul>
						  <ul>
                                 <h4>Other</h4>						     
						     <li><label>weight:</label><span>45kg</span></li>
							 <li><label>weight:</label><span>45kg</span></li>
							 <li><label>weight:</label><span>45kg</span></li>
							
						  </ul>
						
						</div>
					
					</div>
				     <div class="col-md-6">
					   <h4>Share this product</h4>
					   
					   <div class="table-responsiv">
					     <table class="table table-responsive">
						   
						     <tr>
							    <th colspan="2">Reload this page for more updates</th>
							 </tr>
						     <tr>
							    <td><span><label>Product ID</label></span> :</td>
								<td><span><label>565656</label></span></td>
							 </tr>
							  <tr>
							    <td><span><label>Number of Bids</label></span> </td>
								<td><span><label> 5  </label></span> </td>
							 </tr>
							  <tr>
							    <td><span><label>Current Price</label></span> </td>
								<td><span><label>$32</label></span> </td>
							 </tr>
							  <tr>
							    <td><span><label>Bid in creament</label></span> </td>
								<td><span><label>Bid in creament</label></span></td>
							 </tr>
							 <tr>
							    <td><span><label>Seller</label></span> </td>
								<td><span><label><a href="#">Seller address</a></label></span></td>
							 </tr>
							 <tr>
							    <td><span><label>Ends in</label></span> </td>
								<td><span><label>6d 5h reload page to update</label></span></td>
							 </tr>
							 <tr>
							    <td><span><label>Ends on</label></span> </td>
								<td><span><label>11/28/2017 6:21:00 PM Pacific Time</label></span></td>
							 </tr>
						 </table>
					   </div>
					 </div>
				</div>
			 </div> 

          





</div>

 <script>
			      
				  
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2018 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);

			   
			   </script> 


</body>
</html>
<?php
 ?>
