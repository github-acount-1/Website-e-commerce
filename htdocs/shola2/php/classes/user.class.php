<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/helpers_inc.php';
	//require_once $_SERVER['DOCUMENT_ROOT'].'/shola/php/includes/db_inc.php';
	//require_once getRootPath().'php/includes/db_inc.php';
	require_once getRootPath().'php/includes/db_inc.php';

	class User{
		private $password;
		private $email;
		private $user_name;
		private $user_id;
		private $phone;
		private $city;
		private $country;
		private $full_name;
		private $firstName;
		private $lastName;

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
			$this->firstName = self::executeSql("first_name");
			$this->lastName = self::executeSql("last_name");
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

		public function getPassword(){
			return $this->password;
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

		public function getFirstName(){
			return $this->firstName;
		}

		public function getLastName(){
			return $this->lastName;
		}

		public function getCountry(){
			return $this->country;
		}

		public function getCity(){
			return $this->city;
		}

		public static function checkExistence($sql, $field){
			global $pdo;

			//prepare selection statement using field
			$stm = $pdo->prepare($sql);
			$stm->execute(array(":f"=>$field));

			return $stm->fetch()['COUNT(*)'] > 0;
		}

		public  static function userExists($user){
			return self::checkExistence("SELECT COUNT(*) FROM customer WHERE user_name = :f", $user);
		}

		public static function emailExists($email){
			return self::checkExistence("SELECT COUNT(*) FROM customer WHERE email = :f", $email);
		}

		public static function phoneExists($phone){
			return self::checkExistence("SELECT COUNT(*) FROM customer WHERE phone_number = :f", $phone);
		}
	}
	// echo "E: ".User::emailExists("hp@g.c")."<br>";
	// echo "E: ".User::emailExists("ron@g.c")."<br>";
	// echo "E: ".User::emailExists("hp@.c")."<br>";
	// echo "E: ".User::emailExists("hpp@g.c")."<br>";
	// echo "<br>E: ".User::userExists("ron")."<br>";
	// echo "E: ".User::userExists("hp")."<br>";
	// echo "E: ".User::userExists("ronx")."<br>";
	// echo "E: ".User::userExists("rs")."<br>";
	// echo "<br>E: ".User::phoneExists(123456)."<br>";
	// echo "<br>E: ".User::phoneExists(21323456)."<br>";
	// echo "<br>E: ".User::phoneExists(2123456)."<br>";
	// echo "<br>E: ".User::phoneExists(12)."<br>";
	// $u = new User('r@g.c', 123);
	// echo $u->getLastName();
	// echo "<br>Em".$u->getEmail();
?>