
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Dynamic Webpages</title>
</head>
<body>
<?php
 $user_name = "root";
$password = "";
$database = "category2";
$server = "127.0.0.1";


$dbh=mysql_connect ("$server", "$user_name", "$password")
or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("$database");

$query = mysql_query("SELECT * FROM itemtable LIMIT 3");
while($r=mysql_fetch_array($query)) {
	extract($r);
	 $disp=3;
	 //if($itemId<=$disp){
		echo $itemName.'<br>';
	  $disp-=1;
	 //}
	}

//Paginating the data

$rowsPerPage = 1;
$pageNum = 1;
if(isset($_GET['page']))
	{
	$pageNum = $_GET['page'];
	}
	$offset = ($pageNum - 1) * $rowsPerPage;

// how many rows we have in database
$query = "SELECT COUNT(itemName) AS numrows FROM itemtable ORDER BY price ";
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

		   $query = mysql_query("SELECT * FROM itemtable LIMIT 3,5");
			while($r=mysql_fetch_array($query)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				//echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				}

		}
	}


// Creation of navigation links

if ($pageNum > 1)
	{
	$page = $pageNum - 1;
	$prev = " <a href=\"$self?page=$page\">[Prev]</a> ";
			$query = mysql_query("SELECT * FROM itemtable LIMIT 3,5");
			while($r=mysql_fetch_array($query)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				}


	$first = " <a href=\"$self?page=1\">[First Page]</a> ";
				$query = mysql_query("SELECT * FROM itemtable LIMIT 3,5");
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
	$prev = ' '; // we're on page one, don't print previous link
	$first = ' '; // nor the first page link
	}
if ($pageNum < $maxPage)
	{
	$page = $pageNum + 1;
	$next = " <a href=\"$self?page=$page\">[Next]</a> ";
			$query = mysql_query("SELECT * FROM itemtable LIMIT 3,5");
			while($r=mysql_fetch_array($query)) {
				extract($r);
				 $disp=3;
	 			//if($itemId<=$disp){
				echo $itemName.'<br>';
	  			$disp-=1;
	 				//}
				}

	$last = " <a href=\"$self?page=$maxPage\">[Last Page]</a> ";
			$query = mysql_query("SELECT * FROM itemtable LIMIT 3,5");
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
echo $nav . "<br />";
echo $next . "  " . $prev . "<br />";
echo $first . "  " . $last;
// Close the connection to the database
mysql_close();







?>


Read more: http://mrbool.com/how-to-create-a-dynamic-webpage-fetching-data-from-a-database-in-php/26419#ixzz4yrl8LQMZ


</body>
</html>


Read more: http://mrbool.com/how-to-create-a-dynamic-webpage-fetching-data-from-a-database-in-php/26419#ixzz4yrk9BwUv
