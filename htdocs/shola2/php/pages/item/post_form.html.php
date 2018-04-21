<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
	if(!userIsLoggedIn()){
		header('Location: '.getRootPath());
		exit();
	}
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
	require_once $_SERVER['DOCUMENT_ROOT'] .'/shola/php/includes/db_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/item.class.php';

	if(isset($_GET['error']))
		echo "<script>alert('{$error}')</script>";
	

	if(isset($_POST['uploaded'])){
		$img=NULL;
		$name=NULL;
		$error = "";
		if(!empty($_FILES["imagefile"]["tmp_name"])){
			$imageFileType = pathinfo($_FILES["imagefile"]["name"],PATHINFO_EXTENSION);

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			    $error .= "Sorry, only JPG, JPEG & PNG files are allowed.";
			}
			
			if ($error != "") {
			    header("Location: ".$_SERVER['PHP_SELF'].'?error='.urlencode($error));
				exit();
			}
			else{
				$img = $_FILES["file"]["tmp_name"];
				$name = $_FILES['file']['name'];

				echo "<script>alert('{$img}  {$name}')</script>";
			}

		}
		$obj = new itemClass();
		$obj->postItemMethod();
	}	
?>
<body>
<div class ="bg-white" >
<form id="cat_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<input type="hidden" name="uploaded" value="true">
	<div>
		<label for="itemName">Item Name: </label>
		<input type="text" name="itemName" id="itemName" <!--required-->/>
	</div>
	<div>
		<label for="itemImage">image: </label>
		<input type="file" name="imagefile" id="itemImage" <!--required-->/>
	</div>
	<div>
		<label for="description">Description: </label>
		<input type="text" name="description" id="description" <!--required-->/>
	</div>
	<div>
		<label for="availability">How many days would you like your item be available: </label>
		<input type="text" name="availability" id="availability" <!--required-->/>
	</div>
	<div>
		<label for="quantity">Quantity: </label>
		<input type="text" name="quantity" id="quantity" <!--required-->/>
	</div>
	<div>
		<label for="price">Price: </label>
		<input type="text" name="price" id="price" <!--required-->/>
	</div>
	<div id="cat_inp_div">
		<select id="select_cat" name="category" <!--required-->>
			<?php
                foreach($category_list as $c)
                    echo '<option value="'.$c['id'].'">'.$c['category_name']."</option>";
            ?>
		</select>
		<button type="button" id="gen_but" onclick="newCat()">Other</button>
	</div>
	<div>
		<label for="chatbotset" >Do you want to create a chat bot for this product? </label>
		<input type="checkbox" name="chatbotset" value="yes" id="chatbotset" />Yes
		<input type="checkbox" name="chatbotset" value="no" id="chatbotset" />No
	</div>
	<div>
		<input type="submit" value="Post" name="post"/>
	</div>		
</form>
<a href="<?php echo getRootPath()?>"><button>Cancel</button></a>
</div >
<script>
	function newCat(){
		var form_in = document.getElementById("cat_inp_div");
		var inp = document.createElement("input");
		inp.type="text"; inp.id="inp_category"; inp.placeholder="Enter Category";inp.name="new_category";
		form_in.appendChild(inp);
		var sel_form = document.getElementById("select_cat");
		sel_form.style = "display: none";
		var but = document.getElementById("gen_but");
		but.style = "display: none";
		console.log(but);
	}
</script>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>