<?php
//32 - Is there email for support?
$t = 'x-email';

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