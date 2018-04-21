<?php
	define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'].'/Software/project5/Shola/php/includes/');

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
		@session_start();
		return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true);
	}
?>