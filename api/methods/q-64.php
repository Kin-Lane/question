<?php
//64 - Do all Swagger APIs have 200 status codes?

$answer = 'yes';
$flag = 0;
if(isset($SwaggerObject['paths']))
	{
	$paths = $SwaggerObject['paths'];
	foreach($paths as $key => $value)
		{
		foreach($value as $key2 => $value2)
			{
				
			$pathinfo = $key . ' ' . strtoupper($key2);
			
			if(isset($value2['responses']) && is_array($value2['responses']))
				{
				if(count($value2['responses']) > 0)
					{
						
					$anyvalue = 0;
					
					foreach($value2['responses'] as $key => $value)
						{
						if(is_array($key)==false && trim($key)=='200')
							{
							$flag = 0;
							$reference = "";
							$anyvalue = 1;
							}												
						}
						
					if($anyvalue==0)
						{
						$A = array();
						$A['question_id'] = $question_id;
						$A['question'] = $question;
						$A['reference'] = $pathinfo;
						$A['answer'] = $answer;	
						$A['ask_date'] = $ask_date;
						array_push($ReturnObject[$api_name][$question_type], $A);	
						$answerit = 0;						
						}	
							
					}				
				}	
			}		
		}
	}

$pathinfo = "";				
?>