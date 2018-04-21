<html>
<body>
<?php

require_once 'log-in.php';
//$conn= new mysqli_connect($server, $user_name, $password);
	$conn = new mysqli($server, $user_name, $password,$database);
if ($conn->connect_error) die($conn->connect_error);
$rows_per_page=3;

$query = "SELECT * FROM itemtable";
$result = $conn->query($query);
$total_records=mysql_num_rows($result);
$pages=ceil($total_records/$rows_per_page);
mysql_free_result($result)
if (!$result) die($conn->error);
//database connection stuff here
if(!isset($screen))
   $screen=0;
 $start=screen*$rows_per_page;
 $query="SELECT itemDescription FROM itemtable";
 $query.="LIMIT $start,$rows_per_page";
 $result=$conn->query($query);
 $rows=mysql_num_rows($result);

 for($i=0;$i=$rows;$i++){
 	$description=mysql_result($result, $i,0);
 	echo "\$description= $description<br>\n";

 	}
 	echo "<p><hr></p>\n";
//let's create dynamic links row
 	if($screen>0){
 		$url="dynamicPages.php?screen=".$screen-1;
 		echo "<a href =\"$url\">previous</a>\n";
 		}
//page numbering links row
 		

?>
</body>
</html>