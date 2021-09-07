<?php
session_start();
$logout;
if(empty($_SESSION["name"])) {
  header("location:login.php");
}
?>
<?php
$barangayId = $_GET['bid'];
if(null==$barangayId){
  header("location:barangayListAdmin.php");
}

function deleteBarangay($barangayId){
  include('db.php');
  $sql = "DELETE FROM barangays WHERE barangayId = '$barangayId'";

  $result = $conn->query($sql);
  header("location:barangayListAdmin.php");
  $conn->close();
}


if(isset($_POST['DeleteBarangayBtn'])){
  deleteBarangay($barangayId);
}
 ?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Delete Barangay</title>
</head>
 <body>
   <div class="header">
     <img class="headerImage" src="img/header.png" alt="header">
   </div>
   <div class="navbar">

    <a id="home" href="#index.php">Home</a>
    <a id="logoutred" href='logout.php' title='Logout'>Logout</a>
    <a href="contactAdmin.php">Contact</a>
    <a href="casesListAdmin.php">Cases</a>
    <a href="barangayListAdmin.php">Barangay</a>

   </div>
  <h1>Delete Barangay</h1>
  <form action="deleteBarangay.php?bid=<?php echo $barangayId;?>" method="post">
    <?php
    include('db.php');
    //for getting the barangay data
    $sql = "SELECT * FROM barangays WHERE barangayId = '$barangayId'";
    $result = $conn->query($sql);
    if($data = mysqli_fetch_assoc($result)){
      echo "<h1>".$data['barangayName']."</h1>";
    }
    ?>

    <input type="submit" value="Delete Barangay" name="DeleteBarangayBtn">
  </form>
  <br><br><img src="img/footer.png"   style="width:100%;" alt="footer of webpage">
</body>
</html>
