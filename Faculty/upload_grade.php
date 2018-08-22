<?php
      if(isset($_POST['submit'])){
            require 'p1_connection.php';
            $course=$_POST['course'];
            $id=$_POST['student_id'];
            $grade=$_POST['grade'];
            $query10="lock tables `takes` write";
            mysql_query($query10);
            $query3="UPDATE takes SET grade='$grade' WHERE course_id='$course' and student_id='$id'";
            mysql_query($query3);
            $query10="unlock tables";
            mysql_query($query10);
      }
?>
