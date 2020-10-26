<?php
date_default_timezone_set("Asia/Singapore");

// Make sure we see all the errors and warnings
//ini_set('display_errors', 0);
//ini_set('log_errors', 1);
//ini_set('error_log', 'Logs/error_log');

//--Database Information--//
$DB_CONNECTION = "localhost";	//Mysql's Host Connection
$DB_PORT = "3306";				//Mysql's Port
$DB_NAME = "fyp";				//Mysql's Database
$DB_USERNAME = "root";			//Mysql's User
$DB_PASSWORD = "";				//Mysql's Password

$conn = mysqli_connect($DB_CONNECTION, $DB_USERNAME, $DB_PASSWORD) OR die('Unable to connect to database! Please try again later.');
mysqli_select_db($conn, $DB_NAME);


//--FOLDER SHORTCUTS--//
$FOLDER_A = "Admin";
$FOLDER_B = "Config";
$FOLDER_C = "Controllers";

//--Website URL--//
$WEB_URL = "https://protectmypassword.xyz";	// Address of your website. Does not end with a "/"

//--Swiftmailer Information--//
$SENDER_EMAIL = "fyp20s214@gmail.com";
$SENDER_PASSWORD = "fypproject2020";


?>