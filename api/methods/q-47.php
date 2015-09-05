<?php
//47 - Is there a Swagger API title?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['info']['title']))
	{
	if(strlen($SwaggerObject['info']['title'])>1)
		{	
		$answer = 'yes';
		$reference = $SwaggerObject['info']['title'];
		}
	}
		
?>