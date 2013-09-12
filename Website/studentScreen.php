<!DOCTYPE html>
<html>
<head>
	<title>Student Information</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">

<?php
session_start(); 
if(!isset($_SESSION['name']))
	header("location:main_login.php");	//main_login.php is the login page

include 'main.php';

?>
</head>


<body>
<div class="container">
	<div class="floatL">
	<?php require_once('include_navigation.php'); ?>
	</div>
	<div class="floatR">
	<h2>Please choose from the following options:</h2>
		<form action="" id="options" name="options" method="post">
			<label>A exam made of of random questions, from random topics</label>
			<input class="radio" type="radio" name="proceed" onClick="javascript:changeFormAction('options', this.value, 'proceed')" value="randomExam.php">
			<label>A exam made of of random questions, from a chosen topic</label>
			<input class="radio" type="radio" name="proceed" onClick="javascript:changeFormAction('options', this.value, 'proceed')" value="topicExam.php">
			<label>View your past results (sorted by topic)</label>
			<input class="radio" type="radio" name="proceed" onClick="javascript:changeFormAction('options', this.value, 'proceed')" value="pastResults.php">
			
			
			<input id="proceed" name="proceed" type="submit" disabled value="Continue">   
		</form>
	</div>
</div>
</body>
</html>