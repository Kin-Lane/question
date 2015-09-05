<?php
//57 - How many Swagger API paths are there?

$reference = "";
$count = 0;
if(isset($SwaggerObject['paths']))
	{
	$answer = count($SwaggerObject['paths']);
	}
		
?>