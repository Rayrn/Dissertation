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

if (isset($_POST['Topic'])
&& isset($_POST['QNo'])
&& isset($_POST['QText'])
&& isset($_POST['AText1'])
&& isset($_POST['AText2'])
&& isset($_POST['AText3'])
&& isset($_POST['AText4'])
&& isset($_POST['CorrectA']))
{
	$Topic = $_POST['Topic'];
	$QNo = $_POST['QNo'];
	$QText = $_POST['QText'];
	$AText1 = $_POST['AText1'];
	$AText2 = $_POST['AText2'];
	$AText3 = $_POST['AText3'];
	$AText4 = $_POST['AText4'];
	$CorrectA = $_POST['CorrectA'];
	
	insertQuestion($Topic, $QNo, $QText, $AText1, $AText2, $AText3, $AText4,$CorrectA, $connector);
	
	$check = FQFTGen($Topic, $QNo, $connector);
	if ($check[0] != -999)
	{
		$msg = 'Question successfully added to database.';
	}
	else
	{
		$msg = ("Question was NOT added");
	}
}
else
{
	$msg = "All fields must be completed to proceed.";
}

header("location: adminScreen.php?msg=".$msg);
?>