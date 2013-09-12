<!DOCTYPE html>
<html>
<head>
	<title>Random Exam</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">

<?php
session_start(); 
if(!isset($_SESSION['name']))
	header("location:main_login.php");	//main_login.php is the login page
 
include 'DB_Connector.php';
include 'main.php';

// Initiate the connection
$connector = DTDB_Details();

?>

</head>
<body>
<div class="container">
	<div class="floatL">
	<?php require_once('include_navigation.php'); ?>
	</div>
	<div class="floatR">
	<h2>Random Exam!</h2>
		<form action="" id="RQForm" name="RQForm" method="post">
			<strong>Please select the number of questions:</strong>
			<br>  
			<select onChange="javascript:changeFormAction('RQForm', 'examGenerator.php', 'proceed')" id='NoQuestions' name='QNo'
			<?php
				echo "><option selected >No of Questions...</option>";
				
				for($x=5; $x<51; $x=$x+5)
				{
					echo "	<option value =".$x.">".$x."</option>";
				}
			?>
			</select>
			<br>
			<br>
		<input id="proceed" name='proceed' type='submit' value='Start Exam'>
		<input name='examType' type='hidden' value='randomExam'>	
		</form>	
	</div>
</div>				
</body>
</html>