<?php
	session_start();
	$username=$_SESSION["username"];
	$course=$_POST['id'];
	require 'db_connect.php';
  	$query1 = "DELETE FROM takes where student_id='$username' AND course_id='$course'";
	mysql_query($query1);
	$query2 ="DELETE FROM all_courses_taken where student_id='$username' and course_ID='$course' and year=(select current_year from admin) and semester=(SELECT current_sem from students where username='$username')";
	mysql_query($query2);
	$query3 = "DELETE FROM notifications where student_id='$username' AND Course_code='$course'";
	mysql_query($query3);
?>