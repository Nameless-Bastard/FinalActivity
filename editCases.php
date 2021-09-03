<?php
$casesId = $_GET['bid'];
if(null==$casesId){
  header("location:casesList.php");
}


//function for edit
function editCases($casesId, $Conf_cases, $Reco_cases, $Deat_cases, $Acti_cases, $barangayId, $dateOfCase){
  include('db.php');
  $sql= "UPDATE cases SET confirmed ='$Conf_cases', recovered ='$Reco_cases', death ='$Deat_cases',
  active ='$Acti_cases', barangayId ='$barangayId', dateOfCase ='$dateOfCase' WHERE casesId = '$casesId'";

  $result = $conn->query($sql);

  if($result == TRUE) {
    header("location:casesList.php");
  } else {
    $msg = $conn->error;
  }
  $conn->close();
  return $msg;
}
//for isset of editCases Button
if(isset($_POST['editCasesBtn'])){
echo editCases($casesId, $_POST['confirmed'],$_POST['recovered'],$_POST['death'],$_POST['active'],$_POST['barangayId'],$_POST['dateOfCase']);
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit Cases</title>
  </head>

 <body>
  <h1>Edit Cases</h1>
  <form action="editCases.php?bid=<?php echo $casesId?>" method="post">
    <?php
    include('db.php');
    //for getting the cases data
    $sql = "SELECT * FROM cases WHERE casesId = '$casesId'";
    $result = $conn->query($sql);
    $data = mysqli_fetch_assoc($result);
    ?>
      <label>Confirmed Cases</lable><br> <input type="text" value="<?php echo $data['confirmed']; ?>" name="confirmed"><br>
      <label>Recovered Cases</lable><br> <input type="text" value="<?php echo $data['recovered']; ?>" name="recovered"><br>
      <label>Death Cases</lable><br> <input type="text" value="<?php echo $data['death']; ?>" name="death"><br>
      <label>Active Cases</lable><br> <input type="text" value="<?php echo $data['active']; ?>" name="active"><br>
      <label>Barangay Id</lable><br> <input type="text" value="<?php echo $data['barangayId']; ?>" name="barangayId"><br>

      <label>Date Of Case</label><input type="date" name="dateOfCase"><br>
      <input type="submit" value="Edit Case" name="editCasesBtn">
    </form>

</body>
</html>
