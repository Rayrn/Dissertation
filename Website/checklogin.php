<?php
session_start();

include 'DB_Connector.php';

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

// encrypts password
$myencryptedpassword= md5($mypassword);

$connector = DTDB_Details();
$query = $connector->prepare("SELECT * FROM logins WHERE Username =  '". $myusername . "' and Password = '" . $myencryptedpassword . "'");
	$query->execute();

// Check User Type
foreach ($query as $row)
{
	$myusertype=$row['UserType'];
}

// Counting table row(s)
$count=$query->rowCount();

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
	// Register $myusername, $mypassword and redirect to file "login_success.php"
	$_SESSION['name'] = ($myusername);
	$_SESSION['usertype'] = ($myusertype);
	if ($_SESSION['usertype']==1)
	{
		header("location:adminScreen.php");
	}
	else
	{
		header("location:studentScreen.php");
	}
	
}
else
{
	header("location:main_login.php");
}
?>