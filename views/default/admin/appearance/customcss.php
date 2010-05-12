<?php

	/**
	 * Elgg custom css
	 * 
	 * @uses $vars['entity'] 
	 */
	 $custom_css = elgg_get_entities(array('type' => 'object', 'subtype' => 'customcss', 'limit' => 1));
	 foreach($custom_css as $var){
		 $custom_css = $var;
	 }
	 
	 //variables
	 $background = $custom_css->title;
	 $guid = $custom_css->guid;
	 $background_image = $custom_css->background_image;
	 $header = $custom_css->header_back;
	 $header_image = $custom_css->header_image;
	 $headers = $custom_css->headers;
	 $links = $custom_css->links;
	 $paragraph = $custom_css->paragraph;
	 $extra = $custom_css->description;
	 $turnon = $custom_css->turnon;
	 $header_repeat = $custom_css->header_repeat;
	 $header_transparent = $custom_css->header_transparent;
	 $background_repeat = $custom_css->background_repeat;
	 $action_path = $vars['url'] . "action/csseditor/edit";
	 

?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo $vars['url']; ?>mod/csseditor/vendors/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo $vars['url']; ?>mod/csseditor/vendors/js/colorpicker.js"></script>
<script type="text/javascript">
$(function(){
	$('#background').ColorPicker({
		onSubmit: function(hsb, hex, rgb) {
			$('#background').val(hex);
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	$('#header').ColorPicker({
		onSubmit: function(hsb, hex, rgb) {
			$('#header').val(hex);
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	$('#headers').ColorPicker({
		onSubmit: function(hsb, hex, rgb) {
			$('#headers').val(hex);
			fadeIn(500);
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	$('#links').ColorPicker({
		onSubmit: function(hsb, hex, rgb) {
			$('#links').val(hex);
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	$('#paragraph').ColorPicker({
		onSubmit: function(hsb, hex, rgb) {
			$('#paragraph').val(hex);
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	})
});
</script>

<div class="admin_settings csseditor">
<p class="margin_top"><?php echo elgg_echo('csseditor:warning'); ?></p>
<?php

	$form_body = "<h3>" . elgg_echo('csseditor:pagebackground') . "</h3>";
	$form_body .= "<p>" . elgg_echo('csseditor:backgroundcolor') . ":";
	$form_body .= elgg_view('input/text', array('internalname' => 'background', 'value' => $background, 'js' => 'id="background"')) . "</p>";
	$form_body .= "<p>" . elgg_echo('csseditor:backgroundimage') . ":";
	$form_body .= elgg_view('input/text', array('internalname' => 'background_image', 'value' => $background_image)) . "</p>";
	$form_body .= "<p>" . elgg_echo('csseditor:tileimage') . ": <br />" . elgg_view('input/radio', array(
															'internalname' => "background_repeat",
															'value' => $background_repeat,
															'options' => array('Yes', 'No')
															)) . "</p>";
	$form_body .= "<h3>" . elgg_echo('csseditor:headerbackground') . "</h3>";
	$form_body .= "<p>" . elgg_echo('csseditor:backgroundcolor') . ":";
	$form_body .= elgg_view('input/text', array('internalname' => 'header', 'value' => $header, 'js' => 'id="header"')) . "</p>";
	$form_body .= "<p>" . elgg_echo('csseditor:backgroundimage') . ":";
	$form_body .= elgg_view('input/text', array('internalname' => 'header_image', 'value' => $header_image)) . "</p>";
	$form_body .= "<p>" . elgg_echo('csseditor:tileimage') . ": <br />" . elgg_view('input/radio', array(
															'internalname' => "header_repeat",
															'value' => $header_repeat,
															'options' => array('Yes', 'No')
															)) . "</p>";
	$form_body .= "<p>" . elgg_echo('csseditor:transparentback') . ": ";
	$form_body .= elgg_view('input/checkboxes', array(
															'internalname' => "header_transparent",
															'value' => $header_transparent,
															'options' => array('Yes')
															)) . "</p>";
	$form_body .= "<h3>" . elgg_echo('csseditor:headers') . "</h3>";
	$form_body .= "<p>" . elgg_view('input/text', array('internalname' => 'headers', 'value' => $headers, 'js' => 'id="headers"')) . "</p>";
	$form_body .= "<h3>" . elgg_echo('csseditor:links') . "</h3>";
	$form_body .= "<p>" . elgg_view('input/text', array('internalname' => 'links', 'value' => $links, 'js' => 'id="links"')) . "</p>";
	$form_body .= "<h3>" . elgg_echo('csseditor:paragraph') . "</h3>";
	$form_body .= "<p>" . elgg_view('input/text', array('internalname' => 'paragraph', 'value' => $paragraph, 'js' => 'id="paragraph"')) . "</p>";
	$form_body .= "<h3>" . elgg_echo('csseditor:ownstyle') . "</h3>";
	$form_body .= "<p>" . elgg_view('input/plaintext', array('internalname' => 'extra', 'value' => $extra, 'class' => 'input_textarea monospace')) . "</p>";
	$form_body .= "<h3>" . elgg_echo('csseditor:activate') . "</h3>";
	$form_body .= elgg_view("input/pulldown",array(
							'internalname' => "turnon",
							'value' => $turnon,
							'options' => array('no', 'yes')
							)) . "</p>";
       
	$form_body .= elgg_view('input/securitytoken');
	$form_body .= elgg_view('input/hidden', array('internalname' => 'guid', 'value' => $guid));
	$form_body .= "<div class='divider'></div>";   
	$form_body .= elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('csseditor:save')));
?>

<?php
	echo elgg_view('input/form', array('action' => "{$action_path}", 'body' => $form_body, 'internalid' => 'customCSSForm'));
?>
</div>