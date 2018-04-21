<html>
<head>
<title>Category codes</title>
</head>
<body>
<?php
//category class
class Category{
	//public $itemName="Leather coat";
	public $itemName;
	//public $itemPrice=1000."Birr";
	public $itemPrice;
	public $itemPicture;
	public $itemDescription;

	public function getItemName($name){
		$itemName=$name;
	}
	public function getItemPrice($price){
		$itemPrice=$price;
	}
	public function getItemPicture($picture){
		$itemPicture=$picture;
	}
	public function getItemDescription($description){
		$itemDescription=$description;
	}
	public function getItemDerails($name ,$price ,$picture ,$description){
		$itemName=$name;
		$itemPrice=$price;
		$itemPicture=$picture;
		$itemDescription=$description;
	}
	public function display(){
		  echo "<br />I am in category class!";
		 echo "<br />".$this->itemName." is good cloth..."; 
		//echo "<br />itemName is ".$itemName;
		 echo "<br />itemPrice is  ".$this->itemPrice;
		//echo "<br />itemPrice is ".$itemPrice;
	}

}



?>

</body>
</html>


<html>
<body>
<?php
//fashion class
class Fashion extends Category{
	
	//function __construct(argument)
	//{
		//# code...
	//}
//public function 


}


?>

</body>
</html>


<html>
<body>
<?php
//fashion class
class ElectronicsAndComputer extends Category{
	


}


?>

</body>
</html>


<html>
<body>
<?php
//fashion class
class Books extends Category{
	


}


?>

</body>
</html>


<html>
<body>
<?php
//fashion class
class Furniture extends Category{
	


}


?>

</body>
</html>


<html>
<body>
<?php
//men's class
class Men extends Fashion{
	


}


?>

</body>
</html>


<html>
<body>
<?php
//men's class
class Women extends Fashion{
	


}


?>

</body>
</html>


<html>
<body>
<?php
//men's class
class KidsAndBaby extends Fashion{
	


}


?>

</body>
</html>


<html>
<body>
<?php
//cloth class
class Clothes extends Men{
    public $contractTime;

	
public function menClothAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;


}
public function setContratTime($time){
    $contractTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//cloth class
class Shoe extends Men{
   public $contractTime;
	
public function menShoeAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contractTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//cloth class
class WomenClothes extends Women{
   public $contractTime;	

public function womenClothAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contractTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//cloth class
class WomenShoe extends Women{
   public $contractTime;	

public function womenShoeAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contractTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//cloth class
class KidsAndBabyClothes extends KidsAndBaby{
    public $contractTime;	

public function kidsAndBabyClothAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contractTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//shoe class
class KidsAndBabyShoe extends KidsAndBaby{
   public $contractTime;	


public function kidsAndBabyShoeAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contractTime=$time;

}
public function displayDetails(){
	  echo "<br />I am in KidsAndBabyShoe class!";
		//echo "<br />itemName is ".$itemName;
		//echo "<br />itemPrice is ".$itemPrice;
	  echo "<br />itemName is  ".$this->itemName; 
	  echo "<br />itemPrice is  ".$this->itemPrice;
	}

	
}


?>

</body>
</html>


<html>
<body>
<?php
//mobilePhone class
class MobilePhone extends ElectronicsAndComputer{
   public $contractTime;	

public function mobilePhoneAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contractTime=$time;

}

	
}


?>

</body>
</html>


<html>
<body>
<?php
//mobilePhone class
class Computer extends ElectronicsAndComputer{
   public $contractTime;	

public function computerAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contractTime=$time;

}

	
}


?>

</body>
</html>


<html>
<body>
<?php
//mobilePhone class
class Tablates extends ElectronicsAndComputer{
   public $contrateTime;	
	
public function tablateAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contrateTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//mobilePhone class
class TVs extends ElectronicsAndComputer{
  public $contrateTime;	
	
public function tvAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contrateTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//mobilePhone class
class ComputerAccessory extends ElectronicsAndComputer{
  public $contrateTime;	
	
public function computerAccessoryAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contrateTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//fiction class
class Fiction extends Books{
	public $contrateTime;
	
public function fictionAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contrateTime=$time;

}


}


?>

</body>
</html>


<html>
<body>
<?php
//fiction class
class Science extends Books{
	public $contrateTime;
	
public function sciencehAddToDB($name ,$price ,$picture ,$description){
  //$itemName=$name;

  	
}
public function setContratTime($time){
    $contrateTime=$time;

}

}



?>

</body>
</html>









<html>
<body>
<?php
//postItem class
class PostItem extends Category{
	
	
public function postDetailFromDb($nam ,$pric ,$picture ,$description){
     //$itemName=$nam;
		//$itemPrice=$pric;
		//$itemPicture=$picture;
		//$itemDescription=$description;

   }
//public function displayDetailFromDb($name ,$price ,$picture ,$description)
 

public function displayDetail(){
	  echo "<br />I am in postItem class!";
		//echo "<br />itemName is ".$itemName;
		//echo "<br />itemPrice is ".$itemPrice;
	  echo "<br />itemName is  ".$this->itemName; 
		 echo "<br />itemPrice is  ".$this->itemPrice;
	}
}

  $post=new PostItem;
	  $post->itemName="wool coat";
	  $post->itemPrice=1000;
  		//$post->display();
  		//$post->displayDetail();
  $kshoe=new KidsAndBabyShoe;
	  $kshoe->itemName="snake";
	  $kshoe->itemPrice=2000;
	  	$kshoe->displayDetails();


?>

</body>
</html>


<html>
<body>
<?php
//removeItem class
class RemoveItem extends Category{
	

public function removeDetailFromDb($name ,$price ,$picture ,$description){
 

}
public function removeDetailFromDisplayViewPage($name ,$price ,$picture ,$description){
 

}

	
}


?>

</body>
</html>


<html>
<body>
<?php
class  LaravelOrActionListener{ 



}


?>

</body>
</html>


<html>
<body>
<?php
class  DatabaseQuery {



}


?>

</body>
</html>
