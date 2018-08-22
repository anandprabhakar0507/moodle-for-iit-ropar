<?php
	ob_start();
	session_start();
	if(isset($_COOKIE['username'])||($_SESSION["username"]!="")){
		header('Location: dashboard1.php');
	}
	elseif ($_SESSION["username"]!="") {
		# code...
	}
	else{
		header('Location:login_page.html');
	}
?>