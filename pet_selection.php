<?php
session_start();

if (filter_input (INPUT_COOKIE, 'auth') == session_id()) {
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

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());
$pets = false;
$userID = $_SESSION["userid"];
$username = $_SESSION["username"];
$rname = $_SESSION["fname"];

$sql = "SELECT * FROM Pets WHERE memID = $userID";
$result = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($result) == 0) {	
	if (!filter_input(INPUT_POST, "username") || !filter_input(INPUT_POST, "password")) {
		
		$display = "Sad news, $rname, you have no pets. Please create one!";
    $pets = false;
	}
} else {
  $display = "Congratulations, $rname, you have pets! Please select one:";
  $pets = true;
}


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

        function registerValidation() {
            const pass = document.getElementById("pass").value;
            const passCon = document.getElementById("passCon").value;
            if (pass != passCon) {
                alert("Password is not matched");
                return false;
            }
        }
    </script>
<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-green w3-card w3-justify w3-large  w3-opacity">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-green" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-white">Home</a>
          <a href="pet_selection.php" class="w3-bar-item w3-button w3-padding-large w3-white">My Pets</a>
          <a href="logout.php" class="right-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Logout</a>
        </div>
      
        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
          <a href="pet_selection.php" class="w3-bar-item w3-button w3-padding-large">My Pets</a>
          <a href="logout.php" class="right-bar-item w3-button w3-padding-large">Logout</a>
        </div>
      </div>

    <!-- Header -->
    <header id="ok-background" class="w3-container w3-green w3-center" style="padding:128px 16px">
  <h1 class="ok-text-color w3-margin w3-jumbo">Pet Page</h1>
  <p class="ok-text-color w3-xlarge"><?php echo $display; ?></p>
</header>



<div class=" ok-table-container w3-padding-64 w3-row-padding w3-green">
<?php 

if($pets == false){
  echo "<div class=\"w3-container w3-white w3-center\" style=\"padding:128px 16px\">
  <p class=\"ok-text-color w3-xlarge\">Please create your pet</p>
  <button class=\"w3-button w3-black w3-large w3-margin-top\"> <a href=\"#\">Create Pet</a></button>
</div>";
}
?>

  <div class="ok-content";
      <?php

        
        if($pets){
         // $row = mysqli_fetch_array($result);
         echo "<div=\"ok-row\">";
          while ($row = mysqli_fetch_array($result)) {
            $imageloc = $row['imageLocation'];
            $name = $row['petName'];
           // echo $imageloc;
           // echo "<img src=\"imageloc\" alt=\"$name\">";
            printf("  
            <div class =\"ok-column\">    
            <table class=\"pet-table pet-bordered pet-table2\">
            <tr>
            <td>
            <h2>%s </h2>
            </td>
            </tr>
            <tr id=\"#image-container\">
            <td id=\"#image-container\">
            <img src=\"%s\" alt=\"%s\">
            </td>
           </tr>
            <tr>
            <td>
            <form method=\"POST\ action=\"petpage.php\">
            <input type=\"submit\" value=\"Interact With\" class=\"w3-button w3-black w3-large w3-margin-top\" />
            </form>
            </td>
           </tr>
           </table>
            </div>",$name, $row['imageLocation'], $name);
            
          }
          echo "</div>";
        }


      ?>
  </div>
</div>

    <!-- Footer -->
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

</body>

</html>