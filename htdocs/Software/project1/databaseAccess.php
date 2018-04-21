<html>
<body>
<?php

require_once 'log-in.php';
//$conn= new mysqli_connect($server, $user_name, $password);
	$conn = new mysqli($server, $user_name, $password,$database);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM itemtable";
$result = $conn->query($query);
if (!$result) die($conn->error);
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
echo 'ItemName: ' . $result->fetch_assoc()['itemName'] . '<br>';
$result->data_seek($j);
echo 'ItemId: ' . $result->fetch_assoc()['itemId'] . '<br>';
$result->data_seek($j);
echo 'ItemDescription: ' . $result->fetch_assoc()['itemDescription'] . '<br>';
$result->data_seek($j);
echo 'Type: ' . $result->fetch_assoc()['itemType'] . '<br>';
//$result->data_seek($j);
//echo 'ISBN: ' . $result->fetch_assoc()['isbn'] . '<br><br>';
}
$result->close();
$conn->close();


?>
</body>
</html>
<html>
<body>
<?php
function mysql_fatal_error($msg)
{
$msg2 = mysql_error();
echo <<< _END
We are sorry, but it was not possible to complete
the requested task. The error message we got was:
<p>$msg: $msg2</p>
Please click the back button on your browser
and try again. If you are still having problems,
please <a href="mailto:admin@server.com">email
our administrator</a>. Thank you.
_END;
}

?>
</body>
</html>