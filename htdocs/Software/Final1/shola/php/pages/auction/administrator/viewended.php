<?php

//session_start();
	//if($_SESSION['isvalid'] != "true"){
		//header("location:index.php");
	//}
      require ('shola/php/includes/db_inc.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<script language="JavaScript" type="text/javascript" src="jTPS/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="jTPS/jTPS.js"></script>
	<link rel="stylesheet" type="text/css" href="jTPS/jTPS.css">

        
        <style>
                body {
                        font-family: Tahoma;
                        font-size: 9pt;
                }
                #demoTable thead th {
                        white-space: nowrap;
                        overflow-x:hidden;
                        padding: 3px;
                }
                #demoTable tbody td {
                        padding: 3px;
                }
        </style>

<meta charset="UTF-8"></head>

<body>
	<div id="container">
			<center><h5>Unread Notifications</h5></center>
            <div id="bodycon">
            <table id="demoTable" style="border: 1px solid #ccc;" cellspacing="0" width="700">
        <thead>
                <?php echo '<tr>';
                        echo '<th sort="index">Item Name</th>';
                        echo '<th sort="description">Date Posted</th>';
						echo '<th sort="description">Date Ended</th>';
						echo '<th sort="description">Number of Bidders</th>';
                        echo '<th sort="description">Remove Notice</th>';
                echo'</tr>'; ?>
        </thead>
        <tbody>
        	<?php 
			$bids_stat = mysql_query("SELECT * FROM products WHERE status = 0") or die(mysql_error());
			WHILE($stat = mysql_fetch_array($bids_stat)){
				$prodid = $stat['product_id'];
				$numbidderq = mysql_query("SELECT * FROM bid_report WHERE product_id = '$prodid'")or die(mysql_error());
				$numbidder = @MYSQL_NUMROWS($numbidderq);
				echo
					"<tr>
                        <td align='center'>".$stat['prod_name']."</td>
						<td align='center'>".$stat['date_posted']."</td>
						<td align='center'>".$stat['due_date']."</td>
						<td align='center'>".$numbidder."</td>
						<td align='center'><img src='./icons/116.png' alt = '0' width='24' height='22'/></td>";
					echo "</tr>";
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