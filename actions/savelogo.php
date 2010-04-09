<?php

	action_gatekeeper();
	
	global $CONFIG;
	
	$delete = get_input('delete_logo');
	if ($delete == 'yes') {
		
		$CONFIG->site->customlogo = '';
		$CONFIG->site->customlogomime = '';
		$CONFIG->site->customlogo_time = '';
		
	}
	if (isset($_FILES['logo']) && $_FILES['logo']['error'] != 4) {
		
		$mime = array(	'image/gif' => 'gif',
						'image/jpg' => 'jpeg',
						'image/jpeg' => 'jpeg',
						'image/pjpeg' => 'jpeg',
						'image/png' => 'png');  
		
		if (array_key_exists($_FILES['logo']['type'],$mime) && $_FILES['logo']['error'] == 0) {

			if (!file_exists($CONFIG->dataroot . 'logo'))
				mkdir($CONFIG->dataroot . 'logo');
			
			$extension = $mime[$_FILES['logo']['type']];
			$filename = 'logo.' . $extension;
			move_uploaded_file($_FILES['logo']['tmp_name'],$CONFIG->dataroot . 'logo/' . $filename);
			
			$CONFIG->site->customlogo = $filename;
			$CONFIG->site->customlogomime = $_FILES['logo']['type'];
			$CONFIG->site->customlogo_time = time();
			
			system_message(elgg_echo('customlogo:success'));
			
		} else {
			
			register_error(elgg_echo('customlogo:failure'));
			
		}
		
	}
forward("pg/csseditor/customlogo");
