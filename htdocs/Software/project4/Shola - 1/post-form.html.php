
<!DOCTYPE html>
<html>
<head>
	<title>post items for sell</title>
</head>
<body>
<form action="" method="post">
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
		<select name="type" required>
			<option selected="selected" value="">select item category</option>
			<option value="MC">Men's clothe </option>
			<option value="MS">Men's Shoes</option>
			<option value="WC">Women's clothe</option>
			<option value="WS">Women's Shoes</option>
			<option value="BC">Babies clothe</option>
			<option value="BS">Babies Shoes</option>
			<option value="EP">Phones</option>
			<option value="EC">Computer</option>
			<option value="EA">Accessories</option>
			<option value="ET">Tv's</option>
			<option value="FU">Furniture</option>
			<option value="BF">Fiction Books</option>
			<option value="BS">Science Books</option> 
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