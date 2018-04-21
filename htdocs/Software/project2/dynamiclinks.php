
<!DOCTYPE>
<html>
<head>
<title>Category Display</title>
</head>
<body>
<?php
//creating a connection to a database server
 $user_name = "root";
$password = "";
$database = "category2";
$server = "127.0.0.1";

$conn = new mysqli($server, $user_name, $password,$database);
//$dbh=mysql_connect ("$server", "$user_name", "$password")
//or die ('I cannot connect to the database because: ' . mysql_error());
//mysql_select_db ("$database");

//$query = mysql_query("SELECT * FROM itemtable LIMIT 3");
//while($r=mysql_fetch_array($query)) {
	//extract($r);
	 $disp=3;
	 //if($itemId<=$disp){
		//echo $itemName.'<br>';
	  $disp-=1;
	 //}
	//}

//Paginating the data



$userPage=isset($_GET['page']);
if($userPage){
	$value=$_GET['page'];
	/*$query="SELECT itemName FROM itemtable WHERE itemType=$value";
	$result = mysql_query($query) or die('Error, query failed Part 2');
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			echo $result->fetch_assoc()['itemName'] . '<br>';
				//echo $itemName.'<br>';
		}*/
//}
$rowsPerPage = 5;
$pageNum = 1;
if(isset($_GET['page']))
	{
	$pageNum = $_GET['page'];
	}
	$offset = ($pageNum - 1) * $rowsPerPage;
$prv=0;
$mids=0;
$nxt=0;
// how many rows we have in database
$query = "SELECT COUNT(itemName) AS numrows FROM itemtable";
//$result = mysql_query($query);// or die('Error, query failed Part 2');
//$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = $conn->query($query);
		//$rows = $result->num_rows;
		//$numrows = $row['numrows'];
		//$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

//Creation of link to each page

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav = '';
for($page = 1; $page <= $maxPage; $page++)
	{
	if ($page == $pageNum)
		{
		$nav .= " $page "; // no need to create a link to current page
		}
	else
		{
		$nav .= " <a href=\"$self?page=$page\">$page</a> ";

		   //$query = mysql_query("SELECT * FROM itemtable LIMIT 3,5");
			//while($r=mysql_fetch_array($query)) {
				//extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				//echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
			//	}

		}
	}


// Creation of navigation links

if ($pageNum > 1)
	{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?page=$page\"><-Prev</a> ";
					$temp1=$pageNum*$rowsPerPage;
               		$temp2=$rowsPerPage;
				//$rowsPerPage
			//$query = mysql_query("SELECT * FROM itemtable LIMIT $temp1,$temp2");

			//$query = mysql_query("SELECT itemName FROM itemtable WHERE (itemId0 BETWEEN 0 AND 2)");
		/*	$query="SELECT itemName FROM itemtable WHERE itemType=$value";
			$result = mysql_query($query) or die('Error, query failed Part 2');
			while($r=mysql_fetch_array($result, MYSQL_ASSOC)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				}*/
					
				$query="SELECT itemName FROM itemtable WHERE itemType=$value";
				//$query = "SELECT * FROM classics";
					$result = $conn->query($query);
					if (!$result)
						die($conn->error);
					else{
					$rows = $result->num_rows;
					for ($j = 0 ; $j < $rows ; ++$j)
					{
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_ASSOC);
					echo $row['itemName'] . '<br>';

						}
					}	
		/*$result = mysql_query($query) or die('Error, query failed Part 2');
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$result->data_seek($j);
				echo $result->fetch_assoc()['itemName'] . '<br>';
					//echo $itemName.'<br>';
			}*/


	$first = " <a href=\"$self?page=1\">[First Page]</a> ";
						$temp1=$pageNum*$rowsPerPage;
               			$temp2=$rowsPerPage;
				//$query = mysql_query("SELECT * FROM itemtable LIMIT $temp1,$temp2");
		      //$query = mysql_query("SELECT itemName FROM itemtable WHERE (itemId0 BETWEEN 0 AND 2)");
		/*	$query="SELECT itemName FROM itemtable WHERE itemType=$value";	
			$result = mysql_query($query) or die('Error, query failed Part 2');
			while($r=mysql_fetch_array($result, MYSQL_ASSOC)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=1){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				//}
			}*/

			$query="SELECT itemName FROM itemtable WHERE itemType=$value";
			//$query = "SELECT * FROM classics";
					$result = $conn->query($query);
					if (!$result) 
						die($conn->error);
					else{
					$rows = $result->num_rows;
					for ($j = 0 ; $j < $rows ; ++$j)
					{
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_ASSOC);
					echo $row['itemName'] . '<br>';

						}
					}	
		/*$result = mysql_query($query) or die('Error, query failed Part 2');
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			for ($j = 0 ; $j < $rows ; ++$j)
			{
				$result->data_seek($j);
				echo $result->fetch_assoc()['itemName'] . '<br>';
					//echo $itemName.'<br>';
			}	*/
	}
