<?php
	session_start();
	$username=$_SESSION["username"];
	$course_code=$_POST['course_code'];
	$title=$_POST['title'];
	$department=$_POST['department'];
	$credits=$_POST['credits'];
	$ltp=$_POST['ltp'];
	$prerequisite=$_POST['prerequisite'];
	$slot=$_POST['slot'];
	$max_student=$_POST['max_students'];
	 $max_students=intval($max_student);
	$allowed_batches=$_POST['allowed_batches'];
	$cgpa=$_POST['cgpa_constraint'];
	 $cgpa_constraint=floatval($cgpa);
	$curr=0;
	require 'p1_connection.php';
	$query10="lock tables `course_offerings` write";
    mysql_query($query10);
	$query= "INSERT INTO `course_offerings` VALUES 
	('$course_code', '$title', '$username', '$credits', '$ltp', '$slot', '$prerequisite', '$max_students','$curr','$cgpa_constraint' , '$allowed_batches')";
	$query_set = mysql_query($query) or die(mysql_error());
	$query10="unlock tables";
    mysql_query($query10);
?>