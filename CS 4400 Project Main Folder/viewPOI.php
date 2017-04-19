<?php
// create variable names
$locName = $_POST['LocName'];
$city = $_POST['City'];
$state = $_POST['State'];
$zip = $_POST['Zip'];
$checkbox = $_POST['Check'];
$sDate = $_POST['sDate'];
$eDate = $_POST['eDate'];

$zip = trim($zip);

if(!$locName|| !$city || !$state)
{
	echo 'Please choose Name, city, and state';
	exit;
}

if(!get_magic_quotes_gpc())
{
	$locName = addslashes($locname);
	$city = addslashes($city);
	$state = addslashes($state);
}

@   $db = new mysqli('localhost','root','password','cs4400');
		$connected = !mysqli_connect_errno();
		if($connected)
		{
			$queryL = "SELECT * FROM `poi` WHERE `Name`='".$locName."";
			result1 = $db->query($queryL);
			$num_results_loc = $result1->num_rows1;

			echo '<p>POI Location Names: '.$num_results_loc.'</p>';

			for($i = 0; $i <$num_results_loc; $i++)
			{
				$row1 = $result1->fetch_assoc();
				$locName=$i["$locName"];
                echo "<option>
                    $locName
                </option>";
				$result1->free();
			}
		
			$queryC = "SELECT * FROM `poi` WHERE `City`='".$city."";
			result2 = $db->query($queryC);
			$num_results_city = $result2->num_rows2;

			echo '<p>City: '.$num_results_city.'</p>';

			for($j = 0; $j <$num_results_city; $j++)
			{
				$row2 = $result2->fetch_assoc();
				echo'</p>';
				$result->free();
			}

			$queryS = "SELECT * FROM `poi` WHERE `State`='".$state."";
			result3 = $db->query($queryS);
			$num_results_state = $result2->num_rows3;

			echo '<p>State: '.$num_results_state.'</p>';

			for($k = 0; $k <$num_results_state; $k++)
			{
				$row3 = $result3->fetch_assoc();
				echo'</p>';
				$result->free();
			}

			if($checkbox == 1)
			{
				$queryCB = "SELECT * FROM `poi` WHERE `Flag`='".$checkbox."";
				result4 = $db->query($queryCB);
			}

			if($sDate && $eDate) 
			{
				$querySD = "SELECT * FROM 'poi' WHERE 'Date_Flagged`='".$sdate."";
				result5 = $db->query($querySD);
				if()
			}






		}

?>