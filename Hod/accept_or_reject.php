<?php
	session_start();
	require 'db_connect.php';
	$username=$_SESSION['username'];
	$stat=0;
	$student_id=$_POST['test'];
	$course_id=$_POST['test2'];
	if(isset($_POST['accept'])){
		$stat=1;
	}
	elseif (isset($_POST['decline'])) {
		$stat=0;
	}
	else{
		header('Location: notifications.php');
	}
	$query1="Update `notifications` set `status`='$stat' where `student_id`='$student_id' and `Course_code`='$course_id' and `teacher_id`='$username'";
	$q=mysql_query($query1);
	header('Location: notifications.php');
?>