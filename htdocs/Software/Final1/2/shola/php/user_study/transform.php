<?php

	$root = $_SERVER['DOCUMENT_ROOT'];
	if($root[strlen($root) - 1] != "/")
	    $root .= "/";

	require_once $root.'shola/php/includes/helpers_inc.php';				//this includes helper function that everyone has access to
	require_once $root.'shola/php/classes/user.class.php';
	require_once $root.'shola/php/includes/db_inc.php';	//this includes the database connection using a pdo interface and returns $pdo variable

	@session_start();
	if(!userIsLoggedIn()){
		header("Location: ".getRootPath());
		exit();
	}

	/**
	* This function gets user from the database and stores it
	* in an appropriate dictionary data structure
	* @param – none
	* @output- tansformed user, user_data list
	*/ 
	function get_transformed_data(){

		//declare pdo as global variable this variable is imported from external php file(db.inc.php)
		global $pdo;

		//create an associative array that holds user and the corresponding scores for categories
		$user_list = array();				

		//query statement to get all users from database
		$sql = "SELECT * FROM customer";		
		//prepare query and store result in variables users
		$users = $pdo->prepare($sql);		
		//execute prepared query this variable now holds resource of users list
		$users->execute();					

		//fetch users one by one and store in row variable
		while($row = $users->fetch()){		

			//store current user in cur_user variable
			$cur_user = $_SESSION['user']->getUserId();				
			
			//select category and score ensure user parameter to be binded later
			$sql = "SELECT category, score FROM user_data WHERE user_id=:u";			
			$user_prefs = $pdo->prepare($sql);					
			//assign :u parameter the value of current user			
			$user_prefs->bindvalue(":u", $cur_user);			
			//execute sql and return cur users category and corresponding user
			$user_prefs->execute();		
			//empty array to hold associative value of category and score						
			$data_set = array();

			//fetch category and corresponding score for $cur_user from user_prefs table
			while($col = $user_prefs->fetch()){
				$category = $col['category'];
				$score = $col['score'];
				//insert category as key and score as value in data_set
				$data_set[$category] = $score;
			}

			//associate $cur_user(as key) with dataset(as value)
			$user_list[$cur_user] = $data_set;
		}

		return $user_list;
	}


	function similarity_pearson($user_data, $user_one, $user_two){
		//Get list of items both users have bought and store in similar items
		$similar_items = array();

	//	echo "<pre>"; print_r($user_data); echo "<pre><br><br>";

		$user_one_items = array_keys($user_data[$user_one]);
		$user_two_items = array_keys($user_data[$user_two]);

		 // echo "<pre>"; print_r($user_one_items); echo "<pre><br><br>";
		 // echo "<pre>"; print_r($user_two_items); echo "<pre><br><br>";

		foreach($user_one_items as $item){
	//		echo "$item ".in_array($item, $user_two_items)."<br>";
			if(in_array($item, $user_two_items))
				$similar_items[] = $item;
		}

	//	echo "<pre>"; print_r($similar_items); echo "<pre><br>";
		$no_of_items = count($similar_items);

		if($no_of_items == 0) return 0;

	//	echo "<br><pre>";print_r($scores_user_one);echo"<pre><br>";
	//	echo "<pre>";print_r($scores_user_two);echo"<pre><br>";
	   	$sum_one = 0;
	   	$sum_sq_one = 0;
	   	$sum_two = 0;
	   	$sum_sq_two = 0;
	   	$product_sum = 0;
	//   	echo "user one<br>";
	   	foreach($user_one_items as $item){
	//   		echo "$item: ".in_array($item, $similar_items)."<br>";
	   		if(in_array($item, $similar_items)){
	   			$sum_one += $user_data[$user_one][$item];
	   			$sum_sq_one += pow($user_data[$user_one][$item], 2);

	   			$sum_two += $user_data[$user_two][$item];
	   			$sum_sq_two += pow($user_data[$user_two][$item], 2);

	   			$product_sum += $user_data[$user_one][$item] * 
								$user_data[$user_two][$item];
	   		}
	    }

	//	echo "prod: $product_sum<br>";

		$numerator = $product_sum - ($sum_one * $sum_two/$no_of_items);
		$term1 = $sum_sq_one - pow($sum_one, 2)/$no_of_items;
		$term2 = $sum_sq_two - pow($sum_two, 2)/$no_of_items;
		$denominator = sqrt($term1 * $term2);

	//	echo "num: $numerator  den: $denominator<br>";

		return ($denominator == 0)? 0 : ($numerator/$denominator);

	}

	function top_matches($user_data, $user, $n=5){
		$scores = array();

		foreach($user_data as $other_user => $data){
			if($other_user != $user)
				$scores[] = array(similarity_pearson($user_data, $user, $other_user), $other_user);
		}
		rsort($scores);
	//	echo "<pre>"; print_r($scores); echo "<pre><br><br>";
		return $scores;
	}

	function user_based_analysis($user_data, $user){
		$totals = array();
		$similarity_sum = array();
		$user_one_items = array_keys($user_data[$user]);

		// echo "<pre>";
		// print_r($user_one_items);
		// echo "<pre>";

		foreach($user_data as $other_user =>$prefs){
			if($other_user == $user) continue;

			$similarity = similarity_pearson($user_data, $user, $other_user);

			if($similarity <= 0) continue;

			 // echo "<br>Prefs: $other_user<br>";
			// print_r($prefs);
			// echo "<pre>";
			foreach($prefs as $item => $score){
				// echo "<br>Item: $item<br>";
				if(!in_array($item, $user_one_items) || 
					$user_data[$user][$item] == 0){
					
					if(!array_key_exists($item, $totals))
						$totals[$item] = 0;
					$totals[$item] += $score * $similarity;
					
					if(!array_key_exists($item, $similarity_sum))
						$similarity_sum[$item] = 0;
					$similarity_sum[$item] += $similarity;
					// echo "Not in<br>";
					// echo "total[$item] = $totals[$item]<br>";
					// echo "simil[$item] = $similarity_sum[$item]<br>";
				}
			}
		}
		// echo "<pre>";
		// print_r($totals);
		// echo "<pre>";

		// echo "<pre>";
		// print_r($similarity_sum);
		// echo "<pre>";

		$rankings = array();
		$item_list = array_keys($totals);
		foreach($item_list as $item){
			$rankings[] = array($totals[$item]/$similarity_sum[$item],
								$item);
		}
		rsort($rankings);

		// echo "<pre>";
		// print_r($rankings);
		// echo "<pre>";

		return $rankings;
	}

	function userCategoryExists($user, $cat){
		global $pdo;

		$sql = "SELECT count(*) from user_preference where user_id=:u and category=:c";
		$stm = $pdo->prepare($sql);
		$stm->execute(array(":u"=>$user, ":c"=>$cat));

		return $stm->fetch()[0] > 0;
	}

	function writeListToDB($prefs){
		global $pdo;
		$user_id = $_SESSION['user']->getUserId();

		foreach($prefs as $p){
			if(userCategoryExists($user_id, $p[1])){
				$sql = "UPDATE user_preference SET score=:s WHERE user_id=".$user_id." AND category = '".$p[1]."'";
				$stm = $pdo->prepare($sql);
				$stm->execute(array(":s"=>$p[0]));
			}
			else{
				$sql = "INSERT INTO user_preference SET user_id=".$user_id.", category = '".$p[1]."'";
				// echo $sql."<br>";
				$stm = $pdo->prepare($sql);
				$stm->execute();
			}
		}
	}
	
	$critics=array('Lisa Rose'=> array('Lady in the Water'=> 2.5, 'Snakes on a Plane'=> 3.5,
	'Just My Luck'=> 3.0, 'Superman Returns'=> 3.5, 'You, Me and Dupree'=> 2.5,
	'The Night Listener'=> 3.0),
	'Gene Seymour'=> array('Lady in the Water'=> 3.0, 'Snakes on a Plane'=> 3.5,
	'Just My Luck'=> 1.5, 'Superman Returns'=> 5.0, 'The Night Listener'=> 3.0,
	'You, Me and Dupree'=> 3.5),
	'Michael Phillips'=> array('Lady in the Water'=> 2.5, 'Snakes on a Plane'=> 3.0,
	'Superman Returns'=> 3.5, 'The Night Listener'=> 4.0),
	'Claudia Puig'=> array('Snakes on a Plane'=> 3.5, 'Just My Luck'=> 3.0,
	'The Night Listener'=> 4.5, 'Superman Returns'=> 4.0,
	'You, Me and Dupree'=> 2.5),
	'Mick LaSalle'=> array('Lady in the Water'=> 3.0, 'Snakes on a Plane'=> 4.0,
	'Just My Luck'=> 2.0, 'Superman Returns'=> 3.0, 'The Night Listener'=> 3.0,
	'You, Me and Dupree'=> 2.0),
	'Jack Matthews'=> array('Lady in the Water'=> 3.0, 'Snakes on a Plane'=> 4.0,
	'The Night Listener'=> 3.0, 'Superman Returns'=> 5.0, 'You, Me and Dupree'=> 3.5),
	'Toby'=> array('Snakes on a Plane'=>4.5,'You, Me and Dupree'=>1.0,'Superman Returns'=>4.0));

	// echo "<pre>";
	// print_r(user_based_analysis(get_transformed_data(), "bob"));
	// echo "<pre>";

//	$rev = reverse_user_data(get_transformed_data());


	// echo "<pre>";
	// print_r(top_matches($rev, "laptop"));
	// echo "<pre>";

	// echo "<pre>";
	// print_r(user_based_analysis($critics, 'Toby'));
	// echo "<pre>";

	// writeListToDB(user_based_analysis(get_transformed_data(), $_SESSION['user']->getUserName()));

	// echo "<pre>";
	// print_r(get_transformed_data());
	// echo "<pre>";
?>