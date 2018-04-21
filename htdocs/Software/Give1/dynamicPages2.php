<html>
<body>
<?php
// database connection stuff here
require_once 'log2in.php';
//$conn= new mysqli_connect($server, $user_name, $password);
	$conn = new mysqli($server, $user_name, $password,$database);
if ($conn->connect_error) die($conn->connect_error);
$rows_per_page=30;

$query = "SELECT * FROM itemtable";
$result = $conn->query($query);

//$rows_per_page = 30;
//$sql = "SELECT * FROM table_name";
//$result = mysql_query($sql, $db);
$total_records = $result->num_rows;
$pages = ceil($total_records / $rows_per_page);
//mysql_free_result($result);
  //$result->free_result;


if (!isset($screen))
  $screen = 0;
$start = $screen * $rows_per_page;
$query = "SELECT description FROM itemtable ";
$query .= "LIMIT $start, $rows_per_page";
//$result = $conn->query($query);
$rows = $result->num_rows;
/*for ($i = 0; $i < $rows; $i++) {
  $description = mysql_result($result, $i, 0);

  echo "\$description = $itemDescription<br>\n";
}*/
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
//echo 'ItemName: ' . $result->fetch_assoc()['itemName'] . '<br>';
   $n=$j+1;
echo $n.' ,  ' . $result->fetch_assoc()['itemName'] . '<br>';
$result->data_seek($j);
//echo 'ItemId: ' . $result->fetch_assoc()['itemId'] . '<br>';
$result->data_seek($j);
//echo 'ItemDescription: ' . $result->fetch_assoc()['itemDescription'] . '<br>';
$result->data_seek($j);
//echo 'Type: ' . $result->fetch_assoc()['itemType'] . '<br>';
//$result->data_seek($j);
//echo 'ISBN: ' . $result->fetch_assoc()['isbn'] . '<br><br>';
}
//$result->close();
//$conn->close();


echo "<p><hr></p>\n";
// let's create the dynamic links now
if ($screen > 0) {
  $url = "dynamicPages2.php?screen=" . $screen - 1;
  echo "<a href=\"$url\">Previous</a>\n";
}
// page numbering links now
for ($i = 0; $i < $pages; $i++) {
  $url = "dynamicPages2.php?screen=" . $i;
  echo " | <a href=\"$url\">$i</a> | ";
}
if ($screen < $pages) {
  $url = "dynamicPages2.php?screen=" . $screen + 1;
  echo "<a href=\"$url\">Next</a>\n";
}

?>
</body>
</html>