<?php

session_start();
$errors = array();

  include('db.php');

  if (isset($_POST['loginBtn'])) {
		$username = mysqli_real_escape_string($conn, $_POST['userName']);
		$password =  mysqli_real_escape_string($conn, $_POST['password']);

		//ensure that form fields are filled properly
		if(empty($username)){
		 array_push($errors, "Username is required");
		}
		else if(empty($password)){
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

 <html>
   <head>
     <title>Login</title>

     <link rel="stylesheet" type="text/css" href="css/styleShit.css">
   </head>

   <body>
     <div class="maindiv">
       <div class="onehalfdivfirst">
         <img src="img/urban2.png">
       </div>
       <div class="onehalfdivsecond">

         <div class="loginBox">
           <img src="img/avatar.svg" class="avatar" />
           <h1 class="urban">Login</h1>
           <form action="user.php" method="post">
             <?php include('errors.php'); ?>
             <label>Username</label><br />
             <input type="text" placeholder="Enter username" name="userName" /> <br /><br />
             <label>Password</label> <br />
             <input type ="password" placeholder="Enter password" name="password" /> <br /><br />
             <input type="submit" value="Login" name="loginBtn" />
             <!-- <p><?php //echo $LoginInput ?></p> -->
           </form>
         </div>
       </div>
     </div>
   </body>

 </html>
