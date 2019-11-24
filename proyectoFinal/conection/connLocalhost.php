<?php

$server = "localhost";
$bd = "finalProyec";
$user = "root";
$pass = "";

$connLocalhost = mysqli_connect($server, $user, $pass) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_query($connLocalhost, "SET NAMES 'utf8'");
mysqli_select_db($connLocalhost, $bd);
?>