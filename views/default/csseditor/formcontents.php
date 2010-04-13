<?php echo elgg_view_title(elgg_echo('customlogo')); ?>
<div class="admin_settings customlogo">
<p class="margin_top">
<?php
	echo elgg_echo('customlogo:blurb');
?>
</p>
<?php 
	echo "<h3>".elgg_echo('customlogo:file') . "</h3>";
	echo "<p>".elgg_view('input/file',array('internalname' => 'logo', 'value' => $vars['config']->site->customlogo))."</p>";

	if (!empty($vars['config']->site->customlogo)) { ?>
		<p><label>
		<input type="checkbox" name="delete_logo" value="yes" />
		<?php echo elgg_echo('customlogo:delete'); ?>
		</label></p>
	<?php
	}
	echo elgg_view('input/securitytoken');
?>
<div class="divider"></div>
<input type="submit" value="<?php echo elgg_echo('csseditor:save'); ?>" />
</div>