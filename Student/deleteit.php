<?php 
    require 'db_connect.php';
    $query10="lock tables `admin` write";
    mysql_query($query10);
    $query10="unlock tables";
    mysql_query($query10);
?>