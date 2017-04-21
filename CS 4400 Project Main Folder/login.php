<?php 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$num_results=0;
	$print_str = "";
	$filled_fields = $username&&$password;
	if($filled_fields)
	{
		if(!get_magic_quotes_gpc())
		{
			$username = addslashes($username);
			$password = addslashes($password);
		}
		@   $db = new mysqli('localhost','root','password','cs4400');
		$connected = !mysqli_connect_errno();
		if($connected)
		{
			$query = "SELECT * FROM `user` WHERE `Username`='".$username."' AND `Password`='".$password."'";
			$result = $db->query($query);
			$num_results = $result->num_rows;
			if(!$num_results)
			{
				$print_str="<p>Incorrect username or password. Try Again.</p>";
			}
			else
			{
				$row = $result->fetch_assoc();
				if(strcmp(stripslashes($row['User_Type']),"City_Official")==0)
				{
					$query2 = "SELECT `Username` FROM `city_official` WHERE `Approved`='1' AND `Username`='".$row['Username']."'";
					$result2 = $db->query($query2);
					$num_results2 = $result2->num_rows;
					$query3 = "SELECT `Username` FROM `city_official` WHERE `Approved`='0' AND `Username`='".$row['Username']."'";
					$result3 = $db->query($query3);
					$num_results3 = $result3->num_rows;
					if($num_results2)
					{
						ob_start();
						header('Location: choose_functionality_city_official%202.1.html');
						ob_end_flush();
						die();
					}
					elseif($num_results3)
					{
						$print_str="<p>You are a rejected City Official.</p>";
					}
					else
					{
						$print_str="<p>You are a pending City Official.</p>";
					}
				}
				else
				{
					if(!strcmp(stripslashes($row['User_Type']),"Admin"))
					{
						ob_start();
						header('Location: adminchoosefun.html');
						ob_end_flush();
						die();
					}
					if(!strcmp(stripslashes($row['User_Type']),"City_Scientist"))
					{
						ob_start();
						header('Location:  adddata.html');
						ob_end_flush();
						die();
					}
				}
			}
			
		}
		else
		{
			$print_str="<h1>CANNOT CONNECT TO DATABASE.</h1>";
		}
		
	}
	else
	{
		
		$print_str = "<p>You have not entered a username or password</p>";
	}
	
?>
"<!DOCTYPE html>

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
			<form action="login.php" method="post" id="form-main"> <!-- Need to go to new php page and verify login. If user exists, go to appropriate page based on user type. If does not exist, load the same page with error message.  -->
					
					<!--Username-->
				 <div class="md-form">
						<i class="fa fa-user prefix" aria-hidden="true"></i>
						<input type="text" id="form2" name="username" class="form-control">
						<label for="form2">Enter username</label>
					</div>

					<!--Password-->
					<div class="md-form">
						<i class="fa fa-lock prefix"></i>
						<input type="password" id="form4" name="password" class="form-control">
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
	<?php echo $print_str ?>

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
