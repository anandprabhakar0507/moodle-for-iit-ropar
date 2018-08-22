 <?php
	if($_POST['function_num']==1){
		require 'p1_connection.php';
		session_start();
		$username=$_SESSION["username"];
		$query3= "SELECT * FROM course_catalog";
		$query_handle=mysql_query($query3);
		$pictures = array();
		while ($row = mysql_fetch_array($query_handle)) {
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
?>
