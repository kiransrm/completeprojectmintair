<?php
	require_once("inc/session.php");
	require_once("inc/class.user.php");
	$auth_user = new USER();
	$id=$_POST['id'];
	$device_name=$_POST['device_name'];
    $stmt = $auth_user->runQuery("update Device set Device_name='$device_name' where Device_id=:id");
   	$stmt->execute(array(":id"=>$id));
   	echo "success";
   	
?>