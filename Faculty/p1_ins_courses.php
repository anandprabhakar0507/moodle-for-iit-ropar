<?php
	require 'p1_connection.php';
	session_start();
	$username=$_SESSION['username'];
	echo $username;
	$query1="Select * from course_offerings where Instructor_id='$username'";
	$result1=mysql_query($query1);
	$b="float_courses";
	echo("<form action='" . "p1_float_courses_try.php" . "' method='post'><input type='submit' name='username' value='floatcourses'></form>");
	echo("<form action='" . "notifications.php" . "' method='post'><input type='submit' name='notifications' value='Notifications'></form>");	
	if(mysql_num_rows($result1)>0){
		while($query_execute=mysql_fetch_assoc($result1)){
			$a=$query_execute['Course_code'];
			echo '<form method="post" action="p1_each_course.php">
			<input type="submit" name="course" value="' . $a . '">
			</form>';
		}
	}
	else{
		echo 'No courses taken';
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Dashboard</title>
	</head>
	<body>
		<button onclick="location.href = 'list_students.php';">List Students</button>
	</body>
</html>
