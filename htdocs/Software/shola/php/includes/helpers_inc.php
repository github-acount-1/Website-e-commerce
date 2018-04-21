<?php
//	define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'].'shola/');

	/**
	 * Get the root path relative to current directory
	 * @param - none
	 * @return path to root directory
	 */
	function getRootPath(){
		//Get current directory
		$cur_dir = $_SERVER['PHP_SELF'];
		$reps = 0;

		//count if / is repeated
		for($i=1, $end=strlen($cur_dir); $i<$end; $i++){
			if($cur_dir[$i] == '/' && $cur_dir[$i-1] == '/')
				$reps = $reps + 1;
		}

		//count number of backslashes
		$arr = explode('/', $cur_dir);
		//normalize backslash count
		$up = count($arr) - 3 - $reps;
		//generate root path
		$root = "";
		for($i=0; $i<$up; $i++)
			$root = $root."../";

		return $root;
	}

	/**
	 * Check if user is logged in
	 * @return - boolean of user log indication
	 */
	function userIsLoggedIn(){
		require_once 'db_inc.php';
		require_once getRootPath().'/shola/php/classes/user.class.php';

		global $pdo;

		@session_start();
		if(isset($_SESSION['loggedin']) && isset($_SESSION['user']) && $_SESSION['loggedin'] == true){
			$usr = $_SESSION['user'];
			$sql = "SELECT count(*) FROM customer WHERE email = :e";
			$stm = $pdo->prepare($sql);
			$stm->execute(array(":e"=>$usr->getEmail()));
			return $stm->fetch()[0] > 0;
		}
		return false;
	}
?>