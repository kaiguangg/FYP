<?php
include $_SERVER['DOCUMENT_ROOT'].'/Controllers/User/profileSetting.php';

// redirect user to index page if they're not logged in
if (empty($_SESSION['id'])) {
	header('location: '.$WEB_URL.'/index');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Profile - ProtectMyPassword</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<link href="./assets/css/profile.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="home">ProtectMyPassword</a>
            <!--<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>-->
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i><?php echo " " . $_SESSION['first_name'] . " " . $_SESSION['last_name'];?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
		<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="home">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Home
                            </a>
							<a class="nav-link" href="passwordgenerator">
                                <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                                Password Generator
                            </a>
							<a class="nav-link" href="viewsecurepassword">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                View Secure Password
                            </a>
							<a class="nav-link" href="training/password-checker" target="_blank">
                                <div class="sb-nav-link-icon"><i class="fa fa-heartbeat"></i></div>
                                Password Strength
                            </a>
                            <?php
								$user_id = $_SESSION['id'];
								$getUser = "SELECT rank FROM users WHERE user_id = '$user_id'";
								$results = mysqli_query($conn, $getUser);
								$row = mysqli_fetch_row($results);
								if ($row[0] == 2)
								{
									echo'
									<div class="sb-sidenav-menu-heading">Admin Console</div>
									<a class="nav-link" href="admin_housekeeping">
										<div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
										Housekeeping
									</a>
									';
								}
							?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Welcome to</div>
                        ProtectMyPassword
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">My Profile</h1>
						<hr>
						<div class="col-sm-9">
							<!-- Nav pills -->
							<ul class="nav nav-pills pull-left" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="pill" href="#editprofile">Edit Profile</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="pill" href="#changepassword">Change Password</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="pill" href="#viewpassword">View Secure Password</a>
								</li>
							</ul><br><br><br>
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
							<!-- Tab panes -->
							<div class="tab-content">
								<div id="editprofile" class="container tab-pane active"><br>
									<form class="form" action="" method="post" enctype="multipart/form-data">
										<div class="form-group">

											<div class="col-xs-6">
												<label for="first_name"><h4>First name</h4></label>
												<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo str_replace(' ', '&nbsp;', $first_name); ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="last_name"><h4>Last name</h4></label>
												<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo str_replace(' ', '&nbsp;', $last_name); ?>">
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-xs-6">
												<label for="email"><h4>Email</h4></label>
												<input type="email" class="form-control" name="email" id="email" value=<?php echo $email; ?> readonly>
											</div>
										</div>							
										<div class="form-group">
											<div class="col-xs-12">
												<button class="btn btn-lg btn-success" name="saveprofile-btn" type="submit"><i class="fa fa-check"></i> Save</button>
												<button class="btn btn-lg btn-danger" name="deleteaccount-btn" type="submit"><i class="fa fa-user-times"></i> Delete Account</button>
												<?php 
													if (isset($_POST["deleteaccount-btn"]))
													{
														echo'
														<button class="btn btn-lg btn-danger" name="confirmdeleteaccount-btn" type="submit"><i class="fa fa-trash"></i> Confirm Delete Account</button>
														';
													}
												?>
											</div>
										</div>
									</form>
								</div><!--/tab-pane-->
								<div id="changepassword" class="container tab-pane fade"><br>
									<form class="form" action="" method="post">
										<div class="form-group">
											<div class="col-xs-6">
												<label for="old_password"><h4>Old Password</h4></label>
												<input type="password" class="form-control" id="password-field" name="old_password" id="old_password" placeholder="Old Password">
												<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="new_password"><h4>New Password</h4></label>
												<input type="password" class="form-control" id="password-field2" name="new_password" id="new_password" placeholder="New Password">
												<span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-6">
												<label for="confirm_password"><h4>Confirm Password</h4></label>
												<input type="password" class="form-control" id="password-field3" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
												<span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password"></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12">
												<button class="btn btn-lg btn-success" id="changepassword-btn" name="changepassword-btn" type="submit"><i class="fa fa-check"></i> Save</button>
											</div>
										</div>
									</form>
								</div><!--/tab-pane-->
								<div id="viewpassword" class="container tab-pane fade"><br>
									<form class="form" action="" method="post">
										<div class="form-group">
											<div class="col-xs-6">
												<label for="old_password"><h4>My Secure Password</h4></label>
												<input type="password" class="form-control" name="secure_password" id="secure_password" value="<?php echo $secure_password;?>" readonly>
											</div>
										</div>
										<div class="form-group">
											<div class="col-xs-12">
												<button class="btn btn-lg btn-success" id="viewpassword-btn" name="viewpassword-btn" type="button"><i class="fa fa-eye toggle-password"></i> Show</button>
												<button onclick="copyPW()" class="btn btn-lg btn-success" id="copypassword-btn" name="copypassword-btn" type="button"></i> Copy Password to Clipboard</button>
											</div>
										
										</div>
										<br><br><br><br><br><br><br><br>
									</form>
								</div><!--/tab-pane-->
							</div><!--/tab-content-->
						</div><!--/col-9-->
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 2020 <b>ProtectMyPassword</b>. All Rights Reserved.</div>
                            <div>
                                <a href="home">Privacy Policy</a>
                                &middot;
                                <a href="home">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
		<script type="text/javascript">
			var pwShown = 0;
			
			function show() {
				var p = document.getElementById('secure_password');
				p.setAttribute('type', 'text');
			}

			function hide() {
				var p = document.getElementById('secure_password');
				p.setAttribute('type', 'password');
			}
			
			document.getElementById("viewpassword-btn").addEventListener("click", function() {
				if (pwShown == 0) {
					pwShown = 1;
					show();
				} else {
					pwShown = 0;
					hide();
				}
			}, false);
			
			function copyPW() {
			/* Get the text field */
			var copyText = document.getElementById("secure_password");

			/* Select the text field */
			copyText.select();
			copyText.setSelectionRange(0, 99999); /*For mobile devices*/

			/* Copy the text inside the text field */
			document.execCommand("copy");

			/* Alert the copied text */
			alert("Copied password: " + copyText.value);
			}
			
			<!--For Chrome Browser-->
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