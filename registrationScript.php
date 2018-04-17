<?php include "../inc/dbinfo.inc"; ?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE );



if (isset($_POST['username'])) {
        $username = $_POST['username'];
	$usercheck = mysqli_query($connection, "SELECT * FROM Users WHERE username='$username'");

	if($usercheck->num_rows > 0) {
	echo "User already exists! <br>";
	}

}
if (isset($_POST['email'])) {
        $email = $_POST['email'];
	$emailcheck = mysqli_query($connection, "SELECT * FROM Users WHERE email='$email'");

	if($emailcheck->num_rows > 0) {
        echo "Someone has already registered with this email!";
        }


}


if (isset($_POST['password'])) {
	$password = $_POST['password'];
	$passwordhash = password_hash($password, PASSWORD_DEFAULT);

}

if (isset($_POST['major'])) {
	$major = $_POST['major'];
}

	$sql = "INSERT INTO Users (username,email,password,major) VALUES ('$username','$email','$passwordhash','$major')";


  if(mysqli_query($connection,$sql)){
        echo "Succesfully Registered!";
}
?>
