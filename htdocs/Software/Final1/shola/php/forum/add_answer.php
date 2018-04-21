<?php 
	require_once '../includes/helpers_inc.php';
	require_once getRootPath().'php/includes/db_inc.php';
	require_once getRootPath().'php/classes/user.class.php';
    session_start();


	$tbl_name ="fanswer" ;
// Get value of id that sent from hidden field
	$id= $_POST ['id' ];
// Find highest answer number.
	$sql ="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE question_id='$id'" ;
	$result=$pdo->prepare($sql);
	$result->execute();
	$rows =$result->fetch();
// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1
	if ( $rows ) {
		$Max_id = $rows ['Maxa_id']+ 1;
	}
	else {
		$Max_id = 1 ;
	}
// get values that sent from form
	$a_name =$_SESSION['user']->getName();
	$a_email =$_SESSION['user']->getEmail();
	$a_answer =$_POST ['a_answer' ];
	$datetime= date( "d/m/y H:i:s" ); // create date and time
	// Insert answer
	$sql2 ="INSERT INTO $tbl_name(question_id, a_id, a_name, a_email, a_answer, a_datetime) 
	VALUES('$id', '$Max_id', '$a_name', '$a_email', '$a_answer', '$datetime')" ;
	$result2=$pdo->prepare($sql2);
	$result2->execute();
	if ( $result2 ){
        header('Location:../pages/forum/view_topic.html.php');
		/*echo "Successful<BR>" ;
		echo "<a href='../pages/forum/view_topic.html.php?id=" . $id. "'>View your comment</a>" ;*/
	// If added new answer, add value +1 in reply column
		$tbl_name2 = "fquestions" ;
		$sql3 ="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id='$id'" ;
		$result3=$pdo->prepare($sql3);
		$result3->execute();

		header("Location: ../pages/forum/view_topic.html.php?id=". $id, true, 303);
	}
	else {
		echo "ERROR" ;
	}

?>
