
<!DOCTYPE html>
<html>
<head>
	<title>post items for sell</title>
</head>
<body>
<form action="submit-to-DB.php" method="post">
	<div>
		<label for="Itemname">Item Name: </label>
		<input type="text" name="Itemname" id="Itemname" required/>
	</div><br/>
	<div>
		<label for="itemimage">image: </label>
		<input type="text" name="itemimage" id="itemimage" required/>
	</div><br/>
	<div>
		<label for="description">Description: </label>
		<input type="text" name="description" id="description" required/>
	</div><br/>
	<div>
		<label for="Category">Category: </label>
		<input type="text" name="Category" id="Category" placeholder="eg. shoes/cloth etc..." required/>
	</div><br/>
	<div>
		<label for="contractPeriod">How many days would you like your item be available: </label>
		<input type="text" name="contractPeriod" id="contractPeriod" required/>
	</div><br/>
	<div>
		<label for="quantity">Quantity: </label>
		<input type="text" name="quantity" id="quantity" required/>
	</div><br/>
	<div>
		<label for="postdate">Post Date: </label>
		<input type="text" name="postdate" id="postdate" required/>
	</div><br/>
	<div>
		<label for="price">Price: </label>
		<input type="text" name="price" id="price" required/>
	</div><br/><br/>
	<div>
		<input type="checkbox" name="chatbotset" id="chatbotset" />Do you want to create a chat bot for this product? 
	</div>
	
	<div>
		<input type="submit" value="Submit" name="post"/>
	</div><br/><br/>		
</form>
<form action="" method="post">
	<input type="submit" value="cancel" name="cancel"/>
</form>
</body>
</html>