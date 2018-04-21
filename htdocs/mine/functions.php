<?php
function myName(){
	print "</h1 style=\"color:#FF0000;font-family:Arial, Helvetica, sans-serif\">Hi Belayneh</h1>";
}
?>
<html>
<head>
  <title>Function, conditionals, loops, classes and inheritance, ... Example</title>
  </head>
  <body>
  <?php
  myName();//function call
//global $res;
$res=perimeter(4);//function call
echo "<br />Perimeter: $res";//ech0 "Perimeter: ".$res;
//echo "<br />Result is =".$res;
echo "<br />Perimeter: ".perimeter(4);
?>
</body>
</html>
<?php
function perimeter($radius){
	return 2*3.1415*$radius;
	//global $res;
}
?>

<html>
<body>
<?php
$t = date("H");//built in function 
if ($t < "4") {
echo "<br />Have a good morning!";
  echo "<br />Time is: $t";
} 
elseif ($t < "20") {
echo "<br />Have a good day!";
}
 else {
echo "<br />Have a good night!";
}
?>

</body>
</html>

<html>
<body>
<?php
for ($x = 0; $x <= 10; $x++) {
echo "<br />The number is: $x";
}
?>
</body>
</html>


<html>
<body>
<?php
// class definition
class Bear {
// define properties
public $name;
public $weight;
public $age;
public $sex;
// define methods
public function eat() {
echo "<br />".$this->name." is eating...";
}
public function run() {
echo "<br />".$this->name." is running...";
}public function sleep() {
echo "<br />".$this->name." is sleeping...";
}
}
// my first bear
$daddy = new Bear;
$daddy->name = "Daddy Bear"; // give him a name
$daddy->age = 8; // how old is he
$daddy->sex = "male"; // what sex is he
$daddy->colour ="black"; //what colour is his coat
$daddy->weight = 300; // how much does he weigh
// give daddy a wife
$mommy = new Bear;
$mommy->name = "Mommy Bear";
$mommy->age = 7;
$mommy->sex = "female";
$mommy->colour = "black";
$mommy->weight = 310;
// and a baby to complete the family
$baby = new Bear;
$baby->name = "Baby Bear";
$baby->age = 1;
$baby->sex = "male";
$baby->colour = "black";
$baby->weight = 180;
// a nice evening in the Bear family
// mommy eat
$mommy->eat();
// and so does baby
$baby->eat();
// mommy sleeps
$mommy->sleep();
// and so does daddy
$daddy->sleep();
// baby eats some more
$baby->eat();
?>
</body>
</html>


<html>
<body>
<?php


?>
</body>
</html>
<html>
<body>
<?php
// parent class definition
class person {
// define properties
public $name;
public $weight;
public $age;
public $sex;
// define methods
public function eat() {
echo "<br />".$this->name." is eating...";
}
public function run() {
echo "<br />".$this->name." is running...";
}
public function sleep() {
echo "<br />".$this->name." is sleeping...";
}
public function teach() {
echo "<br />".$this->name." is teaching...";
}
}

?>
</body>
</html>

<html>
<body>
<?php
//child class
/**
* 
*/
class employee extends person{
	public $salary;
	public $Id;
	public $empDate;
	public $ssn;

	//function __construct(argument)
	//{
		# code...
	//}
	public function empProfile($sal ,$id ,$dt ,$s){
        $salary=$sal;
        $Id=$id;
        $empDate=$dt;
        $ssn=$s;

	}

}
echo "<br />employee class enherites from person class!";
$emp=new employee;
$emp->name="fitsum";
$emp->age=35;
$emp->sex="male";
//
$emp->teach();
?>
</body>
</html>
