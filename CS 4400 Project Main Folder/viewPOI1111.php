<!DOCTYPE html>
<html lang="en">
<?php 
	@$flag_name = $_GET['name'];
	if (strlen($flag_name))
	{
		if(!get_magic_quotes_gpc())
		{
			$flag_name = addslashes($flag_name);
		}
		@   $db = new mysqli('localhost','root','password','cs4400');
		$connected = !mysqli_connect_errno();
		if($connected)
		{
			$query_read = "SELECT `Flag` FROM `poi` WHERE `Name` = '".$flag_name."'";
			$result = $db->query($query_read);
			$row = $result->fetch_assoc();
			$current_flag = (int)$row['Flag'];
			echo "<p>".$current_flag."</p>";
			if($current_flag)
			{
				$query_write = "UPDATE `poi` SET `Flag` = '0' WHERE `Name` = '".$flag_name."'";
			}
			else
			{
				$query_write = "UPDATE `poi` SET `Flag` = '1' WHERE `Name` = '".$flag_name."'";
			}
		}
	}
?>
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


</head>

<body>
<form action = "http://localhost/cs%204400%20project%20main%20folder/viewPOI1111.php" method = "post">

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
                            echo "<p>You are not connected.</p>";
                        }
                        $result = $db->query("SELECT `Name` FROM `poi`");

                        while($row = $result -> fetch_assoc())
                        {
                            $y = $row['Name'];
                            echo "<option>  $y </option>";
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
                            $x = $row['City'];
                             echo "<option> $x </option>";
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
                            $z = $row['State'];
                            echo "<option> $z </option>";
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
					<input value = "1"; name= "Check" type="checkbox" id="checkbox1">
					<label for="checkbox1">Flagged?</label>
				</fieldset>
			</div>

			<div class="md-form">
			  <div class="form-control-wrapper">
				<input name = "sDate" placeholder="" type="text" id="date-format1" class="form-control floating-label">
				<label for="date-format1">dd/mm/yyyy</label>
			  </div>
			</div>

			<div class="md-form">
			  <div class="form-control-wrapper">
				<input name = "eDate" placeholder="" type="text" id="date-format2" class="form-control floating-label">
				<label for="date-format2">dd/mm/yyyy</label>
			  </div>
			</div>
			
		  
			<div class="text-left">
				<button type = "submit" name = "filter" class="btn btn-indigo">Apply Filter</button>
			</div>

            <div class="text-left">
                <button type = "submit" name = "reset"  class="btn btn-indigo" >Reset Filter </button>
            </div>
            
            <table class='table table-striped'>
            <thead>
            <tr>
                <td>Name</td>
                <td>City</td>
                <td>State</td>
                <td>Zip Code</td>
                <td>Flag</td>
                <td>Date_Flagged</td>
           </tr>
           </thead>
            <tbody>
            <?php
                // create variable names
            @ $name = $_POST['LocName'];
            @ $city = $_POST['City'];
            @ $state = $_POST['State'];
            @ $zip = $_POST['Zip'];
            @ $check = $_POST['Check'];
            @ $sDate = $_POST['sDate'];
            @ $eDate = $_POST['eDate'];

            $zip = trim($zip);
            $name = trim($name);

            if(!get_magic_quotes_gpc())
            {
                $name = addslashes($name);
                $city = addslashes($city);
                $state = addslashes($state);
            }

            @   $db = new mysqli('localhost','root','password','cs4400');
                $connected = !mysqli_connect_errno();
                if($connected)
                {
                    if(isset($_POST['filter']))
                    {

                        if((!$name)&&(!$city)&&(!$state)&&(!$zip)&&(!$check)&&(!$sDate)&&(!$eDate))
                        {
                            echo $print_str="<p>Please Select.</p>";
                        }
                        else
                        {
                            if(($name)&&($city)&&($state)&&($zip)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            elseif(($city)&&($state)&&($zip)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($state)&&($zip)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($city)&&($zip)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($city)&&($state)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `State` = '$state' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($city)&&($state)&&($zip)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `State` = '$state' and and `Zip_Code` = '$zip' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");
                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


                            elseif(($name)&&($city)&&($state)&&($zip)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($name)&&($state)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `State` = '$state' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($city)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($zip)&&($state)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `Zip_Code` = '$zip' and (`State` = '$state' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($city)&&($state)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and (`State` = '$state' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($zip)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($state)&&($zip)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($state)&&($city)&&($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`State` = '$state' and `City` = '$city' and (`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            elseif(($city)&&($state)&&($zip)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($name)&&($state)&&($zip)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($city)&&($state)&&($name)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `State` = '$state' and `name` = '$name' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($city)&&($zip)&&($name)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `Zip_Code` = '$zip' and `name` = '$name' and (`Flag` = '$check' and `Flag` != '0'))");
                           
                            elseif(($name)&&($city)&&($state)&&($zip))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `State` = '$state' and `Zip_Code` = '$zip'))");

                             elseif(($name)&&($state)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `State` = '$state' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($city)&&($state)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `State` = '$state' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($city)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($name)&&($zip)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `Zip_Code` = '$zip' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($city)&&($zip)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `Zip_Code` = '$zip' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($check)&&($city)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE ((`Flag` = '$check' and `Flag` != '0') and `City` = '$city' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($check)&&($name)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE ((`Flag` = '$check' and `Flag` != '0') and `Name` = '$name' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($check)&&($zip)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE ((`Flag` = '$check' and `Flag` != '0') and `Zip_Code` = '$zip' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");

                            elseif(($check)&&($state)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE ((`Flag` = '$check' and `Flag` != '0') and `State` = '$state' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate'))");
                            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            elseif(($check)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE ((`Flag` = '$check' and `Flag` != '0') and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate')) ");

                            elseif(($name)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate')) ");

                            elseif(($name)&&($city)&&($state))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `State` = '$state')");

                            elseif(($name)&&($city)&&($zip))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and `Zip_Code` = '$zip')");

                            elseif(($name)&&($city)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($state)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`State` = '$state' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate')) "); 
                            elseif(($state)&&($zip)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`State` = '$state' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($city)&&($zip)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($name)&&($zip)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `Zip_Code` = '$zip' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($city)&&($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate')) ");

                            elseif(($city)&&($state)&&($zip))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `State` = '$state' and `Zip_Code` = '$zip'))");

                            elseif(($name)&&($state)&&($zip))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `State` = '$state' and `Zip_Code` = '$zip'))");

                            elseif(($city)&&($state)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `State` = '$state' and (`Flag` = '$check' and `Flag` != '0'))");

                            elseif(($name)&&($state)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `State` = '$state' and (`Flag` = '$check' and `Flag` != '0'))");

                            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            elseif(($name)&&($city))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `City` = '$city')"); 
                            
                            elseif(($name)&&($state))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `State` = '$state')"); 

                            elseif(($name)&&($zip))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `Zip_Code` = '$zip')"); 

                            elseif(($name)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name' and `Flag` = '$check' and `Flag` != '0')"); 

                            elseif(($city)&&($state))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `State` = '$state')"); 

                             elseif(($city)&&($zip))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and `Zip_Code` = '$zip')"); 

                            elseif(($city)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city' and (`Flag` = '$check' and `Flag` != '0'))"); 

                            elseif(($state)&&($zip))
                                $result = $db->query("SELECT * From `poi` WHERE (`State` = '$state' and `Zip_Code` = '$zip')"); 

                            elseif(($state)&&($check))
                                $result = $db->query("SELECT * From `poi` WHERE (`State` = '$state' and (`Flag` = '$check' and `Flag` != '0'))"); 

                            elseif(($sDate)&&($eDate))
                                $result = $db->query("SELECT * From `poi` WHERE (`Date_Flagged` >= '$sDate' and `Date_Flagged` <= '$eDate')");
                            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            elseif($name)
                                $result = $db->query("SELECT * From `poi` WHERE (`Name` = '$name')"); 
                            
                            elseif($city)
                                $result = $db->query("SELECT * From `poi` WHERE (`City` = '$city')"); 

                            elseif($state)
                                $result = $db->query("SELECT * From `poi` WHERE (`State` = '$state')");
                            
                            elseif($zip)
                                $result = $db->query("SELECT * From `poi` WHERE (`Zip_Code` = '$zip')"); 
                            
                            elseif($check)
                                $result = $db->query("SELECT * From `poi` WHERE (`Flag` = '$check' and `Flag` != '0')"); 
                            

                            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                            $num_results_loc = $result->num_rows;   
                            
                            for($i = 0; $i <$num_results_loc; $i++)
                            {
                                $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
                                $name = $row['Name'];
                                $city =$row['City'];
                                $state =$row['State'];
                                $zip =$row['Zip_Code'];
                                $check =$row['Flag'];
                                $df=$row['Date_Flagged'];  
                           
                                   
                                /* echo         "<thead>";
                                 echo         "</tr>";

                                 echo               "<th>$name</th>";
                                 echo               "<th>$city</th>";
                                 echo               "<th>$state</th>";
                                 echo               "<th>$zip</th>";
                                 echo               "<th>$check</th>";
                                 echo               "<th>$df</th>";
                                 echo           "</tr>";
                                 echo           "</thead>";*/

                                 echo "<tr>" ;
                                echo "<td> <a href='http://localhost/Group-66-CS-4400-Database-Spring-2017/CS%204400%20Project%20Main%20Folder/blank.php?name=$name'>$name</a></td>";
                                ?>
                                <td><center><Strong><?php echo $city; ?></Strong></center></td>
                                <td><center><Strong><?php echo $state; ?></Strong></center></td>
                                <td><center><Strong><?php echo $zip; ?></Strong></center></td>
                                <td><center><Strong><?php echo $check; ?></Strong></center></td>
                                <td><center><Strong><?php echo $df; ?></Strong></center></td>
                                </tr>

            <?php
                                
                                      
                            }
                        }    
                    }
                    else
                    {
                        $result = $db->query("SELECT `Name`, `City`, `State`, `Zip_Code`, `Flag`, `Date_Flagged` FROM `poi`");
                        $num_results_loc = $result->num_rows;
     
                            for($i = 0; $i <$num_results_loc; $i++)
                            {
                                $row = $result->fetch_assoc();
                                $name = $row['Name'];
                                $city =$row['City'];
                                $state =$row['State'];
                                $zip =$row['Zip_Code'];
                                $check =$row['Flag'];
                                $df=$row['Date_Flagged'];
                                // echo "<table class='table table-striped'>"; 
                                /*echo            "<tr>";
                                echo               "<th>$name</th>";
                                echo               "<th>$city</th>";
                                echo               "<th>$state</th>";
                                echo               "<th>$zip</th>";
                                echo               "<th>$check</th>";
                                echo               "<th>$df</th>";
                                echo           "</tr>";*/
            
                                    echo "<tr>" ;
                                    echo "<td> <a href='http://localhost/CS%204400%20Project%20Main%20Folder/POI_detail.php?name=$name'>$name</a></td>";
                                    ?>
                                    <td><center><Strong><?php echo $city; ?></Strong></center></td>
                                    <td><center><Strong><?php echo $state; ?></Strong></center></td>
                                    <td><center><Strong><?php echo $zip; ?></Strong></center></td>
                                    <td><center><Strong><?php echo $check; ?></Strong></center></td>
                                    <td><center><Strong><?php echo $df; ?></Strong></center></td>
                                    </tr>

            <?php
                            }

                             
                    }


                }     
            ?>
            </tbody>

		<form action = "http://localhost/Group-66-CS-4400-Database-Spring-2017/CS%204400%20Project%20Main%20Folder/choose_functionality_city_official%202.1.html"      method = "post";>
        <div class="text-center">
            <button class="btn btn-indigo">  <a href="choose_functionality_city_official%202.1.html"> Back</a></button>
        </div>
        </form>
    </div>
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
    <script type="text/javascript" src="js/bootstrap-material-datetimepicker.js"></script>
    <!--<script type="text/javascript">
      $('#date-format1,#date-format2').bootstrapMaterialDatePicker({ weekStart: 0, time: false });

     
      *$('table.table tr').click(function yourEvent(){
            window.location.href = $(this).data("http://localhost/Group-66-CS-4400-Database-Spring-2017/CS%204400%20Project%20Main%20Folder/POI_detail.html")
      ;});*/-->

    
       

    </script>


  <script type="text/javascript">
        $('#date-format1,#date-format2').bootstrapMaterialDatePicker({ time: false, format : 'YYYY-DD-MM' });
    </script>

  

</body>

</html>