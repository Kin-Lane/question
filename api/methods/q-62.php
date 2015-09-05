<?php
//62 - Do all Swagger API paths have parameters?

$flag = 0;
if(isset($SwaggerObject['paths']))
	{
	$paths = $SwaggerObject['paths'];
	foreach($paths as $key => $value)
		{
		foreach($value as $key2 => $value2)
			{
			$pathinfo = $key . ' ' . strtoupper($key2);
			
			if(isset($value2['parameters']) && is_array($value2['parameters']))
				{
				if(count($value2['parameters']) > 0)
					{
					$anyvalue = 0;
					foreach($value2['parameters'] as $tag)
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
						$reference = $pathinfo;
						$flag = 1;							
						}		
					}
				else 
					{
					$answer = 'no';
					$reference = $pathinfo;
					$flag = 1;
					}				
				}
			else 
				{
				$answer = 'no';
				$reference = $pathinfo;
				$flag = 1;
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