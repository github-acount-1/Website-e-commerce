<!DOCTYPE html>
<html>
<body>
<?php
$x = 5;
$y = 10;
function myTest() {
global $x, $y;
$y = $x + $y;
 //echo "$y";
}
myTest(); // run function
echo "Sum = ".$y; // output the new value for variable $y
?>
</body>
</html>

<html>
<head>
<title>Function Example</title>
</head>
<body>
<?php
function add($val1,$val2){
	return $val1+$val2;
}
$value1=10;
$value2=20;

print "<br />Total is ".add($value1,$value2);//function call

?>
</body>
</html>