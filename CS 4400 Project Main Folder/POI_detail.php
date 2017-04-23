<!DOCTYPE html>
<?php 
	@   $db = new mysqli('localhost','root','password','cs4400');
		$connected = !mysqli_connect_errno();
		$name = $_GET['name'];
		@$data_type = $_POST['data_type'];
		@$data_min = $_POST['min'];
		@$data_max = $_POST['max'];
		@$end_date = $_POST['end'];
		@$begin_date = $_POST['begin'];
		$improper_filter_data = (strlen($data_min)&&!strlen($data_max))||(!strlen($data_min)&&!strlen($data_max));
		$improper_filter_date = (strlen($end_date)&&!strlen($begin_date))||(!strlen($end_date)&&strlen($begin_date));
		$filter_data = strlen($data_min)&&strlen($data_max);
		$filter_date = strlen($end_date)&&strlen($begin_date);
		$filter_data_type = strlen($data_type);
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php echo "<title>".$name."</title>"; ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style_login.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<?php 
	if(!$connected)
	{
		echo "<p>You could not connect to the database.</p>";
	}
?>
    <!-- /Start your project here-->
	
	<!--Form without header-->
	<div class="center-container">
		<div class="card">
			<div class="card-block">

				<!--Header-->
				<div class="text-center">
					<h3><i class="fa fa-pencil"></i> POI Detail</h3>
					<hr class="mt-2 mb-2">
				</div>

				<br>

				<!--Body-->
				
				<form action="POI_detail.php" method="post" id="form-main">
				<div class="btn-group dropup">
					<select class="btn btn-secondary" name="data_type" for="form-main" aria-labelledby="Data Type">
						<option selected disabled>Data Type</option>
						<?php 
							$query = "SELECT * FROM `data_type`";
							$results = $db->query($query);
							$num_results = $results->num_rows;
							for($i = 0; $i < $num_results; $i++)
							{
								$row = $results->fetch_assoc();
								echo '<option class="dropdown-item">'.$row['Data_Type'].'</option>';
							}
						?>
					</select>
				</div>
                                
				
				
				<div class="row">
					<div class="col-md-6">
						<div class="md-form form-group">
							<i class="fa fa-file-text-o fa-2x prefix" aria-hidden="true"></i>
							<input type="text" id="form91" name="min" class="form-control">
							<label for="form91">Data Value Minimum</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="md-form form-group">
							<input type="text" id="form92" name="max" class="form-control">
							<label for="form92">Data Value Maximum</label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="md-form">
							<i class="fa fa-calendar prefix" aria-hidden="true"></i>
							<input placeholder="Enter Date" type="text" id="date-format1" name="begin" class="form-control floating-label">
							<label for="date-format1">Beginning Date</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="md-form">
							<input placeholder="Enter Date" type="text" id="date-format2" name="end" class="form-control floating-label">
							<label for="date-format2">Ending Date</label>
						</div>
					</div>
				</div>

				<button class="btn btn-outline-success btn-rounded waves-effect" type="submit" form="form-main">Apply Filter</button>
				<button class="btn btn-outline-info btn-rounded waves-effect">Reset Filter</button>
				</form>
			</div>
		</div>
	</div>
		<div class="center-container">
			<div class="card">
				<div class="">
					<ul class="animated fadeInUp card">
						<li><h1 class="h1-responsive"><?php echo $name."'s ";?>Data Points</h1></li>
						<table class="table table-striped">
						  <thead>
							<tr>
							  <th>Data Type</th>
							  <th>Data Value</th>
							  <th>Time & Date of reading</th>
							</tr>
						  </thead>
						  <tbody>
							<?php 
								
								$query = "SELECT `Data_Type`, `Data_Value`, `Date_Recorded` FROM `data_point` WHERE ";
								echo "<p>Filter date is ".$filter_date."</p>";
								echo "<p>Filter data is ".$filter_data."</p>";
								echo "<p>Filter data type is ".$filter_data_type."</p>";
								if($filter_date)
								{
									$date_array_begin = explode(" ", $begin_date);
									$date_array_end = explode(" ", $end_date);
									//Convert to number from month
										if($date_array_end[2] == "January"){$date_array_end[2] = "-01-";}
										else if($date_array_end[2] == "February"){$date_array_end[2] = "-02-";}
										else if($date_array_end[2] == "March"){$date_array_end[2] = "-03-";}
										else if($date_array_end[2] == "April"){$date_array_end[2] = "-04-";}
										else if($date_array_end[2] == "May"){$date_array_end[2] = "-05-";}
										else if($date_array_end[2] == "June"){$date_array_end[2] = "-06-";}
										else if($date_array_end[2] == "July"){$date_array_end[2] = "-07-";}
										else if($date_array_end[2] == "August"){$date_array_end[2] = "-08-";}
										else if($date_array_end[2] == "September"){$date_array_end[2] = "-09-";}
										else if($date_array_end[2] == "October"){$date_array_end[2] = "-10-";}
										else if($date_array_end[2] == "November"){$date_array_end[2] = "-11-";}
										else {$date_array_end[2] = "-12-";}
									//Convert to number from month
										if($date_array_begin[2] == "January"){$date_array_begin[2] = "-01-";}
										else if($date_array_begin[2] == "February"){$date_array_begin[2] = "-02-";}
										else if($date_array_begin[2] == "March"){$date_array_begin[2] = "-03-";}
										else if($date_array_begin[2] == "April"){$date_array_begin[2] = "-04-";}
										else if($date_array_begin[2] == "May"){$date_array_begin[2] = "-05-";}
										else if($date_array_begin[2] == "June"){$date_array_begin[2] = "-06-";}
										else if($date_array_begin[2] == "July"){$date_array_begin[2] = "-07-";}
										else if($date_array_begin[2] == "August"){$date_array_begin[2] = "-08-";}
										else if($date_array_begin[2] == "September"){$date_array_begin[2] = "-09-";}
										else if($date_array_begin[2] == "October"){$date_array_begin[2] = "-10-";}
										else if($date_array_begin[2] == "November"){$date_array_begin[2] = "-11-";}
										else {$date_array_begin[2] = "-12-";}
										
									$date_array_begin[1] = trim($date_array_begin[1]);
									$date_array_begin[3] = trim($date_array_begin[3]);
									$date_array_begin[1] = $date_array_begin[1]." 00:00:00";
									$date_array_end[1] = trim($date_array_end[1]);
									$date_array_end[3] = trim($date_array_end[3]);
									$date_array_end[1] = $date_array_end[1]." 00:00:00";
									
									$temp1 = $date_array_begin[1];
									$temp2 = $date_array_begin[2];
									$temp3 = $date_array_begin[3];
									
									$date_array_begin[1] = $temp3;
									$date_array_begin[2] = $temp2;
									$date_array_begin[3] = $temp1;
									
									$temp1 = $date_array_end[1];
									$temp2 = $date_array_end[2];
									$temp3 = $date_array_end[3];
									
									$date_array_end[1] = $temp3;
									$date_array_end[2] = $temp2;
									$date_array_end[3] = $temp1;
									
									$begin_date = implode($date_array_begin);
									$end_date = implode($date_array_end);
									$query = $query."(`Date_Recorded` BETWEEN '".$begin_date."' AND '".$end_date."') AND ";
								}
								if($filter_data)
								{ 
									$query = $query."(`Data_Value` BETWEEN '".$data_min."' AND '".$data_max."') AND ";
								}
								if($filter_data_type)
								{
									$query = $query."(`Data_Type` = '".$data_type."') AND ";
								}
								if(!($filter_data_type||$filter_data||$filter_date)){
									$query = "SELECT `Data_Type`, `Data_Value`, `Date_Recorded` FROM `data_point` AND`";
								}
								$query = substr_replace($query, '', -4);
								$query = $query."ORDER BY `Date_Recorded` DESC";
								echo "<p>".$query."</p>";
								$results = $db->query($query);
								$num_results = $results->num_rows;
								for($i = 0; $i < $num_results; $i++)
								{
									$row = $results->fetch_assoc();
									echo "<tr>";
									echo '<td scope="row">'.$row['Data_Type'].'</th>';
									echo '<td scope="row">'.$row['Data_Value'].'</th>';
									echo '<td scope="row">'.$row['Date_Recorded'].'</th>';
									echo "</tr>";
								}
							?>
						  </tbody>
						</table>
					</ul>
					<button type="button" href ="" class="btn btn-outline-info waves-effect">Back</button>
					<button type="button" class="btn btn-outline-warning waves-effect">Flag</button>
				</div>
			</div>
		</div>
	</div>
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
      $('#date-format1,#date-format2').bootstrapMaterialDatePicker({ format : ' DD MMMM YYYY' });
    </script>
	<script type="text/javascript">
       $(document).ready(function()
        {
            $('#date').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });

            $('#time').bootstrapMaterialDatePicker
            ({
                date: false,
                shortTime: false,
                format: 'HH:mm'
            });

            $('#date-format').bootstrapMaterialDatePicker
            ({
                format: 'DD MMMM YYYY - HH:mm'
            });
            $('#date-fr').bootstrapMaterialDatePicker
            ({
                format: 'DD/MM/YYYY HH:mm',
                lang: 'fr',
                weekStart: 1, 
                cancelText : 'ANNULER',
                nowButton : true,
                switchOnClick : true
            });

            $('#date-end').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'DD/MM/YYYY HH:mm'
            });
            $('#date-start').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime : true
            }).on('change', function(e, date)
            {
                $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
            });

            $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
        });
    </script> 
	 
</body>

</html>
