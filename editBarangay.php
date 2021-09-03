<?php
$barangayId = $_GET['bid'];
if(null==$barangayId){
  header("location:barangayList.php");
}


//function for edit
function editBarangay($barangayId, $Bname, $Bcaptain, $Bcontact, $Bdistrict){
  include('db.php');
  $sql = "UPDATE barangays SET barangayName = '$Bname', barangayDistrict = '$Bdistrict', barangayCaptain = '$Bcaptain',
  barangayContact = '$Bcontact' WHERE barangayId = '$barangayId'";

  $result = $conn->query($sql);

  if($result == TRUE) {
    header("location:barangayList.php");
  } else {
    $msg = $conn->error;
  }
  $conn->close();
  return $msg;
}
//for isset of editBarangay Button
if(isset($_POST['editBarangayBtn'])){
echo editBarangay($barangayId, $_POST['barangayName'], $_POST['barangayCaptain'], $_POST['barangayContact'], $_POST['barangayDistrict']);
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit Barangay</title>
  </head>

 <body>
  <h1>Edit Barangay</h1>
  <form action="editBarangay.php?bid=<?php echo $barangayId?>" method="post">
    <?php
    include('db.php');
    //for getting the barangay data
    $sql = "SELECT * FROM barangays WHERE barangayId = '$barangayId'";
    $result = $conn->query($sql);
    $data = mysqli_fetch_assoc($result);
    ?>
    <label>Barangay Name</lable> <input type="text" value="<?php echo $data['barangayName']; ?>" name="barangayName"><br><br>
    <label>Barangay Captain</lable> <input type="text" value="<?php echo $data['barangayCaptain']; ?>" name="barangayCaptain"><br><br>
    <label>Barangay Contact</lable> <input type="text" value="<?php echo $data['barangayContact']; ?>" name="barangayContact"><br><br>
    <label>Barangay District</lable><br>


      <?php
      // to identify the district
      if($data['barangayDistrict']==1){
      ?>
      1 <input type="radio" name="barangayDistrict" value="1" checked = true>
      2 <input type="radio" name="barangayDistrict" value="2">
        <?php
      }

      if($data['barangayDistrict']==2){
        ?>
        1 <input type="radio" name="barangayDistrict" value="1">
        2 <input type="radio" name="barangayDistrict" value="2" checked = true>
          <?php
      }
       ?>

    <input type="submit" value="Edit Barangay" name="editBarangayBtn">
  </form>

</body>
</html>
