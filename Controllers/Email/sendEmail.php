<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/Config/config.php';

// Create Sender Email
$myEmail = $SENDER_EMAIL;

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername($SENDER_EMAIL)
    ->setPassword($SENDER_PASSWORD);

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($first_name, $last_name, $userEmail, $token)
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
			<p><b>Dear '. $first_name .' '. $last_name .',</b></p>
			<p>Thanks for signing up ProtectMyPassword! 
			Your account has been created. To complete the account creation process, please activate your account.
			Simply click the button below to verify your email address so that we know this account belongs to you.</p>
			<a href="https://protectmypassword.xyz/Controllers/Email/verify_email.php?token=' . $token . '">Verify email address</a>
			<p>If you did not create an account using this email address, please ignore this email.</p>
			<p><b>- ProtectMyPassword</b></p>
		</div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Email Confirmation'))
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