 <?php
	session_start();
	$username=$_SESSION["username"];
	echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
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
		<br>
		<br>
		<button class="details" onclick="location.href = 'notifications.php';">Notifications</button>
		<button class="details" onclick="location.href = 'list_instructors.php';">List Instructors</button>
		<button class="details" onclick="location.href = 'course_catalog.php';">Course Catalog</button>
		<button class="details" onclick="location.href = 'current_courses.php';">Current Courses</button>
		<button class="details" onclick="location.href = 'list_students.php';">List Students</button>
		<button class="details" onclick="location.href = 'All_probation.php';">List Of Probation Students</button>
		<form action="instructor_courses.php" method="post"><br>
			<h3>Get courses of Instructor </h3>
			<br>
			<b>Instructor ID :<b> <input type="text" name="ID">
			<br>    
			<input type="submit" value="submit" name="submit">
		</form>
	</body>
</html>