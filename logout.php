<?php 
	session_start();
   	unset($_SESSION["user"]);
    echo 'You have cleaned session';
   	header('location: login_Boot.php');
?>