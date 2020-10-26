<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Config/config.php';
?>

<?php
session_start();

$user_id = "";
$first_name = "";
$last_name = "";
$email = "";
$verified = "";
$last_login = "";
$ip_last = "";
$account_created = "";
$role = "";
$display_buttons = 0;
$delete_button = 0;
$errors = [];
$success = [];


// SEARCH AND GET USER PROFILE
if (isset($_POST['searchprofile-btn'])) {
	if (empty($_POST['user_email'])) {
		$errors['user_email'] = 'Email address required';
	} else {
	
		$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$_POST['user_email']."'");
		if (mysqli_num_rows($result) != 1) {
				$errors['email_notexist'] = "Email address does not exist";
		} else {
			while($row = mysqli_fetch_assoc($result)) {
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$email = $row['email'];
				$verified = $row['verified'];
				$last_login = $row['last_login'];
				$ip_last = $row['ip_last'];
				$account_created = $row['account_created'];
				$role = $row['rank'];
				
				if ($verified == 1)
				{
					$verified = "Email address verified";
				}
				else
				{
					$verified = "Email address not verified";
				}
				
				if ($role == 1)
				{
					$role = "User";
				}
				if ($role == 2)
				{
					$role = "Administrator";
				}
				
				$display_buttons = 1;
			}
		}
	}
}

// SET AS USER
if (isset($_POST['setuser-btn'])) {
	$email = $_POST['email'];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
	if (mysqli_num_rows($result) != 1) {
			$errors['email_notexist'] = "Email address does not exist";
	} else {
		while($row = mysqli_fetch_assoc($result)) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
			$verified = $row['verified'];
			$last_login = $row['last_login'];
			$ip_last = $row['ip_last'];
			$account_created = $row['account_created'];
			$role = $row['rank'];
			
			if ($role == 1)
			{
				$errors['is_user'] = "This account is already a User";
				$role = "User";
			}
			if ($role == 2)
			{
				$query2 = "UPDATE users SET rank=1 WHERE email='$email'";
				$results = mysqli_query($conn, $query2);
				
				if ($results) {
					$success['is_admin'] = "This account is now a User";
					$role = "Administrator";
				}
				else {
					$errors['something_wrong'] = "Something went wrong. Please try again";
				}
			}

			$display_buttons = 0;
		}
	}
}

// SET AS ADMIN
if (isset($_POST['setadmin-btn'])) {
	$email = $_POST['email'];

	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
	if (mysqli_num_rows($result) != 1) {
			$errors['email_notexist'] = "Email address does not exist";
	} else {
		while($row = mysqli_fetch_assoc($result)) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$email = $row['email'];
			$verified = $row['verified'];
			$last_login = $row['last_login'];
			$ip_last = $row['ip_last'];
			$account_created = $row['account_created'];
			$role = $row['rank'];
			
			if ($role == 1)
			{
				$query2 = "UPDATE users SET rank=2 WHERE email='$email'";
				$results = mysqli_query($conn, $query2);
				
				if ($results) {
					$success['is_admin'] = "This account is now an Admin";
					$role = "Administrator";
				}
				else {
					$errors['something_wrong'] = "Something went wrong. Please try again";
				}
			}
			if ($role == 2)
			{
				$errors['is_admin'] = "This account is already an Admin";
				$role = "User";
			}

			$display_buttons = 0;
		}
	}
}

// DELETE USER
if (isset($_POST['deleteuser-btn'])) {
	
	if (empty($_POST['user_email'])) {
		$errors['user_email'] = 'Email address required';
	} else {
		$email = $_POST['user_email'];
/*
		$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
		while($row = mysqli_fetch_assoc($result))
		{
			$user_id = $row['user_id'];
		}*/
		
		// Check if email already exists
		$sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result))
			{
				$user_id = $row['user_id'];
			}
			
			$delQuery1 = "DELETE FROM users WHERE email = '$email'";
			$delQuery2 = "DELETE FROM password WHERE user_id = '$user_id'";
			$delQuery3 = "DELETE FROM users_saved_password WHERE user_id = '$user_id'";
			mysqli_query($conn, $delQuery1);
			mysqli_query($conn, $delQuery2);
			mysqli_query($conn, $delQuery3);
			
			$success['delete_user'] = "Account deleted successfully";
		} else {
			$errors['email_notexist'] = "Email address does not exist";
		}
		
		//$row = $conn->query("SELECT * FROM saved_password WHERE email = '$email'")->fetch();
		/*
		if (mysqli_num_rows($result) != 1) {
				$errors['email_notexist'] = "Email address does not exist";
		} else {

			$delQuery = "DELETE FROM users WHERE email = '$email'";
			$delQuery .= "DELETE FROM password WHERE user_id = '$user_id'";
			$delQuery .= "DELETE FROM users_saved_password WHERE user_id = '$user_id'";
			
			if($conn->multi_query($delQuery)){
				$success['delete_user'] = "Account deleted successfully";
			}
			else
			{
				$errors['delete_user'] = "Something went wrong. Please try again";
			}
		}*/
	}
}




?>