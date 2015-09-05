<?php
//60 - Do all Swagger API paths have description?

$flag = 0;
if(isset($SwaggerObject['paths']))
	{
	$paths = $SwaggerObject['paths'];
	foreach($paths as $key => $value)
		{
		foreach($value as $key2 => $value2)
			{
			$pathinfo = $key . ' ' . strtoupper($key2);			
			if(is_array($value2['description']))
				{;
				if(strlen($value2['description']) > 1)
					{
							
					}
				else 
					{
					$answer = 'no';
					$A = array();
					$A['question'] = $question;
					$A['reference'] = $pathinfo;
					$A['answer'] = $answer;	
					$A['ask_date'] = $ask_date;
					array_push($ReturnObject[$api_name][$question_type], $A);	
					$flag = 1;
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
	}		
?>