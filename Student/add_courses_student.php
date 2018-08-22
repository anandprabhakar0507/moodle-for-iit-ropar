<?php
$data = json_decode(stripslashes($_POST['data']));
session_start();
$username=$_SESSION["username"];
$section_id='1';
$semester='spring';
$year=2018;
$grade=0;
$er=0;
require 'db_connect.php';
foreach($data as $d){
  $query1 = "SELECT * FROM course_offerings, takes WHERE student_id='$username' AND Course_code=course_id AND Slot IN (SELECT Slot FROM course_offerings where Course_code='$d')";
  $query_handle=mysql_query($query1);
  if(mysql_num_rows($query_handle)==0){
    $query= "INSERT INTO `takes` (`student_id`, `course_id`, `section_id`, `semester`, `year`, `grade`) VALUES 
  ('$username', '$d', '$section_id', (SELECT current_sem from students where username='$username'), (SELECT current_year from admin), '$grade')";
  mysql_query($query);
}
  else{
    $er=1;
  }
}
if($er==0){
  echo("Success");
}
?>