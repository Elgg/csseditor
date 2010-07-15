<?php
/**
 * Simple css editor
 **/
  
function csseditor_init() {
	global $CONFIG;
	
	// admin page handler
	register_page_handler('csseditor', 'csseditor_page_handler');
	
	// custom logo page handler
	register_page_handler('custom_logo', 'csseditor_custom_logo_page_handler');
	
	// Extend system CSS with our own styles
	elgg_extend_view('css', 'csseditor/css');
	
	// disable (but keep) custom css when enabling a theme
	register_elgg_event_handler('enable', 'plugin', 'csseditor_disable_plugin_hook');
	
	elgg_add_admin_submenu_item('customcss', elgg_echo('csseditor'), 'appearance');
	elgg_add_admin_submenu_item('customlogo', elgg_echo('customlogo'), 'appearance');
}

/**
 * Custom css page handler
 *
 * @param array $page Array of page elements, forwarded by the page handling mechanism
 */
function csseditor_page_handler($page) {
	global $CONFIG;
	if ($page[0] == 'customlogo') {
		//logo uploader
		include($CONFIG->pluginspath . "csseditor/customlogo.php");
	} elseif($page[0] == 'customcss') {
		// css editor
		include($CONFIG->pluginspath . "csseditor/edit.php");
	}
}

/**
 * Serves pages for custom logos
 * 
 * @param $page
 */
function csseditor_custom_logo_page_handler($page) {
	global $CONFIG;
	
	if (!array_key_exists(0, $page)) {
		exit;
	}
	
	$time = elgg_substr($page[0], 0, -4);
	
	if (empty($time)) {
		exit;
	}
	
	if ($time == $CONFIG->site->customlogo_time) {
		include("{$CONFIG->pluginspath}csseditor/sitelogo.php");
	}
	
	exit;
}

/**
 * Detects when enabling a plugin and disables CSS.
 * Adds an admin notice to let people know to enable it if they want.
 * 
 * @param $event
 * @param $type
 * @param $params
 */
function csseditor_disable_plugin_hook($event, $type, $params) {
	global $CONFIG;
	
	$manifest = $params['manifest'];
	if (isset($manifest['category']) && in_array('theme', $manifest['category'])) {
		if ($custom_css_entities = elgg_get_entities(array('types' => "object", 'subtypes' => "customcss", 'limit' => 1))) {
			if ($custom_css_entities[0]->turnon == 'yes') {
				$custom_css_entities[0]->turnon = 'no';
				
				// include an admin notice
				$settings_link = $CONFIG->site->url . 'pg/admin/appearance/customcss';
				$message = sprintf(elgg_echo('csseditor:disabled_by_theme'), $manifest['name'], $settings_link);
				elgg_add_admin_notice('csseditor_disabled_by_theme', $message);
			}
		}
	}
	
	return NULL;
}
     
// Make sure the status initialisation function is called on initialisation
register_elgg_event_handler('init','system','csseditor_init');
register_elgg_event_handler('pagesetup','system','csseditor_pagesetup');

// Register some actions
register_action('csseditor/edit',false,$CONFIG->pluginspath . "csseditor/actions/edit.php");
register_action('csseditor/savelogo',false,$CONFIG->pluginspath . 'csseditor/actions/savelogo.php',true);
