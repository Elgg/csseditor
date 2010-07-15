<?php
/**
 * Elgg header logo
 * Override with custom logo if exists.
 **/
?>

<h1><a href="<?php echo $vars['url']; ?>">
<?php
	$logo = $vars['config']->site->customlogo;
	$logo_time = $vars['config']->site->customlogo_time;
	$logo_mime = $vars['config']->site->customlogomime;

	if (empty($logo) || empty($logo_time) || empty($logo_mime)) {
		echo "<span class='network_title'>" . $vars['config']->sitename . "</span>";
	} else {
		$logo_ext = array_pop(explode('/', $logo_mime));
		$logo_url = "{$vars['url']}pg/custom_logo/$logo_time.$logo_ext";
		
		echo "<img class='custom_logo' src=\"$logo_url\" alt=\"" . htmlentities($vars['config']->sitename) . "\" />";	
	}
?>
</a></h1>
