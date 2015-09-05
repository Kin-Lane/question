<?php
//20 - Is there a blog RSS feed?

$question = "";
$QuestionQuery = "SELECT title FROM question WHERE question_id = " . $question_id;
$QuestionResults = mysql_query($QuestionQuery) or die('Query failed: ' . mysql_error());		
if($QuestionResults && mysql_num_rows($QuestionResults))
	{
	$QuestionResult = mysql_fetch_assoc($QuestionResults);		
	$question = $QuestionResult['title'];
	}
	
$answer = false;	
	
foreach($apis as $api)
	{
	foreach($api['properties'] as $property)
		{
		$type = $property['type'];
		$url = $property['url'];
		//echo $type . "<br />";
		if(strtolower($type)=='x-portal')
			{
			$answer=true;	
			}
		}	
	}
	
$A = array();
$A['question'] = $question;
$A['answer'] = $answer;	
array_push($ReturnObject, $A);		
?>