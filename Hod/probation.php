<?php
	session_start();
	$username=$_SESSION["username"];
	echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
	if(isset($_POST['submit'])){
		require 'db_connect.php'; 
		$semester=$_POST["sem"];
		$query1="Select * from probation_students where semester=$semester";
		$result1=mysql_query($query1);
		while ($row = mysql_fetch_array($result1)) {
			echo $row['student_id'] . ', sgpa: '.$row['sgpa'].', semester' . $row['semester'].'<br>';
		}
	}
?>
