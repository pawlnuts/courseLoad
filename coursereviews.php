<!DOCTYPE html>
<html lang="en">
<head>
<title>CourseLoad</title>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="courseload.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

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
if ($_SESSION['loggedin'] == true){
$user = $_SESSION['username'];

echo "Welcome " . $user . "!";
}
?>


<h1>Course Review</h1>
<form action="coursescript.php">
<input type="submit" value="<-- Return to Course List" >
</form>
<script>
function goBack() {
    window.history.back();
}
</script>

<br>
<br>

<?php include "../inc/dbinfo.inc";

session_start();
$_SESSION['coursereviews'] = $_SERVER["REQUEST_URI"];
?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




        $chosenCourse = $_GET['courseChoice'];
        echo "<b>" . $chosenCourse . "</b>";
//grab course title to later use in sql query
	$course = implode(array_slice(explode(" ",$chosenCourse), 0, 2)," ");
//grab professor name for later use in sql query
	$professor = implode(array_slice(explode(" ",$chosenCourse), 4, 6)," ");


        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        $database = mysqli_select_db($connection, DB_DATABASE );

//grab reviews from chosen course
$course = mysqli_real_escape_string($connection,$course);
$professor = mysqli_real_escape_string($connection,$professor);

$numofreviews = mysqli_query($connection, "SELECT COUNT(reviewID) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor')");

echo "<br>";

$count = mysqli_fetch_array($numofreviews);
echo  "Based off <b>" . $count[0] . "</b> existing reviews: ";

echo "<br><br>";


$answer1 = mysqli_query($connection, "SELECT AVG (answer1) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor')");
$answer2 = mysqli_query($connection, "SELECT AVG (answer2) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor')");
$answer3 = mysqli_query($connection, "SELECT AVG (answer3) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor')");
$answer4 = mysqli_query($connection, "SELECT AVG (answer4) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor')");
$answer5 = mysqli_query($connection, "SELECT AVG (answer5) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor')");

$yes6 = mysqli_query($connection, "SELECT COUNT(answer6) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer6='1')");
$yes7 = mysqli_query($connection, "SELECT COUNT(answer7) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer7='1')");
$yes8 = mysqli_query($connection, "SELECT COUNT(answer8) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer8='1')");
$yes9 = mysqli_query($connection, "SELECT COUNT(answer9) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer9='1')");
$yes10 = mysqli_query($connection, "SELECT COUNT(answer10) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer10='1')");

$no6 = mysqli_query($connection, "SELECT COUNT(answer6) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer6='2')");
$no7 = mysqli_query($connection, "SELECT COUNT(answer7) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer7='2')");
$no8 = mysqli_query($connection, "SELECT COUNT(answer8) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer8='2')");
$no9 = mysqli_query($connection, "SELECT COUNT(answer9) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer9='2')");
$no10 = mysqli_query($connection, "SELECT COUNT(answer10) from Reviews WHERE courseID=(SELECT courseID from Courses WHERE courseName='$course' AND courseProfessor='$professor' AND answer10='2')");


 while ($row = $answer1->fetch_assoc()){$arraytest[]=$row;}
 while ($row = $answer2->fetch_assoc()){$arraytest[]=$row;}
 while ($row = $answer3->fetch_assoc()){$arraytest[]=$row;}
 while ($row = $answer4->fetch_assoc()){$arraytest[]=$row;}
 while ($row = $answer5->fetch_assoc()){$arraytest[]=$row;}

 while($row = $yes6->fetch_assoc()){$arraytest2[]=$row;}
while($row = $yes7->fetch_assoc()){$arraytest2[]=$row;}
while($row = $yes8->fetch_assoc()){$arraytest2[]=$row;}
while($row = $yes9->fetch_assoc()){$arraytest2[]=$row;}
while($row = $yes10->fetch_assoc()){$arraytest2[]=$row;}

 while($row = $no6->fetch_assoc()){$arraytest3[]=$row;}
while($row = $no7->fetch_assoc()){$arraytest3[]=$row;}
while($row = $no8->fetch_assoc()){$arraytest3[]=$row;}
while($row = $no9->fetch_assoc()){$arraytest3[]=$row;}
while($row = $no10->fetch_assoc()){$arraytest3[]=$row;}





?>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
var jArray=<?php echo JSON_encode($arraytest)?>;
var yesArray=<?php echo JSON_encode($arraytest2)?>;
var noArray=<?php echo JSON_encode($arraytest3)?>;
var stringtest = JSON.stringify(jArray);
var yesstring = JSON.stringify(yesArray);


var answer1=jArray[0];var stringanswer1=JSON.stringify(answer1);var arrays = stringanswer1.split('"');var convert1 = arrays[3];
var final1 = parseFloat(convert1);

var answer2=jArray[1];var stringanswer2=JSON.stringify(answer2);var arrays2 = stringanswer1.split('"');var convert2 = arrays2[3];
var final2 = parseFloat(convert1);

var answer3=jArray[2];var stringanswer3=JSON.stringify(answer3);var arrays3 = stringanswer1.split('"');var convert3 = arrays3[3];
var final3 = parseFloat(convert3);

var answer4=jArray[3];var stringanswer4=JSON.stringify(answer4);var arrays4 = stringanswer4.split('"');var convert4 = arrays4[3];
var final4 = parseFloat(convert4);

var answer5=jArray[4];var stringanswer5=JSON.stringify(answer5);var arrays5 = stringanswer5.split('"');var convert5 = arrays5[3];
var final5 = parseFloat(convert5);

