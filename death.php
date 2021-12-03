<?php
session_start();


if (filter_input(INPUT_COOKIE, 'auth') == session_id()) {
    $output = "Good luck on your play!";
} else {
    //redirect back to login form if not authorized
    header("Location: login.html");
    exit;
}

$petID = intval($_POST['petID']);

if($petID ===  ""){
    header("Location: pet_selection.php");
    exit;
}
$userID = $_SESSION["userid"];

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());

$sql = "DELETE FROM Pets WHERE memID = $userID AND petID = $petID";
$result = mysqli_query($mysqli, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<title>Ok Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/mystyle.css">
<link rel="stylesheet" href="css/w3style.css">

<body>
<div class="w3-top">
        <div class="w3-bar w3-green w3-card w3-left-align w3-large  w3-opacity">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-green" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-white">Home</a>
          <a href="pet_selection.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">My Pets</a>
          <a href="death.php" class="w3-bar-item w3-button w3-padding-large w3-white">Death</a>
          <a href="ranking.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-white">Rankings</a>
          <a href="logout.php" class="right-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Logout</a>
        </div>
      
        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
          <a href="pet_selection.php" class="w3-bar-item w3-button w3-padding-large">My Pets</a>
          <a href="ranking.php" class="w3-bar-item w3-button w3-padding-large">Rankings</a>
          <a href="logout.php" class="w3-bar-item w3-button w3-padding-large">Logout</a>
        </div>
      </div>

      <header id="death-background" class="w3-container w3-green w3-center" style="padding:128px 16px">
        <h1 class="ok-text-color w3-margin w3-jumbo">Your pet died.</h1>
        <p class="ok-text-color w3-xlarge">Why did you let this happen?</p>
    </header>

    <footer class="w3-green w3-container w3-padding-64 w3-center w3-opacity">
        <div class="w3-xlarge w3-padding-32">
            <i class="fa fa-facebook-official w3-hover-opacity"></i>
            <i class="fa fa-instagram w3-hover-opacity"></i>
            <i class="fa fa-snapchat w3-hover-opacity"></i>
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>
            <i class="fa fa-twitter w3-hover-opacity"></i>
            <i class="fa fa-linkedin w3-hover-opacity"></i>
        </div>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </footer>







</body>










</html>