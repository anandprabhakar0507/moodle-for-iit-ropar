<?php
	if(isset($_POST['submit'])){
		echo 'enter';
		require 'p1_connection.php';
		$username=$_POST["username"];
		$password=$_POST["password"];
		echo 'Username: '.$_POST["username"].' Password: '.$_POST["password"].'<br>';
		session_start();
		$query="Select * from instructor where Ins_ID ='$username' and Password = '$password'";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			$_SESSION['username']   = $username;
			header('Location: p1_ins_courses.php');
		}
		else{
			echo 'no';
		}
	}
	else{
		echo 'se';
	}
?>
<html>
	<body>
		<h1>Instructor Login</h1>
		<form action="p1_login.php" method="post">
			<b>UserName :<b> <input type="text" name="username">
			<br>
			<b>Password :<b> <input type="password" name="password">
			<br>
			<input type="submit" value="submit" name="submit">
		</form>
	</body>
</html>
