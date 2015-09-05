<?php
$route = '/questions/';
$app->get($route, function ()  use ($app){

	$ReturnObject = array();

	if(isset($_REQUEST['query'])){ $query = $_REQUEST['query']; } else { $query = '';}
			
	if($query=='')
		{
		$Query = "SELECT * FROM question WHERE title LIKE '%" . $query . "%' OR details LIKE '%" . $query . "%'";
		}
	else 
		{
		$Query = "SELECT * FROM question";		
		}
		
	$Query .= " ORDER BY type,title ASC";
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
		
		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
		
	});
?>