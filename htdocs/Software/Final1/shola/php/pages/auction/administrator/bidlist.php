<?php

session_start();
	//if($_SESSION['isvalid'] != "true"){
		//header("location:index.php");
	//}
      require ('shola/php/includes/db_inc.php');
?>

<meta charset="UTF-8"></head>

<body>
	<div id="container">
					<center><h1>Welcome Administrator</h1></center>
					<?php 
					$id = $_GET['id'];
					?>

						  <center><h5><?php echo "$id"; ?> Bidding Log</h5></center>
                           <div id="bodycon">
                          <table id="demoTable" style="border: 1px solid #ccc;" cellspacing="0" width="700">
        <thead>
                <?php echo '<tr>';
                        echo '<th sort="index">Bidder</th>';
                        echo '<th sort="date">Date of Bid Placed</th>';
                        echo '<th sort="description">Amount</th>';
                        
                echo'</tr>'; ?>
        </thead>
        <tbody>
        	<?php 
				$prodid = $_GET['id'];
				$query = mysql_query("SELECT * FROM bid_report LEFT JOIN customer ON customer.user_id = bid_report.bidder LEFT JOIN products ON products.product_id = bid_report.product_id WHERE products.product_id = '$prodid'") or die(mysql_error());
				while ($prod = mysql_fetch_array($query)){
					echo 
					"<tr>
                        <td align='center'>".$prod['last_name'].", ".$prod['first_name']."</td>
                        <td>".$prod['bid_date_time']."</td>
                        <td>P".$prod['bid_amount']."</td>
					</tr>";
				}
			?>

        </tbody>
        <tfoot class="nav">
                <tr>
                        <td colspan=7>
                                <div class="pagination"></div>
                                <div class="paginationTitle">Page</div>
                                <div class="selectPerPage"></div>
                                <div class="status"></div>
                        </td>
                </tr>
        </tfoot>
</table>

		
	</div> <!-- container -->
</body>
</html>