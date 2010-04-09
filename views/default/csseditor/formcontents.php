<?php echo elgg_view_title(elgg_echo('customlogo')); ?>
<div class="contentWrapper">
<?php
	echo autop(elgg_echo('customlogo:blurb'));
?>
<p>
	<label>
		<?php 

			echo elgg_echo('customlogo:file') . "<br />";
			echo elgg_view('input/file',array('internalname' => 'logo', 'value' => $vars['config']->site->customlogo));
		
		?>
	</label>
</p>
<?php
	if (!empty($vars['config']->site->customlogo)) {
?>
<p>
	<label>
		<input type="checkbox" name="delete_logo" value="yes" />
		<?php echo elgg_echo('customlogo:delete'); ?>
	</label>
</p>
<?php
	}
	echo elgg_view('input/securitytoken');
?>
<p>
	<input type="submit" value="<?php echo elgg_echo('save'); ?>" />
</p>
</div>