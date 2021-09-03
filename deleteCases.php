<?php
$casesId = $_GET['bid'];
if(null==$casesId){
  header("location:casesList.php");
}


function deleteCases($casesId){
  include('db.php');
  $sql = "DELETE FROM cases WHERE casesId = '$casesId'";
  $result = $conn->query($sql);

  if($result == TRUE) {
    header("location:casesList.php");
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
    <title>Delete Cases</title>
  </head>
 <body>
  <h1>Delete Cases</h1>
  <form action="deleteCases.php?bid=<?php echo $casesId;?>" method="post">
    <?php
    include('db.php');
    //for getting the barangay data
    $sql = "SELECT cases.*, barangays.*
    FROM cases LEFT JOIN barangays ON cases.barangayId = barangays.barangayId
    WHERE cases.casesId = '$casesId'";
    $result = $conn->query($sql);
    if ($data = mysqli_fetch_assoc($result)) {
      echo "<table border='4'>";
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
</body>
</html>
