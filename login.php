
<?php
session_start();

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

$sql = "SELECT * FROM Members WHERE username = '".$username."' AND password = SHA1('".$password."')";
$result = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($result) == 0) {	
	if (!filter_input(INPUT_POST, "username") || !filter_input(INPUT_POST, "password")) {
		header("Location: register.html");
		exit;
	}
}
	
setcookie("auth", session_id(), time()+60*30, "/", "", 0);
header("Location: pet_page.html");
exit;

while($row = mysqli_fetch_assoc($result)) {
		echo $row["fName"];
		echo $row["lName"];
		echo $row["email"];
}		

mysqli_close();
?>