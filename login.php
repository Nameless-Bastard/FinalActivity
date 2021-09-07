<?php
    session_start();
    $message="";
    if(count($_POST)>0) {
        $con = mysqli_connect('127.0.0.1:3306','root','','admin') or die('Unable To connect');
        $result = mysqli_query($con,"SELECT * FROM login_user WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        } else {
         $message = "Invalid Username or Password!";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:index.php");
    }
?>
<html>
  <head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/styleShit.css">
  </head>

  <body style="background-color:white;">
    <div class="maindiv">
      <div class="onehalfdivfirst">
        <img src="img/urban2.png">
      </div>
      <div class="onehalfdivsecond">

        <div class="loginBox">
          <img src="img/avatar.svg" class="avatar" />
          <form name="frmUser" method="post">
            <div class="error"><?php if($message!="") { echo $message; } ?></div>
            <h3 align="center">Enter Login Details</h3>
            <label>Username</label><br />
            <input type="text" placeholder="Enter username" name="user_name" /> <br /><br />
            <label>Password</label> <br />
            <input type ="password" placeholder="Enter password" name="password" /> <br /><br />
            <input type="submit" value="Submit" name="submit" />
          </form>
        </div>
      </div>
    </div>
  </body>

</html>
