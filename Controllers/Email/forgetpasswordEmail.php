<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Config/config.php';

// Create Sender Email
$myEmail = $SENDER_EMAIL;

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername($SENDER_EMAIL)
    ->setPassword($SENDER_PASSWORD);

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($first_name, $last_name, $userEmail, $token, $new_password)
{
	global $myEmail;
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Email Confirmation</title>
		<style>
			.wrapper {
				padding: 20px;
				color: #000000;
				font-size: 15px;
			}
			a {
				background: #663399;
				padding: 8px 20px;
				text-decoration: none;
				border-radius: 5px;
				color: #FFFFFF;
				font-size: 20px;
				position: absolute;
			}
		</style>
    </head>

    <body>
		<div class="wrapper">
			<p><b>Hello '. $first_name .' '. $last_name .',</b></p>
			<p>You have requested to reset your ProtectMyPassword password. 
			If you have not requested to reset your password, please change your password immediately.<br>
			If you have problem changing your password, you should contact our Administrator as soon as possible.<br><br>
			Your new password is '. $new_password .'<br><br>
			<p>If you did not create an account using this email address, please ignore this email.</p>
			<p><b>- ProtectMyPassword</b></p>
		</div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Reset Password'))
        ->setFrom([$myEmail => 'ProtectMyPassword'])
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}