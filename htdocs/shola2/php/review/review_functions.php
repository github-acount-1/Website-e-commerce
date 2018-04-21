<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';

	function get_total() {
		$result = mysqli_query($con, "SELECT * FROM `parents` ORDER BY `date` DESC");
		$row_cnt = mysqli_num_rows($result);
		echo '<h1>Total Review ('.$row_cnt.')</h1>';
	}

	function get_comments($item_id) {
		global $con;
		$result =  mysqli_query($con, "SELECT * FROM `parents` WHERE item_id = $item_id ORDER BY `date` DESC");
		@$row_cnt = mysqli_num_rows($result);


		foreach($result as $item) {
			$date = new dateTime($item['date']);
			$date = date_format($date, 'M j, Y | H:i:s');
			$user = $item['user'];
			$comment = $item['text'];
			$par_code = $item['code'];

			echo '<div class="comment" id="'.$par_code.'">'
					.'<b><p class="user">'.$user.'</p></b>&nbsp;'
					.'<p class="time">'.$date.'</p>'
					.'<p class="comment-text">'.$comment.'</p><br>';
			/*
					$chi_result = mysqli_query($connect, "SELECT * FROM `children` WHERE `par_code`='$par_code' ORDER BY `date` DESC");
				$chi_cnt = mysqli_num_rows($chi_result);

	            if($chi_cnt == 0){
					
				} else {
					echo '<a class="link-reply" id="children" name="'.$par_code.'"><span id="tog_text">replies</span> ('.$chi_cnt.')</a>'
						.'<div class="child-comments" id="C-'.$par_code.'">';

					foreach($chi_result as $com) {
						$chi_date = new dateTime($com['date']);
						$chi_date = date_format($chi_date, 'M j, Y | H:i:s');
						$chi_user = $com['user'];
						$chi_com = $com['text'];
						$chi_par = $com['par_code'];

						echo '<div class="child" id="'.$par_code.'-C">'
								.'<p class="user">'.$chi_user.'</p>&nbsp;'
								.'<p class="time">'.$chi_date.'</p>'
								.'<p class="comment-text">'.$chi_com.'</p>'
							.'</div>';
					}
					echo '</div>';
				}
            */
				echo '</div>';
		}
	}

	function generateRandomString($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characterLength = strlen($characters);
		$randomString = '';

		for($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $characterLength - 1)];
		}
		return $randomString;
	}
?>