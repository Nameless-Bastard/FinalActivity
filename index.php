<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta charset="utf-8">
  <title></title>
  <style media="screen">
    .LogoFront {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 400px;
    }
    .distansya{
      margin-bottom: 100px;
    }
    .distansya2{
      margin-bottom: 300px;
    }
  </style>
</head>

<body>

  <div class="header">
    <img class="headerImage" src="img/header.png" alt="header">
  </div>
  <div class="navbar">

   <a id="home" class="selectedNavbar" href="#">Home</a>
   <a id="logoutred" href='logout.php' title='Logout'>Logout</a>
   <a href="contactAdmin.php">Contact</a>
   <a href="casesListAdmin.php">Cases</a>
   <a href="barangayListAdmin.php">Barangay</a>

  </div>
  <?php
  $logout;
  if($_SESSION["name"]) {
    echo "<h2 style='text-align:center;'>Welcome ".$_SESSION["name"]."!</h2>";
  }else {
    header("location:login.php");
  }
  ?>
  <div class="Main_div">
    <img class="LogoFront distansya" src="img/pasigimg.png" alt="pasig-logo">
    <img style="width:100%;" class="distansya2" src="img/certificationNseal.png" alt ="centification and seal of Pasig">
    <img style="width:100%;" class="distansya2" src="img/missionVision.png" alt="Mission & Vision">
  </div>
  <br><img  style="width:100%;"src="img/footer.png" alt="footer of webpage">
</body>

</html>
