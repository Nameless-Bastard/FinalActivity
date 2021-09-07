
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Cases List</title>

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
   <?php
   $found = 0;
   $showResult='';
   include('db.php');
   $date = '';
   $search = '';

   if(isset($_GET['searchCasesBtn'])){
     $search = $_GET['searchBarangay'];
     $barangayKeyWord = $_GET['searchBarangay'];
     $sql = "SELECT cases.*, barangays.*
     FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId
     WHERE barangays.barangayName LIKE '%$barangayKeyWord%' ORDER BY dateOfCase DESC";
   }
   else {
     $sql = "SELECT cases.*, barangays.*
     FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId ORDER BY dateOfCase DESC";
   }

   if (isset($_GET['searchCasesBtn'])) {
     $date = $_GET['dateOfCase'];
   }

   // "SELECT cases.*, barangays.* FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId
   // WHERE dateOfCase = '$Keydate'";

   $sql = "SELECT cases.*, barangays.*
   FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId WHERE barangays.barangayName LIKE '%$search%'
   AND cases.dateOfCase LIKE '%$date%' ORDER BY dateOfCase DESC";

   $result = $conn->query($sql);

   while($row = $result->fetch_assoc()) {
       $found = ++$found;
       $showResult .= "<tr>";
       $showResult .= "<td><a href ='barangayCases.php?bid=".$row['barangayId']."'>".$row['barangayName']."</a></td>";
       $showResult .= "<td>".$row['confirmed']."</td>";
       $showResult .= "<td>".$row['recovered']."</td>";
       $showResult .= "<td>".$row['death']."</td>";
       $showResult .= "<td>".$row['active']."</td>";
       $showResult .= "<td>".$row['dateOfCase']."</td>";
       $showResult .= "</tr>";
   }
   ?>
   <div class="Main_div">

  <form method="get" action="casesList.php" class="searchbtn">
  <table class="table_style">
    <thead>
      <tr>
        <th colspan='6'>
          <input type="text" placeholder="Search.." name="searchBarangay" value="<?php if (isset($_GET['searchCasesBtn'])) {
          echo $_GET['searchBarangay'];} ?>"><input type="date" name="dateOfCase" value="<?php if (isset($_GET['searchCasesBtn'])) {
          echo $_GET['dateOfCase'];} ?>"><input type="submit" name="searchCasesBtn">
        </th>
      </tr>
      <tr>
        <th colspan="6" id="tableheading"><span class='searchTotal'><sup>Total Result: <?php echo $found?></sup></span><h2>Cases List</h2></th>
      </tr>
      <?php
        $sql2 = "SELECT SUM(confirmed) AS 'confirmed', SUM(active) AS 'active',
        SUM(recovered) AS 'recovered', SUM(death) AS 'death' FROM cases";
        $result2 = $conn->query($sql2);
        $data = mysqli_fetch_assoc($result2);
        $conf = "<p>Total Cases: ".$data['confirmed']."</p>";
        $act = "<p>Active Cases: ".$data['active']."</p>";
        $reco = "<p>Total recovered: ".$data['recovered']."</p>";
        $deat ="<p>Death: ".$data['death']."</p>";
         ?>
         <tr>
           <th>Barangay Name</th>
           <th>Confirmed Cases</th>
           <th>Recovered Cases</th>
           <th>Death Cases</th>
           <th>Active Cases</th>
           <th>Date Of Cases</th>
         </tr>
     		</thead>
     		<?php
     			$sql2 = "SELECT SUM(confirmed) AS 'confirmed', SUM(active) AS 'active',
     			SUM(recovered) AS 'recovered', SUM(death) AS 'death' FROM cases";
     			$result2 = $conn->query($sql2);
     			$data = mysqli_fetch_assoc($result2);
     			$conf = "<p>Total Cases: ".$data['confirmed']."</p>";
     			$act = "<p>Active Cases: ".$data['active']."</p>";
     			$reco = "<p>Total recovered: ".$data['recovered']."</p>";
     			$deat ="<p>Death: ".$data['death']."</p>";
     			 ?>
     		<thead>
     		<tr>
     			<th></th>
     			<th><sub><?php echo $conf; ?></sub></th>
     			<th><sub><?php echo $reco; ?></sub></th>
     			<th><sub><?php echo $deat; ?></sub></th>
     			<th><sub><?php echo $act; ?></sub></th>
     			<th></th>
     		</tr>
         </thead>
    <tbody>

    <?php
    echo "<tbody class='tbody_style'>";
    echo $showResult;
    if($found==0){
      echo "<tr>";
      echo "<td colspan='6' class='td_noResult'>None match search result.</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    $conn->close();
    ?>

</table>
</form>

<br><br><img src="img/footer.png" style="width:100%;" alt="footer of webpage">
</body>
</html>
