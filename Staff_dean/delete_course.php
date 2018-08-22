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
		$query1="DELETE from `course_catalog` where `Course_ID`='$course_id' and `Title`='$course_name' and `Dept_name`='$Dept_name' and `Credits`='$Credits' and `L-T-P`='$LTP' and `prerequisite1`='$prerequisite1'";
		$result1=mysql_query($query1);
	}
?>
