<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Config/config.php';
session_start();
// redirect user to index page if they're not logged in
if (empty($_SESSION['id'])) {
	header('location: '.$WEB_URL.'/index');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Home - ProtectMyPassword</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<link href="./assets/css/home.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php 
			if (!$_SESSION['verified']) {
				header('location: '.$WEB_URL.'/unverified');
			}
		?>
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
                        <h1 class="mt-4">Home</h1>
						<hr>
						<p>Welcome to <b>ProtectMyPassword</b>,<br><br>
						This is a SIM-UOW Final Year Project of the Behavioural Password Protection.<br>
						This project is to propose new passwords for the users based on the “training” provided. Essentially, the idea is to allow the software to propose a combination of passwords based on what the users like to choose their own passwords. 
						As an example, if the user likes to use multiple alphabets of his children names, then the software will provide proposals to secure those passwords without sacrificing the users’ preference.
						<br>
						The purpose of this application is to create a convenient and easy-to-use application for users, trying to come out with a password. 
						The application is based on numerous users’ references and functions to propose passwords for the users. We hope to provide a comfortable user experience along with the best password protection available.
						<br><br>
						Before you start using, please install our <b>chrome extension</b>.
						<br>
						You can download it <a href="http://www.mediafire.com/file/agb4b34oil8zy2f/file" target="_blank">here</a>!
						<br><br>
						Rest assured that the personal information that you are asked to provide will be kept safely during the project period.<br>
						You can view our marketing website over <a href="https://finalyearproject2020.wixsite.com/finalyearproject2020" target="_blank">here</a>!
						</p>
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
	</body>
</html>