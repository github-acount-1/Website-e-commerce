<?php
	$title="New Topic";
	
	$root = $_SERVER['DOCUMENT_ROOT'];
	if($root[strlen($root) - 1] != "/")
	    $root .= "/";

	require_once $root.'shola/php/includes/helpers_inc.php';
    require_once $root.'shola/php/classes/user.class.php';
	require_once $root .'/shola/php/includes/db_inc.php';

	if(!userIsLoggedIn()){
		header("Location: ".getRootPath());
		exit();
	}
	
	require_once $root.'shola/php/pages/header.html.php';

?>
<body>
	<div class="container bg-white no-margin-bottom">



		<h2 class="padding20">Forum</h2>

		<hr class="thin margin20 no-margin-top"/>

		<div class=" grid padding20">
			<h2><b>Create New Topic</b></h2>
			<form  name="form1" method="post" action="<?php echo getRootPath().'php/forum/add_new_topic.php'; ?>">
				<div class="row input-control modern text" data-role="input">
					<input type="text" name="topic">
					<span class="label" >Topic</span>
					<span class="placeholder">Enter your topic</span>
				</div>

				<div class="row input-control textarea" >
					<span>Description</span><br><br>
					<textarea rows="5" cols="30" name="detail" placeholder="Enter topic here..." style="max-width: 600px; max-height: 200px" >
					</textarea><br>
				</div>
				<div class="row">
					<input class="button rounded place-left primary" type="submit" value="Submit" name="submit"   style="width:80px">
					<input class="button rounded place-right primary" type="submit" value="Reset"  name="submit1"  style="width:80px">
				</div>
			</form>
		</div>
	</div>
<?php
    require_once $root.'shola/php/pages/footer.html.php';
?>