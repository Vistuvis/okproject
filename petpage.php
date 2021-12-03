<?php

session_start();

if (filter_input(INPUT_COOKIE, 'auth') == session_id()) {
    $output = "Good luck on your play!";
} else {
    //redirect back to login form if not authorized
    header("Location: login.html");
    exit;
}
$petID = $_POST['petID'];
$imageloc = $_POST['imageLocation'];
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
<style>
    p {
        line-height: 0.6;
    }

    #game-area {
        height: 700px;
        width: 900px;
        background-image: url('assets/css-images/pethouse.jpeg'); 
        background-repeat: no-repeat;
        background-size: contain;
        margin: 0 auto;
        position: relative;
    }

    .info-container {
        display: flex;
        flex-direction: row;
        margin-top: 20px;
    }

    .criteria {
        margin-right: 10px;
    }

    .points {
        margin-right: 20px;
    }

    .action {
        width: 140px;
        border-radius: 10px;
        border: none;
        box-shadow: 1px 2px 1px 2px #888888;
        margin-right: 20px;
    }

    #rank, #save {
        width: 50px;
    }
    #pet-container {
        position: absolute;
        bottom: 40px;
        margin-left: 300px;

    }

    #pet{
        width: 150%;
        height: auto;
    }

    #item-container {
        position: absolute;
        bottom: 250px;
        margin-left: 250px;
    }

    #item{
        width: 150px;
        height: auto;
    }

    #dialog-container {
        position: absolute;
        bottom: 250px;
        margin-left: 500px;
    }

    #dialog-full{
        width: 200px;
        height: auto;
    }

    #status {
        background-color: rgb(255, 255, 255, 0.7);
        width: 90px;
        border-radius: 20px;
        bottom: 400px;
        margin: 20px auto;
    }
</style>
<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-green w3-card w3-left-align w3-large  w3-opacity">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-green" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
          <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
          <a href="pet_selection.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">My Pets</a>
        </div>
      
        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
          <a href="pet_selection.html" class="w3-bar-item w3-button w3-padding-large">My Pets</a>
        </div>
      </div>

    <!-- Header -->
    <header id="ok-background" class="w3-container w3-green w3-center" style="padding:128px 16px">
        <h1 class="ok-text-color w3-margin w3-jumbo">Pet Page</h1>
        <p class="ok-text-color w3-xlarge">Playing with your pet!</p>
    </header>

    <div id="game-area" class="w3-container w3-center" >
        <div class="info-container">
            <p class="criteria" id="happiness"><strong>Happiness</strong></p>
            <p class="points" id="happiness-points"> 5</p>
            <p class="criteria" id="hunger"><strong>Not Hungry</strong></p>
            <p class="points" id="hunger-points"> 5</p>
            <p class="criteria" id="health"><strong>Health</strong></p>
            <p class="points" id="health-points">5</p>
            <button class="action" id="feed" onclick="feed()">Feed your buddy</button>
            <button class="action" id="play" onclick="play()">Play together</button>
            <button class="action" id="rank" onclick="">Rank</button>
            <button class="action" id="save" onclick="saveData()">Save</button>

        </div>
        <div id="item-container"></div>
        <div id="pet-container">
            <img id="pet" src="<?php echo $imageloc; ?>">
        </div>
        <div id="dialog-container"></div>
        <div id="status"></div>
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

        function feed() {
            const hunger = document.getElementById("hunger-points").innerHTML;
            let hungerLevel = parseInt(hunger);
            
            if (hungerLevel < 10) {
                document.getElementById("item-container").innerHTML="<img id='item' src='assets/css-images/food.webp'>";
                // show icon in 3s using Jquery
                $(document).ready(() => {
                    $("#item-container").show().fadeOut(1000);
                });
                // update hunger level
                hungerLevel += 1;
                document.getElementById("hunger-points").innerHTML = hungerLevel;
            }
            else {
                document.getElementById("dialog-container").innerHTML="<img id='dialog-full' src='assets/css-images/dialog-full.png'>";
                // show icon in 3s using Jquery
                $(document).ready(() => {
                    $("#dialog-container").show().fadeOut(1000);
                });
            }
        }

        function play() {
            const happiness = document.getElementById("happiness-points").innerHTML;
            let happinessLevel = parseInt(happiness); 

            happinessLevel += 1;
            document.getElementById("happiness-points").innerHTML = happinessLevel;
            document.getElementById("item-container").innerHTML="<img id='item' src='assets/css-images/heart.webp'>";
            // show icon in 3s using Jquery
            $(document).ready(() => {
                $("#item-container").show().fadeOut(1000);
            });
        }
        
        function saveData() {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    $(document).ready(() => {
                        document.getElementById("status").innerHTML = "SAVED!";
                        $("#status").show().fadeOut(1000);
                    });
                }
            };

            const happiness = parseInt(document.getElementById("happiness-points").innerHTML);
            const hunger = parseInt(document.getElementById("hunger-points").innerHTML);
            const health = parseInt(document.getElementById("health-points").innerHTML);

            xhr.open("POST", "savegame.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // 
            const data = "petID=<?php echo $petID;?>" + "happiness="+ happiness + "&hunger=" +hunger+ "&health="+ health;
            xhr.send(data);
        }
    </script>

</body>

</html>