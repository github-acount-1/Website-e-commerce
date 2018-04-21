<html>
<body>
<?php
//
require_once 'log2in.php';
//$conn = new mysqli($hn, $un, $pw, $db);
//require_once 'log2in.php';
//$conn= new mysqli_connect($server, $user_name, $password);
	$conn = new mysqli($server, $user_name, $password,$database);
if ($conn->connect_error) die($conn->connect_error);
$query = "SELECT * FROM itemtable";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;
echo "<table><tr> <th><th>itemId</th></th> <th><th>itemName</th></th><th><th>itemDescription</th></th><th><th>itemType</th></th></tr>";
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$row = $result->fetch_array(MYSQLI_NUM);
echo "<tr>";
for ($k = 0 ; $k < 4 ; ++$k) echo "<td><td>$row[$k]</td></td>";
echo "</tr>";
}
echo "</table>";


?>
<?php
require_once 'log2in.php';
//$conn = new mysqli($hn, $un, $pw, $db);
$conn = new mysqli($server, $user_name, $password,$database);
if ($conn->connect_error) die($conn->connect_error);
$query = "INSERT INTO itemtable VALUES(11, 'wool Jacket', 'NN', 'Heavy High Qualty Jacket', '2017-06-10', '30', '10', '1200', 'WC', 4)";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);

?>

</body>
</html>