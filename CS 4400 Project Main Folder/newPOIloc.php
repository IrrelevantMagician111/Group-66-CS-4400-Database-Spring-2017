<?php
	
	$name = $_POST['name'];
	$zip = $_POST['zip'];

	if(!$name || !$zip )
	{
		echo 'Enter all details';
		exit;
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


				

			}



?>