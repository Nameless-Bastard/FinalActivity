<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Barangay List</title>
</head>

<body>
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
          <th colspan="4">
            <input type="text" placeholder="Search.." name="searchBarangay">
            <input type="submit" name="searchBarangayBtn" value="🔍">
          </th>
        </tr>
      </thead>
      <thead>
        <tr>
          <th colspan="6" id="tableheading"><h2>Barangay List</h2></th>
        </tr>
        <tr>
          <th>BARANGAY</th>
          <th>BRGY. CHAIRMAN</th>
          <th>TELEPHONE NO.</th>
          <th>DISTRICT</th>
        </tr>
      </thead>

      <?php
      include('db.php');

      $district1='';
      $district2='';
      $found1= 0;
      $found2= 0;

      if(isset($_POST['searchBarangayBtn'])){
        $NameKeyWord = $_POST['searchBarangay'];
        $sql1 = "SELECT * FROM barangays WHERE concat(barangayName,barangayCaptain,barangayContact) LIKE '%$NameKeyWord%' AND barangayDistrict= '1'";
        $sql2 = "SELECT * FROM barangays WHERE concat(barangayName,barangayCaptain,barangayContact) LIKE '%$NameKeyWord%' AND barangayDistrict= '2'";
      }else {
        $sql1 = "SELECT * FROM barangays WHERE barangayDistrict = '1'";
        $sql2 = "SELECT * FROM barangays WHERE barangayDistrict = '2'";
      }
      $result1= $conn->query($sql1);
      $result2= $conn->query($sql2);
      //----------------------DISTRICT 1
      while($batch1 = ($result1->fetch_assoc())) {
        $found1 = ++$found1;
        $district1 .= "<tr>";
        $district1 .= "<td>".$batch1['barangayName']."</td>";
        $district1 .= "<td>".$batch1['barangayCaptain']."</td>";
        $district1 .= "<td>".$batch1['barangayContact']."</td>";
        $district1 .= "<td>".$batch1['barangayDistrict']."</td>";
        $district1 .= "</tr>";
      }
      //----------------------DISTRICT 2
      while($batch2 = ($result2->fetch_assoc())) {
        $found2 = ++$found2;
        $district2 .= "<tr>";
        $district2 .= "<td>".$batch2['barangayName']."</td>";
        $district2 .= "<td>".$batch2['barangayCaptain']."</td>";
        $district2 .= "<td>".$batch2['barangayContact']."</td>";
        $district2 .= "<td>".$batch2['barangayDistrict']."</td>";
        $district2 .= "</tr>";

      }

      //----------------------DISTRICT 1
      echo "<thead>";
      echo "<tr>";
      echo "<th colspan='4' class='barangay_district'>District 1<span class='searchTotal'><sup>Total Result: ".$found1."</sup></span></th>";
      echo "</tr>";
      echo "</thead>";

      echo "<tbody class='tbody_style'>";
      echo $district1;
      if($found1==0){
        echo "<tr>";
        echo "<td colspan='4' class='td_noResult'>None match search result.</td>";
        echo "</tr>";
      }
      echo "</tbody>";

      //----------------------DISTRICT 2
      echo "<thead>";
      echo "<tr>";
      echo "<th colspan='4' class='barangay_district'>District 2<span class='searchTotal'><sup>Total Result: ".$found2."</sup></span></th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody class='tbody_style'>";
      echo $district2;
      if($found2==0){
        echo "<tr>";
        echo "<td colspan='4' class='td_noResult'>None match search result.</td>";
        echo "</tr>";
      }
      echo "</tr>";
      echo "</tbody>";



      //echo "<p>".$SearchResult1."</p>";





      $conn->close();
      ?>
      </tbody>
    </table>
  </form>
  </div>

</body>

</html>
