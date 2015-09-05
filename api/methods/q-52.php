<?php
//52 - Is there a Swagger API license?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['license']))
	{
	if(count($SwaggerObject['license'])>0)
		{	
		$answer = 'yes';
		}
	}
		
?>