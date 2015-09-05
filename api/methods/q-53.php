<?php
//53 - Is there a Swagger API host?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['host']))
	{
	if(strlen($SwaggerObject['host'])>3)
		{	
		$answer = 'yes';
		$reference = $SwaggerObject['host'];
		}
	}
		
?>