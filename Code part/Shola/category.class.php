<?php 

require_once "helpers.inc.php";
require_once ROOT_DIR.'connectDB-inc.php';


class category{
	$categoryName="";
	$categoryExists=false;



	public function categoryExists($categoryName){
		global $db;
		$sql="SELECT * FROM category WHERE categoryName=$categoryName";
		$statement=$db->prepare($sql);
		$statement->execute();
		if($statement->rowCount>=1){
			$categoryExists=true;
		}else{
			$categoryExists=false;
		}
		return $categoryExists;

	}


	public function addCategory($categoryName){
		global $db;
		if($this->categoryExists($categoryName)){
			exit();
		}
		else{
			try{
				$sql="INSERT INTO category(categoryName) VALUES($categoryName)";
				$statement=$db->prepare($sql);
				$statement->execute();
				
			}catch(Exception $e){
				$e->getMessage();
			}

		}
	}



	s



}
	