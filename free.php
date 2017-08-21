<?php
  session_start();
  include ('steamauth/userInfo.php');

  $servername = "...";
  $username = "...";
  $password = "...";
  $dbname = "...";
  $user = $steamprofile['personaname'];
  $steamid = $steamprofile['steamid'];

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  } 
  $sqlget9 = "SELECT * FROM MasterList WHERE SteamID = '$steamid' LIMIT 1";
  $sqldata9 = mysqli_query($conn, $sqlget9) or die('error getting data');
  $sqlget10 = "SELECT Rank FROM MasterList WHERE SteamID = '$steamid' LIMIT 1";
  $sqldata10 = mysqli_query($conn, $sqlget10) or die('error getting data');
  $conn->close();
?>
<html lang="en">
  <head>
    <?php include ('header.php'); ?>
  </head>
  <style>
    .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      @include box-sizing(border-box);
      &:focus {
        z-index: 2;
      }
    }
  </style>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-color: transparent">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">LuisGPlays</a>
          <?php
              if(isset($_SESSION['steamid'])) {
                    echo "<a href=\"https://www.luisgplays.com/free.php\"><button type=\"button\" class=\"btn btn-success navbar-btn\" style=\"display:inline-block\">Free <i class=\"fa fa-money fa-1x\" aria-hidden=\"true\" style=\"color: white;\"></i></button></a>";     
                  
                while($row = mysqli_fetch_array($sqldata9, MYSQLI_ASSOC)){
                  echo "<button id=\"myButton\"type=\"button\" class=\"btn btn-primary navbar-btn\" style=\"display:inline-block; margin-left: 10px\">";
                  echo $row['Coins'];
                  echo "&nbsp";
                  echo "<i class=\"fa fa-money fa-1x\" aria-hidden=\"true\" style=\"color: white;\"></i></button>"; 
                  echo "<script>";
                  echo "document.getElementById(\"myButton\").onclick = function () {alert(\"";
                  echo "You have ";
                  echo $row['Coins'];
                  echo " Points\")}";
                      }
                  echo "</script>";
                }
                else {
                  echo "";
                }
              ?>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" style="float: right">
            <?php
              if(isset($_SESSION['steamid'])) 
              {
                echo "<li style=\"float: right\"><a href=\"logout.php\">Logout</a></li>";
              }  
            
              else 
              {
                echo "<li style=\"float: right\"><a href=\"login.php\">Login</a></li>";
              }   
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <?php
        echo "<h1 style=\"text-align: center\">";
        echo "$user";
        echo "'s";
        echo " Profile";
        echo "</h1><br><br><img src=\"";
        echo $steamprofile['avatarfull'];
        echo "\" class=\"img-circle img-responsive\" style=\"margin: 0 auto; display: block\" >";
        while($row2 = mysqli_fetch_array($sqldata10, MYSQLI_ASSOC)){
            $rank = $row2['Rank'];
         if($rank == 0){
             echo "<p style='text-align: center'><b>Unranked</b></p>";
             echo "<a href='#link'><p style='text-align: center'>What is this?</p></a>";
         }   
         if($rank == 1){
             echo "<img src='https://pro-rankedboost.netdna-ssl.com/wp-content/uploads/2016/05/1.png' style='display: block; margin: 0 auto'>";
             echo "<a href='#link'><p style='text-align: center'>What is this?</p></a>";
         }
         if($rank == 2){
             echo "<img src='https://pro-rankedboost.netdna-ssl.com/wp-content/uploads/2016/05/2.png' style='display: block; margin: 0 auto'>";
             echo "<a href='#link'><p style='text-align: center'>What is this?</p></a>";
         }
         if($rank == 3){
             echo "<img src='https://pro-rankedboost.netdna-ssl.com/wp-content/uploads/2016/05/3.png' style='display: block; margin: 0 auto'>";
             echo "<a href='#link'><p style='text-align: center'>What is this?</p></a>";
         }
        }
        echo "<br>";
      ?>
      <hr>
      <?php
        echo "<form action=\"promo.php\" method=\"post\" name=\"code\" id=\"code\">";
          echo "<div class=\"form-group\">";
          echo "<input type=\"text\" class=\"form-control\" placeholder=\"Stream Code\" required name=\"code\" id=\"code\">";
          echo "</div>";
          echo "<button type=\"submit\" class=\"btn btn-default\">Submit</button>";
        echo "</form><br>";
      ?>
<!--
      <div class="alert alert-info" role="alert">
        <p>Set LuisGPlays Community As Your Primary Steam Group.</p>
        <button type="button" class="btn btn-info navbar-btn" style="display: inline">Free 20 <i class="fa fa-money fa-1x" aria-hidden="true" style="color: white;"></i></button>
      </div>
-->
      <hr>
      <div> 
      <h2>What is the list?</h2>
      <p>The list is a way for Luis to be able to play with his supporters daily. It costs 50 points to join the list. If you decide that you do not want to be on the list anymore, there is a button to remove your name from the list and you will get your 50 points back. After you play with luis, he will take your name off of the list and your points will be gone forever. If, for some reason, there is an error with you joining Luis' game or for some reason you do not get to play with Luis, you will get a full refund of your points. You may have noticed that a name on the list is a different color, please see the key below for the meaning of these colors.</p>
      <ul>
        <li style="color: purple; font-weight: bold">Donator</li>
        <li style="color: cyan; font-weight: bold">Moderator</li>
        <li style="color: green; font-weight: bold">Developer</li>
      </ul>
      <hr>
      <h2>How do I earn points?</h2>
      <p>You can earn points in many different ways. Everyday Luis gives out 3 different promo codes during the stream. One at the beginning of the stream, on in the middle, and one at the end of the stream. You will need to enter these codes on this page for extra points. These codes are only avaliable for a limited time so you must act fast after you recieve the code. Each code is 15 points on average but their amount can fluctuate. You can also gain points by giveaways that Luis does. If you are the lucky person who wins a giveaway, coins will be automatically added to your account. You may also earn points by donating Luis your skins. You must donate to the offical donation bot listed below to recieve points. Each cent you donate is worth 1 point. All donations are final and non refundable.</p>
      <hr>
      <div class="alert alert-info" role="aler\">
      <p><a href="https://steamcommunity.com/tradeoffer/new/?partner=172467468&token=3jj67qJB" target="_blank">Get more points by donating skins to luis on the official donation bot! Donate Here!</a></p>
      </div>
      <hr>
      <h2 id="link">Rank System</h2>
      <p>You may have noticed a rank by people's name. This does not represent their in-game rank, but instead their rank on this website. This feature is still in testing and will not be fully released for a while. Stay tuned!</p>
      <hr>
       </div> 
       <hr>
    </div>   
    <div class="container">
      <footer>
      <?php include ('footer.php'); ?>
      </footer>
    </div>
  </body>
</html>
