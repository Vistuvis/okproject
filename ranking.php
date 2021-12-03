<!DOCTYPE html>
<html lang="en">
<title>Ok Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preload"  rel="stylesheet" href="css/mystyle.css" as="style">
<link rel="preload" rel="stylesheet" href="css/w3style.css" as="style">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/mystyle.css">
<link rel="stylesheet" href="css/w3style.css">
<style>
  main {
      width: 50%;
      margin: 0 auto;
  }

  #pets-ranking-container, #players-ranking-container {
      display: none;
      text-align: center;
  }

  table {
      margin: 0 auto;
  }

  td, th {
    padding: 20px;
  }
</style>

<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-green w3-card w3-left-align w3-large  w3-opacity">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-green" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Home</a>
    <a href="pet_selection.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">My Pet</a>
    <a href="ranking.php" class="w3-bar-item w3-button w3-padding-large w3-white">Ranking</a>
    <a href="logout.php" class="right-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Logout</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
            <a href="index.html" class="w3-bar-item w3-button w3-padding-large">Home</a>
          <a href="pet_selection.php" class="w3-bar-item w3-button w3-padding-large">My Pets</a>
          <a href="ranking.php" class="w3-bar-item w3-button w3-padding-large">Rankings</a>
          <a href="logout.php" class="w3-bar-item w3-button w3-padding-large">Logout</a>
  </div>
</div>

<!-- Header -->
<header id="ok-background" class="w3-container w3-green w3-center" style="padding:128px 16px">
  <h1 class="ok-text-color w3-margin w3-jumbo">Global Rankings</h1>
  <p class="ok-text-color w3-xlarge">Please select an option to display ranks.</p>
  <button onclick="rankPets()" class="w3-button w3-black w3-large w3-margin-top">Best PETS Ranking</button>
  <button onclick="rankPlayers()" class="w3-button w3-black w3-large w3-margin-top">Best PLAYERS Ranking</button>
</header>
<?php

$server="localhost";
$user="thu";
$pass="letmein7";
$database="okprojectDB";

$mysqli = mysqli_connect($server, $user, $pass, $database) or die("Connection fail: ".mysqli_connect_error());

// query for best pet
$sqlPet = "SELECT p.petName, p.happiness, m.userName ".
          "FROM Pets p, Members m ".
          "WHERE p.memID = m.memID ".
          "ORDER BY p.happiness DESC";

$resultPet = mysqli_query($mysqli, $sqlPet) or die(mysqli_error($mysqli));

if (mysqli_num_rows($resultPet) >= 1) {                
    $blockPet ="<table id='pets-ranking'><tr>"
        ."<th>Pets</th>"
        ."<th>Happiness</th>"
        ."<th>Players</th>"."</tr>";

    while ($info = mysqli_fetch_array($resultPet)) {
        $petName = stripslashes($info['petName']);
        $happiness = $info['happiness'];
        $userName = stripslashes($info['userName']);
        $blockPet .= "<tr>";
        $blockPet .= "<td>".$petName."</td>";
        $blockPet .= "<td>".$happiness."</td>";
        $blockPet .= "<td>".$userName."</td>";
        $blockPet .= "</tr>";
    }
    $blockPet .= "</table>";
}
// query for best players
$sqlPlayer = "SELECT m.memID, m.userName, m.dateAdded, COUNT(p.petID) petNum ".
             "FROM Pets p RIGHT JOIN Members m ON p.memID =  m.memID ".
             "GROUP BY m.memID, m.userName, m.dateAdded ".
             "ORDER BY petNum DESC";

$resultPlayer = mysqli_query($mysqli, $sqlPlayer) or die(mysqli_error($mysqli));

if (mysqli_num_rows($resultPlayer) >= 1) {                
    $blockPlayer ="<table id='players-ranking'><tr>"
        ."<th>Players</th>"
        ."<th>Start Date</th>"                
        ."<th>Number of Pets</th>"."</tr>";

    while ($info = mysqli_fetch_array($resultPlayer)) {
        $userName = stripslashes($info['userName']);
        $dateAdded = stripslashes($info['dateAdded']);
        $petNum = $info['petNum'];
        $blockPlayer .= "<tr>";
        $blockPlayer .= "<td>".$userName."</td>";
        $blockPlayer .= "<td>".$dateAdded."</td>";
        $blockPlayer .= "<td>".$petNum."</td>";
        $blockPlayer .= "</tr>";
    }
    $blockPlayer .= "</table>";
}
?>
<main>
    <div id="pets-ranking-container">
        <h2>MOST HAPPINESS PETS</h2>
        <?=$blockPet?>
    </div>
    <div id="players-ranking-container">
        <h2>BEST PLAYERS</h2>
        <?=$blockPlayer?>
    </div>
</main>
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

function rankPets() {
    // switch options
    document.getElementById("players-ranking-container").style.display = "none";
    document.getElementById("pets-ranking-container").style.display = "block";
}

function rankPlayers() {
    // switch options
    document.getElementById("pets-ranking-container").style.display = "none";
    document.getElementById("players-ranking-container").style.display = "block";
}
</script>

</body>
</html>
