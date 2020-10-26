<?php
include_once 'Config/config.php';

session_start();
// redirect user to index page if they're not logged in
if (empty($_SESSION['id'])) {
	header('location: '.$WEB_URL.'/index');
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Verify your account - ProtectMyPassword</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
		<link href="./assets/css/login.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<form action="forget_password" method="post">
				<h2 class="text-center">Email Confirmation</h2>
				<p>Thanks for signing up ProtectMyPassword!</p>
				<p>An email confirmation has been sent to your email address.</p>
				<p>To complete the account creation process, please activate your account.</p>
			</form>
			<p class="text-center" style="font-size:16px">Already have an account? <a href="login">Sign in</a></p>
		</div>
		
		<script type="text/javascript">
			$("#password").password('toggle');
		</script>
	</body>
</html>