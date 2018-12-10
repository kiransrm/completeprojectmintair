<?php

  require_once("inc/session.php");

  require_once("inc/class.user.php");
  $auth_user = new USER();

 $user_id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));

  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  if(isset($_POST['Submit']))
  {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $contact=$_POST['contact'];
    $this->conn->prepare("update users set user_name='$fname' where id='".$_GET['uid']."'");
  $_SESSION['msg']="Profile Updated successfully";
  }

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
    <link href="build/css/custom.min.css" rel="stylesheet">
    
    
  </head>

  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
         <?php include('template_parts/sidebar.php');?>

        <!-- top navigation -->
        <?php include('template_parts/top_nav.php');?>
        <!-- /top navigation -->
    <!-- page content -->
     <?php $stmt = $auth_user->runQuery("SELECT * FROM `users` where user_id='".$_GET['uid']."'");
      $stmt->execute();
      $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($userRow as $row)
    {?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title">
              <h3><i class="fa fa-angle-right"></i> <?php echo $row['user_name'];?> Information</h3>
                       <div class="col-md-12">
                        <div class="content-panel">
                        <p align="center" style="color:#F00;"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']=""; ?></p>
                             <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                             <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">First Name </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fname" value="<?php echo $row['user_name'];?>" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Last Ename</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="lname" value="<?php echo $row['user_name'];?>" >
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Email </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="email" value="<?php echo $row['user_email'];?>" readonly >
                              </div>
                            </div>
                                
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Registration Date </label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="contact" value="<?php echo $row['joining_date'];?>" readonly >
                              </div>
                          </div>
                            <div style="margin-left:100px;">
                            <input type="submit" name="Submit" value="Update" class="btn btn-theme"></div>
                            </form>
                      </div>
                  </div>
                  <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

         <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>

        <?php 
        include('template_parts/footer_scripts.php'); 
        include('template_parts/footer.php'); 
        ?>