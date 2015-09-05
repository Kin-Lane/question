<?php
$route = '/questions/:question_id/';
$app->put($route, function ($question_id) use ($app){
	
 	$request = $app->request(); 
 	$param = $request->params();	
	
	if(isset($param['title'])){ $title = $param['title']; } else { $title = ''; }
	if(isset($param['details'])){ $details = $param['details']; } else { $details = ''; }
	if(isset($param['type'])){ $type = $param['type']; } else { $type = ''; }				

  	$LinkQuery = "SELECT * FROM question WHERE question_id = " . $question_id;
	//echo $LinkQuery . "<br />";
	$LinkResult = mysql_query($LinkQuery) or die('Query failed: ' . mysql_error());
	
	if($LinkResult && mysql_num_rows($LinkResult))
		{	
		$query = "UPDATE question SET ";

		if(isset($title))
			{
			$query .= "title='" . mysql_real_escape_string($title) . "'"; 
			} 
		if(isset($details))
			{
			$query .= ",details='" . mysql_real_escape_string($details) . "'"; 
			} 	
		if(isset($type))
			{
			$query .= ",type='" . mysql_real_escape_string($type) . "'"; 
			} 
					
		$query .= " WHERE question_id = " . $question_id;
		
		//echo $query . "<br />";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		$ReturnObject = array();												
		$ReturnObject['message'] = "Question Updated!";
		$ReturnObject['question_id'] = $question_id;			
					
		}
	else 
		{	
		$Link = mysql_fetch_assoc($LinkResult);	
			
		$ReturnObject = array();												
		$ReturnObject['message'] = "Question Doesn't Exist!";			
		$ReturnObject['question_id'] = $question_id;	
		
		}		

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));	
		
	});
?>