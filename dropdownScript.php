
<?php include "../inc/dbinfo.inc"; ?>

<?php

ini_set('display_errors',1);

  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE );



	$university=$_GET['universityChoice'];
	echo $university;



?>
