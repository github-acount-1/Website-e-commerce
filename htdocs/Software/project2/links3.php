
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

//get the clicked link or

$userPage=isset($_GET['page']);
if($userPage){
	$value=$_GET['page'];

	//if ($conn->connect_error) die($conn->connect_error);
	/*$query="SELECT itemName FROM itemtable WHERE itemType='$value'";
	
			$result = $conn->query($query);
			if (!$result) die($conn->error);
			$rows = $result->num_rows;
			for ($j = 0 ; $j < $rows ; ++$j)
			{
			$result->data_seek($j);
			echo 'Name: ' . $result->fetch_assoc()['itemName'] . '<br>';
		}*/

//}

//Paginating the data		

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
			
			//$query = mysql_query("SELECT itemName FROM itemtable LIMIT $temp1,$temp2 WHERE itemType='$value'");

			
					$query="SELECT itemName FROM itemtable WHERE itemType='$value'";
				
						$result = $conn->query($query);
						if (!$result) die($conn->error);
						$rows = $result->num_rows;
						for ($j = 0 ; $j < $rows ; ++$j)
						{
						$result->data_seek($j);
						echo 'Name: ' . $result->fetch_assoc()['itemName'] . '<br>';
					}


	$first = " <a href=\"$self?page=1\">[First Page]</a> ";
						$temp1=$pageNum*$rowsPerPage;
               			$temp2=$rowsPerPage;
				//$query = mysql_query("SELECT itemName FROM itemtable LIMIT $temp1,$temp2 WHERE itemType='$value'");

			
						$query="SELECT itemName FROM itemtable WHERE itemType='$value'";
				
						$result = $conn->query($query);
						if (!$result) die($conn->error);
						$rows = $result->num_rows;
						for ($j = 0 ; $j < $rows ; ++$j)
							{
							$result->data_seek($j);
							echo 'Name: ' . $result->fetch_assoc()['itemName'] . '<br>';
							}
		
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
			//$query = mysql_query("SELECT itemName FROM itemtable LIMIT $temp1,$temp2 WHERE itemType='$value'");

		
				$query="SELECT itemName FROM itemtable WHERE itemType='$value'";
			
					$result = $conn->query($query);
					if (!$result) die($conn->error);
					$rows = $result->num_rows;
					for ($j = 0 ; $j < $rows ; ++$j)
						{
						$result->data_seek($j);
						echo 'Name: ' . $result->fetch_assoc()['itemName'] . '<br>';
						}


	$last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
					$temp1=$pageNum*$rowsPerPage;
               		$temp2=$rowsPerPage;
			//$query = mysql_query("SELECT itemName FROM itemtable LIMIT $temp1,$temp2 WHERE itemType='$value'");

			
					$query="SELECT itemName FROM itemtable WHERE itemType='$value'";
			
					$result = $conn->query($query);
					if (!$result) die($conn->error);
					$rows = $result->num_rows;
					for ($j = 0 ; $j < $rows ; ++$j)
						{
						$result->data_seek($j);
						echo 'Name: ' . $result->fetch_assoc()['itemName'] . '<br>';
						}


	}
else if($pageNum==1){



	}
else
	{
	$next = ' '; // we're on the last page, don't print next link
	$last = ' '; // nor the last page link
	}


//Print the navigation links and close the connection to the database:

echo "<br />".$prev. "  ".$nav. "   " .$next;

// Close the connection to the database
//mysql_close();


}




?>

</body>
</html>