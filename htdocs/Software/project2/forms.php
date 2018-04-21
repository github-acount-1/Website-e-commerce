<html>
<body>
<?php // sqltest.php
require_once 'log2in.php';
//$conn = new mysqli($hn, $un, $pw, $db);
$conn = new mysqli($server, $user_name, $password,$database);
if ($conn->connect_error) die($conn->connect_error);
if (isset($_POST['delete']) && isset($_POST['itemId']))
{
$isbn = get_post($conn, 'itemId');
$query = "DELETE FROM itemtable WHERE itemId='$itemid'";
$result = $conn->query($query);
if (!$result) echo "DELETE failed: $query<br>" .
$conn->error . "<br><br>";
}
if (isset($_POST['itemName']) &&
isset($_POST['itemPicture']) &&
isset($_POST['itemDescription']) &&
isset($_POST['postDate']) &&
isset($_POST['contractPeriod'])&&
isset($_POST['quantity'])&&
isset($_POST['price'])&&
isset($_POST['itemType'])&&
isset($_POST['userId']))
{
$itemName = get_post($conn, 'itemName');
$itemPicture = get_post($conn, 'itemPicture');
$itemDescription = get_post($conn, 'itemDescription');
$postDate = get_post($conn, 'postDate');
$contractPeriod = get_post($conn, 'contractPeriod');
$quantity= get_post($conn, 'quantity');
$price = get_post($conn, 'price');
$itemType = get_post($conn, 'itemType');
$userId = get_post($conn, 'userId');
$query = "INSERT INTO itemtable VALUES" .
"('$itemName', '$itemPicture', '$itemDescription', '$postDate', '$contractPeriod' , '$quantity', '$price', '$itemType', '$userId')";
$result = $conn->query($query);
if (!$result) echo "INSERT failed: $query<br>" .
$conn->error . "<br><br>";
}
echo <<<_END
<form action="forms.php" method="post"><pre>
Author <input type="text" name="author">
Title <input type="text" name="title">
Category <input type="text" name="category">
Year <input type="text" name="year">
ISBN <input type="text" name="isbn">
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
Author $row[0]
Title $row[1]
Category $row[2]
Year $row[3]
ISBN $row[4]
</pre>
<form action="forms.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="isbn" value="$row[4]">
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