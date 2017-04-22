<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registration</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/MP.bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/MP.mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Added these for the date and time -->
    <link href="css/adminfunc.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-material-datetimepicker.css" />


</head>

<body style="padding-top: 50px; padding-right: 250px; padding-left: 250px; position: absolute;">


         <!-- Form with header-->
        <div class="card">
        <div class="card-block">

        <!--Header-->
        <div class="form-header  purple darken-4">
            <h3>Registration</h3>
        </div>

        <!--Body-->
        <form action="register.php" method="post">

        <!-- Username -->
        <div class="flex-container">
            <span class="flex-item">Username</span>
            <block style="margin-top: 25px; margin-left: -40px;" id="datavalue"><input type="text" name="username"></block>
        </div>

        <!-- Email Address -->
        <div class="flex-container">
            <span class="flex-item">Email Address</span>
            <block style="margin-top: 25px; margin-left: -40px;" id="datavalue"><input type="text" name="email_address"></block>
        </div>

        <!-- Password -->
        <div class="flex-container">
            <span class="flex-item">Password</span>
            <block style="margin-top: 25px; margin-left: -40px;" id="datavalue"><input type="text" name="password"></block>
        </div>

        <!-- Confirm Password -->
        <div class="flex-container">
            <span class="flex-item">Confirm Password</span>
            <block style="margin-top: 25px; margin-left: -40px;" id="datavalue"><input type="text" name="confirm_password"></block>
        </div>
		
		<script>
			function onCityOfficial(event)
			{
				var userType = document.getElementById('user-type-select').value;
				if(userType==="City_Official")
				{
					document.getElementById('city-stuff').style.display = "block";
				}
				else
				{
					document.getElementById('city-stuff').style.display = "none";
				}
			}	
		</script>

        <!-- User Type -->
        <div>
           <span>User Type</span>
           <block class="dropdown" style="margin-left: 80px;">
            <select name="user_type" id = "user-type-select" onchange="onCityOfficial()">
            <option value="" disabled selected>User Type</option>
            <option type="text" value="City_Official">City Official</option>
            <option type="text" value="City_Scientist">City Scientist</option>
            </select>
          </block>
          <div style="clear:both"></div>
        </div>
        </br>
		
        <div class="blockotext">
        </div>
        <!-- For city official -->
        <div class="flex-container2" id="city-stuff" style="display: none;">

        <!-- City Dropdown -->
        <div class="flex-item" style="margin-left:40px;">
            <span style="margin-right:10px;">City</span>
            <block class="dropdown">
            <?php
            	$mysqli = new mysqli("localhost", "root", "password", "CS4400");
            	$result = $mysqli->query("SELECT `City` FROM `City_State`");
            	if ($result) {
			    	echo '<select name="city" class="mdb-select">';
			    	echo '<option value="" disabled selected>Choose city</option>';
				    for($i=0;$i<$result->num_rows;$i++)
				    {
				    	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		                $city = $row["City"];
                  		echo "<option> $city </option>";
				    }
				    $result->close();
				    echo '</select>';
				}
				else
				{
					printf("Hello?\n");
				}

				//$mysqli->close();
            ?>
            
             </block>
        </div>

        <!-- State -->
        <div class="flex-item" style="margin-left:40px;">
        	<span style="margin-right:10px;">State</span>
            <block class="dropdown">
            <?php
            	$result = $mysqli->query("SELECT `State` FROM `City_State`");
            	if ($result) {
			    	echo '<select name="state" class="mdb-select">';
			    	echo '<option value="" disabled selected>Choose state</option>';
				    for($i=0;$i<$result->num_rows;$i++)
				    {
				    	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		                $state = $row["State"];
                  		echo "<option> $state </option>";
				    }
				    $result->close();
				    echo '</select>';
				}
				else
				{
					printf("Hello?\n");
				}

				$mysqli->close();
            ?>
            
             </block>
        </div>
       
        <!-- Title -->
        <div class="flex-item" style="margin-left:40px">
            <span style="margin-right:10px;">Title:</span>
            <block style="" id="datavalue"><input type="text" name="title"></block>
        </div>
        </div>

        <!--Footer-->
        <div>
            <!--Create-->
            <button style="margin-left: 150px;" type="submit" name="submit" href="login.html" value="1" class="btn btn-dark-green">Create</button>
        </div>
      </div>
    </div>
    </form>

       <?php
        
        @$submit = $_POST['submit']; 
       	@$username = $_POST['username'];
        @$email_address =$_POST['email_address'];    
        @$password = $_POST['password']; 
        @$confirm_password = $_POST['confirm_password'];
        @$user_type = $_POST['user_type'];
        @$city = $_POST['city'];
        @$state = $_POST['state'];
        @$title = $_POST['title'];
        @$box = "City_Official";

        if(($submit)&((!$username)|(!$email_address)|(!$password)|(!$confirm_password)|(!$user_type)))
        {
            echo '<script type="text/javascript">alert("Error: Missing Info");</script>';
            echo '<meta http-equiv="refresh" content="1">';
            exit;
        }

        if(($submit)&($username)&($email_address)&($password)&($confirm_password)&($user_type))
        { 
	       	$username = addslashes($username);
	        $email_address =addslashes($email_address);    
	        $password = addslashes($password); 
	        $confirm_password = addslashes($confirm_password);
	        $user_type = addslashes($user_type);
	        $city = addslashes($city);
	        $state = addslashes($state);
	        $title = addslashes($title);
	        /*Check password match*/
	    	if($password!=$confirm_password)
	    		echo '<script type="text/javascript">alert("Error: Passwords do not match");</script>';
	    	else
	    	{
	            /* If city official is selected make sure bottom is filled */
		        if($user_type==$box)
		        {
		        	if((!$city)|(!$state)|(!$title))
			        {
			        	//exit;
			        	echo '<script type="text/javascript">alert("Error: Missing Info for city official");</script>';
			        	echo '<meta http-equiv="refresh" content="1">';
			        }
			        else
			        {
			        	$db = new mysqli("localhost","root","password","CS4400");
			        	if ($db->connect_errno) {
					        echo 'Error: Could not connect to database. Please try again later.';
					        exit; 
					        echo '<meta http-equiv="refresh" content="1">';

					    }
					    $q1 = "INSERT INTO `Users`(`Username`, `Email_Address`, `Password`, `User_type`) VALUES ('$username', '$email_address', '$password', '$user_type')";
					    $result = $db->query($q1);
					    if(!$result)
			            {
			                echo '<script type="text/javascript">alert("Error: Query 1 fail");</script>';
			                exit;
			                echo '<meta http-equiv="refresh" content="1">';
			            }
			        	$q2 = "INSERT INTO `City_Official`(`Username`, `Title`, `Approved`, `City`,`State`) VALUES ('$username', '$title', '2', '$city', '$state')";
			        	$result2 = $db->query($q2);
			        	if(!$result2)
			            {
			                echo '<script type="text/javascript">alert("Error: Query 2 fail");</script>';
			                exit;
			                echo '<meta http-equiv="refresh" content="1">';
			            }
			            else
			            {
			                echo '<script type="text/javascript">alert("Done: Thanks my dude");</script>';
			                echo '<meta http-equiv="refresh" content="5">';
			            }
		        	}
		        }
		        /* Normal user entry */
		        else
		        {
		            $db = new mysqli("localhost","root","password","CS4400");
				    if ($db->connect_errno) {
				        echo 'Error: Could not connect to database. Please try again later.';
				        exit; 
				    }
				    /* Special City Oficial Case*/
		            $q1 = "INSERT INTO `Users`(`Username`, `Email_Address`, `Password`, `User_type`) VALUES ('$username', '$email_address', '$password', '$user_type')";
		            $result = $db->query($q1);
		            if(!$result)
		            {
		                echo '<script type="text/javascript">alert("Error: Database fail");</script>';
		                exit;
		            }
		            else
		            {
		                echo '<script type="text/javascript">alert("Done: Thanks my dude");</script>';
		                echo '<meta http-equiv="refresh" content="5">';
		            }
		        }

	            //If it was a city official
	            /* If city official is selected make sure bottom is filled
		        if($user_type==$box)
		        	if((!$city)|(!$state)|(!$title))
			        {
			        	exit;
			        	echo '<script type="text/javascript">alert("Error: Missing Info for city official");</script>';
			        	echo '<meta http-equiv="refresh" content="1">';
			        }
			        else
			        {
			        	$q2 = "INSERT INTO `City_Official`(`Username`, `Title`, `Approved`, `City`,`State`) VALUES ('$username', '$title', 2, '$city', 'state')";
			        	$result2 = $db->query($q2);
			        	if(!$result2)
			            {
			                echo '<script type="text/javascript">alert("Error: Database fail");</script>';
			                exit;
			            }
			            else
			            {
			                echo '<script type="text/javascript">alert("Done: Domo my dude");</script>';
			                echo '<meta http-equiv="refresh" content="5">';
			            }
		        }
		        /*************************************************************/
	            $result->close();
	            $result->close();
	            $db->close();
	        }
        }

        ?>


</body>

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
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script> 
    <script type="text/javascript" src="./js/bootstrap-material-datetimepicker.js"></script>
   <!-- <script type="text/javascript" src="./js/datescript.js"></script>-->
    <script type="text/javascript">
        $('#date-format').bootstrapMaterialDatePicker({ format : 'MM/DD/YYYY  HH:mm' });
    </script>
    <script type="text/javascript">
        // Material Select Initialization
        $(document).ready(function() {
            $('.mdb-select').material_select();
        });
    </script>
    
</body>

</html>



