<!DOCTYPE html>
<html>
<head>
	<title>Admin Interface</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">

<?php
session_start(); 
if(!isset($_SESSION['name']))
	header("location:main_login.php");	//main_login.php is the login page

include 'DB_Connector.php';
include 'main.php';

// Initiate the connection
$connector = DTDB_Details();

$user = Search($connector, "Username, TopicName as Topic, Mark", "studentdata, topics", "Username = '".$_SESSION['name']."' and studentdata.TopicID = topics.TopicID");

?>
</head>
<body>
<div class="container">
	<div class="floatL">
	<?php require_once('include_navigation.php'); ?>
	</div>
	<div class="floatR">
<h2>Results for <?php echo $_SESSION['name'] ?>, sorted by Category</h2>
<?php PAR($user); ?>
	</div>
</div>
</body>
</html>