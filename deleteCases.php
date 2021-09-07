<?php
session_start();
$logout;
if(empty($_SESSION["name"])) {
  header("location:login.php");
}
?>
<?php
$casesId = $_GET['bid'];
if(null==$casesId){
  header("location:casesListAdmin.php");
}


function deleteCases($casesId){
  include('db.php');
  $sql = "DELETE FROM cases WHERE casesId = '$casesId'";
  $result = $conn->query($sql);

  if($result == TRUE) {
    header("location:casesListAdmin.php");
  }
  else {
    $msg = $conn->error;
  }
  $conn->close();
  return $msg;
}


if(isset($_POST['deleteCasesBtn'])){
  echo deleteCases($casesId);
}
 ?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Delete Cases</title>
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
  <h1>Delete Cases</h1>
  <form action="deleteCases.php?bid=<?php echo $casesId;?>" method="post">
    <table border='4'>
    <tr>
      <th>Barangay Name</th>
      <th>Confirmed Cases</th>
      <th>Recovered Cases</th>
      <th>Death Cases</th>
      <th>Active Cases</th>
      <th>Date Of Cases</th>
    </tr>
    <?php
    include('db.php');
    //for getting the barangay data
    $sql = "SELECT cases.*, barangays.*
    FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId
    WHERE cases.casesId = '$casesId'";
    $result = $conn->query($sql);
    if ($data = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$data['barangayName']."</td>";
      echo "<td>".$data['confirmed']."</td>";
      echo "<td>".$data['recovered']."</td>";
      echo "<td>".$data['death']."</td>";
      echo "<td>".$data['active']."</td>";
      echo "<td>".$data['dateOfCase']."</td>";
      echo "</tr>";
      echo "</table>";
    }
    ?>
     <br><input type="submit" value="Delete Cases" name="deleteCasesBtn">
  </form>
  <br><br><img  style="width:100%;" src="img/footer.png" alt="footer of webpage">
</body>
</html>
