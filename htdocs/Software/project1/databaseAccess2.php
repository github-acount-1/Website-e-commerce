<html>
<body>
<?php //fetchrow.php
/*require_once 'log-in.php';
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
echo 'ID: ' . $row['itemId'] . '<br>';
echo 'Type: ' . $row['itemType'] . '<br>';
echo 'Description: ' . $row['itemDescription'] . '<br>';
echo 'Quantity: ' . $row['quantity'] . '<br><br>';
}
$result->close();
$conn->close();

*/
 // sqltest.php
//require_once 'login.php';
require_once 'log-in.php';
$conn = new mysqli($server, $user_name, $password,$database);
//$conn = new mysqli("$localhost", "$root", "", "$category2");
if ($conn->connect_error) die($conn->connect_error);
if (isset($_POST['delete']) && isset($_POST['itemName']))
{
$Name = get_post($conn, 'itemName');
$query = "DELETE FROM itemtable WHERE itemName='$Name'";
$result = $conn->query($query);
if (!$result) echo "DELETE failed: $query<br>" .
$conn->error . "<br><br>";
}
if (isset($_POST['itemId']) &&
isset($_POST['itemType']) &&
isset($_POST['itemDescription']) &&
isset($_POST['quantity']) &&
isset($_POST['itemName']))
{
$ID = get_post($conn, 'itemId');
$Type = get_post($conn, 'itemType');
$Description = get_post($conn, 'itemDescription');
$Quantity = get_post($conn, 'quantity');
$Name = get_post($conn, 'itemName');
$query = "INSERT INTO itemtable VALUES" .
"('$ID', '$Type', '$Description', '$Quantity', '$Name')";
$result = $conn->query($query);
if (!$result) echo "INSERT failed: $query<br>" .
$conn->error . "<br><br>";
}
echo <<<_END
<form action="databaseAccess2.php" method="post"><pre>
ID <input type="text" name="itemId">
Type <input type="text" name="itemType">
Description <input type="text" name="itemDescription">
Quantity <input type="text" name="quantity">
Name <input type="text" name="itemName">
<input type="submit" value="ADD RECORD">
</pre></form>
_END;
$query = "SELECT * FROM itemtable";

$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$row = $result->fetch_array(MYSQLI_NUM);
echo <<<_END
<pre>
ID $row[0]
Type $row[1]
Description $row[2]
Quantity $row[3]
Name $row[4]
</pre>
<form action="databaseAccess2.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="itemName" value="$row[4]">
<input type="submit" value="DELETE RECORD"></form>
_END;
}
$result->close();
$conn->close();
function get_post($conn, $var)
{
return $conn->real_escape_string($_POST[$var]);
}


?>

</body>
</html>