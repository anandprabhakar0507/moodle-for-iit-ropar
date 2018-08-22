<?php
    session_start();
    $username=$_SESSION["username"];
    echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
?>
<html>
    <head>
        <script src="js/jquery.min.js"></script>
        <script src="common.js"></script>
        <title>dashboard</title>
        <style>
            .details{
            float: right;
            padding: 0px;
            margin: 1px;
            }
            body {
            padding: 0 2em;
            font-family: Montserrat, sans-serif;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            color: #444;
            background: #eee;
            }
            h1 {
            font-weight: normal;
            letter-spacing: -1px;
            color: #34495E;
            }
        </style>
    </head>
    <body>
        <h1>Dashboard</h1>
        <button class="details" onclick="location.href = 'notifications.php';">Notifications</button>
        <button class="details" onclick="location.href = 'list_instructors.php';">List Instructors</button>
        <button class="details" onclick="location.href = 'course_catalog.php';">Course Catalog</button>
        <button class="details" onclick="location.href = 'current_courses.php';">Current Courses</button>
        <button class="details" onclick="location.href = 'list_students.php';">List Students</button>
    </body>
</html>