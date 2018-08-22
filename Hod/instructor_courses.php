<?php
    session_start();
    $username=$_SESSION["username"];
    echo '<div class="details">'.'You are logged in as '.'<a href="#">'.$username.' '.'</a>'.'<a href="delete_session.php">(Log out) </a></div>';
    if(isset($_POST['submit'])){
        $id=$_POST['ID'];
        require 'db_connect.php';
        $query1="Select Dept_Name from instructor where Ins_ID='$username'" ;
        $result1=mysql_query($query1);
        $row = mysql_fetch_array($result1); 
        $department=$row['Dept_Name'];
        echo $department;
        $query2="Select Ins_ID from instructor where Dept_Name='$department'" ;
        $result2=mysql_query($query2);
        $query3="Select * from all_courses_floated where Instructor_id='$id'";
        $result3=mysql_query($query3);
        while($row1 = mysql_fetch_array($result3)){
            echo $row1['Course_code'].' '.$row1['Course_name'].' '.$row1['Instructor_id'].' '.$row1['Credits'].' '.$row1['Slot'].' '.$row1['prerequisite'].' '.$row1['year'].' '.$row1['semester'].'<br>';
        }
    }
?>
