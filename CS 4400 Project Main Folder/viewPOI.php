<?php
// create variable names
	@ $locName = $_POST['LocName'];
	@ $city = $_POST['City'];
	@ $state = $_POST['State'];
	@ $zip = $_POST['Zip'];
	@ $checkbox = $_POST['Check'];
	@ $sDate = $_POST['sDate'];
	@ $eDate = $_POST['eDate'];

	$zip = trim($zip);

	if(!strlen($locName) && !strlen($city) && !strlen($state))
	{
		echo 'Please choose Name, city, and state';
		exit;
	}

	else
	{
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
				if(isset($_POST['filter']))
				{
					if($locName)
					{
						$result = $db->query("SELECT `Name` `City` `State` `Zip_Code` `Flag` `Date_Flagged` FROM `poi`");
	                        while($row = $result -> fetch_assoc())
	                        {
	                            $name=$row['Name'];
                                $city=$row['City'];
                                $state=$row['State'];
                                $zip=$row['Zip_Code'];
                                $flag=$row['Flag'];
                                $dateFlag=$row['Date_Flagged'];

	                             echo "<table class='table table-striped'>";
			                        echo "	<thead>
			                        			<tr>
								                    <th>Location Name</th>
								                    <th>City</th>
								                    <th>State</th>
								                    <th>Zip Code</th>
								                    <th>Flagged?</th>
								                    <th>Date Flagged</th>
							                    </tr>
			                            	<thead>
			                            		</tr>
					                                <th>name</th>
								                    <th>city</th>
								                    <th>state</th>
								                    <th>zip</th>
								                    <th>Flag</th>
								                    <th>dateFlag</th>
			                            		</tr>
			                        </thead>";
			                        echo "<tbody>";
	                        }
					}
				}
			}
	}			
?>