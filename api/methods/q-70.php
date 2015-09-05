<?php
//70 - How many Swagger API definitions are there?

$count = 0;
$answer = 0;
if(isset($SwaggerObject['definitions']))
	{
	if(is_array($SwaggerObject['definitions']))
		{
		$answer = count($SwaggerObject['definitions']);
		}		
	}
		
?>