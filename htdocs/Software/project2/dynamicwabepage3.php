
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

/*
$dbh=mysql_connect ("$server", "$user_name", "$password")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("$database");

//$query = mysql_query("SELECT * FROM itemtable LIMIT 3");
//while($r=mysql_fetch_array($query)) {
	//extract($r);
	 $disp=3;
	 //if($itemId<=$disp){
		//echo $itemName.'<br>';
	  $disp-=1;
	 //}
	//}
*/

$conn = new mysqli($server, $user_name, $password,$database);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT * FROM itemtable";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo 'Name: ' . $row['itemName'] . '<br>';

 	}

 	
//Paginating the data

$rowsPerPage = 1;
$pageNum = 1;
if(isset($_GET['page']))
	{
	$pageNum = $_GET['page'];
	}
	$offset = ($pageNum - 1) * $rowsPerPage;

$disp=0;
// how many rows we have in database
$query = "SELECT COUNT(itemName) AS numrows FROM itemtable";
$result = mysql_query($query) or die('Error, query failed Part 2');
$row = mysql_fetch_array($result, MYSQL_ASSOC);
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
	$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
			$query = mysql_query("SELECT * FROM itemtable LIMIT 2,3");
			while($r=mysql_fetch_array($query)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				}


	$first = " <a href=\"$self?page=1\">[First Page]</a> ";
				$query = mysql_query("SELECT * FROM itemtable LIMIT 0,2");
			while($r=mysql_fetch_array($query)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=1){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				//}
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
	$next = " <a href=\"$self?page=$page\">[Next]</a> ";
			$query = mysql_query("SELECT * FROM itemtable LIMIT 5,2");
			while($r=mysql_fetch_array($query)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				}

	$last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
			$query = mysql_query("SELECT * FROM itemtable LIMIT 7,3");
			while($r=mysql_fetch_array($query)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				}

	}
else
	{
	$next = ' '; // we're on the last page, don't print next link
	$last = ' '; // nor the last page link
	}


//Print the navigation links and close the connection to the database:

// Print the navigation links
echo "<br />  ".$nav;
echo $next . "    " . $prev;
echo $first . "    " . $last;
// Close the connection to the database
//mysql_close();







?>



</body>
</html>

