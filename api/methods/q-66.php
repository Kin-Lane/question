<?php
//66 - Do all Swagger API response have references to definitions?

$answer = 'no';
$reference = "";
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
						if(is_array($value))
							{
							foreach($value as $key2 => $value2)
								{ 
								if($key2 == "schema")
									{
									$anyvalue=1;									
									}	
								}	
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
	
if($flag==0)
	{
	$answer = 'yes';
	}
else
	{
	$answer = 'no';	
	$reference = $pathinfo;	
	}

$pathinfo = "";					
?>