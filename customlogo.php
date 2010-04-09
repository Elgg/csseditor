<?php

// Load Elgg framework
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
// Only admins
admin_gatekeeper();
set_context('admin');
		
// View form
$body = elgg_view('csseditor/form');
		
// Layout
$body = elgg_view_layout("one_column_with_sidebar", $body);
	    
// Draw page
page_draw(elgg_echo('customlogo'),$body);