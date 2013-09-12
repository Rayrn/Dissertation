<?php
session_start(); 
if(!isset($_SESSION['name']))
	header("location:main_login.php");	//main_login.php is the login page
if($_SESSION['usertype'] != 1)
	header("StudentScreen.php"); //Sends non-admins to the student screen.
include 'DB_Connector.php';
include 'main.php';

// Initiate the connection
$connector = DTDB_Details();

if (isset($_POST['QNo']))
{
	if ($_POST['QNo'] > 0)
	{
		$ExamLength = $_POST['QNo'];
		
		unset($_SESSION['ExamLength']);
		$_SESSION['ExamLength'] = ($ExamLength);
	
		unset($_SESSION['QuestionNo']);
		$_SESSION['QuestionNo'] = (1);
	
		unset($_SESSION['Answers']);
		$_SESSION['Answers'] = array_fill(1, $ExamLength, 0);
	}
}

if(isset($_POST['examType']))
{
	if ($_POST['examType'] == 'topicExam')
	{
		if (isset($_POST['Topic']))
		{
			if ($_POST['Topic'] > 0)
			{
				$Topic = $_POST['Topic'];
				
				if(isset($ExamLength))
				{
					$Exam = RQFTGen($ExamLength, $Topic, $connector);
					
					unset($_SESSION['examType']);
					$_SESSION['examType'] = $_POST['examType'];
					
					unset($_SESSION['Topic']);
					$_SESSION['Topic'] = ($Topic);
					
					unset($_SESSION['Exam']);
					$_SESSION['Exam'] = ($Exam);
					
					header("location: exam.php");
					exit();
				}
			}
		}
	}	
	if($_POST['examType'] == 'randomExam')
	{
		if(isset($ExamLength))
		{
			$Exam = RQRTGen($ExamLength, $connector);
			unset($_SESSION['Exam']);
			$_SESSION['Exam'] = ($Exam);
			
			header("location:exam.php");
			exit();
		}
	}
}

if(isset($_POST['examType']))
{
	if($_POST['examType'] == 'topicExam')
	{
		header("location:topicExam.php");
		exit();
	}
	
	if($_POST['examType'] == 'randomExam')
	{
		header("location:randomExam.php");
		exit();
	}
}
else
{
	header("location:studentScreen.php");
	exit();
}
?>