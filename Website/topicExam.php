<!DOCTYPE html>
<html>
<head>
	<title>Topic Exam </title>
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
	<h2>Please choose a topic!</h2>
	<form action="examGenerator.php" id="RQForm" name="RQForm" method="post">
		<strong>Please select the Topic:</strong>
        <br>  
		<select id='Topic' name='Topic'
		<?php
			$tList = topicList ($connector);
			
			echo "><option selected >Topic Options...</option>";
			
			foreach ($tList as $topic)
			{
				echo "	<option value =".$topic['TopicID']."
						>".$topic['TopicName']."</option>";
			}
		?>
        </select>
		<br>
		<br>
		<strong>Please select the number of questions:</strong>
        <br>  
		<select id='QNo' name = 'QNo'
		<?php
			echo "><option selected >No of Questions...</option>";
			
			for($x=1; $x<9; $x++)
			{
				echo "<option value =".$x.">".$x."</option>";
			}
		?>
        </select>
		<br>
		<br>
		<input id="proceed" class="active" name='proceed' type='submit' value='Start Exam'>
		<input id="proceed" class="active" name='examType' type='hidden' value='topicExam'>
	</form>
	</div>
</div>			
</body>
</html>