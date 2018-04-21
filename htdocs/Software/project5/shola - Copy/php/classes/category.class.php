<?php 

require_once "helpers.inc.php";
require_once ROOT_DIR.'connectDB-inc.php';


class category{
	public $categoryName;
	//$categoryExists=false;



	public function setCategoryName($name){
		$categoryName=$name;
		return $categoryName;
	}

	public function getCategoryName(){
		return $categoryName;
	}

	public function categoryExists($categoryName){
		global $db;
		$sql="SELECT * FROM category WHERE categoryName=:categoryName";
		$statement=$db->prepare($sql);
		$statement->bindValue(':categoryName',$categoryName);
		$statement->execute();
		if($statement->rowCount()>=1){
			$categoryExists=true;
			echo 'exists';
		}else{
			$categoryExists=false;
			echo 'doesnt exist';
		}
		return $categoryExists;

	}


	public function addCategory($categoryName){
		global $db;
		if(!$this->categoryExists($categoryName)){
			try{
				$sql="INSERT INTO category(categoryName) VALUES(:categoryName)";
				$statement=$db->prepare($sql);
				$statement->bindValue(':categoryName',$categoryName);
				$statement->execute();
				echo 'added';
				
			}catch(Exception $e){
				$error=$e->getMessage();
				echo "not added".$error;
			}
		}
		else{
			echo 'not added';

		}
	}



	



}
	