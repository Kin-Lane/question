<?php
//40 - Is there a rate limit page?
$t = 'x-rate-limit';

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