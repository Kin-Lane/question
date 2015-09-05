<?php
//73 - Do all Swagger API definition properties have a type??

$property_count = 0;
if(isset($SwaggerObject['definitions']) && is_array($SwaggerObject['definitions']))
	{
	foreach($SwaggerObject['definitions'] as $key => $definition)
		{		
		if(isset($definition[$key]['properties']))
			{			
			$properties = $definition[$key]['properties'];			
			if(is_array($definition[$key]['properties']))
				{
				foreach($properties as $param_name => $param_fields)
					{						
					$pathinfo = $key . " - " . $param_name;
					if(isset($param_fields['type']))
						{
						
						}
					else 
						{									
						$answer = 'no';
						$A = array();
						$A['question'] = $question;
						$A['reference'] = $pathinfo;
						$A['answer'] = $answer;	
						$A['question'] = $question;
						$A['ask_date'] = $ask_date;
						array_push($ReturnObject[$api_name][$question_type], $A);	
						$flag = 1;							
						}
					}
				}
			}			
		}
	}
if($property_count>0)
	{
	$answer = '';
	}	
else
	{
	$answer = 'yes';
	}		
?>