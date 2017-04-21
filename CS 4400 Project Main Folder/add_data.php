<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add points</title>
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

<body style="padding: 50px 390px 50px 390px; position: fixed;">


         <!-- Form with header-->
        <div class="card">
        <div class="card-block">

        <!--Header-->
        <div class="form-header  purple darken-4">
            <h3>Add a new data point:</h3>
        </div>

        <!--Body-->
        <form action="http://localhost:8888/add_data.php" method="post">
        <div>
            <span>POI location name:</span>
            <!--<select name="location_name"> -->
            <block class="dropdown">
            <!--<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Locations
            <span class="caret"></span></button>-->
            
			
            <?php
            	$mysqli = new mysqli("localhost:8889", "master_user", "password", "CS4400");
            	$result = $mysqli->query("SELECT `Name` FROM `POI` WHERE `Flag`=1");
            	if ($result) {
			    	echo '<select name="location_name" class="mdb-select">';
			    	echo '<option value="" disabled selected>Choose location</option>';
				    for($i=0;$i<$result->num_rows;$i++)
				    {
				    	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
				    	//unset($id, $name);
		                $name = $row["Name"];
                  		echo "<option> $name </option>";
				    }
				    /* free result set */
				    //echo '</select>';
				    $result->close();
				    echo '</select>';
				}
				else
				{
					printf("Hello?\n");
				}

				$mysqli->close();
            ?>
            <!--<option type="text" value="Fuckers, MM">Fuckers, MM</option>
            <option type="text" value="Paso, PL">Paso, PL</option>
            <option type="text" value="Atl, GA">Atl, GA</option>
            </select>
            </select>-->
             </block>
            <a href="http://www.sony.com"><u>add a new location</u></a>
        </div>

        <div class="flex-container">
            <div class="flex-item">Time and date of reading:</div>
            <div class="flex-item-cal">
            <div class="row" style="margin-right: -189px">
                <div class="col-md-6">
                    <div class="form-control-wrapper">
                        <input type="text" id="date-format" class="form-control floating-label" placeholder=" / /  " name="date_time">
                    </div>
                </div>
           </div>
           </div>
           <div class="flex-item-icons">
            <img src="calendericon.png" alt="Calender" style="width:50px;height:50px;">
           </div>
           <div class="flex-item-icons">
            <img src="clockicon.png" alt="Tick tock" style="width:50px;height:50px;">
           </div>
        </div>

        <div>
           <span>Data type</span>
           <block class="dropdown">
            <select name="data_type">
            <option value="" disabled selected>Choose data type</option>
            <option type="text" value="Mold">Mold</option>
            <option type="text" value="Air Quality">Air Quality</option>
            </select>
          </block>
          <div style="clear:both"></div>
        </div>

        <div class="flex-container">
            <span class="flex-item">Data value:</span>
            <block style="margin-top: 25px; margin-left: -140px;" id="datavalue"><input type="text" name="data_value"></block>
        </div>

        <!--Footer-->
        <div>
            <button type="button" class="btn btn-deep-orange"><a href="http://www.yahoo.com" style="color: #ffffff; text-decoration: none; ">back</a></button>
            <!--White-space-->
            <block id="white-space"></block>
            <!--Amber-->
            <button type="submit" name="submit" value="1" class="btn btn-dark-green">accept</button>
        </div>
      </div>
    </div>
    </form>

       <?php
        
        $submit = $_POST['submit']; 
       	$location_name = $_POST['location_name'];
        $date_time =$_POST['date_time'];    
        $data_type = $_POST['data_type']; 
        $data_value = $_POST['data_value'];
        /*echo $location_name.' is the location<br />';
        echo $date_time.' is the date and time<br />';
        echo $data_type.' is the data type<br />';
        echo $data_value.' is the data value<br />';
        echo "<p>Testing</p>";*/
        if(($submit)&(($location_name == NULL)|($date_time == NULL)|($data_type == NULL)|($data_value == NULL)))
            echo 'Error Missing Entry';
        if(($submit)&($location_name)&($date_time)&($data_type)&($data_value))
        {
        	$location_name = addslashes($location_name); 
	        $date_time = addslashes($date_time);    
	        $data_type = addslashes($data_type); 
	        $data_value = doubleval($data_value);
            $db = new mysqli("localhost:8889","master_user","password","CS4400");

		    if ($db->connect_errno) {
		        echo 'Error: Could not connect to database. Please try again later.';
		        exit; 
		    }

		    //INSERT INTO `data_point` (`Location_Name`, `Date_Recorded`, `Data_value`, `Data_type`, `Accepted`) VALUES ('Georgia Tech', '1/25/2018 0:00', '1', 'Mold', '1')

            $q1 = "INSERT INTO `data_point`(`Location_Name`, `Date_Recorded`, `Data_value`, `Data_type`,`Accepted`) VALUES ('$location_name', '$date_time', '$data_value', '$data_type','0')";

            $result = $db->query($q1);

            if(!$result)
            {
                echo 'Error: Unable to fill database';
                exit;
            }
            else
            {
                echo 'Done. Domo my dude';
                echo '<meta http-equiv="refresh" content="5">';
            }
            $result->close();
            $db->close();
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
    <!-- For date and time 
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

            $.material.init()
        });
        </script>-->


    
</body>

</html>
