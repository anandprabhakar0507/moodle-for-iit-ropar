<?php
	session_start();
	require 'db_connect.php';
	$username=$_SESSION['username'];
	$stat=0;
	$student_id=$_POST['test'];
	$course_id=$_POST['test2'];
	if(isset($_POST['accept'])){
		$query1="Update `notifications` set `status`=1 where `student_id`='$student_id' and `Course_code`='$course_id'";
		$q=mysql_query($query1);
	}
	elseif (isset($_POST['decline'])) {
		$query1="Delete from notifications where student_id='$student_id' and Course_code='$course_id'";
		$q=mysql_query($query1);
		$query2="Delete from takes where student_id='$student_id' and Course_id='$course_id'";
		$q2=mysql_query($query2);
	}
	else{
		header('Location: notifications.php');
	}
    header('Location: notifications.php');
?>