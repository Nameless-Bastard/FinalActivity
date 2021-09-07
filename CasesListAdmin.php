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

	<link rel="stylesheet" href="css/master.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title></title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


<style media="screen">

form.searchbtn input[type=submit]:hover {
  background: #ed9664;
}

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
.floatRighT{
  float: right;
  margin-right: 20px;
}


/* div.aside{
display: inline-block;
margin-left: auto;
margin-right: auto;
width:auto;
overflow:visible;
background-color: #615300;
}
div.aside a{
color: #f2f2f2;
display: inline-block;
padding: 14px 16px;
text-decoration: none;
font-size: 17px;
} */
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Cases List</title>

  </head>
 <body>
	 <div class="header">
     <img class="headerImage" src="img/header.png" alt="header">
   </div>
	 <div class="navbAR">

    <a id="home" href="#index.php">Home</a>
    <a id="logoutred" href='logout.php' title='Logout'>Logout</a>
    <a href="contactAdmin.php">Contact</a>
    <a class="selectedNavbar" href="casesListAdmin.php">Cases</a>
    <a href="barangayListAdmin.php">Barangay</a>

   </div>

   <!-- Add Modal -->
   <div class="modal fade" id="add" tabindex="-1" role="dialog"  aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Add Cases</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="CaseslistAdmin.php" method="post">
              <div class="form-group">
                <label for="modalConfirmed">Confirmed cases</label>
                <input type="text" class="form-control" id="modalConfirmed" placeholder="confirmed..." name="confirmedCases">
              </div>
              <div class="form-group">
                <label for="modalRecovered">Recovered cases</label>
                <input type="text" class="form-control" id="modalRecovered" placeholder="recovered..." name="recoveredCases">
              </div>
              <div class="form-group">
                <label for="modalDeath">Death Cases</label>
                <input type="text" class="form-control" id="modalDeath"  placeholder="death..." name="deathCases">
              </div>
              <div class="form-group">
                <label for="modalActive">Active Cases</label>
                <input type="text" class="form-control" id="modalActive"  placeholder="active..." name="activeCases">
              </div>
              <div class="form-group">
                  <label for="modalBarangay">Barangay</label>
                  <select class="selectpicker form-control" data-live-search="true" id="modalBarangay" name="barangayId" required="required" data-error="Barangay is required.">
                    <?php

                    include('db.php');

                    $barangaySql = "SELECT * FROM barangays";
                    $barangayResult = $conn->query($barangaySql);

                      while ($row=$barangayResult->fetch_assoc()) {
                        echo "<option value=".$row['barangayId'].">".$row["barangayName"]. "</option>";
                      }
                    $conn->close();
                    ?>

                    </select>
              </div>
              <div class="form-group">
                <label for="modalDate">Date of Case</label>
                <input type="date" class="form-control" id="modalDate" name="dateOfCases">
              </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
           <button type="submit" class="btn btn-danger" name="addCaseBtn">Add cases</button>
         </div>
      </form>
       </div>
     </div>
   </div>


