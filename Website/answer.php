<?php
session_start(); 
if(!isset($_SESSION['name']))
  header("location:main_login.php");	//main_login.php is the login page
if(!isset($_SESSION['QuestionNo']) || !isset($_SESSION['ExamLength']) ||  !isset($_SESSION['Answers']))
	header("location:studentScreen.php");
	
$QuestionNo = $_SESSION['QuestionNo'];
$ExamLength = $_SESSION['ExamLength'];
$Answers = $_SESSION['Answers'];

if (isset($_POST['CorrectA']))
{

	$LastAnswer = $_POST['CorrectA'];
	$Answers[$QuestionNo] = $LastAnswer;
	$_SESSION['Answers'] = $Answers;
	
	$_SESSION['QuestionNo']++;
	$QuestionNo++;
	}

if ($QuestionNo  > $ExamLength)
{
	header("location: results.php");
}
else
{
	header("location: exam.php");
}
?>