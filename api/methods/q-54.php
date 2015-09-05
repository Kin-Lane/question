<?php
//54 - Is there a Swagger API base path?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['basePath']))
	{
	if(strlen($SwaggerObject['basePath'])>0)
		{	
		$answer = 'yes';
		$reference = $SwaggerObject['basePath'];
		}
	}
		
?>