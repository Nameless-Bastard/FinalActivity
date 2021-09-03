<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  <link rel="stylesheet" href="css/master.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <style>
    *{
      box-sizing: border-box;
    }

    input[type=text], select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }
    input[type=email]{
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }

    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    .container {
      background-color: #f2f2f2;
      display: inline-block;
      border-radius: 5px;
      padding: 20px;
      width: 60%;


    }
    .second_container{
      float: right;
      border-radius: 5px;
      padding: 20px;
      width: 40%;
    }

    .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }

    .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .container
      .second_container {
        width: 100%;
        margin-top: 0;
      }
    }
  </style>
</head>
<body>
  <nav>
    <div class="navbar">
     <a id="home" href="index.html">Home</a>
     <a href="contact.php">Contact</a>
     <a href="casesList.php">Cases</a>
     <a href="barangayList.php">Barangay</a>
    </div>
  </nav>
  <div class="Main_div">
    <h2>Responsive Form</h2>
    <p>Resize the browser window to see the effect. When the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other.</p>

    <div class="container">
      <form action="contact.php" method="post">
      <div class="row">
        <div class="col-25">
          <label for="fname">First Name</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="FirstName" placeholder="Your name.." required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Last Name</label>
        </div>
        <div class="col-75">
          <input type="text" id="lname" name="LastName" placeholder="Your last name.." required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">email</label>
        </div>
        <div class="col-75">
            <input type="email" name="Email" placeholder="Your email.." required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Subject</label>
        </div>
        <div class="col-75">
            <input type="email" name="Subject" placeholder="The subject.." required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="subject">Message</label>
        </div>
        <div class="col-75">
          <textarea id="subject" name="Message" placeholder="Write something.." style="height:200px" required></textarea>
        </div>
        <div class="row">
          <input type="submit" value="Submit">
        </div>
      </div>

      </form>
    </div>
    <div class="second_container">
      <h1 style="text-align:center;">Contact Pasig City Government</h1><br>
      <p style="font-size:20px;text-align:justify;">Victor Ma. Regis N. Sotto is committed in creating the most open and accessible Pasig City administration.
        To send questions, comments, concerns, or well-wishes to the Mayor or his staff, please use the form below.</p>

    </div>
  </div>

</body>
</html>
<?php

function addBarangay($fname, $lname, $email, $subject, $Message){
  include('db.php');

  $sql = "INSERT INTO mailbox (FirstName, LastName, email, Subject, Message)
  VALUES ('$fname', '$lname', '$email', '$subject', '$Message')";
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
