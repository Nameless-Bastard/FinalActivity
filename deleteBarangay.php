<?php
$barangayId = $_GET['bid'];
if(null==$barangayId){
  header("location:barangayList.php");
}

function deleteBarangay($barangayId){
  include('db.php');
  $sql = "DELETE FROM barangays WHERE barangayId = '$barangayId'";
  $result = $conn->query($sql);

  header("location:barangayList.php");
  $conn->close();
}


if(isset($_POST['DeleteBarangayBtn'])){
  deleteBarangay($barangayId);
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Delete Barangay</title>
  </head>
 <body>
  <h1>Delete Barangay</h1>
  <form action="deleteBarangay.php?bid=<?php echo $barangayId;?>" method="post">
    <?php
    include('db.php');
    //for getting the barangay data
    $sql = "SELECT * FROM barangays WHERE barangayId = '$barangayId'";
    $result = $conn->query($sql);
    if($data = mysqli_fetch_assoc($result)){
      echo "<h1>".$data['barangayName']."</h1>";
    }
    ?>

    <input type="submit" value="Delete Barangay" name="DeleteBarangayBtn">
  </form>
</body>
</html>
