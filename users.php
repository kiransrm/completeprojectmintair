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
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title">
                 <section class="wrapper">
                  <h3><i class="fa fa-angle-right"></i> Manage Users</h3>
                       <div class="row">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover">
                                  <h4><i class="fa fa-angle-right"></i> All User Details </h4>
                                  <hr>
                                    <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th class="hidden-phone">First Name</th>
                                        <th> Last Name</th>
                                        <th> Email Id</th>
                                        <th>Reg. Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $stmt = $auth_user->runQuery("SELECT * FROM `users` WHERE 1");
                                    $stmt->execute();
                                    $userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $cnt=1;
                                    foreach($userRow as $row)
                                    {?>
                                        <tr>
                                          <td><?php echo $cnt;?></td>
                                          <td><?php echo $row['user_name'];?></td>
                                          <td><?php echo $row['user_name'];?></td>
                                          <td><?php echo $row['user_email'];?></td>
                                          <td><?php echo $row['joining_date'];?></td>
                                        <td>
                                           
                                           <a href="update-profile.php?uid=<?php echo $row['user_id'];?>"> 
                                           <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                           <a href="manage-users.php?id=<?php echo $row['user_id'];?>"> 
                                           <button class="btn btn-danger btn-xs" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash-o "></i></button></a>
                                        </td>
                                    </tr>
                                    <?php $cnt=$cnt+1; }?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section>
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