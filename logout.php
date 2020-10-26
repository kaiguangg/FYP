<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);
unset($_SESSION['email']);
unset($_SESSION['verified']);
unset($_SESSION['type']);
unset($_SESSION['_token']);
session_unset();
session_destroy();

// Redirect to the index page:
header('Location: '.$WEB_URL.'/index');
?>