<?php
$route = '/questions/:question_id/ask/organization/:organization_id/';
$app->get($route, function ()  use ($app){

	$ReturnObject = array();
	
 	$request = $app->request(); 
 	$param = $request->params();		

 	$appid = $param['appid'];
	$appkey = $param['appkey'];
	
	if(isset($param['organization_id'])){ $organization_id = $param['organization_id']; } else { $organization_id = 0;}
	if(isset($param['questions'])){ $questions = $param['questions']; } else { $questions = 0;}
	$question_array = array($question_id);

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
		// APIs.json		
		// ------------
					
		if($type=="APIs.json")
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
						$type = $QuestionResult['type'];
						}						
						
					include "q-" . $question_id . ".php";					
						
					if($type == 'APIs.json')
						{					
						$A = array();
						$A['question'] = $question;
						$A['reference'] = $reference;
						$A['answer'] = $answer;	
						array_push($ReturnObject, $A);
						}			
					}			
				}	
				
			// Have Swagger
			foreach($apis as $api)
				{
				foreach($api['properties'] as $property)
					{
					$type = $property['type'];
					$url = $property['url'];
					if($type=='Swagger')
						{
						
						$SwaggerText = file_get_contents($url);
						$SwaggerObject = json_decode($SwaggerText,true);
						
						$Swagger_Info_Title = $SwaggerObject['info']['title'];
						//echo $Swagger_Info_Title;
						
						foreach($question_array as $question_id)			
							{
													
							$question = "";
							$QuestionQuery = "SELECT title,type FROM question WHERE question_id = " . $question_id;
							$QuestionResults = mysql_query($QuestionQuery) or die('Query failed: ' . mysql_error());		
							if($QuestionResults && mysql_num_rows($QuestionResults))
								{
								$QuestionResult = mysql_fetch_assoc($QuestionResults);		
								$question = $QuestionResult['title'];
								$type = $QuestionResult['type'];
								}						
							
							include "q-" . $question_id . ".php";					
							
							//echo "question: " . $question . "<br />";
							//echo "answer: " . $answer . "<br />";
							
							if($type == 'Swagger')
								{													
								$A = array();
								$A['question'] = $question;
								$A['answer'] = $answer;	
								array_push($ReturnObject, $A);
								}
							}						
										
						}
					}	
				}				
																			
			}		
		
		} 
					
	//$ReturnObject['type'] = 'organization';			
	//$ReturnObject['organization_id'] = $organization_id;
	//$ReturnObject['question_id'] = $question_id;
	//$ReturnObject['answer'] = $answer;

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));
	
	});	
?>