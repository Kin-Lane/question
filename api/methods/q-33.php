<?php
//33 - Is there an FAQ section?
$t = 'x-faq';

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