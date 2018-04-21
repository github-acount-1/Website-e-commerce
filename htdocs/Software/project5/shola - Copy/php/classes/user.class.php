<?php
	require_once ROOT_DIR.'php/includes/db_inc.php';

	class User{
		private $password;
		private $email;
		private $user_name;
		private $user_id;
		private $phone;
		private $city;
		private $country;
		private $full_name;

		function __construct($email, $pass){
			$this->email = $email;
			$this->password = $pass;
			$this->user_name = self::executeSql("user_name");
			$this->user_id = self::executeSql("user_id");
			$this->email = self::executeSql("email");
			$this->phone = self::executeSql("phone_number");
			$this->full_name = self::executeSql("first_name")." ".self::executeSql("last_name");
			$this->country = self::executeSql("country");
			$this->city = self::executeSql("city");
		}

		/**
		 * This function recives a field variable and returns correspoinding results
		 */
		private function executeSql($field){
			global $pdo;

			//prepare selection statement using field
			$sql = "SELECT {$field} FROM customer WHERE email = :e AND password = :p";
			$stm = $pdo->prepare($sql);
			$stm->execute(array(":e"=>$this->email, ":p"=>$this->password));

			return $stm->fetch()[$field];
		}

		public function getEmail(){
			return $this->email;
		}

		public function getUserName(){
			return $this->user_name;
		}

		public function getUserId(){
			return $this->user_id;
		}

		public function getPhone(){
			return $this->phone;
		}

		public function getName(){
			return $this->full_name;
		}

		public function getCountry(){
			return $this->country;
		}

		public function getCity(){
			return $this->city;
		}
	}

?>