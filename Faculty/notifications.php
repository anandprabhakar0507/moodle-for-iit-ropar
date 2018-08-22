<?php
	require 'p1_connection.php';
	session_start();
	$username=$_SESSION['username'];
    $query1="Select * from notifications where teacher_id='$username'";
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