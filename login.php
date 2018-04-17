<!DOCTYPE html>
<?php include "../inc/dbinfo.inc"; ?>
<?php

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE );

$username = $password = "";
$username_err = $password_err = "";

session_start();
$url = $_SESSION['coursereviews'];


if($_SERVER["REQUEST_METHOD"] == "POST"){

$username = $_POST['username'];
$password = trim($_POST['password']);

$usercheck = mysqli_query($connection, "SELECT * FROM Users WHERE username = '$username'");

while ($row = $usercheck->fetch_assoc()){
	$thepassword=$row['password'];
}



if(password_verify($password,$thepassword)){
//session_start();
$_SESSION['loggedin'] = true;
$_SESSION['username'] = $username;

header("Location: " . $url);

}


}


?>
<html lang="en">
<head>
<title>CourseLoad::Registration</title>
<meta charset="utf-8">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="courseload.css" rel="stylesheet">
</head>

<body>
<div id="wrapper">

<header>
<span id="headingstyler">CourseLoad</span>
<br>
Find out what you're <span class="emphasis">really</span> signing up for
</header>
 <div id="homepagepicture">
 </div>

<main class="registration">

<span class="bold">Log-In</span>
 <br>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(mysqli_num_rows($usercheck)==0) {
        echo "User does not exist";
}

}
?>

<form method="post" action="login.php">

   <div class="form-group">
    <label for="exampleUserName">Username</label>
    <input type="text" class="form-control" name="username" id="exampleUserName" aria-describedby="userNameHelp" placeholder="Enter Username" required="required">

  </div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
if(!password_verify($password,$thepassword)){
echo "Incorrect password";
}


}
?>


  <div class="form-group right" id="right">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required="required">
  </div>


  <button type="submit" class="btn btn-success btn-lg">Log In!</button>



</form>

</main>


</div>
</body>
</html>
