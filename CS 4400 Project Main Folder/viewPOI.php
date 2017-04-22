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
			if($name || $city || $state || $zip || $check || $sDate || $eDate)
			{
				$result = $db->query("SELECT `Name`, `City`, `State`, `Zip_Code`,`Flag`, `Date_Flagged` FROM `poi`");
                    while($row = $result -> fetch_assoc())
                    {
                        if($name==$row['Name']||$city==$row['City']||$state==$row['State']||$zip==$row['Zip_Code']||$check==$row['Flag']|| (($dFlag=$row['Date_Flagged'] >= $sDate) && ($dFlag=$row['Date_Flagged'] <= $sDate)))
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