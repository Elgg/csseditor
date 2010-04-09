<?php
/**
 * Elgg custom css - edit
 */

// Make sure we're logged in (send us to the front page if not)
if (!isadminloggedin()) forward();

// Get input data
$background = get_input('background');
$background_image = get_input('background_image');
$header_back = get_input('header');
$header_image = get_input('header_image');
$headers = get_input('headers');
$links = get_input('links');
$paragraph = get_input('paragraph');
$extra = get_input('extra');
$turnon = get_input('turnon');
$previous_guid = get_input('guid');
$header_repeat = get_input('header_repeat');
$background_repeat = get_input('background_repeat');
$header_transparent = get_input('header_transparent');
		
// First delete the previous custom css
if($previous_guid)
	delete_entity($previous_guid);
		
// Initialise a new ElggObject
$customcss = new ElggObject();
			
// Tell the system it's a thewire post
$customcss->subtype = "customcss";
		
// Set its owner to the current user
$customcss->owner_guid = get_loggedin_userid();
			
// Set access to public for the css
$customcss->access_id = 2;
			
// Set its description appropriately
$customcss->title = $background;
$customcss->description = $extra;
$customcss->background_image = $background_image;
$customcss->header_back = $header_back;
$customcss->header_image = $header_image; 
$customcss->headers = $headers;
$customcss->links = $links;
$customcss->paragraph = $paragraph;
$customcss->turnon = $turnon;
$customcss->header_repeat = $header_repeat;
$customcss->header_transparent = $header_transparent;
$customcss->background_repeat = $background_repeat;
	        
//save
$save = $customcss->save();
		
//reboot simple cache
datalist_set('simplecache_lastupdate', 0);
   
// Success message
system_message(elgg_echo("csseditor:posted"));
	
// Forward 
forward("pg/csseditor/");