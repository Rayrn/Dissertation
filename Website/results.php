<!DOCTYPE html>
<html>
<head>
<title>Exam Results</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
<?php
session_start(); 
if(!isset($_SESSION['name']))
  header("location:main_login.php");	//main_login.php is the login page
if(!isset($_SESSION['Exam']) || !isset($_SESSION['QuestionNo']) || !isset($_SESSION['ExamLength']) || !isset($_SESSION['Answers']))
	header("location:studentScreen.php"); 
include 'DB_Connector.php';
?>
</head>
<body>

<div class="container">
	<div class="floatL">
	<?php require_once('include_navigation.php'); ?>
	</div>
	<div class="floatR">
	<h2>Results from Exam</h2>
		<?php
		$Exam = $_SESSION['Exam'];
		$questionNo = $_SESSION['QuestionNo'];
		$examLength = $_SESSION['ExamLength'];
		$answers = $_SESSION['Answers'];
		$control = 1;
		$noCorrect = 0;
		
		foreach ($Exam as $question)
		{
			if ($question[0]['CorrectA'] == $answers[$control])
			{
				echo "Question ".($control)." (QRef ".$question[0]['Topic'].".".$question[0]['QNo'].") was correct!<Br>";
				$noCorrect++;
			}
			else
			{
				echo "Question ".($control)." (QRef ".$question[0]['Topic'].".".$question[0]['QNo'].") was incorrect!<br>";
			}
			$control++;
		}
		echo "<br><br><h2>You got ".(100 / $examLength * $noCorrect)."% (".$noCorrect."/".$examLength.") correct.</h2>";
		
		if(isset($_SESSION['examType']))
		{
			if($_SESSION['examType'] == 'topicExam')
			{
				$connector = DTDB_Details();
				
				$query = $connector->prepare("Update studentdata SET Mark = '".$noCorrect."/".$examLength."' WHERE Username = '".$_SESSION['name']."' AND TopicID = '".$_SESSION['Topic']."'");
				$query->execute();
			}
		}
		
		unset($_SESSION['Exam']);
		unset($_SESSION['QuestionNo']);
		unset($_SESSION['ExamLength']);
		unset($_SESSION['Answers']);
		unset($_SESSION['examType']);
		unset($_SESSION['Topic']);
		?>
	</div>
</div>
</body>
</html>