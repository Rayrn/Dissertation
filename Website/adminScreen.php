<!DOCTYPE html>
<html>
<head>
	<title>Admin Interface</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">

<?php
session_start(); 
if(!isset($_SESSION['name']))
	header("location:main_login.php");	//main_login.php is the login page
if($_SESSION['usertype'] == 0)
	header("location:studentScreen.php"); //Sends non-admins to the student screen.


include 'DB_Connector.php';
include 'main.php';

// Initiate the connection
$connector = DTDB_Details();

$tList = topicList ($connector);

if((isset($_POST['Topic'])) && (isset($_POST['QNo'])))
{
	$Topic = $_POST['Topic'];
	$QNo = (int) $_POST['QNo'];
}

if((isset($Topic)) && (isset($QNo)))
{
	$questionList = FQFTGen($QNo, $Topic, $connector);
	if ($questionList[0] == -999)
	{
		$msg = "Please select a valid topic and question number";
		header("location: adminScreen.php?msg=".$msg);
		exit();
	}
	else
	{	
		foreach ($questionList as $question)
		{
			$QText = $question[0]["QText"];
			$AText1 = $question[0]["AText1"];
			$AText2 = $question[0]["AText2"];
			$AText3 = $question[0]["AText3"];
			$AText4 = $question[0]["AText4"];
			$CorrectA = $question[0]["CorrectA"];
		}
	}
}

?>
</head>
<body>
<div class="container">
	<div class="floatL">
	<?php require_once('include_navigation.php'); ?>
	</div>
	<div class="floatR">
<?php
$msg = "";
if(isset($_GET['msg']))
{
	$msg = $_GET['msg'];
	echo "<h4 class='alert'>".$msg."</h4>";
	
	$msg = "";
}
?>

<h2>Please Select Existing Question</h2>
	<form action="" id="qData" name="questionData" method="post">
        <label>Please select the Topic:</label> 
        <select id = 'Topic' name = 'Topic' 
		<?php
			if(isset($Topic))
			{
				echo "value = ".$Topic.">";
			}
			else
			{
				echo "><option selected >Please Select A Topic</option>";
			}
				
			foreach ($tList as $topic)
			{
				echo "	<option value =".$topic['TopicID']."
						>".$topic['TopicName']."</option>";
			}
		?>>
        </select>
		<br>
    	<label for="QNo">Please Select Question Number:</label>  
  		<input type ="text" id="QNo" name="QNo"  value = "<?php
			if(isset($QNo))
			{
				echo $QNo;
			}
		?>">
		
		<label for="QText">Question Text</label>
		<textarea id="QText" name="QText" ><?php
			if(isset($QText))
			{
				echo $QText;
			}
		?></textarea>

        
        <label for="AText1">First Answer</label>
		<input type="text" id="AText1" name="AText1" value = "<?php
			if(isset($AText1))
			{
				echo $AText1;
			}
		?>">
        <span class="col2">
		<label for="Ans1">Correct Answer</label>
		<input type="radio" class="radio" name="CorrectA" id="Ans1" value="1"
		<?php
			if (isset($CorrectA) == true)
			{
				if ($CorrectA == 1)
				{
					echo "checked='CHECKED'";
				}
			}
		?> ></span>
	
        <label for="AText2">Second Answer</label>
		<input type="text" id="AText2" name="AText2" value = "<?php
			if(isset($AText2))
			{
				echo $AText2;
			}
		?>"   >
		<span class="col2">
        <label for="Ans2">Correct Answer</label>
		<input type="radio" class="radio" id="Ans2" name="CorrectA" value="2"
		<?php
		if (isset($CorrectA) == true)
			{
			if ($CorrectA == 2)
			{
				echo "checked='CHECKED'";
			}
		}
		?>></span>
	
        <label for="AText3">Third Answer</label>
		<input type="text" id="AText3" name="AText3" value = "<?php
			if(isset($AText3))
			{
				echo $AText3;
			}
		?>" >
		<span class="col2">
        <label for="Ans3">Correct Answer</label>
		<input type="radio" class="radio" id="Ans3" name="CorrectA" value="3"
		<?php
		if (isset($CorrectA) == true)
		{
			if ($CorrectA == 3)
			{
				echo "checked='CHECKED'";
			}
		}
		?>></span>

        <label for="AText4">Fourth Answer</label>
		<input type="text" id="AText4" name="AText4" value = "<?php
			if(isset($AText4))
			{
				echo $AText4;
			}
		?>"   >
		<span class="col2">
		<label for="Ans4">Correct Answer</label>
		<input name="CorrectA" id="Ans4" type="radio" class="radio" value="4"
		<?php
			if (isset($CorrectA) == true)
				{
				if ($CorrectA == 4)
				{
					echo "checked='CHECKED'";
				}
			}
		?>></span>
	
        <span class="_232">
        <label for="refresh">Refresh question details</label>
		<input type="radio" class="radio" id="refresh" name="proceed" onClick="javascript:changeFormAction('qData', this.value, 'proceed')" value="adminScreen.php">
        
        <label for="addnew">Add new question to database</label>
        <input type="radio" class="radio" id="addnew" name="proceed" onClick="javascript:changeFormAction('qData', this.value, 'proceed')" value="addQuestion.php">
        
        <label for="update">Save changes to question</label>
        <input type="radio" class="radio" id="update" name="proceed" onClick="javascript:changeFormAction('qData', this.value, 'proceed')" value="updateQuestion.php">
        
        <label for="delete">Delete question</label>
        <input type="radio" class="radio" id="delete" name="proceed" onClick="javascript:changeFormAction('qData', this.value, 'proceed')" value="deleteQuestion.php">
        </span>
        
        <input id="proceed" name="proceed" type="submit" disabled value="Continue">
        <div class="clear"></div>
	</form>
	</div>
</div>
</body>
</head>
</html>