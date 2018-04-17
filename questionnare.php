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


<main class="questionnaremain">

<b>
<?php

$chosenCourse=$_POST['chosenCourse'];
echo $chosenCourse;;

$professor=$_POST['professor'];
$course=$_POST['course'];
$url=$_POST['url'];


?>
</b>

<br>
Please answer these 10 questions in regards to your experience with the course and the Professor:

<br>
<br>

<form name="coursequestionnare" action="reviewScript.php" method="post">
	<div class="question">
	1. How difficult was this course in comparison to your other courses?
	<br>
		<input type="radio" name="q1" value="1" required> Extremely Easy
		<input type="radio" name="q1" value="2"> Easy
		<input type="radio" name="q1" value="3"> Average
		<input type="radio" name="q1" value="4"> Difficult
		<input type="radio" name="q1" value="5"> Extremely Difficult
	</div>


	<div class="question">
	2. How time consuming was this course in comparison to your other courses?
	<br>
		<input type="radio" name="q2" value="1" required> Extremely Easy
		<input type="radio" name="q2" value="2"> Easy
		<input type="radio" name="q2" value="3"> Average
		<input type="radio" name="q2" value="4"> Pretty Time Consuming
		<input type="radio" name="q2" value="5"> Extremely Time Consuming
	</div>

	<div class="question">
	3. How much homework did you have in this course compared to your other courses?
	<br>
		<input type="radio" name="q3" value="1" required> None
		<input type="radio" name="q3" value="2"> A little bit of homework
		<input type="radio" name="q3" value="3"> Average
		<input type="radio" name="q3" value="4"> A lot of homework
		<input type="radio" name="q3" value="5"> Too much homework
	</div>

	<div class="question">
	4. How much knowledge did you gain in this course compared to your other courses?
	<br>
		<input type="radio" name="q4" value="1" required> None
		<input type="radio" name="q4" value="2"> Not enough
		<input type="radio" name="q4" value="3"> Average
		<input type="radio" name="q4" value="4"> A good amount
		<input type="radio" name="q4" value="5"> An incredible amount
	</div>

	<div class="question">
	5. How much did you enjoy the lectures?
	<br>
		<input type="radio" name="q5" value="1" required> Awful lectures
		<input type="radio" name="q5" value="2"> Bad lectures
		<input type="radio" name="q5" value="3"> Average
		<input type="radio" name="q5" value="4"> Good lectures
		<input type="radio" name="q5" value="5"> Amazing lectures
	</div>

	<div class="question">
	6. Was a textbook required?
	<br>
		<input type="radio" name="q6" value="1" required> Yes
		<input type="radio" name="q6" value="2"> No
	</div>

	<div class="question">
	7. Was electronic not taking allowed (i.e. laptops?)
	<br>
		<input type="radio" name="q7" value="1" required> Yes
		<input type="radio" name="q7" value="2"> No
	</div>

	<div class="question">
	8. Did the professor grade fairly?
	<br>
		<input type="radio" name="q8" value="1" required> Yes
		<input type="radio" name="q8" value="2"> No
	</div>

	<div class="question">
	9. Do you regret taking this course?
	<br>
		<input type="radio" name="q9" value="1" required> Yes
		<input type="radio" name="q9" value="2"> No
	</div>

	<div class="question">
	10. Do you recommend taking this course?
	<br>
		<input type="radio" name="q10" value="1" required> Yes
		<input type="radio" name="q10" value="2"> No
	</div>

	<div class="question">
	 Anything else you would like to add? Don't hold back!
	<br>
		<textarea rows="3" cols="50"> </textarea>
	</div>

<input type="hidden" name="course" value="<?php echo $course?>">
<input type="hidden" name="professor" value="<?php echo $professor?>">

<input type="hidden" name="url" value="<?php echo $url?>">
<input type="submit" name="submit" value="Submit!">


</form>


</main>


</div>
</body>
</html>
