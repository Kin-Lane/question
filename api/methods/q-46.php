<?php
//46 - Is there a Swagger definition?

$answer = 'no';
if(isset($SwaggerObject) && is_array($SwaggerObject))
	{	
	$answer = 'yes';
	$reference = $swagger_url;
	}
		
?>