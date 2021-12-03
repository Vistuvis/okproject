<?php
session_start();

if (filter_input(INPUT_COOKIE, 'auth') == session_id()) {
    $output = "Good luck on your play!";
} else {
    //redirect back to login form if not authorized
    header("Location: login.html");
    exit;
}
$petID = $_POST["petID"];
$happiness= $_POST["happiness"];
$hunger= $_POST["hunger"];
$health = $_POST["health"];

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());

$sql = "UPDATE Pets SET happiness = ".$happiness.", health = ".$health.", hunger = ".$hunger." WHERE petID = ".$petID; //changed petid from 1
if (mysqli_query($mysqli, $sql)) {
	echo "Success!";
}

?>