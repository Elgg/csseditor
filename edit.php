<?php
/**
 * Elgg csseditor edit page
 */

// Load Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
		
admin_gatekeeper();
set_context('admin');
// Set admin user for user block
set_page_owner($_SESSION['guid']);
		
// title
$area1 = elgg_view_title(elgg_echo("csseditor"));
	    
//add form
$custom_css = elgg_get_entities(array('type' => 'object', 'subtype' => 'customcss', 'limit' => 1));
$area1 .= elgg_view('csseditor/edit', array('entity' => $custom_css));
	    
//select the correct canvas area
$body = elgg_view_layout("one_column_with_sidebar", $area1);
		
// Display page
page_draw(sprintf(elgg_echo('csseditor'),$page_owner->name),$body);