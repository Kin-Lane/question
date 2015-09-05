<?php
$route = '/questions/';	
$app->post($route, function () use ($app){

 	$request = $app->request(); 
 	$param = $request->params();			
	
	if(isset($param['title'])){ $title = $param['title']; } else { $title = ''; }
	if(isset($param['details'])){ $details = $param['details']; } else { $details = ''; }
	if(isset($param['type'])){ $type = $param['type']; } else { $type = ''; }		
	
  	$LinkQuery = "SELECT * FROM question WHERE title = '" . $title . "'";
	//echo $LinkQuery . "<br />";
	$LinkResult = mysql_query($LinkQuery) or die('Query failed: ' . mysql_error());
	
	if($LinkResult && mysql_num_rows($LinkResult))
		{	
		$Link = mysql_fetch_assoc($LinkResult);	
		
		$question_id = $Link['question_id'];
			
		$ReturnObject = array();												
		$ReturnObject['message'] = "Question Already Exists!";			
		$ReturnObject['question_id'] = $question_id;	
		
		}
	else 
		{				
			
		$query = "INSERT INTO question(";		
	
		
		if(isset($title)){ $query .= "title,"; } 
		if(isset($details)){ $query .= "details,"; }
		if(isset($type)){ $query .= "type,"; }
		
		$query .= "closing";
		
		$query .= ") VALUES(";		
		
		if(isset($title)){ $query .= "'" . mysql_real_escape_string($title) . "',"; } 
		if(isset($details)){ $query .= "'" . mysql_real_escape_string($details) . "',"; }
		if(isset($type)){ $query .= "'" . mysql_real_escape_string($type) . "',"; }  
		
		$query .= "'nothing'";
		
		$query .= ")";
		
		//echo $query . "<br />";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		$question_id = mysql_insert_id();
		
		$ReturnObject = array();												
		$ReturnObject['message'] = "Question Term Added";
		$ReturnObject['question_id'] = $question_id;	
					
		}

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));				

	});
?>