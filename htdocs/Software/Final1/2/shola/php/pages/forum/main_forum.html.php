<?php 
	$title="Forum";

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
	$tbl_name ="fquestions" ; // Table name
	$sql ="SELECT * FROM $tbl_name ORDER BY id ASC" ;
	// OREDER BY id DESC is order result by descending
	$result=$pdo->prepare($sql);
	$result->execute();
?>
<body>
<div class="bg-white" style="padding: 20px;">
    
    <H2> Main Forum </H2>
    <hr class="thin">
    
	<table width ="90%" border = "0" align= "center" cellpadding ="3" cellspacing= "1" bgcolor= "#CCCCCC">
		<tr>
			<td width ="6%" align="center" bgcolor="#E6E6E6"><strong> #</strong></td>
			<td width ="53%" align="center" bgcolor="#E6E6E6"><strong> Topic </strong></td>
			<td width ="15%" align="center" bgcolor="#E6E6E6"><strong> Views </strong ></td>
			<td width ="13%" align="center" bgcolor="#E6E6E6"><strong> Replies </strong></td>
			<td width ="13%" align="center" bgcolor="#E6E6E6"><strong> Date /Time </strong ></td>
		</tr>
		<?php foreach($result as $rows):?>
			<tr>
				<td bgcolor="#FFFFFF" > <?php echo $rows[ 'id' ]; ?> </td>
				<td bgcolor="#FFFFFF" ><a href ="view_topic.html.php?id= <?php echo $rows[ 'id' ]; ?>"> <?php echo $rows ['topic' ]; ?> </a> <br> </td>
				<td align="center" bgcolor="#FFFFFF"> <?php echo $rows ['view' ]; ?> </td>
				<td align="center" bgcolor="#FFFFFF" > <?php echo $rows ['reply' ]; ?> </td>
				<td align="center" bgcolor="#FFFFFF" > <?php echo $rows ['datetime' ]; ?> </td>
			</tr>
		<?php endforeach;?>
		<?php
			if(userIsLoggedIn()){
		?>
				<tr>
					<td colspan= "5" align= "right" bgcolor="#E6E6E6" ><a href ="new_topic.html.php"><strong> Create New Topic </strong> </a></td>
				</tr>
		<?php		
			}
		?>
		
	</table>
</div>
<?php
    require_once $root.'shola/php/pages/footer.html.php';
?>