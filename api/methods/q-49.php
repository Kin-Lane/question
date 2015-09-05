<?php
//49 - Is there a Swagger API version?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['info']['version']))
	{
	if(strlen($SwaggerObject['info']['version'])>1)
		{	
		$answer = 'yes';
		$reference = $SwaggerObject['info']['version'];
		}
	}
		
?>