<?php
//session_start();
//$mysqli = new mysqli('localhost', 'root', '')

#if(isset($_POST['Create']) == TRUE){

	#$username = mysql_real_escape_string($_POST['username']);
	#	echo $username;
	#$Email = mysql_real_escape_string($_POST['Email']);
	$Password = mysql_real_escape_string($_POST['Password']);
	#echo $Password;
	$Cpassword = mysql_real_escape_string($_POST['Confirm Password']);
	#echo $Cpassword;
	if($password = $Cpassword) {
		$sqluname = mysql_query("SELECT * FROM 'users' WHERE 'username' = '$username");
		if*mysql_num_rows($sql = 0){
			$sqlemail = mysql_query("SELECT * FROM 'Email Address' WHERE 'Email Address' = '$email");
			if*mysql_num_rows($sql = 0)
				echo "registration successful";
		}
		else 
			echo "username is already taken";
	}
	else
		echo "passwords do not match";
}


?>

