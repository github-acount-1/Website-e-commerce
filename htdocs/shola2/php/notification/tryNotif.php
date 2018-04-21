<?php 
	require_once 'includes/helpers_inc.php';
	require_once ROOT_DIR.'/php/classes/notify.class.php';
	$user=3;
	notification::clearCount($user);
	$notifs ="uiefndfhifgf"; 
	notification::addNotification($user,$notifs);
	echo 'dsjadgsa';
?>

