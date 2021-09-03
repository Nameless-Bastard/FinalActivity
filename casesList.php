<?php
$found = 0;
$showResult='';
include('db.php');
if(isset($_POST['searchCasesBtn'])){
  $barangayKeyWord = $_POST['searchBarangay'];
  $sql = "SELECT cases.*, barangays.*
  FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId WHERE barangays.barangayName LIKE '%$barangayKeyWord%'";
}
else {
  $sql = "SELECT cases.*, barangays.* FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId";
}

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $found = ++$found;
    $showResult .= "<tr>";
    $showResult .= "<td>".$row['barangayName']."</td>";
    $showResult .= "<td>".$row['confirmed']."</td>";
    $showResult .= "<td>".$row['recovered']."</td>";
    $showResult .= "<td>".$row['death']."</td>";
    $showResult .= "<td>".$row['active']."</td>";
    $showResult .= "<td>".$row['dateOfCase'];
    $showResult .= "</tr>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/maste.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Cases List</title>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title></title>

  </head>
 <body>
   <div class="navbar">
    <a id="home" href="index.html">Home</a>
    <a href="contact.php">Contact</a>
    <a href="casesList.php">Cases</a>
    <a href="barangayList.php">Barangay</a>
   </div>

   <div class="Main_div">

  <form method="post" action="casesList.php" class="searchbtn">
  <table class="table_style">
    <thead>
      <tr>
        <th colspan='6'>
          <input type="text" placeholder="Search.." name="searchBarangay">
          <input type="submit" name="searchCasesBtn" value="🔍">
        </th>
      </tr>
      <tr>
        <th colspan="6" id="tableheading"><span class='searchTotal'><sup>Total Result: <?php echo $found?></sup></span><h2>Cases List</h2></th>
      </tr>


    <tr>
      <th>Barangay Name</th>
      <th>Confirmed Cases</th>
      <th>Recovered Cases</th>
      <th>Death Cases</th>
      <th>Active Cases</th>
      <th>Date Of Cases</th>
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
</div>
</body>
</html>
