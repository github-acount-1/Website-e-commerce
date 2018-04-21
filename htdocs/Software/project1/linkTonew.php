<html>
<body>
<?php
  $con = mysql_connect("localhost","root","");
  if (!$con) {
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("simple_login", $con);
  $result = mysql_query("SELECT * FROM itemtable ");
  echo "<table align='center' bgcolor='#F9F0F0' border='0' cellspacing='0'>
    <tr>
      <th><font color='red'>Firstname</font></th>
    </tr>";
  while($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td><a href='send.php'><img src='".$row['photo']."' \" width=\"150px\" height=\"150px\" /></a><br><br><br>";
    echo "<a href='send.php'><td align='center' style='vertical-align:text-top' width='200px'>" . $row['Firstname'] . "</td>";
    echo "<td align='center' style='vertical-align:text-top' width='200px'>" . $row['Lastname'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  mysql_close($con);
?>

</body>
</html>