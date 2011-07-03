<?php
/**
 * CSS Editor custom header logo
 */


$site = elgg_get_site_entity();
$site_name = $site->name;

$logo = $vars['config']->site->customlogo;
$logo_time = $vars['config']->site->customlogo_time;
$logo_mime = $vars['config']->site->customlogomime;

if (empty($logo) || empty($logo_time) || empty($logo_mime)) {
?>

<h1>
	<a class="elgg-heading-site" href="<?php echo elgg_get_site_url(); ?>"><?php echo $site_name; ?></a>
</h1>

<?php
} else {
	$logo_ext = array_pop(explode('/', $logo_mime));
	$logo_url = "{$vars['url']}logo/$logo_time.$logo_ext";

	echo "<img class='custom_logo' src=\"$logo_url\" alt=\"" . htmlentities($vars['config']->sitename) . "\" />";
}
