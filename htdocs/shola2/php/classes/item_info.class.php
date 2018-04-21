<?php

class DisplayDetails{



	public static function getDetail($item_id){
	
	$itemName="";
	$description="";
	$price="";

try{
	global $pdo;
	$sql="SELECT item_name,description,price FROM items WHERE item_id=:item_id";
	$stmt=$pdo->prepare($sql);
	$stmt->bindValue(':item_id',$item_id);
	$stmt->execute();
	$row=$stmt->fetch();
	$itemName=$row['item_name'];
	$description=$row['description'];
	$price=$row['price'];
}
catch(Exceptoin $e){
	print_r($e->getMessage());
}
try{
	$sql2="SELECT image_url FROM item_image WHERE item_id=:item_id";
	$stmt2=$pdo->prepare($sql2);
	$stmt2->bindValue(':item_id',$item_id);
	$stmt2->execute();
	$row2=$stmt->fetch();

	$url=$row2['image_url'];
}
catch(Exception $e){
	print_r($e->getMessage());
}
//require_once '../templates/detailPage.html.php';
return array($itemName,$description,$price,$url);

/*'<div>
		<img src="">
	  </div>
	  <div>
	  	<p>'.$itemName.'</p>
	  </div>
	  <div>
	  	<p>'.$description.'</p>
	  </div>
	  <div>
	  	<p><b>'.$price.'</p>
	  </div>
	  <form action="" method="post">
	  <input type="submit" name="buy" value="Buy Now">
	  </form>
	  <form action="currencyConvertor.php?id=$item_id" method="get">
	  <input type="submit" name="calculate" value="Currency Convertor"/>
	  </form>
	 '; 
*/
}


}

