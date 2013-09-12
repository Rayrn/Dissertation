<script>
function changeFormAction(formName, inputValue, unlockID)
{
	document.getElementById(formName).action = inputValue;
	document.getElementById(unlockID).disabled=0;
	document.getElementById(unlockID).className='active';
}

function unlockElement(unlockID)
{
	document.getElementById(unlockID).disabled=0;
	document.getElementById(unlockID).className='active';
}
</script>

<?php
// returns -999 no matches occur.
function Search ($connector, $select, $from, $where)
{
	$results = array();
	$query = $connector->prepare('SELECT ' . $select . ' FROM ' . $from . ' WHERE ' . $where);
	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC))
	{
		$results[] = $row;
	}
	
	if (empty($results))
		$results = -999;
	return $results;
}

// Function to return a random set of questions on random topics
function RQRTGen($noQuestions, $connector)
{
	$prevResults[] = 0;
	
	$query = $connector->prepare('SELECT * FROM questions');
	$query->execute();
	
	$count = $query->rowCount();
	
	if ($count < $noQuestions)
		$noQuestions = $count;
		
	$count = 0;
	$tList = topicList($connector);
	
	// While loop to output a pre-determined no of questions
	while ($count < $noQuestions)
	{
		$check = false;
		
		// Check to see if question has already been asked
		while($check == false)
		{
			shuffle($tList);
			$tNo = $tList[0]['TopicID'];
			
			$qList = questionList($connector,$tNo);
			shuffle($qList);
			$qNo = $qList[0]['QNo'];
		
			$check = QDone($tNo, $qNo, $prevResults);
		}		
		$prevResults[] = $tNo. ", " . $qNo;
		
		$results[] = Search($connector, '*', 'questions', 'Topic = ' . $tNo . ' and QNo = ' . $qNo);
		$count++;
	}
	
	return $results;
}

// Function to return a random set of questions on a fixed topic
function RQFTGen($noQuestions, $topic, $connector)
{
	$prevResults[] = 0;
	
	$query = $connector->prepare("SELECT * FROM questions WHERE Topic = '".$topic."'");
	$query->execute();
	
	$count=$query->rowCount();
	
	if ($count < $noQuestions)
		$noQuestions = $count;
		
	$count = 0;
	$qList = questionList($connector,$topic);
	
	// While loop to output a pre-determined no of questions
	while ($count < $noQuestions)
	{
		$check = false;
		
		// Check to see if question has already been asked
		while($check == false)
		{
			shuffle($qList);
			$qNo = $qList[0]['QNo'];;
		
			$check = QDone($topic, $qNo, $prevResults);
		}		
		$prevResults[] = $topic. ", " . $qNo;
		
		$results[] = Search($connector, '*', 'questions', 'Topic = ' . $topic . ' and QNo = ' . $qNo);
		$count++;
	}
	
	return $results;
}

// Function to return a specific question from a fixed topic
function FQFTGen($questionNo, $topic, $connector)
{
	$results[] = Search($connector, '*', 'questions', 'Topic = ' . $topic . ' and QNo = ' . $questionNo);

	return $results;
}

// Function to check if question has already been asked.
function QDone($tNo, $qNo, $prevResults)
{
	if (in_array(($tNo.", ".$qNo), $prevResults) == true)
		return false;
	return true;
}

// Insert into questions table query
function insertQuestion($Topic, $QNo, $QText, $AText1, $AText2, $AText3, $AText4, $CorrectA, $connector)
{
	$query = $connector->prepare("INSERT into questions VALUES
	(".$Topic.", ".$QNo.", '".$QText."', '"
	.$AText1."', '".$AText2."', '".$AText3."', 
	'".$AText4."', ".$CorrectA.")");
	$query->execute();
}

// Update questions table query
function updateQuestion($Topic, $QNo, $QText, $AText1, $AText2, $AText3, $AText4, $CorrectA, $connector)
{
	$query = $connector->prepare("Update questions SET
	QText = '".$QText."', 
	AText1 = '".$AText1."', AText2 = '".$AText2."', 
	AText3 = '".$AText3."', AText4 = '".$AText4."', 
	CorrectA = ".$CorrectA." WHERE Topic = '".$Topic."' AND QNo = '".$QNo."'");
	$query->execute();
}

// Delete from questions table query
function deleteQuestion($Topic, $QNo, $connector)
{
	$query = $connector->prepare("DELETE FROM questions 
	WHERE Topic = '".$Topic."' AND QNo = '".$QNo."'");
	$query->execute();
}

//  Function to return the full topic list table
function topicList($connector)
{
	$results = array();
	
	$query = $connector->prepare("SELECT * FROM topics");
	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC))
	{
		$results[] = $row;
	}

	return $results;
}

//  Function to return the full list of questions for a specific topic
function questionList($connector, $topic)
{
	$results = array();
	
	$query = $connector->prepare("SELECT * FROM questions WHERE topic = ".$topic);
	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_ASSOC))
	{
		$results[] = $row;
	}
	
	return $results;
}

// Prints the Array Result
function PAR($array)
{
	echo	"<table border=0>\n
			<tr>\n";
	
	foreach ($array[0] as $key => $control)
	{
	    echo "<th>$key</th>";
	}
	echo "</tr>";
	
	foreach ($array as $row)
	{
		echo "<tr>";
    	foreach ($row as $key => $val)
    	{
       	 	echo "<td>$val</td>";
   	 	}
    	echo "</tr>\n";
	}
	
	echo "</table>\n";
}
?>