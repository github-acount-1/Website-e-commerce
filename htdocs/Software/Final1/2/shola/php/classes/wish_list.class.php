<?php
	$root = $_SERVER['DOCUMENT_ROOT'];
	if($root[strlen($root) - 1] != "/")
		$root .= "/";
		
	require_once $root.'shola/php/includes/helpers_inc.php';
	require_once $root.'shola/php/includes/db_inc.php';
	require_once $root.'shola/php/classes/user.class.php';
	require_once $root.'shola/php/classes/notify.class.php';
	require_once $root.'shola/php/classes/item.class.php';

	class WishList{
		private $user_id;
		private $item_id;

		public function __construct($user, $item){
			$this->user_id = $user;
			$this->item_id = $item;
		}

		public function inWishList(){
			global $pdo;

			$sql = "SELECT count(*) FROM wish_list WHERE user_id=:u AND item_id=:i";
			$stm = $pdo->prepare($sql);
			$stm->execute(array(":u"=>$this->user_id, ":i"=>$this->item_id));

			return $stm->fetch()['count(*)'] > 0;
		}

		public function addToWishList(){
			global $pdo;
			if(!self::inWishList()){
				$sql = "INSERT INTO wish_list SET user_id=:u, item_id=:i";
				$stm = $pdo->prepare($sql);
				if($stm->execute(array(":u"=>$this->user_id, ":i"=>$this->item_id))){
					$item_name = itemClass::getItemName($this->item_id);
					Notification::addNotification($this->user_id, "{$item_name} added to wish list");
					return true;
				}
			}
			return false;
		}

	}	
?>