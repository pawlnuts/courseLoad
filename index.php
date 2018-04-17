<!DOCTYPE html>
<html lang="en">
<head>
<title>CourseLoad</title>
<meta charset="utf-8">

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


<main>


The creation of your perfect schedule is just a few clicks away!
<br>
<br>
<span class="bold">First:</span>
Choose your school:

<form action="courses.php" method="get">
<?php include "../inc/dbinfo.inc";
session_start();
$_SESSION['loggedin'] = false; ?>
<select name="universityChoice">
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE );
        $sql = mysqli_query($connection, "SELECT universityName FROM Universities");

      while ($row = $sql->fetch_assoc()){
echo "<option>" . $row['universityName'] . "</option>";

}


?>
</select>
<button id="myButton" type="submit" class="btn btn-primary">Go!</button></a>




</form>



</main>
</div>
</body>
</html>
