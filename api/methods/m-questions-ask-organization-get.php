<?php
$route = '/questions/ask/organization/';
$app->get($route, function ()  use ($app){

	$ReturnObject = array();
	
	$ask_date = date('Y-m-d H:i:s');
	
 	$request = $app->request(); 
 	$param = $request->params();		
	
	if(isset($param['apisjson_url'])){ $apisjson_url = $param['apisjson_url']; } else { $apisjson_url = '';}
	if(isset($param['questions'])){ $questions = $param['questions']; } else { $questions = 0;}
	
	$ReturnObject['apisjson_url'] = $apisjson_url;
	
	$question_array = explode(",",$questions);
	$ObjectText = file_get_contents($apisjson_url);
	$ObjectResult = json_decode($ObjectText,true);	  				
	
	if(isset($ObjectResult) && is_array($ObjectResult))
		{

		$api_json_name = $ObjectResult['name'];		
		
		$api_description = $ObjectResult['description'];
		$api_image = $ObjectResult['image'];
		$api_tags = $ObjectResult['tags'];			
		$api_created = $ObjectResult['created'];	
		$api_modified = $ObjectResult['modified'];				
						
		$apis = $ObjectResult['apis'];	
		
		foreach($apis as $api)			
			{
				
			$api_name = $api['name'];	
			if(isset($ReturnObject[$api_name]) && !is_array($ReturnObject[$api_name]))
				{
				$ReturnObject[$api_name] = array();				
				}
				
			foreach($question_array as $question_id)			
				{
					
				//echo $question_id . "<br />";	
							
				$question = "";
				$answer = "";
				$reference = "";
				
				$QuestionQuery = "SELECT title,type FROM question WHERE question_id = " . $question_id;
				$QuestionResults = mysql_query($QuestionQuery) or die('Query failed: ' . mysql_error());		
				if($QuestionResults && mysql_num_rows($QuestionResults))
					{
					$QuestionResult = mysql_fetch_assoc($QuestionResults);		
					$question = $QuestionResult['title'];
					$question_type = $QuestionResult['type'];					
					if(!isset($ReturnObject[$question_type]))
						{
						if(!isset($ReturnObject[$api_name][$question_type]))
							{							
							$ReturnObject[$api_name][$question_type] = array();
							}	
						}					
					}						

				if($question_type == 'APIsJSON')
					{					
					include "q-" . $question_id . ".php";					
									
					$A = array();
					$A['question'] = $question;
					$A['reference'] = $reference;
					$A['answer'] = $answer;	
					$A['ask_date'] = $ask_date;
					array_push($ReturnObject[$api_name][$question_type], $A);
					}			
				}			

			foreach($api['properties'] as $property)
				{
				$swagger_type = $property['type'];
				$url = $property['url'];
				
				if(strtolower($swagger_type)=='swagger')
					{
					
					//try
						//{
						$swagger_url = $url;	
						$SwaggerText = file_get_contents($swagger_url);
						$SwaggerObject = json_decode($SwaggerText,true);
						
						$Swagger_Info_Title = $SwaggerObject['info']['title'];
	
						foreach($question_array as $question_id)			
							{
													
							$question = "";
							$answer = "";
							$QuestionQuery = "SELECT title,type FROM question WHERE question_id = " . $question_id;
							$QuestionResults = mysql_query($QuestionQuery) or die('Query failed: ' . mysql_error());		
							if($QuestionResults && mysql_num_rows($QuestionResults))
								{
								$QuestionResult = mysql_fetch_assoc($QuestionResults);		
								$question = $QuestionResult['title'];
								$question_type = $QuestionResult['type'];
								
								if(!isset($ReturnObject[$api_name][$question_type]))
									{							
									$ReturnObject[$api_name][$question_type] = array();
									}	
								}						
							
							//echo $question_id . " - " . $question_type . "<br />";
							
							if($question_type == 'Swagger')
								{
								
								$answerit = 1;								
								include "q-" . $question_id . ".php";	
										
								if($answerit==1)
									{																															
									$A = array();
									$A['question_id'] = $question_id;
									$A['question'] = $question;
									$A['reference'] = $reference;
									$A['answer'] = $answer;	
									$A['ask_date'] = $ask_date;
									array_push($ReturnObject[$api_name][$question_type], $A);
									}
								}
							}						
						//}
					//catch (Exception $e)
						//{}			
					}
				}	
			}				 
		}

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));
	
	});	
?>