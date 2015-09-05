<?php
$route = '/questions/:question_id/';
$app->delete($route, function ($question_id) use ($app){
	
	$ReturnObject = array();

	$query = "DELETE FROM question WHERE question_id = " . $question_id;
	//echo $query . "<br />";
	mysql_query($query) or die('Query failed: ' . mysql_error());	

	$ReturnObject = array();												
	$ReturnObject['message'] = "Question Deleted!";			
	$ReturnObject['question_id'] = $question_id;	

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));	

	});	
?>