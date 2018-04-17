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

<main>


<?php

session_start();
$_SESSION['courses'] = $_SERVER["REQUEST_URI"];


//grab university name and display it in header
$universityName = $_GET['universityChoice'];
echo "<h1>" . $universityName . "</h1>";

?>

<b>Select your course:</b>

<form action="coursereviews.php" method="get">
<?php include "../inc/dbinfo.inc"; ?>
<select name = "courseChoice">
<?php
ini_set('display_errors',1);

//output list of courses offered by chosen university
        $universityName = $_GET['universityChoice'];
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE );
        $universityName = mysqli_real_escape_string($connection,$universityName);
//create table
//create list of courses taught only by chosen university
	$courselist = mysqli_query($connection, "SELECT courseName, courseProfessor FROM Courses WHERE universityID=(SELECT universityID from Universities WHERE universityName='$universityName') ORDER BY courseName");

	while ($row = $courselist->fetch_assoc()){
	echo "<option>" . $row['courseName'] . " taught by " . $row['courseProfessor'] . "</option>";
	}


?>
</select>


<input type="hidden" name="chosenUniversity" value="<?php echo $universityName;?>" >
<button id="myButton" type="submit" class="btn btn-primary">Check out Reviews!</button>

</form>

</main>


</div>
</body>
</html>
