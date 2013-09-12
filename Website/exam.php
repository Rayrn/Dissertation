<!DOCTYPE html>
<html>
<head>
	<title>Student Exam</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
<?php
session_start(); 
if(!isset($_SESSION['name']))
  header("location:main_login.php");	//main_login.php is the login page
if(!isset($_SESSION['Exam']) || !isset($_SESSION['QuestionNo']) || !isset($_SESSION['ExamLength']))
	header("location:studentScreen.php");
	
include 'main.php';

$Exam = $_SESSION['Exam'];
$questionNo = $_SESSION['QuestionNo'];
$examLength = $_SESSION['ExamLength'];

if ($questionNo > $examLength)
{
	header("location: results.php");
	exit();
}

$control = 1;

foreach ($Exam as $question)
{
	if ($control == $questionNo)
	{
		$Topic = $question[0]['Topic'];
		$QNo = $question[0]['QNo'];
		$QText = $question[0]['QText'];
		$AText1 = $question[0]['AText1'];
		$AText2 = $question[0]['AText2'];
		$AText3 = $question[0]['AText3'];
		$AText4 = $question[0]['AText4'];
		$CorrectA = $question[0]['CorrectA'];
	}
	$control++;
}

?>
</head>
<body>
<div class="container">
	<div class="floatL">
	<?php require_once('include_navigation.php'); ?>
	</div>
	<div class="floatR">
	<h2>Question <?php echo ($questionNo); ?></h2>
	<p>QRef: <?php echo $Topic.".".$QNo; ?></p>
		<form action="answer.php" name="viewQuestion" method="post">
		<label for="QText">Question Text</label>
		<textarea id="QText" name="QText" readonly><?php echo $QText; ?></textarea>
		
		<label for="AText1">Answer 1</label>
		<textarea id="AText1" name="AText1" readonly><?php echo $AText1;?></textarea>
		<span class="col2">
		<label for="Ans1">Select Answer</label>
		<input type="radio" class="radio" id="Ans1" name="CorrectA" value="1" onClick="javascript:unlockElement('proceed')"></span>
		
		<label for="AText2">Answer 2</label>
		<textarea id="AText2" name="AText2" readonly><?php echo $AText2;?></textarea>
		<span class="col2">
		<label for="Ans2">Select Answer</label>
		<input type="radio" class="radio" id="Ans2" name="CorrectA" value="2" onClick="javascript:unlockElement('proceed')"></span>
		
		<label for="AText3">Answer 3</label>
		<textarea id="AText3" name="AText3" readonly><?php echo $AText3;?></textarea>
		<span class="col2">
		<label for="Ans3">Select Answer</label>
		<input type="radio" class="radio" id="Ans3" name="CorrectA" value="3" onClick="javascript:unlockElement('proceed')"></span>
		
		<label for="AText4">Answer 4</label>
		<textarea id="AText4" name="AText4" readonly><?php echo $AText4;?></textarea>
		<span class="col2">
		<label for="Ans4">Select Answer</label>
		<input type="radio" class="radio" id="Ans4" name="CorrectA" value="4"  onClick="javascript:unlockElement('proceed')"></span>
		
		<input id="proceed" name="proceed" type="submit" value="Next Question">
	</form>
	</div>
</div>
</body>
</head>
</html>