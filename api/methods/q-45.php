<?php
//44 - Is there a terms of service?
$t = 'x-terms-of-service';

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