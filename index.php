<?php
session_start();
require_once("inc/class.user.php");
$login = new USER();
$url=$login->getCurrentURL();
if($login->is_loggedin()!="")
{
	$login->redirect('dashboard.php');
}

if(isset($_POST['btn-login']))
{

	$uname = strip_tags($_POST['username']);
	$umail = strip_tags($_POST['username']);
	$upass = strip_tags($_POST['password']);

	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('dashboard.php');
	}
	else
	{
		$error = "Wrong Details !";
	}
}
if(isset($_POST['btn-signup']))
{

	$username = strip_tags($_POST['username']);
	$uemail = strip_tags($_POST['email']);
	$upassword = strip_tags($_POST['password']);

	if($username=="")	{
		$error[] = "provide username !";
	}
	else if($uemail=="")	{
		$error[] = "provide email id !";
	}
	else if(!filter_var($uemail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upassword=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upassword) < 6){
		$error[] = "Password must be atleast 6 characters";
	}
	else
	{

		try
		{

			$stmt = $login->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:username OR user_email=:uemail");
			$stmt->execute(array(':username'=>$username, ':uemail'=>$uemail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['user_name']==$username) {
				$error[] = "sorry username already taken !";
			}
			else if($row['user_email']==$uemail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{

				if($login->register($username,$uemail,$upassword)){
					$login->redirect('index.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
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
    <link href="/mintair/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/mintair/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/mintair/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/mintair/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/mintair/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-signin" method="post" id="login-form">
              <h1>Login Form</h1>
							<div id="error">
							<?php
									if(isset($error))
									{
										?>
														<div class="alert alert-danger">
															 <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
														</div>
														<?php
									}
								?>
							</div>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
								<button type="submit" name="btn-login" class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" class="form-signin">
              <h1>Create Account</h1>
							<?php
									if(isset($error))
									{
										foreach($error as $error)
										{
											 ?>
																 <div class="alert alert-danger">
																		<i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
																 </div>
																 <?php
										}
									}
									else if(isset($_GET['joined']))
									{
										 ?>
														 <div class="alert alert-info">
																	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php#signin'>login</a> here
														 </div>
														 <?php
									}
							?>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email"  required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
									<button type="submit" class="btn btn-default submit" name="btn-signup">SIGN UP</button>
                <!-- <a class="btn btn-default submit" href="index.html">Submit</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
