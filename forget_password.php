<?php 
include $_SERVER['DOCUMENT_ROOT'].'/Controllers/User/forgetpasswordController.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Reset Password - ProtectMyPassword</title>
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
				<h2 class="text-center">Reset Password</h2>
				<p>Please provide your email address.</p>
				<?php if (count($errors) > 0): ?> <!--If there are any error messages in the $errors array, we need to display them on the form.-->
					<div class="alert alert-danger">
					<?php foreach ($errors as $error): ?>
					<li>
						<?php echo $error; ?>
					</li>
					<?php endforeach;?>
					</div>
				<?php endif;?>
				<?php if (count($success) > 0): ?> <!--If there are any success messages in the $success array, we need to display them on the form.-->
					<div class="alert alert-success">
					<?php foreach ($success as $success): ?>
					<li>
						<?php echo $success; ?>
					</li>
					<?php endforeach;?>
					</div>
				<?php endif;?>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email">
				</div>
				<div class="form-group">
					<button type="submit" name="submit-btn" class="btn btn-primary btn-block">Reset Password</button>
				</div>
			</form>
			<p class="text-center">Don't have an account? <a href="register">Create an Account</a></p>
		</div>
		<footer class="footer">
			<p>Copyright &copy; 2020 <b>ProtectMyPassword</b>. All Rights Reserved.</p>
		</footer>
		
		<script type="text/javascript">
			$("#password").password('toggle');
		</script>
	</body>
</html>