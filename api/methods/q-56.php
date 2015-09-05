<?php
//56 - Is there a Swagger API https scheme?

$reference = "";
$answer = 'no';
if(isset($SwaggerObject['schemes']))
	{
	foreach($SwaggerObject['schemes'] as $scheme)
		{
		if(strtolower($scheme)=='https')	
			{	
			$answer = 'yes';
			}
		}
	}	
?>