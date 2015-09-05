<?php
//63 - Do all Swagger API paths have responses?

$flag = 0;
if(isset($SwaggerObject['paths']))
	{
	$paths = $SwaggerObject['paths'];
	foreach($paths as $key => $value)
		{
		foreach($value as $key2 => $value2)
			{
			$pathinfo = $key . ' ' . strtoupper($key2);
			
			if(is_array($value2['responses']))
				{
				if(count($value2['responses']) > 0)
					{
					$anyvalue = 0;
					foreach($value2['responses'] as $tag)
						{
						if($tag == '')
							{
								
							}
						else
							{
							$anyvalue = 1;	
							}
						}
					if($anyvalue==0)
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