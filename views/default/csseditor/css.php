<?php
/**
 * Elgg custom css
 *
 * We apply the custom CSS at the both of elgg/css to override the default theme
 */

$custom_css = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'customcss',
	'limit' => 1,
));
if ($custom_css) {
	$custom_css = $custom_css[0];
}

// check to see if custom css is set to display
if ($custom_css->active == "yes") {

	//set variables
	$background = $custom_css->background;
	$background_image = $custom_css->background_image;
	$header_back = $custom_css->header_back;
	$header_image = $custom_css->header_image;
	$headers = $custom_css->headers;
	$links = $custom_css->links;
	$paragraph = $custom_css->paragraph;
	$extra = $custom_css->arbitrary_css;
	$header_repeat = $custom_css->header_repeat;
	$header_transparent = $custom_css->header_transparent;
	$background_repeat = $custom_css->background_repeat;

	// merge background work
	if ($background && $background_image) {
		if ($background_repeat == "yes") {
			$background = "#" . $background . " url(" . $background_image . ") repeat";
		} else {
			$background = "#" . $background . " url(" . $background_image . ") no-repeat";
		}
	} elseif (!$background && $background_image) {
		if ($background_repeat == "yes") {
			$background = "url(" . $background_image . ") repeat";
		} else {
			$background = "url(" . $background_image . ") no-repeat";
		}
	} elseif ($background) {
		$background = "#" . $background;
	}
/*
	// merge header work
	if ($header_transparent == "yes") {
		$header_back = "transparent";
	} else {
		if ($header_back && $header_image) {
			if ($header_repeat == "yes")
				$header_back = "#" . $header_back . " url(" . $header_image . ") repeat";
			else
				$header_back = "#" . $header_back . " url(" . $header_image . ") no-repeat";
		}elseif (!$header_back && $header_image) {
			if ($header_repeat == "yes")
				$header_back = "url(" . $header_image . ") repeat";
			else
				$header_back = "url(" . $header_image . ") no-repeat";
		}elseif ($header_back) {
			//$header_back = "#" . $header_back;
			$header_back_color_only = "#" . $header_back; // to preserve header shadow
		}
	}
*/


	if ($background) {
		echo <<<CSS
body {
	background: $background;
}
CSS;
	}
/*
	//header background set?
	if ($header_back) {
		if ($header_back_color_only) {
			?>
						#elgg_header {
							background-color:<?php echo $header_back_color_only; ?>;
						}
			<?php
		} else {
			?>
						#elgg_header {
							background:<?php echo $header_back; ?>;
						}
			<?php
		}
	}
	//headers set?
	if ($headers) {
		?>

					h1, h2, h3, h4, h5 {
						color:#<?php echo $headers; ?>;
					}

		<?php
	}

	//links set?
	if ($links) {
		?>

					a {
						color:#<?php echo $links; ?>;
					}

		<?php
	}

	//paragraph set?
	if ($paragraph) {
		?>

					p {
						color:#<?php echo $paragraph; ?>;
					}

		<?php
	}

	//extras?
	if ($extra)
		echo $extra;
 *
 */
}

?>


/* css rules for the plugins admin interface */
img.custom_logo {
	max-width: 300px;
	max-height: 60px;
}
