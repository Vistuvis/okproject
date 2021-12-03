<?php
session_start();

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
<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-green w3-card w3-justify w3-large  w3-opacity">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-green" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-white">Home</a>
          <a href="pet_selection.php" class="w3-bar-item w3-button w3-padding-large w3-white">My Pets</a>
          <a href="ranking.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-hover-white">Rankings</a>
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
  <h1 class="ok-text-color w3-margin w3-jumbo">Pet Page</h1>
  <p class="ok-text-color w3-xlarge"><?php echo $display; ?></p>
</header>

<div id="myModal" class="modal">
<div class="modal-content w3-center">
  <div class="modal-header w3-green ">
    <span class="close">&times;</span>
    <h2>Select Attributes for your Pet</h2>
  </div>
  <div class="modal-body">
  <form class="register-form2" id="testform" name="myform" action="pet_selection.php">
            <div class="name">
                <input id="petName" class="input2" type="text" name="petName" placeholder="petName" required minlength="3" maxlength="20" />
            </div>
            <fieldset class="optionGroup">
            <?php
              $dirname = __DIR__."/pet_assets/";
              //echo $dirname;
              $dir = new DirectoryIterator($dirname);
              foreach ($dir as $fileinfo) {
                  if (!$fileinfo->isDot()) {
                      //echo ($fileinfo->getFilename());
                      echo "<label>
                      <input type=\"radio\" name=\"petloc\" id=\"petloc\" value=\"$fileinfo\" ><img src=\"pet_assets\\$fileinfo\" class=\"resize\">
                      </label>";
                  }
              }

            ?>
            </fieldset>
            <div><button type="button" onclick='insertNewPet()' id="button1" class="w3-button w3-black w3-large w3-margin-top">Adopt a pet!</button></div>
        </form>
  </div>
</div>
</div>


<div class=" ok-table-container w3-padding-64 w3-row-padding w3-green">
<?php

if ($pets || $pets == false) {
    echo "<div class=\"w3-container w3-white w3-center\" style=\"padding:128px 16px\">
  <p class=\"ok-text-color w3-xlarge\">Please create your pet</p>
  <button id=\"myBtn\" class=\" w3-button w3-black w3-large w3-margin-top\">Create a Pet</button>
</div>";
}
?>
<div id="reload">
  <div class="ok-content"
      <?php

        
        if ($pets) {
            // $row = mysqli_fetch_array($result);
            echo "<div=\"ok-row\">";
            while ($row = mysqli_fetch_array($result)) {
                $imageloc = $row['imageLocation'];
                $name = $row['petName'];
                $petID = $row['petID'];
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
            <form method=\"POST\" action=\"petpage.php\">
            <input type=\"hidden\" id=\"petID\" name=\"petID\" value=\"$petID\">
            <input type=\"hidden\" id=\"imageLocation\" name=\"imageLocation\" value=\"$imageloc\">
            <input type=\"submit\" value=\"Interact With\" class=\"w3-button w3-black w3-large w3-margin-top\" />
            </form>
            </td>
           </tr>
           </table>
            </div>", $name, $row['imageLocation'], $name);
            }
            echo "</div>";
        }


      ?>
  </div>
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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
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

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
          modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
            location.reload(); 
          }
          
        }
        function refresh(){
          location.reload(); 
        }

      function insertNewPet() {
        if(document.getElementById("petName").value == ""){
          alert("You did not enter a name:");
        } else{

        
      //let formData = new FormData(document.forms.myform);
      let xhr = new XMLHttpRequest();
      console.log(xhr.readyState);
      let data = "petName=" +document.getElementById("petName").value + "&petloc=" + document.querySelector('input[name="petloc"]:checked').value;;
      xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
    document.getElementById("demo").innerHTML = this.responseText;
            }
          };
      xhr.open("POST", "newpet.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() { // Call a function when the state changes.
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 0) {
        alert("Test");
    }
    console.log(xhr.readyState);
}
      xhr.send(data);
      //xhr.onload = () => alert(xhr.response);
      document.getElementById("button1").disabled = true;
      //$("#reload").load("pet_selection.php");
  }

      }
    </script>

</body>

</html>