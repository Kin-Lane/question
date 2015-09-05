<?php
//67 - Does Swagger APIs have security definitions?

$answer = "no";
$count = 0;
//echo "isset: " . isset($SwaggerObject['securityDefinitions']) . "<br />";
if(isset($SwaggerObject['securityDefinitions']))
	{
	//echo "isset: " . count($SwaggerObject['securityDefinitions']) . "<br />";	
	if(count($SwaggerObject['securityDefinitions'])>0)
		{
		$answer = "yes";
		}
	}
		
?>