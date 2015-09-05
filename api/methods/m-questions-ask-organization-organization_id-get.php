<?php
$route = '/questions/ask/organization/:organization_id/';
$app->get($route, function ($organization_id)  use ($app){

	$ReturnObject = array();
	
	$ask_date = date('Y-m-d H:i:s');
	
 	$request = $app->request(); 
 	$param = $request->params();		

 	$appid = $param['appid'];
	$appkey = $param['appkey'];
	
	if(isset($param['questions'])){ $questions = $param['questions']; } else { $questions = 0;}
	$question_array = explode(",",$questions);

	// Organization have Blog RSS URL
	$requestURL = "https://organization.api.kinlane.com:443/organization/" . $organization_id . "/urls/?appid=" . $appid . "&appkey=" . $appkey;	
	//echo $requestURL . "<br />";
	
	$http = curl_init();  
	curl_setopt($http, CURLOPT_URL, $requestURL);  
	curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);   
	
	curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
	
	$output = curl_exec($http);
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	$info = curl_getinfo($http);
	
	//var_dump($output);	
	$Objects = json_decode($output,true);		
	//var_dump($Objects);
	
	foreach($Objects as $Object)
		{
		$type = $Object['type'];
		$url = $Object['url'];
		
		// ------------
		// APIsJSON		
		// ------------
					
		if($type=="APIsJSON")
			{
				
			$ObjectText = file_get_contents($url);
			$ObjectResult = json_decode($ObjectText,true);	  				
			
			//var_dump($ObjectResult);
			
			$api_name = $ObjectResult['name'];
			$api_description = $ObjectResult['description'];
			$api_image = $ObjectResult['image'];
			$api_tags = $ObjectResult['tags'];			
			$api_created = $ObjectResult['created'];	
			$api_modified = $ObjectResult['modified'];				
							
			$apis = $ObjectResult['apis'];	
			
			foreach($apis as $api)			
				{
				foreach($question_array as $question_id)			
					{
											
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
							$ReturnObject[$question_type] = array();	
							}					
						}						
						
					include "q-" . $question_id . ".php";					
					
					if($question_type == 'APIsJSON')
						{					
						$A = array();
						$A['question'] = $question;
						$A['reference'] = $reference;
						$A['answer'] = $answer;	
						$A['ask_date'] = $ask_date;
						array_push($ReturnObject[$question_type], $A);
						}			
					}			
				}	
				
			// Have Swagger
			foreach($apis as $api)
				{
				foreach($api['properties'] as $property)
					{
					$swagger_type = $property['type'];
					$url = $property['url'];
					
					if(strtolower($swagger_type)=='swagger')
						{
						
						try
							{
							$SwaggerText = file_get_contents($url);
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
									if(!isset($ReturnObject[$question_type]))
										{
										$ReturnObject[$question_type] = array();	
										}
									}						
								
								include "q-" . $question_id . ".php";					
		
								if($question_type == 'Swagger')
									{													
									$A = array();
									$A['question'] = $question;
									$A['reference'] = $reference;
									$A['answer'] = $answer;	
									$A['ask_date'] = $ask_date;
									array_push($ReturnObject[$question_type], $A);
									}
								}						
							}
						catch (Exception $e)
							{}			
						}
					}	
				}																							
			}				
		} 
					
	// Bulk Update For Organization
	$Question_URL = "https://organization.api.kinlane.com/organization/" . $organization_id . "/questions/bulk/?appid=" . $appid . "&appkey=" . $appkey;
	//echo $Question_URL . "<br />";
	$http = curl_init();
	curl_setopt($http,CURLOPT_URL, $Question_URL);
	curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($http,CURLOPT_POST, 1);
	curl_setopt($http,CURLOPT_POSTFIELDS, format_json(json_encode($ReturnObject)));	
	curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
	
	$output = curl_exec($http);
	$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
	$info = curl_getinfo($http);
						
	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(trim(json_encode($ReturnObject))));
	
	});	
?>