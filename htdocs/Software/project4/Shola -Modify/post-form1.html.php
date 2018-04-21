<?php 
$postForm='
<!DOCTYPE html>
<html>
<head>
	<title>post items for sell</title>
</head>
<body>
<form action="submit-to-DB.php" method="post">
	<div>
		<label for="itemName">Item Name: </label>
		<input type="text" name="itemName" id="itemName" required/>
	</div>
	<div>
		<label for="itemImage">image: </label>
		<input type="text" name="itemImage" id="itemImage" required/>
	</div>
	<div>
		<label for="description">Description: </label>
		<input type="text" name="description" id="description" required/>
	</div>
	<div>
		<label for="availability">How many days would you like your item be available: </label>
		<input type="text" name="availability" id="availability" required/>
	</div>
	<div>
		<label for="quantity">Quantity: </label>
		<input type="text" name="quantity" id="quantity" required/>
	</div>
	<div>
		<label for="price">Price: </label>
		<input type="text" name="price" id="price" required/>
	</div>
	<div>
		<label for="category">Category: </label>
		<input type="text" name="category" id="category" placeholder="eg. shoes/cloth etc..." required/>
	</div>
	<div>
		<input type="checkbox" name="chatbotset" id="chatbotset" />Do you want to create a chat bot for this product? 
	</div>
	<div>
		<input type="submit" value="Post" name="post"/>
	</div>		
</form>
<form action="" method="post">
	<input type="submit" value="cancel" name="cancel"/>
</form>
</body>
</html>


';

return $postForm;
