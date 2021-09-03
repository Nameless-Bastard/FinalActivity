<!DOCTYPE html>
<html>
  <head>
    <title>Add Cases</title>
  </head>

 <body>
  <h1>Add Cases</h1>
  <form action="addCases.php" method="post">
      <label>Confirmed Cases</lable><br> <input type="text" name="confirmed"><br>
      <label>Recovered Cases</lable><br> <input type="text" name="recovered"><br>
      <label>Death Cases</lable><br> <input type="text" name="death"><br>
      <label>Active Cases</lable><br> <input type="text" name="active"><br>
      <label>Name of Barangay</label>
      <select name="barangayId">
        <?php
        //to show barangay
        include('db.php');
        $barangaySql = "SELECT * FROM barangays";
        $barangayResult = $conn->query($barangaySql);
              // to show barangay
              while($row = $barangayResult->fetch_assoc())
              {
                echo "<option value = ".$row['barangayId'].">".$row['barangayName']."</option>";
              }
          $conn->close();
         ?>
       </select><br>
       <label>Date Of Case</label><input type="date" name="dateOfCase"><br>
       <input type="submit" value="Add Cases" name="addCasesBtn">
    </form>

</body>
</html>
<?php

function addCases($Conf_cases, $Reco_cases, $Deat_cases, $Acti_cases, $barangayId, $dateOfCase){
  include('db.php');

  $sql = "INSERT INTO cases (confirmed, recovered, death, active, barangayId, dateOfCase)
  VALUES ('$Conf_cases', '$Reco_cases', '$Deat_cases' , '$Acti_cases', '$barangayId', '$dateOfCase')";
  $result = $conn->query($sql);
  if($result == TRUE) {
    $msg = "New record created successfully";
  }

  else {
    $msg = $conn->error;
  }

  $conn->close();
  return $msg;

}


if(isset($_POST['addCasesBtn']))
{
echo addCases($_POST['confirmed'],$_POST['recovered'],$_POST['death'],$_POST['active'],$_POST['barangayId'],$_POST['dateOfCase']);
}
?>
