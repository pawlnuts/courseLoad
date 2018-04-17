<?php include "../inc/dbinfo.inc"; ?>

<?php

ini_set('display_errors',1);

  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE );

$Q1 = $_POST['q1'];
$Q2 = $_POST['q2'];
$Q3 = $_POST['q3'];
$Q4 = $_POST['q4'];
$Q5 = $_POST['q5'];
$Q6 = $_POST['q6'];
$Q7 = $_POST['q7'];
$Q8 = $_POST['q8'];
$Q9 = $_POST['q9'];
$Q10 = $_POST['q10'];


 $url = $_POST['url'];

$course = $_POST['course'];
$professor = $_POST['professor'];


$course = mysqli_real_escape_string($connection,$course);
$professor = mysqli_real_escape_string($connection,$professor);

echo $course;
echo "<br>";
echo $professor;

//$test="SELECT courseID from Courses WHERE courseName='$course' AND course          "


$reviewquery = "INSERT INTO Reviews (courseID,answer1,answer2,answer3,answer4,answer5,answer6,answer7,answer8,answer9,answer10) VALUES ((SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor'),'$Q1','$Q2','$Q3','$Q4','$Q5','$Q6','$Q7','$Q8','$Q9','$Q10')";


        if(mysqli_query($connection,$reviewquery)){
          header("Location: " . $url);
   	 exit;
                }
 /**       else {
        echo "Inserted!";
                }
**/


?>
