<?php
session_start();
$logout;
if(empty($_SESSION["name"])) {
  header("location:login.php");
}
?>
<?php
$msg = "";
function Messageffs($fname, $lname, $Email, $Subject, $Message){
  include('db.php');

  $fname = mysqli_real_escape_string($conn, $_POST['FirstName']);
  $lname = mysqli_real_escape_string($conn, $_POST['LastName']);
  $Email = mysqli_real_escape_string($conn, $_POST['Email']);
  $Subject = mysqli_real_escape_string($conn, $_POST['Subject']);
  $Message = mysqli_real_escape_string($conn, $_POST['Message']);

  $sqlMail = "INSERT INTO mailbox (FirstName, LastName, Subject, Message, Email)
  VALUES ('$fname', '$lname', '$Subject', '$Message', '$Email')";

  $result = $conn->query($sqlMail);

  global $msg;

  if($result == TRUE) {
     $msg .= "<h3 class='messageSuccess'>Message sent successfully</h3>";
  }

  else {
    $msg = $conn->error;
  }


}


if(isset($_POST['addMailBtn']))
{
echo Messageffs($_POST['FirstName'],$_POST['LastName'],$_POST['Email'],$_POST['Subject'],$_POST['Message']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <style>


  </style>
</head>
<body>
  <div class="header">
    <img class="headerImage" src="img/header.png" alt="header">
  </div>
  <div class="navbar">

   <a id="home" href="#index.php">Home</a>
   <a id="logoutred" href='logout.php' title='Logout'>Logout</a>
   <a class="selectedNavbar" href="contactAdmin.php">Contact</a>
   <a href="casesListAdmin.php">Cases</a>
   <a href="barangayListAdmin.php">Barangay</a>

  </div>
  <div class="Main_div">
    <h1 style="text-align:center;">Contact Pasig City Government</h1><br>
    <p style="font-size:20px; text-align:center; width:70%; margin-left: auto;margin-right:auto;">Victor Ma. Regis N. Sotto is committed in creating the most open and accessible Pasig City administration.
      To send questions, comments, concerns, or well-wishes to the Mayor or his staff, please use the form below.</p>

    <div class="container contact">
      <form action="contactAdmin.php" method="post">
      <div class="roww">
        <div class="col-25">
          <label for="fname">First Name</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="FirstName" placeholder="Your name.." required>
        </div>
      </div>
      <div class="roww">
        <div class="col-25">
          <label for="lname">Last Name</label>
        </div>
        <div class="col-75">
          <input type="text" id="lname" name="LastName" placeholder="Your last name.." required>
        </div>
      </div>
      <div class="roww">
        <div class="col-25">
          <label for="country">email</label>
        </div>
        <div class="col-75">
            <input type="email" name="Email" placeholder="Your email.." required>
        </div>
      </div>
      <div class="roww">
        <div class="col-25">
          <label for="country">Subject</label>
        </div>
        <div class="col-75">
            <input type="text" name="Subject" placeholder="The subject.." required>
        </div>
      </div>
      <div class="roww">
        <div class="col-25">
          <label for="subject">Message</label>
        </div>
        <div class="col-75">
          <textarea id="subject" name="Message" placeholder="Write something.." style="height:200px" required></textarea>
        </div>
      </div>
      <input type="submit" value="Submit" name="addMailBtn">

      </form>
    </div>
    <div class="second_container">

        <div class="limited-container iii">

          <?php echo $msg ?>

          <div class="Lcontacts_container">
            <h3 >📞</h3>
            <h5>PASIG HOTLINE</h5>
            <p>8643-0000</p>
          </div>
          <div class="Mcontacts_container">
            <h3>🏥</h3>
            <h5>PASIG CHILDREN’S HOSPITAL</h5>
            <p>8643-2222</p>
          </div>
          <div class="Rcontacts_container">
            <h3>🏥</h3>
            <h5>PASIG CITY GENERAL HOSPITAL</h5>
            <p>8643-3333</p>
          </div>
          <div class="Lcontacts_container">
            <h3 >📞</h3>
            <h5>PASIG TRUNKLINE</h5>
            <p>8643-1111</p>
          </div>
          <div class="Mcontacts_container">
            <h3 >📱</h3>
            <h5>TXT PASIG</h5>
            <p>0920-890-5313</p>
          </div>
          <div class="Rcontacts_container">
            <h3 >📱</h3>
            <h5>CHO OPERATION CENTER</h5>
            <p>09615825019</p>
          </div>
          <div class="Lcontacts_container">
            <h3 >📱</h3>
            <h5>NAGPAYONG SUPER HEALTH CENTER</h5>
            <p>09615825001</p>
          </div>
          <div class="Mcontacts_container">
            <h3 >📱</h3>
            <h5>SANTOLAN SUPER HEALTH CENTER</h5>
            <p>09615825003</p>
          </div>
          <div class="Rcontacts_container">
            <h3 >📱</h3>
            <h5>SAN JOAQUIN SUPER HEALTH CENTER</h5>
            <p>09615825017</p>
          </div>
          <div class="Lcontacts_container">
            <h3 >📱</h3>
            <h5>MANGGAHAN SUPER HEALTH CENTER</h5>
            <p>09615825015</p>
          </div>
          <div class="Mcontacts_container">
            <h3 >📱</h3>
            <h5>SUMILANG SUPER HEALTH CENTER</h5>
            <p>09615825016</p>
          </div>
          <div class="Rcontacts_container">
            <h3 >📱</h3>
            <h5>ROSARIO SUPER HEALTH CENTER</h5>
            <p>09615825018</p>
          </div>
        </div>
    </div>
  </div>
  <div class="Main_div">


    <?php
    $found = 0;
    $showResult='';
    include('db.php');

    $sql = "SELECT * FROM mailbox ORDER BY DateAndTime  desc LIMIT 5" ;


    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){

      $FNAME = $row['FirstName'];
      $LNAME = $row['LastName'];
      $SUBJECT = $row['Subject'];
      $MESSAGE = $row['Message'];
      $EMAIL = $row['Email'];
      $DAT = $row['DateAndTime'];

      echo '<div class="postMessage">';
      echo "<h4>".$FNAME." ".$LNAME."</h4>";
      echo "<h6>".$EMAIL."<h6>";
      echo "<sup>".$DAT."</sup>";
      echo "<h4>".$SUBJECT."</h4>";
      echo"<p>".$MESSAGE."</p>";
      echo '</div>';


    }
    ?>

    </div>
    <div class="messageSuccess">

    </div>

  </div>

<br><br><img src="img/footer.png"  style="width:100%;" alt="footer of webpage">
</body>
</html>
