<?php

	$body = elgg_view('csseditor/formcontents');
	echo elgg_view('input/form',array(	'method' => 'post',
										'body' => $body,
										'enctype' => 'multipart/form-data',
										'action' => $vars['url'] . 'action/csseditor/save_logo'));

?>