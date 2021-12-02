<?php

$memID = $_POST["memID"];
$petName = $_POST["petName"];

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());
$sql = "INSERT INTO Pets(petID, memID, petName) VALUES(NULL, $memID, '".$petName."')";
if (mysqli_query($mysqli, $sql)) {
	echo "Success!";
}
?>