else
	{
	$prev = ' '; // we're on page one, don't print previous link

	$first = ' '; // nor the first page link
	}
if ($pageNum < $maxPage)
	{
	$page = $pageNum + 1;
	$next = " <a href=\"$self?page=$page\"> Next></a> ";
               $temp1=$pageNum*$rowsPerPage;
               $temp2=$rowsPerPage;
			//$query = mysql_query("SELECT * FROM itemtable LIMIT $temp1,$temp2");
			//$query = mysql_query("SELECT itemName FROM itemtable WHERE (itemId0 BETWEEN 6 AND 7)");
		/*	$query="SELECT itemName FROM itemtable WHERE itemType=$value";
			$result = mysql_query($query) or die('Error, query failed Part 2');
			while($r=mysql_fetch_array($result, MYSQL_ASSOC)) {
				extract($r);
				 //$disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			//$disp-=1;
	 				//}
				}*/
				$query="SELECT itemName FROM itemtable WHERE itemType=$value";
				//$query = "SELECT * FROM classics";
					$result = $conn->query($query);
					if (!$result)
						 die($conn->error);
					else{	
					$rows = $result->num_rows;
					for ($j = 0 ; $j < $rows ; ++$j)
					{
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_ASSOC);
					echo $row['itemName'] . '<br>';

						}
					}
			/*$result = mysql_query($query) or die('Error, query failed Part 2');
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
				for ($j = 0 ; $j < $rows ; ++$j)
				{
					$result->data_seek($j);
					echo $result->fetch_assoc()['itemName'] . '<br>';
						//echo $itemName.'<br>';
				}*/


	$last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
					$temp1=$pageNum*$rowsPerPage;
               		$temp2=$rowsPerPage;
			//$query = mysql_query("SELECT * FROM itemtable LIMIT $temp1,$temp2");
		//$query = mysql_query("SELECT itemName FROM itemtable WHERE (itemId0 BETWEEN 9 AND 10)");
           /*  $query="SELECT itemName FROM itemtable WHERE itemType=$value";  
             $result = mysql_query($query) or die('Error, query failed Part 2');		
			while($r=mysql_fetch_array($result, MYSQL_ASSOC)) {
				extract($r);
				 //$disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			//$disp-=1;
	 				//}
				}*/
				$query="SELECT itemName FROM itemtable WHERE itemType=$value";
				//$query = "SELECT * FROM classics";
					$result = $conn->query($query);
					if (!$result) 
						die($conn->error);
					else{
					$rows = $result->num_rows;
					for ($j = 0 ; $j < $rows ; ++$j)
					{
					$result->data_seek($j);
					$row = $result->fetch_array(MYSQLI_ASSOC);
					echo $row['itemName'] . '<br>';

						}
					}	
	/*$result = mysql_query($query) or die('Error, query failed Part 2');
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
		for ($j = 0 ; $j < $rows ; ++$j)
		{
			$result->data_seek($j);
			echo $result->fetch_assoc()['itemName'] . '<br>';
				//echo $itemName.'<br>';
		}*/


	}
else if($pageNum==1){



	}
else
	{
	$next = ' '; // we're on the last page, don't print next link
	$last = ' '; // nor the last page link
	}


//Print the navigation links and close the connection to the database:

// Print the navigation links
//echo "<br />  ".$nav;
//echo $next . "    " . $prev;
//echo $first . "    " . $last;
echo "<br />".$prev. "  ".$nav. "   " .$next;
//echo $nav. "   " .$next;
//echo $first . "    " . $last;
// Close the connection to the database
//mysql_close();


}




?>

</body>
</html>