

	


<html>
  

<head>
<meta charset="utf-8">
	<title>Bidding Zone - Message</title>

 
<head>
	
	
	<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#dialog-modal" ).dialog({
			height: 1000,
			modal: true
		});
	});
	</script>
</head>
<body>
    
    <div id="templatmeo_content">
		<div class="demo">
			<div id="dialog-modal" title="Message">
				<center>
				<p><?php
	  require ('shola/php/includes/db_inc.php');
				
	session_start();
	require("functions.php");
	//if(isset($_POST['submit']))
		$high = $_POST['high'];
		$id = $_SESSION['product_id'];
	
		$bidamount = $_GET['bid_amount'];
		$query = mysql_query("SELECT * FROM products WHERE product_id = '$id'") or die (mysql_error());
		$prod = mysql_fetch_array($query);
		
		$prodname = $prod['prod_name'];
		if($bidamount > $high){

		mysql_query("INSERT INTO bid_report(product_id,bid_date_time,bid_amount,status) VALUES ('$id',now(),'$bid_amount',0)");


		echo "Congratulations! You are the highest bidder for Item ".$prodname."<br /><br /><a href='details.php?id=".$id."'>Back</a>";
		
		
		}elseif($bidamount <= $high){
			echo "Your Bid is not counted for the amount is lower than the highest bid or does not exceed the starting bid<br /><br /><a href=details.php?id=".$id.">Back</a>";
		}
	
	
?></p>
	<p></a></p>
		</center>
	</div>
		</div>
	</div> 
</body>
</html>
