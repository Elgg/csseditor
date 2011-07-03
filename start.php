<?php
/**
 * Online CSS editor
 */

elgg_register_event_handler('init', 'system', 'csseditor_init');

function csseditor_init() {

	elgg_register_page_handler('logo', 'csseditor_logo_page_handler');

	elgg_extend_view('css/elgg', 'csseditor/css');

	// disable (but keep) custom css when enabling a theme
	//register_elgg_event_handler('enable', 'plugin', 'csseditor_disable_plugin_hook');

	elgg_register_admin_menu_item('configure', 'customcss', 'appearance');
	elgg_register_admin_menu_item('configure', 'customlogo', 'appearance');

	$base = elgg_get_plugins_path() . 'csseditor/actions/csseditor';
	elgg_register_action('csseditor/edit', "$base/edit.php", 'admin');
	elgg_register_action('csseditor/save_logo', "$base/save_logo.php", 'admin');
}

/**
 * Serves custom logos
 *
 * @param $page
 */
function csseditor_logo_page_handler($page) {
	global $CONFIG;

	if (!array_key_exists(0, $page)) {
		exit;
	}

	$time = elgg_substr($page[0], 0, -4);

	if (empty($time)) {
		exit;
	}

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
		foreach ($split_output as $chunk) {
			echo $chunk;
		}
	}
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
