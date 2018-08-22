<?php 
	ob_start();
	if($_POST['function_num']==1){
		session_start();
		$email=$_SESSION["email"];
		$number = mt_rand(1000, 9999);
		$msg = "Your OTP: $number";
		$_SESSION["otp_num"]=$number;
		echo mail($email,"Password Recovery from Moodle",$msg);
	}
	else if($_POST['function_num']==2){
			session_start();	
			require 'db_connect.php'; 
			$otp=$_POST['otp'];
			$otp2=$_SESSION["otp_num"];
			$password=$_POST['password'];
			$username=$_SESSION["username"];
			$sql = "UPDATE students SET `password`='$password' WHERE `username`='$username'";
			$query_handle=mysql_query($sql);
			if(! $query_handle ) {
			die('Could not update data: ' . mysql_error());
			}
			echo "Success";
		}
?>
