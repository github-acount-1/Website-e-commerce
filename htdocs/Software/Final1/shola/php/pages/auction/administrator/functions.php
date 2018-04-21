<?php
	  require ('shola/php/includes/db_inc.php');
function cats(){
		$query = mysql_query("SELECT * FROM `product_categories`") or die (mysql_error());
		  echo "<select name ='category'>";
		  echo "<option>Select Category</option>";
		while($row = mysql_fetch_array($query)){
				
				echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";							
		}
				echo "</select>";
}

function categoryadd(){
	if (isset($_POST['cmdadd'])) 
 	{
	
 	$name = $_FILES["catimage"] ["name"];
	$type = $_FILES["catimage"] ["type"];
	$size = $_FILES["catimage"] ["size"];
	$temp = $_FILES["catimage"] ["tmp_name"];
	$error = $_FILES["catimage"] ["error"];
	if ($error > 0){
		die("Error uploading file! Code $error.");
	}else{
		if($size > 1000000000) //conditions for the file
		{
			die("Format is not allowed or file size is too big!");
		}else{
			move_uploaded_file($temp,"images/category/".$name);
			echo "Upload Complete!";
		}
	} 			
	$categoryname = $_POST['category_name'];
	mysql_query("INSERT INTO product_categories(category_name, cat_image) VALUES('$categoryname','$name')")or die(mysql_error());  
	echo " One record successfully added!";
	
}}
	