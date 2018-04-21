<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/review/review_functions.php';
   ?>
<html>
	<head>
		<title>reviewing</title>
		<meta charset="UTF-8" lang="en-US">
		<link rel="stylesheet" href="style.css">
		<script src="<?php echo getRootPath().'js/jquery.3.2.1.min.js';?>"></script>
		<!--<script src="js/global.js"></script>-->
	</head>
	<body>
		<div class="page-container">
			<form action="check_com.php" method="post" class="main">
				<label>enter your review:</label>
				<textarea class="form-text" name="comment" id="comment"></textarea>
				<br />
				<input type="submit" class="form-submit" name="new_comment" value="Submit Review">
			</form>
			
		</div>
	</body>
</html>