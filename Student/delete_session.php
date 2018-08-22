<?php
    ob_start();
    session_start();
    setcookie('username',$username,time()-120);
    echo 'Logged out!!';
    session_destroy();
    header('Location:login_page.html');
?>