var answer6yes=yesArray[0];var stringanswer6yes=JSON.stringify(answer6yes);var arrays6yes = stringanswer6yes.split('"');var convert6yes = arrays6yes[3];
var final6yes = parseFloat(convert6yes);

var answer7yes=yesArray[1];var stringanswer7yes=JSON.stringify(answer7yes);var arrays7yes = stringanswer7yes.split('"');var convert7yes = arrays7yes[3];
var final7yes = parseFloat(convert7yes);

var answer8yes=yesArray[2];var stringanswer8yes=JSON.stringify(answer8yes);var arrays8yes = stringanswer8yes.split('"');var convert8yes = arrays8yes[3];
var final8yes = parseFloat(convert8yes);

var answer9yes=yesArray[3];var stringanswer9yes=JSON.stringify(answer9yes);var arrays9yes = stringanswer9yes.split('"');var convert9yes = arrays9yes[3];
var final9yes = parseFloat(convert9yes);

var answer10yes=yesArray[4]; var stringanswer10yes=JSON.stringify(answer10yes);var arrays10yes = stringanswer10yes.split('"'); var convert10yes = arrays10yes[3];
var final10yes = parseFloat(convert10yes);

var answer6no=noArray[0]; var stringanswer6no=JSON.stringify(answer6no);var arrays6no = stringanswer6no.split('"');var convert6no = arrays6no[3];
var final6no = parseFloat(convert6no);

var answer7no=noArray[1];var stringanswer7no=JSON.stringify(answer7no);var arrays7no = stringanswer7no.split('"');var convert7no = arrays7no[3];
var final7no = parseFloat(convert7no);

var answer8no=noArray[2];var stringanswer8no=JSON.stringify(answer8no);var arrays8no = stringanswer8no.split('"');var convert8no = arrays8no[3];
var final8no = parseFloat(convert8no);

var answer9no=noArray[3];var stringanswer9no=JSON.stringify(answer9no);var arrays9no = stringanswer9no.split('"');var convert9no = arrays9no[3];
var final9no = parseFloat(convert9no);

var answer10no=noArray[4];var stringanswer10no=JSON.stringify(answer10no);var arrays10no = stringanswer10no.split('"');var convert10no = arrays10no[3];
var final10no = parseFloat(convert10no);



Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Average Response'
    },
    xAxis: {
        categories: [
            'Difficulty',
            'Time',
            'Homework',
            'Knowledge',
            'Lectures'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
	max: 5
    },
 tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },


    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

series: [{
          name: 'Average',
        data: [final1,final2,final3,final4,final5]

    }]
});

</script>

<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Recommend?',
        align: 'center',
        verticalAlign: 'middle',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Recommend?',
        innerSize: '50%',
        data: [
            ['Yes', final10yes],
            ['No', final10no],
            {
                dataLabels: {
                    enabled: false
                }
            }
        ]
    }]
});
</script>

<div id="container3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Regret?',
        align: 'center',
        verticalAlign: 'middle',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Regret?',
        innerSize: '50%',
        data: [
            ['Yes', final9yes],
            ['No', final9no],
            {
                dataLabels: {
                    enabled: false
                }
            }
        ]
    }]
});
</script>

<div id="container4" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container4', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Fair Grader?',
        align: 'center',
        verticalAlign: 'middle',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Regret?',
        innerSize: '50%',
        data: [
            ['Yes', final8yes],
            ['No', final8no],
            {
                dataLabels: {
                    enabled: false
                }
            }
        ]
    }]
});
</script>

<div id="container5" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container5', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Textbook?',
        align: 'center',
        verticalAlign: 'middle',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Textbook?',
        innerSize: '50%',
        data: [
            ['Yes', final6yes],
            ['No', final6no],
            {
                dataLabels: {
                    enabled: false
                }
            }
        ]
    }]
});
</script>

<div id="container6" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container6', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: 0,
        plotShadow: false
    },
    title: {
        text: 'Laptops?',
        align: 'center',
        verticalAlign: 'middle',
        y: 40
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                    fontWeight: 'bold',
                    color: 'white'
                }
            },
            startAngle: -90,
            endAngle: 90,
            center: ['50%', '75%']
        }
    },
    series: [{
        type: 'pie',
        name: 'Laptops?',
        innerSize: '50%',
        data: [
            ['Yes', final7yes],
            ['No', final7no],
            {
                dataLabels: {
                    enabled: false
                }
            }
        ]
    }]
});
</script>




<input type="hidden" name="chosenUniversity2" value="<?php echo $chosenUniversity;?>" >

<?php
if ($_SESSION['loggedin'] == false){ ?>


Want to leave your own reviews?
<form method="get" action="registration.php">
	<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']?>">
	<input type="submit" class="btn btn-secondary" value="Register Now!">
</form>

Already have an account?
<form method="get" action="login.php">
	<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']?>">
	<input type="submit" class="btn btn-success" value="Log-In">
</form>

<?php } ?>


<?php

if ($_SESSION['loggedin'] == true){ ?>


<form action="questionnare.php" method="post">

<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']?>">
<input type="hidden" name="chosenCourse" value="<?php echo $chosenCourse;?>" >
<input type="hidden" name="professor" value="<?php echo $professor;?>" >
<input type="hidden" name="course" value="<?php echo $course;?>" >

<input type="submit" value="Leave a Review!">
<br>
<a href="logout.php">Logout</a>

</form>

<?php } ?>

</main>


</div>
</body>
</html>
