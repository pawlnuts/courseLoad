<?php

session_start();
$url = $_SESSION['courses'];

header("Location: " . $url);

?>
