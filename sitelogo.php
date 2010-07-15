<?php

require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
global $CONFIG;
$logo = $CONFIG->site->customlogo;
$mime = $CONFIG->site->customlogomime;
	
if (!empty($logo)) {
	$contents = file_get_contents($CONFIG->dataroot . 'logo/' . $logo);
	header('Expires: ' . date('r', time() + 60*60*24*7));
	header('Pragma: public');
	header('Cache-Control: public');
	header("Content-Disposition: inline; filename=\"{$logo}\"");
	header("Content-type: {$mime}");
	header("Content-Length: " . strlen($contents));
		
	$split_output = str_split($contents, 1024);
   	foreach($split_output as $chunk) {
       	echo $chunk; 
   	}
}
