<?php
//48 - Is there a Swagger API description?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['info']['description']))
	{
	if(strlen($SwaggerObject['info']['description'])>3)
		{	
		$answer = 'yes';
		$reference = $SwaggerObject['info']['description'];
		}
	}
		
?>