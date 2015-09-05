<?php
//29 - Is there code samples?
$t = 'x-code-samples';

$answer = 'no';	
	
foreach($apis as $api)
	{
	foreach($api['properties'] as $property)
		{
		$type = $property['type'];
		$url = $property['url'];
		if(strtolower($type)==$t)
			{
			$reference = $url;
			$answer = 'yes';	
			}
		}	
	}		
?>