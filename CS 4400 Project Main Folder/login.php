<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Page</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style_login.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<?php
	$password = $_POST['password'];
	$username = $_POST['username'];
	echo $username.' is the username<br />';
	echo $password.' is the password<br />';
?>
<body>
<!--This the background video with clouds-->
<div class="background-wrap">
	<video id="video-bg-elem" preload="auto" autoplay="true" loop="loop" muted="muted" poster="img\clouds.png">
		<source src="video\clouds.mp4" type="video/mp4">
	</video>
</div>
<!--This is the div used to tint the background-->
<div class="text"></div>
<!--This is the login page-->
<div class="center-container">
	<div class="card">
		<div class="card-block">

			<!--Header-->
			<div class="text-center">
				<h3>Login</h3>
				<hr class="mt-2 mb-2">
			</div>

			<!--Body-->
			<form action="login.php" method="get" id="form-main"> <!-- Need to go to new php page and verify login. If user exists, go to appropriate page based on user type. If does not exist, load the same page with error message.  -->
				<!--Username-->
				<div class="md-form">
					<i class="fa fa-user prefix" aria-hidden="true"></i>
					<input type="text" id="form2" class="form-control">
					<label for="form2">Enter Username</label>
				</div>

				<!--Password-->
				<div class="md-form">
					<i class="fa fa-lock prefix"></i>
					<input type="password" id="form4" class="form-control">
					<label for="form4">Enter password</label>
				</div>

				<!--Login-->
				<div class="text-center">
					<button type="submit" form="form-main" value="Login" class="btn btn-deep-purple">Login</button>
				</div>
			</form>
		</div>

		<!--Footer, Register-->
		<div class="modal-footer">
			<div class="options">
				<p>Not a User?<a href="register1.html"> Register</a></p> <!--Will link to Sandeep's Register Page-->
			</div>
		</div>

	</div>

</div>
    <!-- /Start your project here-->
	

    <!-- SCRIPTS -->
	<style>
	
	</style>
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