<!-- Add Modal Function -->
   <?php

      function addCasesBtn($Ccases, $Rcases, $Dcases, $Acases, $Barangayid,$dateOfCase){
        include('db.php');

        $sqlAdd = "INSERT INTO cases (confirmed,recovered, death, active, barangayId,dateOfCase)
        VALUES ('$Ccases', '$Rcases', ' $Dcases', '$Acases', '$Barangayid','$dateOfCase')";

        $resultAdd = $conn->query($sqlAdd);

        if ($resultAdd == TRUE) {
          echo "<script>alert('Data Saved'); </script>";
        }
        else {
          echo "<script>alert('Data Not Saved'); </script>";
        }
        $conn->close();


      }

      if (isset($_POST['addCaseBtn'])) {
        echo addCasesBtn($_POST['confirmedCases'], $_POST['recoveredCases'],$_POST['deathCases'],
        $_POST['activeCases'],$_POST['barangayId'],$_POST['dateOfCases']);
      }

   ?>

   <!-- Edit Modal -->
   <div class="modal fade" id="edit" tabindex="-1" role="dialog"  aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Edit Cases</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form action="CaseslistAdmin.php" method="post">
              <div class="form-group">
                <label for="modalConfirmed">Confirmed cases</label>
                <input type="text" class="form-control" id="modalConfirmed" placeholder="confirmed..." name="confirmedCases">
              </div>
              <div class="form-group">
                <label for="modalRecovered">Recovered cases</label>
                <input type="text" class="form-control" id="modalRecovered" placeholder="recovered..." name="recoveredCases">
              </div>
              <div class="form-group">
                <label for="modalDeath">Death Cases</label>
                <input type="text" class="form-control" id="modalDeath"  placeholder="death..." name="deathCases">
              </div>
              <div class="form-group">
                <label for="modalActive">Active Cases</label>
                <input type="text" class="form-control" id="modalActive"  placeholder="active..." name="activeCases">
              </div>
              <div class="form-group">
                  <label for="modalBarangay">Barangay</label>
                  <select class="selectpicker form-control" data-live-search="true" id="modalBarangay" name="barangayId" required="required" data-error="Barangay is required.">
                    <?php

                    include('db.php');

                    $barangaySql = "SELECT * FROM barangays";
                    $barangayResult = $conn->query($barangaySql);

                      while ($row=$barangayResult->fetch_assoc()) {
                        echo "<option value=".$row['barangayId'].">".$row["barangayName"]. "</option>";
                      }
                    $conn->close();
                    ?>

                    </select>
              </div>
              <div class="form-group">
                <label for="modalDate">Date of Case</label>
                <input type="date" class="form-control" id="modalDate" name="dateOfCases">
              </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
           <button type="submit" class="btn btn-danger" name="addCaseBtn">Add cases</button>
         </div>
      </form>
       </div>
     </div>
   </div>

   <!-- Search Filter -->
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
  FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId WHERE barangays.barangayName LIKE '%$barangayKeyWord%' ORDER BY dateOfCase DESC";
}
else {
  $sql = "SELECT cases.*, barangays.* FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId ORDER BY dateOfCase DESC";
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
    $showResult .= "<td><a href ='barangayCasesAdmin.php?bid=".$row['barangayId']."'>".$row['barangayName']."</a></td>";
    $showResult .= "<td>".$row['confirmed']."</td>";
    $showResult .= "<td>".$row['recovered']."</td>";
    $showResult .= "<td>".$row['death']."</td>";
    $showResult .= "<td>".$row['active']."</td>";
    $showResult .= "<td>".$row['dateOfCase']."</td>";
		$showResult .= "<td><a style='text-shadow: 1px 1px black;' class='text-warning' href='editCases.php?bid=".$row['casesId']."'>Edit</a></td>";
	 $showResult .= "<td><a style='text-shadow: 1px 1px black;' class='text-danger' href='deleteCases.php?bid=".$row['casesId']."'>Delete</a></td>";

    $showResult .= "</tr>";

}
?>

 <div class="Main_div">

  <form method="get" action="CaseslistAdmin.php" class="searchbtn">
  <table class="table_style">
    <thead>
      <tr>
        <th colspan='8'>
          <input type="text" placeholder="Search.." name="searchBarangay" value="<?php if (isset($_GET['searchCasesBtn'])) {
          echo $_GET['searchBarangay'];} ?>"><input type="date" name="dateOfCase" value="<?php if (isset($_GET['searchCasesBtn'])) {
          echo $_GET['dateOfCase'];} ?>"><input type="submit" name="searchCasesBtn">

        </th>

      </tr>
      <tr>
        <th colspan="8" id="tableheading"><span class='searchTotal'><sup>Total Result: <?php echo $found?></sup></span><h2>Cases List</h2><button type="button" class="btn btn-outline-warning floatRighT" data-toggle="modal" data-target="#add">ADD CASE</button>

        </th>
      </tr>

    <tr>
      <th>Barangay Name</th>
      <th>Confirmed Cases</th>
      <th>Recovered Cases</th>
      <th>Death Cases</th>
      <th>Active Cases</th>
      <th>Date Of Cases</th>
      <th> Edit </th>
      <th> DELETE </th>
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
			<th></th>
			<th></th>
		</tr>
    </thead>
    <tbody>

    <?php
    echo "<tbody class='tbody_style'>";
    echo $showResult;
    if($found==0){
      echo "<tr>";
      echo "<td colspan='8' class='td_noResult'>None match search result.</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    $conn->close();
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>




</table>
</form>
</div>
<br><br><img style="width:100%;" src="img/footer.png" alt="footer of webpage">
</body>
</html>
