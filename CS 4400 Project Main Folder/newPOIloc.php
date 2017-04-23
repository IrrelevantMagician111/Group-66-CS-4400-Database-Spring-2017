<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Insert Page Name</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

<?php
	
	@$name = $_POST['name'];
	@$city = $_POST['city'];
	@$state = $_POST['state'];
	@$zip = $_POST['zip'];
	@   $db = new mysqli('localhost','root','password','cs4400');
	$connected = !mysqli_connect_errno();
	if(!(strlen($name)&&strlen($city)&&strlen($state)&&strlen($zip)))
	{
		echo '<p>Must choose a POI Location, city, and state.</p>';
	}
	else
	{
		if(!get_magic_quotes_gpc())
		{

			$name = addslashes($name);
			$city = addslashes($city);
			$state = addslashes($state);
			$zip = addslashes($zip);
		}	
				if($connected)
				{
					$query = "INSERT INTO `cs4400`.`poi` (`Name`, `Flag`, `Date_Flagged`, `Zip_Code`, `City`, `State`) VALUES ('".$name."', '0', '0000-00-00', '".$zip."', '".$city."', '".$state."')";
					$result = $db->query($query);
					if(!$result){echo "<p>Could not insert tuple. Violates key constraint.</p>";}
				}
				else
				{
					echo "<p>Could not connect to database. Contact yout database administrator.</p>";
				}
	}
?>

<div class="card center-container">
    <div class="card-block">

        <!--Header-->
        <div class="form-header light-blue-gradient">
            <h3> Add a New Location</h3>
        </div>

        <!--Body-->
		<form action="newPOIloc.php" method="post">
			<div class="md-form">
				<i class="fa fa-map-marker prefix"></i>
				<input type="text" id="form3" name="name" class="form-control">
				<label for="form3">POI Location Name</label>
			</div>
			<?php
				$query2 = "SELECT DISTINCT `City` FROM `city_state`";
				$result2 = $db->query($query2);
				$num_results2 = $result2->num_rows;
				$query3 = "SELECT DISTINCT `State` FROM `city_state`";
				$result3 = $db->query($query3);
				$num_results3 = $result3->num_rows;	
			?>
			<select class="btn btn-secondary" id="user-type-select" name="city" aria-labelledby="City" >
				<option selected disabled>City</option>
				<?php 
					for ($i = 0; $i < $num_results2; $i++)
					{
						$row = $result2->fetch_assoc();
						echo '<option value="'.$row['City'].'">'.$row['City'].'</option>';
					}
				?>
			</select>

			<select class="btn btn-secondary" id="user-type-select" name="state" aria-labelledby="State">
				<option selected disabled>State</option>
				<?php 
					for ($i = 0; $i < $num_results3; $i++)
					{
						$row = $result3->fetch_assoc();
						echo '<option value="'.$row['State'].'">'.$row['State'].'</option>';
					}
				?>
			</select>

			<div class="md-form">
				<input type="text" id="form4" name="zip" class="form-control">
				<label for="form4">Zip Code</label>
			</div>

			<div class="text-left">
				<a class="btn btn-indigo" href="add_data.php">Back</a>
				<button type="submit" class="btn btn-indigo">Submit</button>
			</div>
		</form>
    </div>
</div>
<!--/Form with header-->

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