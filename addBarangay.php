<!DOCTYPE html>
<html>
  <head>
    <title>Add Barangay</title>
  </head>

 <body>
  <h1>Add Barangay</h1>
  <form action="addBarangay.php" method="post">
    <label>Barangay Name</lable> <input type="text" name="barangayName"><br><br>
    <label>Barangay Captain</label> <input type="text" name="barangayCaptain"><br><br>
    <label>Barangay Contact</label> <input type="text" name="barangayContact"><br><br>
    <label>Barangay District</lable><br>
    <label>District 1</lable> <input type="radio" value = "1" name="district">
    <label>District 2</lable> <input type="radio" value = "2" name="district"><br><br>

    <input type="submit" value="Add Barangay" name="addBarangayBtn">
  </form>

</body>
</html>

<?php

function addBarangay($Bname, $Bdistrict, $Bcaptain, $Bcontact){
  include('db.php');

  $sql = "INSERT INTO barangays (barangayName, barangayDistrict, barangayCaptain, barangayContact)
  VALUES ('$Bname', '$Bdistrict', '$Bcaptain', '$Bcontact')";
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


if(isset($_POST['addBarangayBtn']))
{
echo addBarangay($_POST['barangayName'],$_POST['district'],$_POST['barangayCaptain'],$_POST['barangayContact']);
}

?>
