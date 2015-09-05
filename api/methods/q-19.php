<?php
//19 - Is there a blog?
$t = 'x-blog';

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