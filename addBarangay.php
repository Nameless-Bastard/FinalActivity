<?php
session_start();
$logout;
if(empty($_SESSION["name"])) {
  header("location:login.php");
}
?>session_start();
<!DOCTYPE html>
<html>
  <head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
    <title>Add Barangay</title>
  </head>

 <body>

   <div class="header">
     <img class="headerImage" src="img/header.png" alt="header">
   </div>
   <div class="navbar">

    <a id="home" href="index.html">Home</a>
    <a href="contact.php">Contact</a>
    <a href="casesList.php">Cases</a>
    <a href="barangayListAdmin.php">Barangay</a>
   </div>
  <h1>Add Barangay</h1>
  <form action="addBarangay.php" method="post">
    <label>Barangay Name</lable> <input type="text" name="barangayName"><br><br>
    <label>Barangay Captain</label> <input type="text" name="barangayCaptain"><br><br>
    <label>Barangay Contact</label> <input type="text" name="barangayContact"><br><br>
    <label>Barangay District</lable><br>
    <label>District 1</lable> <input type="radio" value = "1" name="district">
    <label>District 2</lable> <input type="radio" value = "2" name="district"><br><br>

    <input type="submit" value="Add Barangay" name="addBarangayBtn">
  </form>
<br><br><img src="img/footer.png" alt="footer of webpage">
</body>
</html>

<?php

function addBarangay($Bname, $Bdistrict, $Bcaptain, $Bcontact){
  include('db.php');

  $sql = "INSERT INTO barangays (barangayName, barangayDistrict, barangayCaptain, barangayContact)
  VALUES ('$Bname', '$Bdistrict', '$Bcaptain', '$Bcontact')";
  $result = $conn->query($sql);

  if($result == TRUE) {
    header("location:barangayListAdmin.php");
  }

  else {
    $msg = $conn->error;
  }

  $conn->close();
  return $msg;

}


if(isset($_POST['addBarangayBtn']))
{
echo addBarangay($_POST['barangayName'],$_POST['district'],$_POST['barangayCaptain'],$_POST['barangayContact']);
}

?>
