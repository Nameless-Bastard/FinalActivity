<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styleShit.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  </head>

  <body>
    <div class='main-container'>
        <img src="img/urban.svg" class="urban"/>
        <img src="img/gray.png" class="gray" />
          <div class="loginBox">
            <img src="img/avatar.svg" class="avatar" />
              <h1 class="login">Login</h1>
                <form action="login.php" method="post">
                  <label>Username</label><br />
                  <input type="text" placeholder="Enter username" name="userName" /> <br /><br />
                  <label>Password</label> <br />
                  <input type ="password" placeholder="Enter password" name="password" /> <br /><br />

                  <input type="submit" value="Login" name="loginBtn" />
                </form>
          </div>
    </div>





<?php

  session_start();
	$errors = array();

  include('server.php');

  if (isset($_POST['loginBtn'])) {
		$username = mysqli_real_escape_string($conn, $_POST['userName']);
		$password =  mysqli_real_escape_string($conn, $_POST['password']);

		//ensure that form fields are filled properly
		if(empty($username)){
		  array_push($errors, "Username is required");

		}
		if(empty($password)){
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password); // encrypt before comparing with that from database
			$query = "SELECT * FROM login WHERE Username = '$username' AND Password='$password'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) == 1) {
				// log user in
          $_SESSION['username'] = $username;
  				$_SESSION['success'] = "You are now logged in";
  				header('location: Home.php'); // redirect to homepage
  			}else{
  				array_push($errors, "wrong  username/password combination");
  			}
		}


	}



 ?>


  </body>

</html>

