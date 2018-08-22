 <?php

	if($_POST['function_num']==1){
		require 'db_connect.php'; 
		session_start();
		$username=$_SESSION["username"];
		$query3= "SELECT * FROM course_offerings where Course_code NOT IN (SELECT course_id from takes where student_id='$username')";
		$query_handle=mysql_query($query3);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle)) {
			$picture = array(
			"Course_code" => $row['Course_code'],
			"Course_name"         => $row['Course_name'],
			"Instructor_id"          => $row['Instructor_id'],
			"Credits"          => $row['Credits'],
			"LTP"          => $row['L-T-P'],
			"Slot"       => $row['Slot'],
			"prerequisite1"       => $row['prerequisite1'],
			"cgpa_constraint"       => $row['cgpa_constraint'],
			"allowed_batches"       => $row['allowed_batches']
			);
			$pictures[] = $picture;
		}
		echo json_encode($pictures);
	}
	elseif($_POST['function_num']==101){
		require 'db_connect.php'; 
		$query3= "SELECT activate_course_registration from admin";
		$query_handle=mysql_query($query3);
		$row = mysql_fetch_array($query_handle);
		echo $row['activate_course_registration'];
	}
	elseif ($_POST['function_num']==10) {
		require 'db_connect.php'; 
		session_start();
		$username=$_SESSION["username"];
		$query3= "SELECT * FROM all_courses_taken where student_id='$username' and grade>0 ORDER BY semester";
		$query_handle=mysql_query($query3);
		$query4= "SELECT CGPA FROM students where username='$username'";
		$query_handle4=mysql_query($query4);
		$row4 = mysql_fetch_array($query_handle4);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle)) {
			$picture = array(
			"Student_id" => $row['student_id'],
			"Course_id"         => $row['Course_ID'],
			"Ins_id"          => $row['Ins_ID'],
			"Semester"          => $row['semester'],
			"Year"          => $row['year'],
			"Grade"       => $row['grade'],
			"CGPA"       => $row4['CGPA']
			);
			$pictures[] = $picture;
		}
		echo json_encode($pictures);	
	}
	else{
		require 'db_connect.php'; 
		session_start();
		$username=$_SESSION["username"];
		$query3= "SELECT * FROM takes where student_id='$username'";
		$query_handle=mysql_query($query3);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle)) {
			$course_co=$row['course_id'];
			$Semester=$row['semester'];
			$Grade=$row['grade'];
			$Year=$row['year'];
			$Status=$row['status'];
			$query4= "SELECT * FROM course_offerings where Course_code='$course_co'";
			$query_handle2=mysql_query($query4);
			while ($row2 = mysql_fetch_array($query_handle2)) {
				$picture = array(
				"Course_code" => $row2['Course_code'],
				"Course_name"         => $row2['Course_name'],
				"Instructor_id"          => $row2['Instructor_id'],
				"Credits"          => $row2['Credits'],
				"LTP"          => $row2['L-T-P'],
				"Slot"       => $row2['Slot'],
				"Semester"       => $Semester,
				"Grade"       => $Grade,
				"Year"       => $Year,
				"Status"       => $Status
				);
				$pictures[] = $picture;
			}
		}
		echo json_encode($pictures);
	}
?>
