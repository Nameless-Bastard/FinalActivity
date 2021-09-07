<?php
$barangayId = $_GET['bid'];
if(null==$barangayId){
  header("location:barangayList.php");
}
  include('db.php');
  //for getting the barangay data
  $sql = "SELECT * FROM barangays WHERE barangayId = '$barangayId'";
  $result = $conn->query($sql);
  $data = mysqli_fetch_assoc($result);
 ?>
 <?php
 $casesRow="";
 $found=0;
 //query
 $sqla = "SELECT cases.*, barangays.* FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId
 WHERE cases.barangayId = '$barangayId' ORDER BY cases.dateOfCase DESC";
 $result = $conn->query($sqla);




 while($row = $result->fetch_assoc()) {
     $found = ++$found;
     $casesRow.= "<tr>";
     $casesRow.= "<td>".$row['dateOfCase']."</td>";
     $casesRow.= "<td>".$row['confirmed']."</td>";
     $casesRow.= "<td>".$row['recovered']."</td>";
     $casesRow.= "<td>".$row['death']."</td>";
     $casesRow.= "<td>".$row['active']."</td>";
     $casesRow.= "</tr>";
 }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Barangays</title>
  </head>
 <body>
   <div class="header">
     <img class="headerImage" src="img/header.png" alt="header">
   </div>
   <div class="navbar">

    <a id="home" href="index.html">Home</a>
    <a href="contact.php">Contact</a>
    <a href="casesList.php">Cases</a>
    <a href="barangayList.php">Barangay</a>
   </div>
   <div class="Main_div">
   <form method="post" action="barangayList.php" class="searchbtn">
  <table class="table_style">
    <thead>


    <tr>
      <th colspan="5"><h2 style="text-align:center; padding:0;margin:0;">Barangay <?php echo $data['barangayName']; ?></h1></th>
    </tr>
    <tr>
      <th colspan="5"><h4 style="text-align:center; padding:0;margin:0;"><?php echo $data['barangayCaptain']; ?></h4> </th>
    </tr>
    <tr>
    <th colspan='5' class='barangay_district'> District <?php echo $data['barangayDistrict'] ?><span class='searchTotal'><sup>Total Result :<?php echo $found ?></sup></span></th>
    </tr>
    <?php
      $sql2 = "SELECT SUM(confirmed) AS 'confirmed', SUM(active) AS 'active',
      SUM(recovered) AS 'recovered', SUM(death) AS 'death' FROM cases WHERE barangayId ='$barangayId'";
      $result2 = $conn->query($sql2);
      $data = mysqli_fetch_assoc($result2);
      $conf = "<p>Total Cases: ".$data['confirmed']."</p>";
      $act = "<p>Active Cases: ".$data['active']."</p>";
      $reco = "<p>Total recovered: ".$data['recovered']."</p>";
      $deat ="<p>Death: ".$data['death']."</p>";

       ?>
    <tr>
      <th>Date</th>
      <th>Confirmed<sub><?php echo $conf; ?></sub></th>
      <th>Recovered<sub><?php echo $reco; ?></sub></th>
      <th>Death<sub><?php echo $deat; ?></sub></th>
      <th>Active<sub><?php echo $act; ?></sub></th>
    </tr>
    </thead>

    <?php
    echo "<tbody class='tbody_style'>";
    echo $casesRow;
    if($found==0){
      echo "<tr>";
      echo "<td colspan='5' class='td_noResult'>None match search result.</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    $conn->close();
    ?>

</table></form>
</div>
<br><br><img src="img/footer.png"  style="width:100%;" alt="footer of webpage">
</body>
</html>
