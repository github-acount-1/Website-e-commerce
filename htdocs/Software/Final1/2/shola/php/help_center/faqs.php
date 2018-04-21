<?php
	$title="FAQ";
	$root = $_SERVER['DOCUMENT_ROOT'];
	if($root[strlen($root) - 1] != "/")
	    $root .= "/";

	require_once $root.'shola/php/includes/helpers_inc.php';
	require_once $root.'shola/php/classes/user.class.php';
	// if(!userIsLoggedIn()){
	// 	header('Location: '.getRootPath());
	// 	exit();
	// }
	require_once $root.'shola/php/pages/header.html.php';
?>

<div class="bg-white" style="padding: 20px;">

<?php
$ob=new Display();
$ob->dataFromDb1();

 class Display{

 	public function makeAconnection(){

 		$connec=mysqli_connect(HOST, DATABASE_USER, PASSWORD, DATABASE_NAME) or die("<p>Can't connect</p>");
 		return $connec;
 	  }

	public function dataFromDb1(){
        $sql = "SELECT asked_quesiton,answer,frequency FROM question ORDER BY frequency DESC limit 10";
		$run = @mysqli_query($this->makeAconnection(),$sql); // making query based on the given parameter to fetch the needed data...
		$chek = @mysqli_fetch_assoc($run) ;
		if($chek && $chek['frequency']>=2){    // before doing anythig first check the what no is frequently in our case 2 is the number.
			$run1 = mysqli_query($this->makeAconnection(),$sql); // making query based on the given parameter to fetch the needed data...
		while ($rows =mysqli_fetch_assoc($run1)) {     // Fetches a result row as an associative array
			
			if($rows['frequency']>=2){               // not to display in less frequently asked qustions 
			echo "<!DOCTYPE html>
 	  			<html>
 					<head>
 						<title></title>
 					</head>
 					<body>
 					<div class='row-cells'>
 	 				 	 $rows[asked_quesiton] $rows[frequency] times<br>
 	 				 </div>
 					</body>
 				</html>";
 	    if(is_null($rows['answer'])){
			echo "Ans: No Answers is given yet <br>"; // if the question is not answerd
	  		 }
	    else{
	   
	   		echo 'Ans: '.$rows['answer'].'<br>';     // to show the answer
	   		}
        }else 
        break; // if the frequency of the questions is less than 2 it breaks
       
			}
		}
	   else{
	       echo "There are no frequently asked questions.";
	   }
     }}

?>

    </div>

<?php
    require_once $root.'shola/php/pages/footer.html.php';
?>