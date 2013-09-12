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
if((isset($_POST['Topic'])) && (isset($_POST['QNo'])))
{
	if(($_POST['Topic'] > 0) && ($_POST['QNo'] > 0))
	{
		$Topic = $_POST['Topic'];
		$QNo = $_POST['QNo'];
		
		$count = FQFTGen($QNo, $Topic, $connector);
		
		if ($count[0] == -999)
		{
			$msg = ("Question does not exist.");
		}
		else
		{
			deleteQuestion($Topic, $QNo, $connector);
			
			$count = FQFTGen($QNo, $Topic, $connector);
			if ($count[0] == -999)
			{
				$msg = 'Question successfully removed from database.';
			}
			else
			{
				$msg = "Error, please try again.";
			}
		}
	}
	else
	{
			$msg = "Please select both a topic and question number.";
	}
}
else
{
	$msg = "Please select both a topic and question number.";
}
	
header("location: adminScreen.php?msg=".$msg);

?>