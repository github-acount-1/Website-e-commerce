<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
	// if(!userIsLoggedIn()){
	// 	header('Location: '.getRootPath());
	// 	exit();
	// }
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
	$id = $_GET['id'];

	include 'Database.php';
	// include 'SaveQuestion.php';

	if( isset($_POST['submit_question']) ) {


		$question = $_POST['user_question'];

		// check if fields are not null
		if( !is_null($question) ) {
			// check if fields are empty
			if( !empty($question) ) {

				$database = new Database();
				$user_keywods = explode(' ', $question);

				$result = [];
				

				foreach ($user_keywods as $key => $value) {
					$sql = "SELECT * FROM questions where prod_id = {$id} and keywords like '%$value%' limit 1";

					// echo "Value: $value";

					$db_result = $database->select($sql);
					$result = !empty($db_result) ? $db_result : []; 

					// print_r($result);

					if(count($result)) {
						// increment count
						$prod_id = $result[0]['prod_id'];
						$prev_count = $result[0]['count'] != null ? $result[0]['count'] : 0;

						$answer = $result[0]['answer'];

						// var_dump($prev_count);

						$sql2 = "UPDATE questions set count = ? where prod_id = ? ";	
						$params2 = [$prev_count + 1, $prod_id];

						$database->update($sql2, $params2);

						break;
					} 

				}

				echo "Operation Successful";
				
				// print_r($result);

			} else {
				$error_msg = 'Please fill out all the fields';
			}
		} else {
			$error_msg = 'Please fill out all the fields';
		}

	}





?>
<body>

<div class ="bg-white">
  <div class="padding20">

    <h1>Ask Your Question Here... </h1>

  </div>


<div class="padding20">
    <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id; ?>" class="ask_question" method="post">
      <div class="input-control modern text full-size" data-role="input">

            <input type="text" name="user_question"   id="question_box">
            <span class="label">Question</span>
            <span class="placeholder">Enter your question</span>
      </div>
    <button class="button rounded  primary" value="Submit" type="submit" name="submit_question" id="p" style="width:80px">
    Submit
    </button>
      </form>
      <div class="padding10">
    <?php if(isset($answer)): ?>
            <h4>Answer</h4>
            <p  style="font-size:20px;" class="answer">
                <?= $answer; ?>
            </p>
        <?php endif; ?>
    </div>
    </div>
</div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>