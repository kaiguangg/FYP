<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Controllers/User/authController.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
		<title>Register your account - ProtectMyPassword</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
		<script src='https://www.google.com/recaptcha/api.js'> </script>
		<link href="./assets/css/register.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="signup-form">
			<form action="register" method="post">
				<h2>Register</h2>
				<p class="hint-text">Create your account. It's free and only takes a minute.</p>
				<?php if (count($errors) > 0): ?> <!--If there are any error messages in the $errors array, we need to display them on the form.-->
					<div class="alert alert-danger">
					<?php foreach ($errors as $error): ?>
					<li>
						<?php echo $error; ?>
					</li>
					<?php endforeach;?>
					</div>
				<?php endif;?>
				<div class="form-group">
					<div class="row">
						<div class="col-xs-6"><input type="text" class="form-control" name="first_name" placeholder="First Name"></div>
						<div class="col-xs-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name"></div>
					</div>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="password" id="password-field" class="form-control" name="password" placeholder="Password" data-toggle="password">
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<div class="form-group">
					<input type="password" id="password-field2" class="form-control" name="confirm_password" placeholder="Confirm Password" data-toggle="password">
					<span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				</div>
				<div class="form-group">
					<label class="checkbox-inline"><input type="checkbox" required="required"> I've read and agree to the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
				</div>
				<div class="form-group">
					<div class="g-recaptcha" data-sitekey="6LfJP7MZAAAAAP-_ua52g4w-W3GN6C2n_5EBA92j" required="required"></div>
				</div>
				<div class="form-group">
					<button type="submit" name="signup-btn" class="btn btn-primary btn-lg btn-block">Register Now</button>
				</div>
				<div class="form-group">
					<input type="hidden" id="_token" name="_token" value="<?php echo $_SESSION['_token']; ?>">
				</div>
			</form>
			<div class="text-center" style="font-size:16px">Already have an account? <a href="login">Sign in</a></div>
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