<?php 
session_start();
session_destroy();

header("location:main_login.php"); //main_login.php is the login page   
?>