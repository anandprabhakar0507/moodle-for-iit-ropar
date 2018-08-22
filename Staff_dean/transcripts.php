<?php
	session_start();
	$username=$_SESSION["username"];
	echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
	if(isset($_POST['submit'])){
		$stu_ID=$_POST["ID"];
		$semester=$_POST["sem"];
		if($stu_ID!=""){
			require 'p1_connection.php';
			$query1="Select student_id,course_id,grade from takes where student_id=$stu_ID and semester=$semester";
			$result1=mysql_query($query1);
			while ($row = mysql_fetch_array($result1)) {
				echo $row['student_id'] . $row['course_id'] . $row['grade'];
				}
			$query2="Select CGPA from students where username=$stu_ID";
			$result2=mysql_query($query2);
			echo "The CGPA IS ";
			echo $result2;
		}
	}
?>
