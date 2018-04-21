<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] .'/shola/php/includes/db_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] .'/shola/php/includes/helpers_inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/classes/user.class.php';
    session_start();
    if(!userIsLoggedIn()){
		header("Location: ".getRootPath());
		exit();
	}
	require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/header.html.php';
	$tbl_name ="fquestions" ; // Table name
	// get value of id that sent from address bar
	$id= $_GET ['id' ];
	$sql ="SELECT * FROM $tbl_name WHERE id='$id'";
	$result=$pdo->prepare($sql);
	$result->execute();
	$rows =$result->fetch();
	?>
<body>
	<div class="bg-white">
		<table width ="400" border ="0" align="center" cellpadding ="0" cellspacing= "1" bgcolor= "#CCCCCC">
			<tr>
				<td><table width= "100%" border ="0" cellpadding ="3" cellspacing= "1" bordercolor ="1"bgcolor= "#FFFFFF">
					<tr>
						<td bgcolor="#F8F7F1"><strong> <?php echo $rows['topic']; ?> </strong></td>
					</tr>
					<tr>
						<td bgcolor="#F8F7F1"> <?php echo $rows['detail']; ?> </td>
					</tr>
					<tr>
						<td bgcolor="#F8F7F1"><strong> By :</strong><?php echo $rows['name']; ?> <strong> Email : </strong> <?php echo $rows ['email']; ?> </td>
					</tr>
					<tr>
						<td bgcolor="#F8F7F1" ><strong> Date /time : </strong> <?php echo $rows ['datetime']; ?> </td>
					</tr>
				</table></td>
			</tr>
		</table>
		<br>
		<?php
		$tbl_name2 = "fanswer" ; // Switch to table "forum_answer"
		$sql2 ="SELECT * FROM $tbl_name2 WHERE
		question_id='$id'" ;
		$result2=$pdo->prepare($sql2);
		$result2->execute();?>
		<?php foreach($result2 as $rows): ?>

			<table width ="400" border ="0" align="center"
			cellpadding ="0" cellspacing= "1" bgcolor= "#
			CCCCCC">
			<tr>
				<td><table width= "100%" border ="0" cellpadding ="3" cellspacing= "1" bgcolor= "#FFFFFF" >

					<tr>
						<td width ="18%" bgcolor="#F8F7F1" ><strong> Name </strong></td>
						<td width ="5%" bgcolor="#F8F7F1" >:</td>
						<td width ="77%" bgcolor="#F8F7F1" > <?php echo $rows['a_name' ]; ?> </td>
					</tr>
					<tr>
						<td bgcolor="#F8F7F1" ><strong> Comment </strong ></td>
						<td bgcolor="#F8F7F1" >:</td>
						<td bgcolor="#F8F7F1" > <?php echo $rows[ 'a_answer' ]; ?> </td>
					</tr>
					<tr>
						<td bgcolor="#F8F7F1" ><strong> Date /Time </strong ></td>
						<td bgcolor="#F8F7F1" >:</td>
						<td bgcolor="#F8F7F1" > <?php echo $rows[ 'a_datetime' ]; ?> </td>
					</tr>
				</table></td>
			</tr>
		</table><br>
		<?php
		endforeach;
		$sql3 ="SELECT view FROM $tbl_name WHERE id='$id'" ;
		$result3=$pdo->prepare($sql3);
		$result3->execute();
		$rows =$result->fetch();
		$view =$rows ['view'];
		// if have no counter value set counter = 1
		if ( empty( $view )){
			$view =1;
		//$sql4 ="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'" ;
			$sql4 ="update $tbl_name set view='$view' WHERE id='$id'" ;
			$result4=$pdo->prepare($sql4);
			$result4->execute();
		}
		// count more value
		$addview =$view +1;
		$sql5 ="update $tbl_name set view='$addview'WHERE id='$id'" ;
		$result5=$pdo->prepare($sql5);
		$result5->execute();
		$rows =$result->fetch();
		?>
		<br>
		<table width ="400" border ="0" align="center" cellpadding ="0" cellspacing= "1" bgcolor= "#CCCCCC">
			<tr>
				<?php
					if(userIsLoggedIn()){
				?>
						<form name ="form1" method ="post" action="../../forum/add_answer.php">
							<td>
								<table width ="100%" border ="0" cellpadding = "3"
								cellspacing ="1" bgcolor ="#FFFFFF">
								
								<tr>
									<td valign = "top" ><strong> Comment</strong></td>
									<td valign = "top" >:</td>
									<td><textarea name ="a_answer" cols ="45" rows= "3" id="a_answer" ></textarea></td>
								</tr>
								<tr>
									<td>&nbsp; </td>
									<td><input name ="id" type ="hidden" value=" <?php echo $id ; ?>"></td>
									<td><input type ="submit" name ="Submit" value="Submit"> <input type ="reset" name = "Submit2" value="Reset"></td>
									</tr>
									</table>
								</td>
							</form>
				<?php	
					}
				?>
				
				</tr>
			</table>
	</div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/pages/footer.html.php';
?>