<?php
session_start();
$logout;
if(empty($_SESSION["name"])) {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Barangay List</title>
  <style media="screen">
.navbAR {
  overflow: visible;
  background-color: #d47033;
  position: static;
  width: 100%;
  height: 70px;
  border-radius: 0;
  padding-left:15px;
  padding-right:15px;;

}

.navbAR a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  border-radius: 10px;
  border: solid #f7aa7e 1px;
  margin-left: 3px;
  margin-top: 8px;
}
.navbAR a:hover {
  background: #f7aa7e;
  color: black;
  border: solid white 1px;
  border-radius: 10px;
}
  </style>
</head>

<body>

  <div class="header">
    <img class="headerImage" src="img/header.png" alt="header">
  </div>
  <div class="navbAR">

   <a id="home" href="#index.php">Home</a>
   <a id="logoutred" href='logout.php' title='Logout'>Logout</a>
   <a href="contactAdmin.php">Contact</a>
   <a href="casesListAdmin.php">Cases</a>
   <a class="selectedNavbar" href="barangayListAdmin.php">Barangay</a>

  </div>
  <div class="Main_div">
  <form method="post" action="barangayListAdmin.php" class="searchbtn barangayList">
    <table class="table_style">
      <thead>
        <tr>
          <th colspan="6">
            <input type="text" placeholder="Search.." name="searchBarangay">
            <input type="submit" name="searchBarangayBtn" value="🔍">
          </th>
        </tr>
      </thead>
      <thead>
        <tr>
          <th colspan="6" id="tableheading"><h2>Barangay List</h2><a href ='addBarangay.php'><button type="button" class="btn btn-outline-warning floatRighT" data-toggle="modal" data-target="#add">ADD CASE</button></a></th>
        </tr>
        <tr>
          <th>BARANGAY</th>
          <th>BRGY. CHAIRMAN</th>
          <th>TELEPHONE NO.</th>
          <th>DISTRICT</th>
          <th>EDIT</th>
          <th>DELETE</th>
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
        $district1 .= "<td><a href ='barangayCasesAdmin.php?bid=".$batch1['barangayId']."'>".$batch1['barangayName']."</a></td>";
        $district1 .= "<td>".$batch1['barangayCaptain']."</td>";
        $district1 .= "<td>".$batch1['barangayContact']."</td>";
        $district1 .= "<td>".$batch1['barangayDistrict']."</td>";
        $district1 .= "<td><a style='text-shadow: 1px 1px black;' class='text-warning' href='editBarangay.php?bid=".$batch1['barangayId']."'>Edit</a></td>";
    	  $district1 .= "<td><a style='text-shadow: 1px 1px black;' class='text-danger' href='deleteBarangay.php?bid=".$batch1['barangayId']."'>Delete</a></td>";
        $district1 .= "</tr>";
      }
      //----------------------DISTRICT 2
      while($batch2 = ($result2->fetch_assoc())) {
        $found2 = ++$found2;
        $district2 .= "<tr>";
        $district2 .= "<td><a href ='barangayCasesAdmin.php?bid=".$batch2['barangayId']."'>".$batch2['barangayName']."</a></td>";
        $district2 .= "<td>".$batch2['barangayCaptain']."</td>";
        $district2 .= "<td>".$batch2['barangayContact']."</td>";
        $district2 .= "<td>".$batch2['barangayDistrict']."</td>";
        $district2 .= "<td><a style='text-shadow: 1px 1px black;' class='text-warning' href='editBarangay.php?bid=".$batch2['barangayId']."'>Edit</a></td>";
    	  $district2 .= "<td><a style='text-shadow: 1px 1px black;' class='text-danger' href='deleteBarangay.php?bid=".$batch2['barangayId']."'>Delete</a></td>";
        $district2 .= "</tr>";

      }

      //----------------------DISTRICT 1
      echo "<thead>";
      echo "<tr>";
      echo "<th colspan='6' class='barangay_district'>District 1<span class='searchTotal'><sup>Total Result: ".$found1."</sup></span></th>";
      echo "</tr>";
      echo "</thead>";

      echo "<tbody class='tbody_style'>";
      echo $district1;
      if($found1==0){
        echo "<tr>";
        echo "<td colspan='6' class='td_noResult'>None match search result.</td>";
        echo "</tr>";
      }
      echo "</tbody>";

      //----------------------DISTRICT 2
      echo "<thead>";
      echo "<tr>";
      echo "<th colspan='6' class='barangay_district'>District 2<span class='searchTotal'><sup>Total Result: ".$found2."</sup></span></th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody class='tbody_style'>";
      echo $district2;
      if($found2==0){
        echo "<tr>";
        echo "<td colspan='6' class='td_noResult'>None match search result.</td>";
        echo "</tr>";
      }
      echo "</tr>";
      echo "</tbody>";



      //echo "<p>".$SearchResult1."</p>";






      ?>
      </tbody>
    </table>
  </form>
  </div>
<br><br>
<img style="width:100%;" src="img/footer.png" alt="footer of webpage">
</body>

</html>
