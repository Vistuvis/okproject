
<?php
session_start();
echo "test";
if (filter_input(INPUT_COOKIE, 'auth') == session_id()) {
    $output = "Good luck on your play!";
} else {
    //redirect back to login form if not authorized
    header("Location: login.html");
    exit;
}

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$memID = $_SESSION['userid'];
$petName = $_POST['petName'];
$imageLocation = $_POST['petloc'];

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());
$sql = "INSERT INTO Pets(petID, memID, petName, happiness, health, hunger, imageLocation) VALUES(NULL, $memID, '$petName', 100, 100, 100, 'pet_assets/$imageLocation')";
if (mysqli_query($mysqli, $sql)) {
	echo "Success!";
} else{
	echo "failed!";
}
echo $petName;
echo $imageLocation;
echo "test";
?>