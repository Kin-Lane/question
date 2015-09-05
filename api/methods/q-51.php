<?php
//51 - Is there a Swagger API contact nae

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['info']['contact']))
	{
	if(count($SwaggerObject['info']['contact'])>0)
		{	
		$answer = 'yes';
		//$reference = $SwaggerObject['info']['contact'];
		}
	}
		
?>