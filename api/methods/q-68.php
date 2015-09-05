<?php
//68 - Do all Swagger API paths have security references??

$flag = 0;
if(isset($SwaggerObject['paths']))
	{
	$paths = $SwaggerObject['paths'];
	foreach($paths as $key => $value)
		{
		foreach($value as $key2 => $value2)
			{
			$pathinfo = $key . ' ' . strtoupper($key2);
			
			if(isset($value2['security']) && is_array($value2['security']))
				{
				if(count($value2['security']) == 0)
					{
					$A = array();
					$A['question_id'] = $question_id;
					$A['question'] = $question;
					$A['reference'] = $pathinfo;
					$A['answer'] = $answer;	
					$A['ask_date'] = $ask_date;
					array_push($ReturnObject[$api_name][$question_type], $A);	
					$answerit=0;				
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