
<?php
session_start();

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
echo $username;
$sql = "SELECT * FROM Members WHERE userName = '$username' AND password = SHA1('$password')";
$result = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($result) == 0) {	
	
		header("Location: login.html");
		mysqli_close();
		exit;
}
	
setcookie("auth", session_id(), time()+60*30, "/", "", 0);
$row = $result->fetch_assoc();

//session user variables
$_SESSION["userid"] = $row["memID"];
$_SESSION["username"] = $row["userName"];
$_SESSION["fname"] = $row["fName"];

header("Location: pet_selection.php");
exit;

/*while($row = mysqli_fetch_assoc($result)) {
		echo $row["fName"];
		echo $row["lName"];
		echo $row["email"];
}	*/	

mysqli_close();
?>