<?php
	session_start();
	$username=$_SESSION["username"];
	echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
	if(isset($_POST['submit'])){
		require 'db_connect.php'; 
		$course_id=$_POST["Course_ID"];
		$course_name=$_POST["Title"];
		$Dept_name=$_POST["Dept_name"];
		$Credits=$_POST["Credits"];
		$LTP=$_POST["LTP"];
		$prerequisite1=$_POST["prerequisite1"];
		$query10="lock tables `course_catalog` write";
		mysql_query($query10);
		$query1="INSERT into course_catalog values ('$course_id','$course_name','$Dept_name','$Credits','$LTP','$prerequisite1')";
		$result1=mysql_query($query1);
		$query10="unlock tables";
		mysql_query($query10);
	}
?>
