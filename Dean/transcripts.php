<?php
	session_start();
	$username=$_SESSION["username"];
	echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
	if(isset($_POST['submit'])){
		$stu_ID=$_POST["ID"];
		$semester=$_POST["sem"];
		if($stu_ID!=""){
			require 'db_connect.php';
			$query1="Select student_id,Course_ID,grade from all_courses_taken where student_id='$stu_ID' and semester='$semester'";
			$result1=mysql_query($query1);
			while ($row = mysql_fetch_array($result1)) {
				echo $row['student_id'] .' '. $row['Course_ID'].' ' . $row['grade'].'<br>';
			}
			$query2="Select CGPA from students where username='$stu_ID'";
			$result2=mysql_query($query2);
			echo "The CGPA IS ";
			while ($row = mysql_fetch_array($result2)) {
				echo $row['CGPA'];
			}
		}
	}
?>
