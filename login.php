<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/User/authController.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sign in here - ProtectMyPassword</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
		<link href="./assets/css/login.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<form action="login" method="post">
				<h2 class="text-center">Log in</h2>
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
					<input type="password" id="password-field" name="password" class="form-control" placeholder="Password" value="">
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<div class="form-group">
					<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
				</div>
				<div class="form-group">
					<button type="submit" name="login-btn" class="btn btn-primary btn-block">Log in</button>
				</div>
				<div class="clearfix">
					<a href="forget_password" class="pull-right">Forgot Password?</a>
				</div>
			</form>
			<p class="text-center">Don't have an account? <a href="register">Create an Account</a></p>
		</div>
		<footer class="footer">
			<p>Copyright &copy; 2020 <b>ProtectMyPassword</b>. All Rights Reserved.</p>
		</footer>
		
		<!--For Chrome Browser-->
		<script type="text/javascript">
		$(".toggle-password").click(function() {

			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));
			if (input.attr("type") == "password") {
			input.attr("type", "text");
			} else {
			input.attr("type", "password");
			}
		});
		</script>
		
		
	</body>
</html>