<?php
$route = '/questions/:question_id/tags/';
$app->post($route, function ($question_id)  use ($app){


	$ReturnObject = array();
		
 	$request = $app->request(); 
 	$param = $request->params();	
	
	if(isset($param['tag']))
		{
		$tag = trim(mysql_real_escape_string($param['tag']));
			
		$ChecktagQuery = "SELECT tag_id FROM tags where tag = '" . $tag . "'";
		$ChecktagResults = mysql_query($ChecktagQuery) or die('Query failed: ' . mysql_error());		
		if($ChecktagResults && mysql_num_rows($ChecktagResults))
			{
			$tag = mysql_fetch_assoc($ChecktagResults);		
			$tag_id = $tag['tag_id'];
			}
		else
			{

			$query = "INSERT INTO tags(tag) VALUES('" . $tag . "'); ";
			mysql_query($query) or die('Query failed: ' . mysql_error());	
			$tag_id = mysql_insert_id();			
			}

		$ChecktagPivotQuery = "SELECT * FROM question_tag_pivot where tag_id = " . trim($tag_id) . " AND question_id = " . $question_id;
		$ChecktagPivotResult = mysql_query($ChecktagPivotQuery) or die('Query failed: ' . mysql_error());
		
		if($ChecktagPivotResult && mysql_num_rows($ChecktagPivotResult))
			{
			$ChecktagPivot = mysql_fetch_assoc($ChecktagPivotResult);		
			}
		else
			{
			$query = "INSERT INTO question_tag_pivot(tag_id,question_id) VALUES(" . $tag_id . "," . $question_id . "); ";
			mysql_query($query) or die('Query failed: ' . mysql_error());					
			}

		$F = array();
		$F['tag_id'] = $tag_id;
		$F['tag'] = $tag;
		$F['question_count'] = 0;
		
		array_push($ReturnObject, $F);

		}		

		$app->response()->header("Content-Type", "application/json");
		echo stripslashes(format_json(json_encode($ReturnObject)));
	});	
?>