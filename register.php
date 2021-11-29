<?php
if (!filter_input(INPUT_POST, "fname") || !filter_input(INPUT_POST, "lname") ||
    !filter_input(INPUT_POST, "email") || !filter_input(INPUT_POST, "username") || !filter_input(INPUT_POST, "password")) {
	header("Location: register.html");
	exit;
}

$fname = filter_input(INPUT_POST, "fname");
$lname = filter_input(INPUT_POST, "lname");
$email = filter_input(INPUT_POST, "email");
$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());
$sql = "INSERT INTO Members VALUES (NULL, '".$fname."', '".$lname."', '".$email."', '".$username."', SHA1('".$password."'), CURDATE());";

if (mysqli_query($mysqli, $sql))
{
	echo "Your account was created";
} else {
	echo "Account creation failed.";
}
?>