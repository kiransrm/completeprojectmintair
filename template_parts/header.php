<?php
  require_once("inc/session.php");

  require_once("inc/class.user.php");
  $auth_user = new USER();

 $user_id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));

  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

       <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
   
    <!-- Custom Theme Style -->
    <link href="build/css/custom.css" rel="stylesheet">
    <style>
    .gaugescharts {
    width: 100%;
    height: 200px;
    margin: auto;
  }
  .gaugescharts a {
    display: none!important;
}
  select#device {
    background: #c00000;
    border: 1px solid none!important;
    border: 1;
    border: 1px border none!important;
    color: white;
    text-align: center;
  }
  .devices {
    /* text-align: center; */
    width: 56%;
    display: block;
    text-align: center;
    margin: 0 auto;
}
    </style>
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
     <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    
    
    <!-- Custom Theme Scripts -->