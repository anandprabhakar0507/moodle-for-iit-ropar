<?php
	require 'db_connect.php';
	session_start();
	$username=$_SESSION['username'];
	echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
	$query1="Select * from notifications where teacher_id='$username' and status=0";
	$result1=mysql_query($query1);
	if(mysql_num_rows($result1)>0){
		$co=1;
		while($query_execute=mysql_fetch_assoc($result1)){
			$test=$query_execute['student_id'];
			$test2=$query_execute['Course_code'];
			echo $co.') '.$query_execute['student_id'].' has raised a ticket for ' .$query_execute['Course_code'].' on '.$query_execute['Timestamp']. '. Description: '.$query_execute['Description'];
			echo '<form method="post" action="accept_or_reject.php">
			<input type="hidden" name="test" value="' . $test . '">
			<input type="hidden" name="test2" value="' . $test2 . '">
			<input type="submit" name="accept" value="accept">
			<input type="submit" name="decline" value="decline">
			</form>';
			$co=$co+1;
		}
	}
	else{
		echo 'No notifications';
	}
?>

<html>
	<head>
		<script src="js/jquery.min.js"></script>
		<script src="common.js?v=2"></script>
		<title>dashboard</title>
		<style>
			.details{
			float: right;
			padding: 0px;
			margin: 1px;
			}
		</style>
	</head>
	<body>
	</body>
</html>