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
    <link href="css/login_style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap-material-datetimepicker.css" />


  <script>
    $(function() {
      
      $("#datepicker, #datepicker2").datepicker({
        onSelect: function(dateText, inst) { 
          $(this).prev()[0].value = dateText;
        }
      });
    
    
  });
  </script>


</head>

<body>
<form action = "viewPOI.php" method = "post">
    <!-- /Start your project here-->
    <!--Form with header-->
<div class="center-container">
    <div class="card">
		<div class="card-block">
			<!--Header-->
			<div class="form-header light-blue-gradient text-center">
				<h3> View POIs</h3>
			</div>

			<!--Body-->
			<div class="dropdown">
				<select class = "btn btn-secondary" name = "LocName">
                    <option selected disabled> POI Location Name </option>
                    <?php
                        @   $db = new mysqli('localhost','root','password','cs4400');
                        $connected = !mysqli_connect_errno();
                        if(!$connected)
                        {
                        }
                        $result = $db->query("SELECT `Name` FROM `poi`");

                        while($row = $result -> fetch_assoc())
                        {
                             echo "<option value=\"loc\">" .$row['Name'] ."</option>";
                        }
                
                    ?>
				</select>
			</div>

			<div class="dropdown">
				
                <select class = "btn btn-secondary" name = "City">
                    <option selected disabled> City </option>
                 <?php
                        @   $db = new mysqli('localhost','root','password','cs4400');
                        $connected = !mysqli_connect_errno();
                        if(!$connected)
                        {
                            echo "<p>You are bot connected.</p>";
                        }
                        $result = $db->query("SELECT DISTINCT `City` FROM `poi`");

                        while($row = $result -> fetch_assoc())
                        {
                             echo "<option value = \"Cityy\">" .$row['City'] ."</option>";
                        }
                
                    ?>
                </select>
			</div>

			<div class="dropdown">
                <select class = "btn btn-secondary" name = "State">
                    <option selected disabled> State </option>
                     <?php
                        @   $db = new mysqli('localhost','root','password','cs4400');
                        $connected = !mysqli_connect_errno();
                        if(!$connected)
                        {
                            echo "<p>You are bot connected.</p>";
                        }
                        $result = $db->query("SELECT distinct `State` FROM `poi`");

                        while($row = $result -> fetch_assoc())
                        {
                             echo "<option value = \"statee\">".$row['State'] ."</option>";
                        }
                
                    ?>
                </select>
			</div>

			<div class="md-form">
				<input name = "Zip" type="text" id="form4" class="form-control">
				<label for="form4">Zip Code</label>
			</div>

			 <div class="text-center">
				<fieldset class="form-group">
					<input name= "Check" type="checkbox" id="checkbox1">
					<label for="checkbox1">Flagged?</label>
				</fieldset>
			</div>

			<div class="md-form">
			  <div class="form-control-wrapper">
				<input name = "sDate" placeholder="Start date" type="text" id="date-format1" class="form-control floating-label">
				<label for="date-format1">dd/mm/yyy</label>
			  </div>
			</div>

			<div class="md-form">
			  <div class="form-control-wrapper">
				<input name = "eDate" placeholder="End date" type="text" id="date-format2" class="form-control floating-label">
				<label for="date-format2">dd/mm/yyy</label>
			  </div>
			</div>
			
		  
            
			<div class="text-left">
				<button name = "filter" class="btn btn-indigo">Apply Filter</button>
				<button class="btn btn-indigo href="#">Reset Filter</button>
			</div>
            
			
        </div>
	</div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th>Location Name</th>
                      <th>City</th>
                      <th>State</th>
                      <th>Zip Code</th>
                      <th>Flagged?</th>
                      <th>Date Flagged</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Georgia Tech</td>
                        <td>Atlanta</td>
                        <td>GA</td>
                        <td>30332</td>
                        <td>Yes</td>
                        <td>01/31/2017</td>
                    </tr> 
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <button class="btn btn-indigo">Back</button>
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

    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script> 
    <script type="text/javascript" src="./js/bootstrap-material-datetimepicker.js"></script>
    <script type="text/javascript">
      $('#date-format1,#date-format2').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    </script>
  
</form> 
</body>

</html>
