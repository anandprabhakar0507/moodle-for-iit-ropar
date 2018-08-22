 <?php

	if($_POST['function_num']==1){
		require 'db_connect.php'; 
		session_start();
		$username=$_SESSION["username"];
		$query3= "SELECT * FROM `instructor` ORDER BY Dept_Name ASC";
		$query_handle=mysql_query($query3);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle)) {
			$picture = array(
			"Name" => $row['Name'],
			"Department"         => $row['Dept_Name'],
			"Address"          => $row['Address'],
			"Contact_No"          => $row['Contact_No'],
			"email"          => $row['email']
			);
			$pictures[] = $picture;
		}

		echo json_encode($pictures);
	
	}
	elseif($_POST['function_num']==2){
		require 'db_connect.php'; 
		session_start();
		$username=$_SESSION["username"];
		$query4= "SELECT * FROM `course_catalog` ORDER BY Dept_name ASC";
		$query_handle1=mysql_query($query4);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle1)) {
			$picture = array(
			"Course_ID" => $row['Course_ID'],
			"Title"         => $row['Title'],
			"Department"          => $row['Dept_name'],
			"Credits"          => $row['Credits'],
			"LTP"          => $row['L-T-P'],
			"Prerequisite"          => $row['prerequisite1']
				);
				$pictures[] = $picture;
		}
		echo json_encode($pictures);
	}
	elseif($_POST['function_num']==3){
			require 'db_connect.php'; 
		session_start();
		$username=$_SESSION["username"];
		$query1= "SELECT * FROM `course_offerings`";
		$query_handle2=mysql_query($query1);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle2)) {
		$picture = array(
		"Course_ID" => $row['Course_code'],
		"Title"         => $row['Course_name'],
		"Instructor_id"          => $row['Instructor_id'],
		"Credits"          => $row['Credits'],
		"LTP"          => $row['L-T-P'],
		"Slot"          => $row['Slot'],
		"Prerequisite"          => $row['prerequisite1']
			);
			$pictures[] = $picture;
		}

		echo json_encode($pictures);

	}

	elseif($_POST['function_num']==4){
			require 'db_connect.php'; 
		session_start();
		$username=$_SESSION["username"];
		$query10= "SELECT * FROM `students` ORDER BY department ASC";
		$query_handle10=mysql_query($query10);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle10)) {
			$adv_id=$row['advisor_id'];
		$query11= "SELECT Instructor_id FROM `advisor_table` where id='$adv_id'";
		$query_handle11=mysql_query($query11);
		$row2 = mysql_fetch_array($query_handle11);
		$picture = array(
		"firstname" => $row['firstname'],
		"lastname"         => $row['lastname'],
		"email"          => $row['email'],
		"phone_number"          => $row['phone_number'],
		"Department"          => $row['department'],
		"advisor_id"          => $row2['Instructor_id'],
		"cgpa"          => $row['CGPA'],
		"current_semester"          => $row['current_sem']
			);
			$pictures[] = $picture;
		}
		echo json_encode($pictures);
	}
?>
