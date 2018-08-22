<?php
	ob_start();
	$username=$_POST['username'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$phone_number=$_POST['phone_number'];
	$phone_number=floatval($phone_number);
	$email=$_POST['email'];
	$department=$_POST['department'];
	$password1=$_POST['password'];
	$password=md5($password1);
	$checkbox=$_POST['checkbox'];	
	require 'db_connect.php';
	if($checkbox)
	setcookie('username',$username,time()+120);
	$query= "INSERT INTO `students` (`username`, `firstname`, `lastname`, `phone_number`, `email`, `department`, `password`) VALUES 
	('$username', '$firstname', '$lastname', '$phone_number', '$email', '$department', '$password')";
	//$query3= "SELECT food,calories FROM FOOD WHERE healthy_unhealthy='h'";
	mysql_query($query);
	echo("Success");
?>
