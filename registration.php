<!DOCTYPE html>

<?php include "../inc/dbinfo.inc"; ?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
$database = mysqli_select_db($connection, DB_DATABASE );

$username = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){


if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $usercheck = mysqli_query($connection, "SELECT * FROM Users WHERE username='$username'");
}
if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $emailcheck = mysqli_query($connection, "SELECT * FROM Users WHERE email='$email'");
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
        header("location: login.php");
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

<span class="bold">Registration</span>
 <br>


<form method="post" action="registration.php">

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
 if($emailcheck->num_rows > 0) {
        echo "*Someone has already registered with this email!";
        }
}
?>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required="required">

  </div>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){


  if($usercheck->num_rows > 0) {
        echo "*User already exists!<br>";
        }
}
?>

   <div class="form-group">
    <label for="exampleUserName">Username</label>
    <input type="text" class="form-control" name="username" id="exampleUserName" aria-describedby="userNameHelp" placeholder="Enter Username" required="required">

  </div>



  <div class="form-group right" id="right">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
  </div>

<select name="major" required="required">


<option>Computer Science</option>
<option>Information Systems</option>
<option>Physics</option>


</select>

<!--
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span id="selected">Your Major</span>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" name="major" href="javascript:return false;">Information Systems</a>
    <a class="dropdown-item" name="major" href="javascript:return false;">Computer Science</a>
    <a class="dropdown-item" name="major" href="javascript:return false;">Physics</a>
  </div>
</div>
-->

<script>
 $('.dropdown-menu a').click(function(){
    $('#selected').text($(this).text());
  });
</script>

<br>
<input type="hidden" name="url" value="<?php echo $url?>">
<button type="submit" class="btn btn-primary btn-lg">Register!</button>


</form>

</main>


</div>
</body>
</html>
