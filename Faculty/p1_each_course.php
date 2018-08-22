<?php
	require 'p1_connection.php';
	$id=$_POST["course"];
	$query1="Select student_id from takes where course_id='$id'";
     $result1=mysql_query($query1);
	while ($row = mysql_fetch_array($result1)) {
		echo ' <form action="upload_grade.php" method="post">
		<input type="hidden" name="course" value="' . $id . '">
		<input type="hidden" name="student_id" value="' . $row['student_id'] . '"> 
		<b>"' .$row["student_id"] .'":<b> <input type="number" min="0" max="10" step="1" name="grade">
		<input type="submit" value="submit" name="submit">
		</form>';
		echo '<br>';
	}
?>
