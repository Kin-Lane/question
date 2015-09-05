<?php
//Do all Swagger API definitions have properties?

$property_count = 0;
if(isset($SwaggerObject['definitions']))
	{
	foreach($SwaggerObject['definitions'] as $key => $definition)
		{
		if(isset($definition['properties']) && is_array($definition['properties']))
			{
			$property_count = count($definition['properties']);
			}			
		}
	}
if($property_count>0)
	{
	$answer = 'yes';
	}	
else
	{
	$answer = 'no';
	}		
?>