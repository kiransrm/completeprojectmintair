<?php
  
// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
  require_once("inc/session.php");

  require_once("inc/class.user.php");
  require_once("inc/class.backup_restore.php");
  $auth_user = new USER();
  $backups = new BackupRestore();
  $msg = '';
  $type = 'success';
  
  //$commonFunctions->downloadFile('backup/db-backup-1540024816.sql');
  //$auth_user->restoreDbTableSql('backup/db-backup-1540024697.sql');
 $user_id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));


  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  if(isset($_POST['save']))
  {
    $ip_address=$_POST['ip_address'];
    $subnet=$_POST['subnet'];
    $default_gateway=$_POST['default_gateway'];
    $dns_1=$_POST['dns_1'];
    $dns_2=$_POST['dns_2'];
    $mailserver=$_POST['mailserver'];
    $port=$_POST['port'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $mailservice=$_POST['mailservice'];
    if($mailservice =='tls')
    {
      $tls=1;
      $ssl=0;
    }
    if($mailservice =='ssl')
    {
      $tls=0;
      $ssl=1;
    }
    
    $email_address=$_POST['emailaddress'];
    $reportemail=$_POST['reportemail'];
    // echo $query="update Configuration set Ip4='$ip_address' and Subnet='$subnet',gateway='$default_gateway',dns1='$dns_1',dns2='$dns_2',smtp='$mailserver',mailport='$port',username='$username',password='$password',usetls='$tls',usessl='$ssl',Reportemail='$email_address',report_on='$reportemail' where Cname='Current'";
    // die("kkk");
    $stmt = $auth_user->runQuery("update Configuration set    
                                  Ip4='$ip_address',
                                  Subnet='$subnet',
                                  gateway='$default_gateway',
                                  dns1='$dns_1',
                                  dns2='$dns_2',
                                  smtp='$mailserver',
                                  mailport='$port',
                                  username='$username',
                                  password='$password',
                                  usetls='$tls',
                                  usessl='$ssl',
                                  Reportemail='$email_address',
                                  report_on='$reportemail' where Cname=:cname");
    $stmt->execute(array(":cname"=>'Current'));
  }

//monitor table backup  csv or mysql
if(isset($_POST['bkmonitor_submit'])){
  $bktype = $_POST['bkmonitor'];

  //request for the .csv file backup
  if($bktype == 'bkmcsv'){
    
    $backups->backupDbTableCsv('Monitoring');
  }
  //request for the .sql file backup
  elseif($bktype == 'bkmsql'){
    $backups->backupDbTableSql(array('Monitoring'));  
  }
  //unknown request show error
  else{
      $msg.="Seems we couldn't find the request!";
      $type = 'danger';
  }
}
//monitor table restore  csv or mysql

if(isset($_POST['resmonitor_submit'])){
    $rstype = $_POST['restoremonito'];
   
    // restore table via sql file
    if($rstype == 'rsmsql'){
      
      try {

        //check for the upload validation arg filename, filetype
        $backups->fileUploadValidation($_FILES['monitorfile'], array('sql'));

        //Rename file to new name arg filename
        $newFileName = $backups->renameUploadFile($_FILES['monitorfile']['name']);

        //Start uploading the file args filename, newname, uploaddirectory

        if($backups->doUpload($_FILES['monitorfile'], $newFileName, 'backup')){

          if($backups->restoreDbTableSql(WEB_PATH.'/backup/'.$newFileName)):

          //delete the file from server after succesfull restore
            $backups->deleteFile($newFileName, WEB_PATH.'/backup/');
            $msg.='Backup has been restored succesfully';
            $type ='success';
          endif;
        }
        //$backups->restoreDbTableSql()
      } catch (Exception $e) {

        $msg.=$e->getMessage();
        $type ='danger';
      }

      
    }
    // restore table via .sql file
    elseif ($rstype == 'rsmcsv') {
      /* TBD
      * add restore functionality via CSV File
      */
      try {

        //check for the upload validation arg filename, filetype
        $backups->fileUploadValidation($_FILES['monitorfile'], array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'));

        //Rename file to new name arg filename
        $newFileName = $backups->renameUploadFile($_FILES['monitorfile']['name']);

        if($backups->doUpload($_FILES['monitorfile'], $newFileName, 'backup')){

          if($backups->restoreDbTableCsv('Monitoring' ,WEB_PATH.'/backup/'.$newFileName)):

          //delete the file from server after succesfull restore
            $backups->deleteFile($newFileName, WEB_PATH.'/backup/');
            $msg.='Backup has been restored succesfully';
            $type ='success';
          endif;
        }



      }
      catch (Exception $e) {

        $msg.=$e->getMessage();
        $type ='danger';
      }
    }
    // unknown request show error
    else{
      $msg.="Seems we couldn't find the request!";
      $type = 'danger';   
    }
    
}

//take configuration table backup csv or mysql

if(isset($_POST['bkconfig_submit'])){
  $bkconfigType = $_POST['bkconfig'];

  //request for the csv file backup
  if($bkconfigType == 'bkconfigcsv'){

    $backups->backupDbTableCsv('Configuration');
  }
  //request for the .sql file backup
  elseif($bkconfigType == 'bkconfigmsql'){
    $backups->backupDbTableSql(array('Configuration'));  
  }
  //this is a unknown request
  else{
      $msg.="Seems we couldn't find the request!";
      $type = 'danger';
  }
}

//configuration table restore  csv or mysql

if(isset($_POST['rsconfig_submit'])){
    $rsconfig_type = $_POST['resconfing'];
    
    // restore type is via mysql file
    if($rsconfig_type == 'resconfingmsql'){
      
      try {

        //check for the upload validation arg filename, filetype
        $backups->fileUploadValidation($_FILES['resconfingfile'], array('sql'));

        //Rename file to new name arg filename
        $newFileName = $backups->renameUploadFile($_FILES['resconfingfile']['name']);

        //Start uploading the file args filename, newname, uploaddirectory

        if($backups->doUpload($_FILES['resconfingfile'], $newFileName, 'backup')){

          if($backups->restoreDbTableSql(WEB_PATH.'/backup/'.$newFileName)):

            //delete the file from server after succesfull restore
            $backups->deleteFile($newFileName, WEB_PATH.'/backup/');
            $msg.='Backup has been restored succesfully ss';
            $type ='success';
          endif;
        }
        //$backups->restoreDbTableSql()
      } catch (Exception $e) {

        $msg.=$e->getMessage();
        $type ='danger';
      }

      
    }
    // restore type is via csv file
    else if($rsconfig_type == 'resconfingcsv'){
      
             //check for the upload validation arg filename, filetype
        $backups->fileUploadValidation($_FILES['resconfingfile'], array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain'));

        //Rename file to new name arg filename
        $newFileName = $backups->renameUploadFile($_FILES['resconfingfile']['name']);

        if($backups->doUpload($_FILES['resconfingfile'], $newFileName, 'backup')){

          if($backups->restoreDbTableCsv('Configuration' ,WEB_PATH.'/backup/'.$newFileName)):

          //delete the file from server after succesfull restore
            $backups->deleteFile($newFileName, WEB_PATH.'/backup/');
            $msg.='Backup has been restored succesfully';
            $type ='success';
          endif;
        }
        
    }
    //unknown process show error
    else{
      $msg.="Seems we couldn't find the request!";
      $type = 'danger';

    }
    
}
//take complete backup only sql
if(isset($_GET['bk']) && $_GET['bk'] == 'complete'){
  $backups->backupDbTableSql();
}


//Do complete Restore

if(isset($_POST['completerestore_submit'])){
       
  try {

    //check for the upload validation arg filename, filetype
    $backups->fileUploadValidation($_FILES['completerestore'], array('sql'));

    //Rename file to new name arg filename
    $newFileName = $backups->renameUploadFile($_FILES['completerestore']['name']);

    //Start uploading the file args filename, newname, uploaddirectory

    if($backups->doUpload($_FILES['completerestore'], $newFileName, 'backup')){

      $backups->restoreDbTableSql(WEB_PATH.'/backup/'.$newFileName);

      //delete the file from server after succesfull restore
      $backups->deleteFile($newFileName, WEB_PATH.'/backup/');
      $msg.='Backup has been restored succesfully';
      $type ='success';
    }
    //$backups->restoreDbTableSql()
  } catch (Exception $e) {

    $msg.=$e->getMessage();
    $type ='danger';
  }

      
    
    
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta,title, CSS, favicons, etc. -->
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
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    
   
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
              
            <div class="row">
              <div class="clearfix"></div>
              <?php if(!empty($msg)){
                echo '<div class="alert alert-'.$type.' alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>'.$msg.'</strong></div>';
              }
              ?>
              <div class="clearfix"></div>
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>Backup/Restore Monitor Data Only</strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left" method="post" >
  
         <div class="form-group">

            <div class="col-md-6 col-sm-9 col-xs-9">

                CSV:
                <input type="radio" class="flat" name="bkmonitor" checked="" value="bkmcsv" /> &nbsp;&nbsp; SQL:
                <input type="radio" class="flat" name="bkmonitor" value="bkmsql" />

            </div>
            <div class="col-md-6 col-sm-9 col-xs-9 text-right">
                <button type="submit" name="bkmonitor_submit" class="btn btn-success">Backup</button>
            </div>
        </div>
        </form>
        <hr/>
        <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
         <div class="form-group">

            <div class="col-md-4 col-sm-12 col-xs-12">

                CSV:
                <input type="radio" class="flat" name="restoremonito" checked="" value="rsmcsv" />&nbsp;&nbsp;SQL:
                <input type="radio" class="flat" name="restoremonito" value="rsmsql"  />

            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">

                <input type="file" name="monitorfile" /><small>.csv or .sql</small>
            

            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 text-right">
                <button type="submit" name="resmonitor_submit" class="btn btn-primary">Restore</button>
            </div>
        </div>
      </form>

        </div>
        </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><strong>Backup/Restore Configuration Data</strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br>
          <form class="form-horizontal form-label-left" method="post" >
            <div class="form-group">

              <div class="col-md-6 col-sm-9 col-xs-9">

                  CSV:
                      <input type="radio" class="flat" name="bkconfig" value="bkconfigcsv" checked="" >&nbsp;&nbsp;SQL:
                      <input type="radio" class="flat" name="bkconfig" value="bkconfigmsql">

                  </div>
                  <div class="col-md-6 col-sm-9 col-xs-9 text-right">
                      <button type="submit" name="bkconfig_submit" class="btn btn-success">Backup</button>
                  </div>
            </div>
              <div class="clearfix"></div>
              <hr/>
            </form>
            <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
          <div class="form-group">

              <div class="col-md-4 col-sm-12 col-xs-12">

                  CSV:
                  <input type="radio" class="flat" name="resconfing"  value="resconfingcsv" checked=""  />&nbsp;&nbsp;  SQL:
                  <input type="radio" class="flat" name="resconfing"  value="resconfingmsql"  />

              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">

                  <input type="file" required name="resconfingfile" /><small>.csv or .sql</small>
              

              </div>
              <div class="col-md-4 col-sm-12 col-xs-12 text-right">
                  <button type="submit" name="rsconfig_submit" class="btn btn-primary">Restore</button>
              </div>
          </div>
        </form>
          <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><strong>Backup/Restore All Data</strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                  <form class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <div class="col-md-6 col-sm-12 col-xs-12 text-center">
                            <label>Take Complete backup</label>
                            <a href="backups.php?bk=complete" class="btn btn-success">Backup</a>
                          </div>
                           <div class="col-md-6 col-sm-12 col-xs-12 text-center">
                            <input type="file" name="completerestore" class="pull-left" />
                            <button type="submit" class="btn btn-primary" name="completerestore_submit">Restore </button> <span class="label label-danger">Can't be undone!</span>
                          </div>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                     <br>

                  </form>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php 
        include('template_parts/footer_scripts.php'); 
        include('template_parts/footer.php'); 
        ?>