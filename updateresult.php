<?php
	require_once("inc/session.php");
	require_once("inc/class.user.php");
	$auth_user = new USER();
	$id=$_POST['id'];
	$dismiss=$_POST['dismiss'];
    $stmt = $auth_user->runQuery("update Alerts set Dismiss='$dismiss' where id=:id");
   	$stmt->execute(array(":id"=>$id));
   	echo "success";
   	
?>