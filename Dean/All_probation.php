<?php
    session_start();
    $username=$_SESSION["username"];
    require 'db_connect.php'; 
    echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
    $query1="Select * from probation_students";
    $result1=mysql_query($query1);
    if(mysql_num_rows($result1)>0){
        while ($row = mysql_fetch_assoc($result1)) {
            echo $row['student_id'] . ', sgpa: '.$row['sgpa'].', semester' . $row['semester'].'<br>';
        }
    }
    else{
        echo 'No students';
    }
?>
