<?php
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/helpers_inc.php';
require_once $_SERVER['DOCUMENT_ROOT'].'shola/php/includes/db_inc.php';
class Notification{
	public static function addNotification($user_id, $notif){
		global $pdo;

		try{
			$sql="INSERT INTO notifications (notification,user_id,notif_date) VALUES (:notif,:id,CURRENT_TIMESTAMP)";
			$statement=$pdo->prepare($sql);
			$statement->bindValue(':notif',$notif);
			$statement->bindValue(':id',$user_id);
			$statement->execute();
		}catch(Exception $e){
			//do sth
		}
		try{
			$sql2="UPDATE new_notification_count SET new_notif_count=new_notif_count+1 WHERE user_id=:id";
			$stmt=$pdo->prepare($sql2);
			$stmt->bindValue(':id',$user_id);
			$stmt->execute();
		}
		catch(Exception $e){

		}
 	}
 	public static function clearCount($user_id){
 		global $pdo;
 		try{
			$sql2="UPDATE new_notification_count SET new_notif_count=0 WHERE user_id=:id";
			$stmt=$pdo->prepare($sql2);
			$stmt->bindValue(':id',$user_id);
			$stmt->execute();
		}
		catch(Exception $e){

		}
 	}

 	public static function getNotifs($user_id){
 		global $pdo;
 		try{
			$sql="SELECT notification,notif_date FROM notifications WHERE user_id=:id";
			$stmt=$pdo->prepare($sql);
			$stmt->bindValue(':id',$user_id);
			$stmt->execute();
		}
		catch(Exception $e){

		}
 		$notfs = array();
 		while($row = $stmt->fetch())
 			$notfs[] = array("text"=>$row['notification'], "date"=>$row['notif_date']);
 		return $notfs;
 	}

 	public static function notifCount($user_id){
 		global $pdo;
 		try{
			$sql="SELECT new_notif_count FROM new_notification_count WHERE user_id=:id";
			$stmt=$pdo->prepare($sql);
			$stmt->bindValue(':id',$user_id);
			$stmt->execute();
		}
		catch(Exception $e){

		}
 		$row = $stmt->fetch();
 		return $row['new_notif_count'];
 	}
}




