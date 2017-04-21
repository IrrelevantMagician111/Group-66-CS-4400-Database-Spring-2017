<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>POI Report</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <!-- Template styles -->
    <style rel="stylesheet">
        /* TEMPLATE STYLES */
        
        html,
        body,
        .view {
            height: 100%;
        }
        /* Navigation*/
        
        .navbar {
            background-color: transparent;
        }
        
        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }
        
        .top-nav-collapse {
            background-color: #1C2331;
        }
        
        footer.page-footer {
            background-color: #1C2331;
            margin-top: -1px;
        }
        
        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #1C2331;
            }
        }
        /*Call to action*/
        
        .flex-center {
            color: #fff;
        }
        
        .view {
            background: url("img/report.jpg")no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
		.arrow-up {
			  width: 0; 
			  height: 0; 
			  border-left: 5px solid transparent;
			  border-right: 5px solid transparent;
			  
			  border-bottom: 5px solid white;
		}
		.arrow-down {
			  width: 0; 
			  height: 0; 
			  border-left: 5px solid transparent;
			  border-right: 5px solid transparent;
			  
			  border-top: 5px solid white;
			  margin-top: 5px
		}
    </style>

</head>
<?php
  //Query 1 
   @$db = new mysqli('localhost','root','password','cs4400');
	$connected = !mysqli_connect_errno();
    $query1 = "SELECT Name AS POI_LOCATION, City, State, MOLD_MIN, MOLD_AVG, MOLD_MAX, AIR_MIN, AIR_AVG, AIR_MAX, NUM_POINTS, Flag
	FROM
	   (SELECT Air_name AS Name, MOLD_MIN, MOLD_AVG, MOLD_MAX, AIR_MIN, AIR_AVG, AIR_MAX 
		FROM (SELECT D.`Name`AS Mold_name, MIN(D.`Data_Value`) AS MOLD_MIN, AVG(D.`Data_Value`) AS MOLD_AVG, MAX(D.`Data_Value`) AS MOLD_MAX
			  FROM `poi` AS P, `data_point` AS D 
			  WHERE P.`Name`=D.`Name`AND D.`Data_Type`='Mold' 
			  GROUP BY D.`Name`) AS M 
			  RIGHT JOIN (SELECT D.`Name` AS Air_name, MIN(D.`Data_Value`)AIR_MIN, AVG(D.`Data_Value`) AS AIR_AVG, MAX(D.`Data_Value`) AS AIR_MAX
						  FROM `poi` AS P, `data_point` AS D 
						  WHERE P.`Name`=D.`Name`AND D.`Data_Type`='Air Quality' 
						  GROUP BY D.`Name`) AS A 
			  ON M.Mold_name=A.Air_name
		UNION    
		SELECT  Mold_name AS Name, MOLD_MIN, MOLD_AVG, MOLD_MAX, AIR_MIN, AIR_AVG, AIR_MAX 
		FROM (SELECT D.`Name`AS Mold_name, MIN(D.`Data_Value`) AS MOLD_MIN, AVG(D.`Data_Value`) AS MOLD_AVG, MAX(D.`Data_Value`) AS MOLD_MAX
			  FROM `poi` AS P, `data_point` AS D 
			  WHERE P.`Name`=D.`Name`AND D.`Data_Type`='Mold' 
			  GROUP BY D.`Name`) AS M 
			  LEFT JOIN (SELECT D.`Name` AS Air_name, MIN(D.`Data_Value`) AS AIR_MIN, AVG(D.`Data_Value`) AS AIR_AVG, MAX(D.`Data_Value`) AS AIR_MAX
						 FROM `poi` AS P, `data_point` AS D 
						 WHERE P.`Name`=D.`Name`AND D.`Data_Type`='Air Quality' 
						 GROUP BY D.`Name`) AS A 
			  ON M.Mold_name=A.Air_name) AS F
		NATURAL JOIN 
		(SELECT W.`Name`, Count(*) AS NUM_POINTS
		FROM `data_point`AS W
		GROUP BY W.`Name`) AS Q
		NATURAL JOIN
		(SELECT *
		 FROM `poi` AS p) AS R";
		$result = $db->query($query1);
		$num_results = $result->num_rows;

		//Query 2 
		 
	$query2 = "SELECT N.`Name` AS Name, N.`City` AS City, N.`State` AS State, N.`Flag` AS Flag 
	  FROM `poi` AS N 
	  WHERE N.`Name` NOT IN (SELECT `Name` 
							 FROM `data_point`)";	
	$result2 = $db->query($query2);
	$num_results2 = $result2->num_rows + $num_results;
?>
<body <?php if($num_results < 9){ echo 'style="height: 100vh;"';} else{$vh = ($num_results2+3.5)*8.4; echo 'style="height: '.$vh.'vh;"'; }?>>

    <!--Navbar-->
    
    <!--/.Navbar-->
	    
	    

   

    <!--Mask-->
    <div class="view hm-black-strong">
        <div class="full-bg-img flex-center">
            <ul class="animated fadeInUp">
                <li>
                    <h1 class="h1-responsive">POI Report</h1></li>
						<table class="table table-striped" id = "poi-table">
						  <thead>
							<tr>
								<td></td>
								<td><div class="arrow-up prefix" onclick="sortTable(0, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(0, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(1, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(1, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(2, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(2, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(3, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(3, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(4, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(4, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(5, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(5, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(6, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(6, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(7, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(7, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(8, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(8, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(9, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(9, 'poi-table', 3, 11)"></div></td>
								<td><div class="arrow-up prefix" onclick="sortTable(10, 'poi-table', 3, 11)"></div><div class="arrow-down prefix" onclick="sortTable(10, 'poi-table', 3, 11)"></div></td>
							</tr>
							<tr>
							  <th></th>
							  <th>POI Location</th>
							  <th>City</th>
							  <th>State</th>
							  <th>Mold Min.</th>
							  <th>Mold Avg</th>
							  <th>Mold Max</th>
							  <th>AQ Min</th>
							  <th>AQ Avg</th>
							  <th>AQ Max</th>
							  <th># of data points</th>
							  <th>Flagged?</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php
							$i = 0;
							for(; $i < $num_results; $i++)
							{
								$row = $result->fetch_assoc();
								$POI_LOCATION = stripslashes($row['POI_LOCATION']);
								$City = stripslashes($row['City']);
								$State = stripslashes($row['State']);
								$Mold_Min = stripslashes($row['MOLD_MIN']);
								if(!strlen($Mold_Min)){$Mold_Min="0";}
								$Mold_Avg = stripslashes($row['MOLD_AVG']);
								if(!strlen($Mold_Avg)){$Mold_Avg="0";}
								$Mold_Max = stripslashes($row['MOLD_MAX']);
								if(!strlen($Mold_Max)){$Mold_Max="0";}
								$AQ_Min = stripslashes($row['AIR_MIN']);
								if(!strlen($AQ_Min)){$AQ_Min="0";}
								$AQ_Avg = stripslashes($row['AIR_AVG']);
								if(!strlen($AQ_Avg)){$AQ_Avg="0";}
								$AQ_Max = stripslashes($row['AIR_MAX']);
								if(!strlen($AQ_Max)){$AQ_Max="0";}
								$num_data_points = stripslashes($row['NUM_POINTS']);
								$Flagged = stripslashes($row['Flag']);
								if($Flagged==="1"){$Flagged="Yes";}
								else{$Flagged="No";}
								echo "<tr>";
								echo '<th scope="row">'.($i+1).'</th>';
								echo "<td>".$POI_LOCATION."</td>";
								echo "<td>".$City."</td>";
								echo "<td>".$State."</td>";
								echo "<td>".$Mold_Min."</td>";
								echo "<td>".$Mold_Avg."</td>";
								echo "<td>".$Mold_Max."</td>";
								echo "<td>".$AQ_Min."</td>";
								echo "<td>".$AQ_Avg."</td>";
								echo "<td>".$AQ_Max."</td>";
								echo "<td>".$num_data_points."</td>";
								echo "<td>".$Flagged."</td>";
								echo "</tr>";
							}
							for(; $i < $num_results2; $i++)
							{
								$row = $result2->fetch_assoc();
								$POI_LOCATION = stripslashes($row['Name']);
								$City = stripslashes($row['City']);
								$State = stripslashes($row['State']);
								$Flagged = stripslashes($row['Flag']);
								if($Flagged==="1"){$Flagged="Yes";}
								else{$Flagged="No";}
								$zero = "0";
								echo "<tr>";
								echo '<th scope="row">'.($i+1).'</th>';
								echo "<td>".$POI_LOCATION."</td>";
								echo "<td>".$City."</td>";
								echo "<td>".$State."</td>";
								echo "<td>".$zero."</td>";
								echo "<td>".$zero."</td>";
								echo "<td>".$zero."</td>";
								echo "<td>".$zero."</td>";
								echo "<td>".$zero."</td>";
								echo "<td>".$zero."</td>";
								echo "<td>".$zero."</td>";
								echo "<td>".$Flagged."</td>";
								echo "</tr>";
							}
						  ?>
						  </tbody>
						</table>
            </ul>
        </div>
    </div>
    <!--/.Mask-->

    <!--Footer-->
    
    <!--/.Footer-->


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
	
	<!-- Sorting Script -->
	<script type="text/javascript" src="js/sorting.js"></script>


</body>

</html>