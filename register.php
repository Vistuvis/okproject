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
<script>
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

</script>
<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-green w3-card w3-left-align w3-large  w3-opacity">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-green"
                href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
            <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-white">Home</a>
            <a href="register.html" class="w3-bar-item w3-button w3-padding-large w3-white">Register</a>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href="register.html" class="w3-bar-item w3-button w3-padding-large">Register</a>
        </div>
    </div>

<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">

      <h5 class="w3-padding-32">
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
$sql = "SELECT email from Members";
$result = mysqli_query($mysqli, $sql);
echo "$result";
if($result['email'] == $email) {
	echo "That email is already in use";
	echo "<a href=\"register.html\">Go back</a>";
	mysqli_close();
}
else{
    $sql = "INSERT INTO Members VALUES (NULL, '".$lname."', '".$fname."', '".$email."', '".$username."', SHA1('".$password."'), CURDATE());";

    if (mysqli_query($mysqli, $sql)) {
        echo "Your account was created";
        echo "<a href=\"index.html\">Go Home</a>";
        mysqli_close();
    } else {
        echo "Account creation failed.";
        echo "<a href=\"index.html\">Go Home</a>";
        mysqli_close();
    }
}
?>

</h5>

    </div>
  </div>
</div>
</body>
</html>