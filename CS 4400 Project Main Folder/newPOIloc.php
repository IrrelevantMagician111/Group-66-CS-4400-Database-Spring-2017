<?php
	
	 $name = $_POST['name'];
	 $city = $_POST['city'];
	 $state = $_POST['state'];
	 $zip = $_POST['zip'];
	$print_str = '';
	if(!strlen($name))
	{
		$print_str = '<p>Must choose a POI Loaction.</p>';
	}

	if(!get_magic_quotes_gpc())
	{

		$name = addslashes($name);
		$zip = addcslashes($zip);
	}	

	@   $db = new mysqli('localhost','root','password','cs4400');
			$connected = !mysqli_connect_errno();
			if($connected)
			{
				if(isset($_POST['filter']))
				{
					//if(!$name || !$zip || !$city || !$state)
					//{
					//	$print_str="<p>Enter All Fields.</p>";
						// redirect to original page
					//}

					//else
					{
						$result = $db->query("SELECT `Name` FROM `poi`");
						$num_results = $result->num_rows;

						for($i=0; $i < $num_results ;$i++)
						{
							//$row = $result->fetch_assoc();
							//if($name == $row[$name])
							//{
							//	$print_str="<p>Enter All Fields.</p>";
							//}

							//elseif($city == $row[$city] && $state == $row[$state]) // psuedocode
							//{
							//	$print_str="<p>Enter All Fields.</p>";
							//}

							//else
							{
								
								$query = "INSERT INTO poi (Name, Flag, Date_Flagged, Zip_Code, City, State)
								VALUES ('$name, '0', '0000-00-00', '$zip','$city', '$state')";	
							}
						}
					}
				}

			}



?>