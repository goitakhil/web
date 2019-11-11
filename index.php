<?php
session_start();
if((isset($_SESSION['loggedIn']))){
  header("Location: homepage.php");
}
?>
<html>
<head>
	<center>
	<?php require_once("loginheader.php");
  ?></center>
  <link rel="stylesheet" href="login.css">

</head>
<header><h1>Login Page</h1></header>
<p>Please login to view all the contents.</p>
<center>

<body>

<form method="post" action="loginhandler.php">

	<div class="container">

		<div>  <label for="email">  <div> <b>Email</b> </div> </label>

  		<input type="text" placeholder="Enter Email" name="Email"
  		value="<?php echo isset($_SESSION['formInput']) ? $_SESSION['formInput']['Email'] : ''; ?>"
		</div>
  	<?php

  		if(isset($_SESSION['email_doesnot'])) {
  			echo "<div id = 'error'>" . $_SESSION['email_doesnot'] . "</div>";
  		}
  		unset($_SESSION['email_doesnot']);
  			if(isset($_SESSION['emailErr'])){
  				echo "<div id = 'error' >" . $_SESSION['emailErr'] . "</div>";
  			}
  			unset($_SESSION['emailErr']);
  	?>

  	<div>
  		<label for="password"> <div> <b>Password</b> </div> </label>
  		<div> <input type="password" placeholder="Enter Password" name="password" >
  		</div>
  	</div>
  	<?php
  		if(isset($_SESSION['passwordErr'])) {
      	echo "<div id = 'error'>" . $_SESSION['passwordErr'] . "</div>";
    	}
  		unset($_SESSION['passwordErr']);
  		unset($_SESSION['formInput']);


  	?>

	</div>

	<button type="submit">LogIn</button>
</form>
<div class="signup-button">
  <a href="signup.php">SignUp</a>
</div>
</body>
</center>
<?php
	require_once 'footer.php';
?>
