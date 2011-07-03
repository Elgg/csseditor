<?php
/**
 * Elgg custom css - edit
 */

// Get input data
$previous_guid = get_input('guid');
$background = get_input('background');
$background_image = get_input('background_image');
$header_back = get_input('header');
$header_image = get_input('header_image');
$headers = get_input('headers');
$links = get_input('links');
$paragraph = get_input('paragraph');
$extra = get_input('extra');
$turnon = get_input('turnon');
$header_repeat = get_input('header_repeat');
$background_repeat = get_input('background_repeat');
$header_transparent = get_input('header_transparent');

// First delete the previous custom css
if ($previous_guid) {
	delete_entity($previous_guid);
}

$customcss = new ElggObject();
$customcss->subtype = "customcss";
$customcss->owner_guid = elgg_get_logged_in_user_guid();
$customcss->access_id = ACCESS_PUBLIC;
$customcss->background = $background;
$customcss->arbitrary_css = $extra;
$customcss->background_image = $background_image;
$customcss->header_back = $header_back;
$customcss->header_image = $header_image;
$customcss->headers = $headers;
$customcss->links = $links;
$customcss->paragraph = $paragraph;
$customcss->header_repeat = $header_repeat;
$customcss->header_transparent = $header_transparent;
$customcss->background_repeat = $background_repeat;
$customcss->active = $turnon;
$save = $customcss->save();

elgg_regenerate_simplecache();
elgg_delete_admin_notice('csseditor_disabled_by_theme');

system_message(elgg_echo("csseditor:posted"));

forward(REFERER);
