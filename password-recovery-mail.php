<?php

require('phpmailer/classes/class.phpmailer.php');
$mail = new PHPMailer();
define("PROJECT_HOME","http://localhost/recruitment/");
$emailBody = "<div>" . $user["email"] . ",<br><br><p>Click this link to recover your password<br><a href='" . PROJECT_HOME . "reset_password.php?email=" . $user["email"] . "'>" . PROJECT_HOME . "reset_password.php?email=" . $user["email"] . "</a><br><br></p>Regards,<br> Admin.</div>";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "";
$mail->Port     = 587;  
$mail->Username = "hesen@ameyaindo.com";
$mail->Password = "yatmmiko";
$mail->Host     = "lokal.ameyaindo.com";
$mail->Mailer   = "smtp";
			
$mail->SetFrom("hesen@ameyaindo.com", "Recruitment Portal");
$mail->AddAddress($user["email"]);
$mail->Subject = "Forgot Password Recovery";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
	$error_message = 'Problem in Sending Password Recovery Email';
} else {
	$success_message = 'Please check your email to reset password!';
}

?>
