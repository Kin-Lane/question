<?php
//70 - How many Swagger API definitions are there?

$answer = "no";
$definitioncount = 0;
if(isset($SwaggerObject['definitions']))
	{
	$definitioncount = count($SwaggerObject['definitions']);
	}
if($definitioncount>0)
	{
	$answer = "yes";	
	}		
?>