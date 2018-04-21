
<!DOCTYPE>
<html>
<head>
<title>Category Display</title>
</head>
<body>
<?php
//creating a connection to a database server
require_once 'loginAll2.php';

$conn = new mysqli($server, $user_name, $password,$database);

//get the clicked link or

$userPage=isset($_GET['page']);
if($userPage){
	$value=$_GET['page'];

	if ($conn->connect_error) die($conn->connect_error);
	$query="SELECT itemName FROM itemtable WHERE itemType='$value'";
	
			$result = $conn->query($query);
			if (!$result) die($conn->error);
			$rows = $result->num_rows;
			for ($j = 0 ; $j < $rows ; ++$j)
			{
			$result->data_seek($j);
			  $n=$j+1;
			echo $n.".  ".$result->fetch_assoc()['itemName'] . '<br>';
			//echo 'Name: ' . $result->fetch_assoc()['itemName'] . '<br>';
		}

}

//Paginating the data	???	



?>

</body>
</html>