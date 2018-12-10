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
  $auth_user = new USER();

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
    <!-- ajax cdn -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Network configuration</h2>
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
                      <?php
                        //$stmt = $auth_user->runQuery("SELECT * from Device ");
                         $stmt = $auth_user->runQuery("SELECT * FROM `Configuration` WHERE `Cname` = 'Current'");
                         $stmt->execute();
                         //$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
                         $userRow = $stmt->fetch(PDO::FETCH_OBJ);
                         
                         
                      ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">IP Address</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="ip_address" type="text" value="<?php echo $userRow->Ip4;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Subnet Mask</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="subnet" data-inputmask="'mask' : '(999) 999-9999'" type="text" value="<?php echo $userRow->Subnet;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Default Gateway</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="default_gateway" data-inputmask="'mask': '99-999999'" type="text" value="<?php echo $userRow->gateway;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">DNS 1</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="dns_1" data-inputmask="'mask' : '****-****-****-****-****-***'" type="text" value="<?php echo $userRow->dns1;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">DNS 2</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="dns_2" data-inputmask="'mask' : '99-99999999'" type="text" value="<?php echo $userRow->dns2;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Mail Sever</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                   <div id="msg"></div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">
                          Mail Server
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="mailserver" id="server" type="text" value="<?php echo $userRow->smtp;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Mail Server Port</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" id="port" name="port" value="<?php echo $userRow->mailport;?>" type="text">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Username</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="username" id="uname" type="text" value="<?php echo $userRow->username;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="password" id="pass" type="password" value="<?php echo $userRow->password;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Confirm Password</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" name="confirmpassword" id="cpass" type="password" value="<?php echo $userRow->password;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <input name="mailservice" id="tls" <?php if($userRow->usetls=="1") {echo "checked";}?> type="radio" value="tls">Use TLS
                          <input name="mailservice" id="ssl" <?php if($userRow->usessl=="1") {echo "checked";}?> type="radio" value="ssl">Use SSL
                        </div>
                      </div>
                     <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          
                          <button type="submit" class="btn btn-success" id="tserver">Test Server</button>
                        </div>
                      </div>
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Weekly Report</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Email Address</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input class="form-control" id="email" name="emailaddress" type="text" value="<?php echo $userRow->Reportemail;?>">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                       
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="checkbox" name="reportemail" <?php if($userRow->report_on=="1") {echo "checked";}?> value="1">Recive Report by email
                         
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                          <button type="submit" class="btn btn-primary" name="save">Save</button>
                          <button type="submit" class="btn btn-success" name="cancel">Cancel</button>
                          <button type="submit" class="btn btn-success" name="default">Set As Default</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
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
   
    <script>
                      $("#tserver").on('click' , function(e){
                        e.preventDefault();
                        var serverss = $("#server").val();
                        var mailserver=$("#port").val();
                        var username=$("#uname").val();
                        var pass=$("#pass").val();
                        var cpass=$("#cpass").val();
                        var setmethod = $('input[name=mailservice]:checked').val();
                        var uemail=$("#email").val();
						            if(server.length==0){
                          alert("Please Enter Mail Server Properly");
                          return false;
                        }
                        if(mailserver==""|| !mailserver.match(/^\d+$/)) {
                          alert("Please Enter  Port number and it should be numeric");
                          return false;
                        }
                        if(username.length==0){
                          alert("Please Enter Username Properly");
                          return false;
                        }
                        if(pass.length==0 ||cpass.length==0){
                          alert("Password can not be empty");
                          return false;
                        }
                        if(pass!=cpass){
                          alert("Please Enter both password equally");
                          return false;
                        }
                        $.ajax({
                        	beforeSend: function()
                        	{
					 		$("#tserver").html("Please wait...")
							},
                          url:"message.php",
                          type:'POST',
                         /* dataType:'JSON',*/
                          data:{
                          server:serverss,
                          mserver:mailserver,
                          uname:username,
                          password:pass,
                          mailmethod:setmethod,
                          testingmail:uemail
                           },
                          success: function(data){

                          	 $("#tserver").html("Test Server")

                          	/*if(data.success==1)
                          	{*/
                          		//$("#msg").html(data); 
                          	
                            //$("#msg").html("<div class='alert alert-success'>"+data.msg+"</div>");

                           /* var data1 = json_decode(data);
                            console.log(data[0].msg);*/
                            console.log(data);

                          /*  console.log(data.success);
                           // console.log(data.msg_type);
                          }
                          else
                          {
                          	console.log(data);
                          	$("#msg").html("<div class='alert alert-danger'>"+data.msg+"</div>");
                          }*/
                          	},

                          	error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }

                        })
                    /* $.ajax({
                          url:'message.php',
                          type:'POST',
                          data:{
                            server : serverss,
                            mailserver : port,
                            username : uname,
                            password : pass,
                            cpass : cpass
                            
                          },
                          success: function(data){

                            $("#msg").html(data); 
                          }
                        });*/
   
                       });
    </script>