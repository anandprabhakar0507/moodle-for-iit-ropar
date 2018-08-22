<?php 
	ob_start();
	if($_POST['function_num']==1){
		require 'db_connect.php'; 
		$username=$_POST['username'];
		$password=$_POST['password'];
		$checkbox=$_POST['checkbox'];
		$query3= "SELECT username,password FROM students WHERE username='$username'";
		$query_handle=mysql_query($query3);
		session_start();
		$_SESSION["username"] = $username;
		if(mysql_num_rows($query_handle)==1){
			$reply=mysql_fetch_assoc($query_handle);
			$matched_password= $reply['password'];
			if($matched_password===$password){
				if($checkbox==1){		
					setcookie('username',$username,time()+120);
				}
				echo "Success";
			}
			else{
				echo 'Please check your password';
			}
		}
		else{
			echo 'error';
		}		
	}

	else if($_POST['function_num']==2){
		require 'db_connect.php'; 
		$username=$_POST['username'];
		$query3= "SELECT email FROM students WHERE username='$username'";
		$query_handle=mysql_query($query3);
		if(mysql_num_rows($query_handle)==1){
			$reply=mysql_fetch_assoc($query_handle);
			session_start();
			$_SESSION["email"] = $reply['email'];
			$_SESSION["username"] = $username;
			$_SESSION["check"]=1;
			echo "Success";
		}
		else{
			echo 'error';
		}
	}
?>

