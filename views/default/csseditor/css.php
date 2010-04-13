<?php

	/**
	 * Elgg custom css
	 * 
	 * This let's users change the body background, header background, 
	 * headers, links and paragraphs as well as free form
	 * 
	 */
	 
	$get_custom = get_entities("object", "customcss", 0, "", 1);
	 
	if($get_custom){
	 	foreach($get_custom as $custom){
		 	$custom_css = $custom;
	 	}
 	}
	 
	 //check to see if custom css is set to display
	 if($custom_css->turnon == "yes"){
		 
		 //set variables
		 $background = $custom_css->title;
		 $background_image = $custom_css->background_image;
		 $header_back = $custom_css->header_back;
		 $header_image = $custom_css->header_image;
		 $headers = $custom_css->headers;
		 $links = $custom_css->links;
		 $paragraph = $custom_css->paragraph;
		 $extra = $custom_css->description;
		 $header_repeat = $custom_css->header_repeat;
		 $header_transparent = $custom_css->header_transparent;
		 $background_repeat = $custom_css->background_repeat;
		 
		 //merge header and background work
		 if($background && $background_image){
			 if($background_repeat == "yes")
		 		$background = "#" . $background . " url(" . $background_image . ") repeat";
		 	 else
		 	  	$background = "#" . $background . " url(" . $background_image . ") no-repeat";
	 	 }elseif(!$background && $background_image){
		 	 if($background_repeat == "yes")
		 	 	$background = "url(" . $background_image . ") repeat";
		 	 else
		 	 	$background = "url(" . $background_image . ") no-repeat";
	 	 }elseif($background){
		 	 $background = "#" . $background;
	 	 }
	 	 
	 	 //merge header and background work
	 	 if($header_transparent == "yes"){
		 	 $header_back = "transparent";
	 	 }else{
			 if($header_back && $header_image){
				if($header_repeat == "yes")
			 		$header_back = "#" . $header_back . " url(" . $header_image . ") repeat";
			 	else
			 		$header_back = "#" . $header_back . " url(" . $header_image . ") no-repeat";
		 	 }elseif(!$header_back && $header_image){
				if($header_repeat == "yes")
			 	 	$header_back = "url(" . $header_image . ") repeat";
			 	else
			 		$header_back = "url(" . $header_image . ") no-repeat";
		 	 }elseif($header_back){
			 	 //$header_back = "#" . $header_back;
			 	 $header_back_color_only = "#" . $header_back; /* to preserve header shadow */
		 	 }
	 	 }
		 
		 //check to see if the admin set a background
		 if($background){
?>
			body {
				background:<?php echo $background; ?>;
			}
			
<?php
		}
		
		//header background set?
		if($header_back){
			if ($header_back_color_only) {
?>
			#layout_header {
				background-color:<?php echo $header_back_color_only ; ?>;
			}
<?php
		}
		else {
?>
			#layout_header {
				background:<?php echo $header_back ; ?>;
			}
<?php		
		}
	}		
		//headers set?
		if($headers){
	
?>

			h1, h2, h3, h4, h5 {
				color:#<?php echo $headers; ?>;
			}

<?php
		}
		
		//links set?
		if($links){	
		
?>

			a {
				color:#<?php echo $links; ?>;
			}
			
<?php

		}
		
		//paragraph set?
		if($paragraph){	
			
?>

			p {
				color:#<?php echo $paragraph; ?>;
			}	
			
<?php
		}
		
		//extras?
		if($extra)
			echo $extra;
	
	}//close opening if statement
?>


/* css rules for the plugins admin interface */
img.custom_logo {
	max-width: 300px;
	max-height: 60px;
}
.input_textarea.csseditor {
	font-family:Monaco,"Courier New",Courier,monospace;
	font-size:13px;
}
