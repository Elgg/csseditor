<?php
/**
 * Simple css editor
 **/
  
function csseditor_init() {
	// Load system configuration
	global $CONFIG;
	
	// Register a page handler, so we can have nice URLs
	register_page_handler('csseditor','csseditor_page_handler');
		
	// Extend system CSS with our own styles
	elgg_extend_view('css','csseditor/css');
	
	elgg_add_admin_submenu_item('customcss', elgg_echo('csseditor'), 'appearance');
	elgg_add_admin_submenu_item('customlogo', elgg_echo('customlogo'), 'appearance');
}

/**
 * Adding the custom css option to the admin menu
 *
 */
function csseditor_pagesetup() {
	if (get_context() == 'admin' && isadminloggedin()) {
		global $CONFIG;
		//add_submenu_item(elgg_echo('csseditor'), $CONFIG->wwwroot . 'pg/csseditor/customcss');
		//add_submenu_item(elgg_echo('customlogo'), $CONFIG->wwwroot . 'pg/csseditor/customlogo');
	}
}

/**
 * Custom css page handler
 *
 * @param array $page Array of page elements, forwarded by the page handling mechanism
 */
function csseditor_page_handler($page) {
	global $CONFIG;
	if($page[0] == 'customlogo'){
		//logo uploader
		include($CONFIG->pluginspath . "csseditor/customlogo.php");
	}elseif($page[0] == 'customcss'){
		// css editor
		include($CONFIG->pluginspath . "csseditor/edit.php");
	}else{
	
		if (!array_key_exists(0, $page)) {
			exit;
		}
		$time = str_replace('.jpg', '', $page[0]);
		if (empty($time)) {
			exit;
		}
		if ($time == $CONFIG->site->customlogo_time) {
			include("{$CONFIG->pluginspath}csseditor/sitelogo.php");
		}
		exit;
	}
}

function customlogo_page_handler($page) {
	global $CONFIG;
	if (!array_key_exists(0, $page)) {
		exit;
	}
	$time = str_replace('.jpg', '', $page[0]);
	if (empty($time)) {
		exit;
	}
	if ($time == $CONFIG->site->customlogo_time) {
		include("{$CONFIG->pluginspath}csseditor/sitelogo.php");
	}
	exit;
}
     
// Make sure the status initialisation function is called on initialisation
register_elgg_event_handler('init','system','csseditor_init');
register_elgg_event_handler('pagesetup','system','csseditor_pagesetup');

// Register some actions
register_action('csseditor/edit',false,$CONFIG->pluginspath . "csseditor/actions/edit.php");
register_action('csseditor/savelogo',false,$CONFIG->pluginspath . 'csseditor/actions/savelogo.php',true);
