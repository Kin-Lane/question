<?php
$route = '/questions/:question_id/';
$app->get($route, function ($question_id)  use ($app){


	$ReturnObject = array();
		
	$Query = "SELECT * FROM question WHERE question_id = " . $question_id;
	//echo $Query . "<br />";
	
	$QuestionResult = mysql_query($Query) or die('Query failed: ' . mysql_error());
	  
	while ($Question = mysql_fetch_assoc($QuestionResult))
		{
			
		$question_id = $Question['question_id'];	
		$title = $Question['title'];
		$details = $Question['details'];
		$type = $Question['type'];
		
		// manipulation zone				
				
		$F = array();
		$F['question_id'] = $question_id;
		$F['title'] = $title;
		$F['details'] = $details;
		$F['type'] = $type;
		
		$ReturnObject = $F;
		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
	});
?>