<?php

//23 - Is there getting started information?
$t = 'x-getting-started';
	
$answer = 'no';	
	
foreach($apis as $api)
	{
	foreach($api['properties'] as $property)
		{
		$type = $property['type'];
		$url = $property['url'];
		if(strtolower($type)==strtolower($t))
			{
			$reference = $url;
			$answer = 'yes';
			}
		}	
	}	
?>