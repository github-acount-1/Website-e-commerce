<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';


	class Category{

		public static function categoryExists($categoryName){
			global $pdo;
			$sql="SELECT count(*) FROM category WHERE category_name=:cn";
			$statement=$pdo->prepare($sql);
			$statement->execute(array(":cn"=>strtolower($categoryName)));

			return $statement->fetch()[0]>=1;
		}


		public static function addCategory($categoryName){
			global $pdo;

			if(self::categoryExists(strtolower($categoryName))){
				return false;
			}
			else{
				try{
					$sql="INSERT INTO category(category_name) VALUES('$categoryName')";
					$statement=$pdo->prepare($sql);
					$statement->execute();
					return true;
				}
				catch(Exception $e){
					return false;
				}
			}
		}

		public static function getCategoryList(){
			global $pdo;

			$sql = "SELECT category_name, id from category ORDER BY category_name";
			$stm = $pdo->prepare($sql);
			$stm->execute();
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);

			return $result;
		}

		public static function getCategoryCount(){
			global $pdo;

			$sql = "SELECT count(*) FROM category";
			$stm = $pdo->prepare($sql);
			$stm->execute();

			return $stm->fetch()['count(*)'];
		}

		public static function getCatName($cat_id){
			global $pdo;

			$sql = "SELECT category_name  from category WHERE id = :i";
			$stm = $pdo->prepare($sql);
			$stm->execute(array(":i"=>$cat_id));
			
			return $stm->fetch()['category_name'];
		}

		public static function getCatId($cat_name){
			global $pdo;

			$sql = "SELECT id  from category WHERE category_name = :i";
			$stm = $pdo->prepare($sql);
			$stm->execute(array(":i"=>$cat_name));
			
			return $stm->fetch()['id'];
		}

		public static function getItemsCategory($item_id){
			global $pdo;

			$sql = "SELECT category  from items WHERE item_id = :i";
			$stm = $pdo->prepare($sql);
			$stm->execute(array(":i"=>$item_id));
			
			return $stm->fetch()['category'];
		}
	}
?>