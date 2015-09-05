<?php
//34 - Is there a knowledge base?
$t = 'x-knowledge-base';

$answer = 'no';	
	
foreach($apis as $api)
	{
	foreach($api['properties'] as $property)
		{
		$type = $property['type'];
		$url = $property['url'];
		if(strtolower($type)==$t)
			{
			
			$answer = 'yes';
			}
		}	
	}		
?>