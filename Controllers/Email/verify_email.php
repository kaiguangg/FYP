<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Config/config.php';
?>
<?php
//session_start();

$success =[];

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result))
	{
		$user_id = $row['user_id'];
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$email = $row['email'];
	}

    if (mysqli_num_rows($result) > 0) 
	{
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE token='$token'";

		$new_token = bin2hex(random_bytes(50)); // generate unique token
		
        if (mysqli_query($conn, $query)) {
			$updateNewToken = "UPDATE users SET token='$new_token' WHERE user_id='$user_id'";
			mysqli_query($conn, $updateNewToken);
			
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
			$_SESSION['last_name'] = $user['first_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            $_SESSION['type'] = 'alert-success';
			$success['success_verify'] = "Your email address has been verified successfully";
            header('location: '.$WEB_URL.'/login');
            exit(0);
        }
    } 
	else 
	{
        $success['invalid_url'] = "The url is invalid or you already have activated your account.";
		header('location: '.$WEB_URL.'/login');
        exit(0);
    }
} else {
    echo "No token provided!";
}
?>