<?php
require ("phpmailer/PHPMailerAutoload.php");
/*function checkMail($server,$mailserver,$username,$pass,$subject,$emailBody,$to,$your_email,$your_smtp,$your_smtp_user)
{

}*/
$server=$_POST["server"];
$mailserver=$_POST["mserver"];
$username=$_POST["uname"];
$pass=$_POST["password"];
$subject="Welcome";
$emailBody="Welcome to Mint Air through tls";
$to=$_POST["testingmail"];
$your_email = "hr@csinfotech.in";
$your_smtp = $server;
$your_smtp_user = $username;
$your_smtp_pass = $pass;
$your_website = "Mint Air";
try{
	ob_start();
	$mail = new PHPMailer(); //New instance, with exceptions enabled
	$mail->IsSMTP = true; // tell the class to use SMTP
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->Port = $mailserver;//587; // set the SMTP server port
	$mail->Host = $your_smtp; // SMTP server
	$mail->Username = $your_smtp_user; // SMTP server username
	$mail->Password = $your_smtp_pass; // SMTP server password
	$mail->SMTPSecure = $_POST["mailmethod"];//'tls';
	//$mail->IsSendmail(); // tell the class to use Sendmail
	$mail->SMTPDebug = 1;
	//$mail->AddReplyTo($your_email,$your_website);
	$mail->From = $your_email;
	$mail->FromName = $your_website;
	//$to = "someone@example...com";
	$mail->AddAddress($to);
		if($attachment!='')
		{
		$mail->addAttachment($attachment); 
		}
	$mail->Subject = $subject;
	#$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	#$mail->WordWrap = 80; // set word wrap
	$mail->MsgHTML($emailBody);
	$mail->IsHTML(false); // send as HTML	
	//$mail->AddBCC('dmytro@virtualdusk.com');
	$mail->send())
	$return_array=array();
	$return_array=array(
							'msg' => 'msg had been send',
							'success' => 1
						);

    }
		else
		{
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
catch (Exception $e)
	{
	echo 'Message could not be sent. Mailer Error: ', $e->getMessage();
	$msg="danger";
	echo $msg;
	}
?>