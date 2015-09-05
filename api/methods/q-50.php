<?php
//50 - Is there a Swagger API terms of service?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['info']['termsOfService']))
	{
	if(strlen($SwaggerObject['info']['termsOfService'])>3)
		{	
		$answer = 'yes';
		$reference = $SwaggerObject['info']['termsOfService'];
		}
	}
		
?>