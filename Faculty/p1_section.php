<?php
	require 'p1_connection.php';
	$query="SELECT * FROM Section";
	if($sai=mysqli_query($con,$query)){
		echo "query executed<br>";
		while($query_execute=mysql_fetch_assoc($sai)){
			echo $query_execute['Course_ID'].'<br>';
		}
	}
	else{
		echo "query not executed";
	}
?>
