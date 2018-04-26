<?php
/* Create Sliders Items */
add_action('init', 'create_slider');
function create_slider() {
	$slider_args = array(
		'label' => 'Slider',
		'singular_label' => 'Slider',
		'public' => true,
		'show_ui' => true,
		'menu_position' => 5,			
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array('title','thumbnail', 'page-attributes')
	);
	register_post_type('slider',$slider_args);
}

add_action('admin_init', 'add_slider');
add_action('save_post', 'update_slider_website_url');
	
function add_slider(){
	add_meta_box("slider_details", "Slider Options", "slider_options", "slider", "normal", "low");
}

function slider_options(){
	global $post, $shortname;
	$selected_slider = get_option($shortname.'_slider_type');
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
	$custom = get_post_custom($post->ID);

	//set the options if the slider is Accordion or Nivo Slider
	if ( ($selected_slider == 'Accordion Slider') || ($selected_slider == 'Nivo Slider') ) {
		$slider_title = $custom["slider_title"][0];
		$slider_description = $custom["slider_description"][0];
		$slider_website_url = $custom["slider_website_url"][0];
	}

	//set the options if the slider is Piecemaker
	if ($selected_slider == 'Piecemaker Slider') {	
		$slider_title = $custom["slider_title"][0];
		$slider_description = $custom["slider_description"][0];
		$slider_website_url = $custom["slider_website_url"][0];
		
		$slider_piecemaker_pieces = $custom["slider_piecemaker_pieces"][0];
		$slider_piecemaker_time = $custom["slider_piecemaker_time"][0];
		$slider_piecemaker_transition = $custom["slider_piecemaker_transition"][0];
		$slider_piecemaker_delay = $custom["slider_piecemaker_delay"][0];
		$slider_piecemaker_depthoffset = $custom["slider_piecemaker_depthoffset"][0];
		$slider_piecemaker_cubedistance = $custom["slider_piecemaker_cubedistance"][0];		
	}
		
	//set the options if the slider is OneByOne
	if ($selected_slider == 'OneByOne Slider') {
	
		//slider content align option
		$slider_text_align = $custom["slider_text_align"][0];
		
		//slider title options
		$slider_title = $custom["slider_title"][0];
		$slider_title_color = $custom["slider_title_color"][0];
		$slider_title_color_checkbox = $custom["slider_title_color_checkbox"][0];
		$slider_title_bgcolor = $custom["slider_title_bgcolor"][0];
		$slider_title_bgcolor_checkbox = $custom["slider_title_bgcolor_checkbox"][0];
		
		//slider subtitle options
		$slider_subtitle = $custom["slider_subtitle"][0];
		$slider_subtitle_color = $custom["slider_subtitle_color"][0];
		$slider_subtitle_color_checkbox = $custom["slider_subtitle_color_checkbox"][0];
		$slider_subtitle_bgcolor = $custom["slider_subtitle_bgcolor"][0];
		$slider_subtitle_bgcolor_checkbox = $custom["slider_subtitle_bgcolor_checkbox"][0];		
		
		//slider description options
		$slider_description = $custom["slider_description"][0];
		$slider_description_color = $custom["slider_description_color"][0];
		$slider_description_color_checkbox = $custom["slider_description_color_checkbox"][0];
		$slider_description_bgcolor = $custom["slider_description_bgcolor"][0];
		$slider_description_bgcolor_checkbox = $custom["slider_description_bgcolor_checkbox"][0];				
		
		//slider button options
		$slider_website_url = $custom["slider_website_url"][0];
		$slider_button_text = $custom["slider_button_text"][0];
		$slider_button_color = $custom["slider_button_color"][0];
		$slider_button_color_checkbox = $custom["slider_button_color_checkbox"][0];
		$slider_button_bgcolor = $custom["slider_button_bgcolor"][0];
		$slider_button_bgcolor_checkbox = $custom["slider_button_bgcolor_checkbox"][0];				
		
		//slider piecemaker transitions options
		$slider_piecemaker_pieces = $custom["slider_piecemaker_pieces"][0];
		$slider_piecemaker_time = $custom["slider_piecemaker_time"][0];
		$slider_piecemaker_transition = $custom["slider_piecemaker_transition"][0];
		$slider_piecemaker_delay = $custom["slider_piecemaker_delay"][0];
		$slider_piecemaker_depthoffset = $custom["slider_piecemaker_depthoffset"][0];
		$slider_piecemaker_cubedistance = $custom["slider_piecemaker_cubedistance"][0];
		
	}
	
?>
	<div id="slider-options">
		<table>
				
			<?php
				//set the options if the slider is Accordion
				if ( ($selected_slider == 'Accordion Slider') || ($selected_slider == 'Nivo Slider') || ($selected_slider == 'Piecemaker Slider')) {
			?>
			<tr>
				<td>
					<h3 class="heading">Title</h3>
					<small>Enter the title.</small><br /><br />
					<textarea name="slider_title" cols="117" rows="2"><?php echo $slider_title; ?></textarea><br /><br />
				</td>
			</tr>
			
			<tr>
				<td>
					<h3 class="heading">Slide Description</h3>
					<small>Add slide description (optional)</small><br /><br />
					<textarea name="slider_description" cols="117" rows="10"><?php echo $slider_description; ?></textarea><br /><br />
				</td>
			</tr>			
			<tr>
				<td>
					<h3 class="heading">URL</h3>
					<small>URL the Slide gets linked to</small><br /><br />
					<input style="width: 600px" name="slider_website_url" value="<?php echo $slider_website_url; ?>" /><br /><br />
				</td>
			</tr>			
			<?php } ?>
				
			<?php
				//set the options if the slider is OneByOne
				if ($selected_slider == 'OneByOne Slider') {
			?>

			<tr>
				<td valign="top">
					<h3 class="heading">Description Align</h3>
					<small>The entire slider content align.</small><br/><br/>		
					<select name="slider_text_align" id="slider_text_align">
						<?php
							$slider_text_align1 = '';
							$slider_text_align2 = '';

							if ($slider_text_align == 'right') { $slider_text_align1 = " selected"; }
							if ($slider_text_align == 'left') { $slider_text_align2 = " selected"; }						
						?>
						<option value="right"<?php echo $slider_text_align1; ?>>&nbsp;&nbsp;Right&nbsp;&nbsp;&nbsp;</option>
						<option  value="left"<?php echo $slider_text_align2; ?>>&nbsp;&nbsp;Left&nbsp;&nbsp;&nbsp;&nbsp;</option>
					</select><br/><br/>

				</td>
			</tr>
			
			<tr>
				<td>
					<h3 class="heading">Title</h3>
					<small>Enter the title.</small><br /><br />
					<textarea name="slider_title" cols="117" rows="2"><?php echo $slider_title; ?></textarea><br /><br />					

					<small><strong>Title Font Color</strong></small><br />
					<small>Click and select the font color.</small><br />
					<?php
						$slider_title_color_checkbox_selected = '';
						if ($slider_title_color_checkbox == 'on') { $slider_title_color_checkbox_selected = 'checked="checked" '; }					
						echo '<input style="width:70px;" class="color" name="slider_title_color" id="slider_title_color" type="text" value="'.$slider_title_color.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_title_color_checkbox" id="slider_title_color_checkbox" '.$slider_title_color_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />

					<small><strong>Title Background Color</strong></small><br />
					<small>Click and select the font background color.</small><br />
					<?php
						$slider_title_bgcolor_checkbox_selected = '';
						if ($slider_title_bgcolor_checkbox == 'on') { $slider_title_bgcolor_checkbox_selected = 'checked="checked" '; }
						echo '<input style="width:70px;" class="color" name="slider_title_bgcolor" id="slider_title_bgcolor" type="text" value="'.$slider_title_bgcolor.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_title_bgcolor_checkbox" id="slider_title_bgcolor_checkbox" '.$slider_title_bgcolor_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />
				</td>
			</tr>			
			
			<tr>
				<td>
					<h3 class="heading">Subtitle</h3>
					<small>Enter the subtitle</small><br /><br />
					<textarea name="slider_subtitle" cols="117" rows="2"><?php echo $slider_subtitle; ?></textarea><br /><br />
					<small><strong>Subtitle Font Color</strong></small><br />
					<small>Click and select the font color.</small><br />
					<?php
						$slider_subtitle_color_checkbox_selected = '';
						if ($slider_subtitle_color_checkbox == 'on') { $slider_subtitle_color_checkbox_selected = 'checked="checked" '; }						
						echo '<input style="width:70px;" class="color" name="slider_subtitle_color" id="slider_subtitle_color" type="text" value="'.$slider_subtitle_color.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_subtitle_color_checkbox" id="slider_subtitle_color_checkbox" '.$slider_subtitle_color_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />

					<small><strong>Subtitle Background Color</strong></small><br />
					<small>Click and select the subtitle background color.</small><br />
					<?php
						$slider_subtitle_bgcolor_checkbox_selected = '';
						if ($slider_subtitle_bgcolor_checkbox == 'on') { $slider_subtitle_bgcolor_checkbox_selected = 'checked="checked" '; }
						echo '<input style="width:70px;" class="color" name="slider_subtitle_bgcolor" id="slider_subtitle_bgcolor" type="text" value="'.$slider_subtitle_bgcolor.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_subtitle_bgcolor_checkbox" id="slider_subtitle_bgcolor_checkbox" '.$slider_subtitle_bgcolor_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />
				</td>
			</tr>
			
			<tr>
				<td>
					<h3 class="heading">Slide Description</h3>
					<small>Add slide description (optional)</small><br /><br />
					<textarea name="slider_description" cols="117" rows="10"><?php echo $slider_description; ?></textarea><br /><br />
					<small><strong>Description Font Color</strong></small><br />
					<small>Click and select the font color.</small><br />
					<?php
						$slider_description_color_checkbox_selected = '';
						if ($slider_description_color_checkbox == 'on') { $slider_description_color_checkbox_selected = 'checked="checked" '; }						
						echo '<input style="width:70px;" class="color" name="slider_description_color" id="slider_description_color" type="text" value="'.$slider_description_color.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_description_color_checkbox" id="slider_description_color_checkbox" '.$slider_description_color_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />

					<small><strong>Description Background Color</strong></small><br />
					<small>Click and select the description background color.</small><br />
					<?php
						$slider_description_bgcolor_checkbox_selected = '';
						if ($slider_description_bgcolor_checkbox == 'on') { $slider_description_bgcolor_checkbox_selected = 'checked="checked" '; }
						echo '<input style="width:70px;" class="color" name="slider_description_bgcolor" id="slider_description_bgcolor" type="text" value="'.$slider_description_bgcolor.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_description_bgcolor_checkbox" id="slider_description_bgcolor_checkbox" '.$slider_description_bgcolor_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />					
				</td>
			</tr>
			
			<tr>
				<td>
					<h3 class="heading">Button Options</h3>
					<small><strong>Button Text</strong></small><br />
					<small>Enter button text</small><br /><br />
					<input style="width: 600px" name="slider_button_text" value="<?php echo $slider_button_text; ?>" /><br /><br />
					<small>URL the Slide gets linked to</small><br /><br />
					<input style="width: 600px" name="slider_website_url" value="<?php echo $slider_website_url; ?>" /><br /><br />
					<small><strong>Button Font Color</strong></small><br />
					<small>Click and select the button font color.</small><br />
					<?php
						$slider_button_color_checkbox_selected = '';
						if ($slider_button_color_checkbox == 'on') { $slider_button_color_checkbox_selected = 'checked="checked" '; }
						echo '<input style="width:70px;" class="color" name="slider_button_color" id="slider_button_color" type="text" value="'.$slider_button_color.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_button_color_checkbox" id="slider_button_color_checkbox" '.$slider_button_color_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />

					<small><strong>Button Background Color</strong></small><br />
					<small>Click and select the button background color.</small><br />
					<?php
						$slider_button_bgcolor_checkbox_selected = '';
						if ($slider_button_bgcolor_checkbox == 'on') { $slider_button_bgcolor_checkbox_selected = 'checked="checked" '; }
						echo '<input style="width:70px;" class="color" name="slider_button_bgcolor" id="slider_button_bgcolor" type="text" value="'.$slider_button_bgcolor.'" />';
						echo '&nbsp;&nbsp;<input type="checkbox" name="slider_button_bgcolor_checkbox" id="slider_button_bgcolor_checkbox" '.$slider_button_bgcolor_checkbox_selected.'/> Enable the custom font color.';
					?><br /><br />
				</td>
			</tr>
			<?php } ?>			
			
			<?php 
				if ($selected_slider == 'Piecemaker Slider') {
					
					/* Piecemaker Tween Types */
					$tween_types = array("linear", "easeInSine", "easeOutSine", "easeInOutSine", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeOutInCubic", "easeInQuint", "easeOutQuint", "easeInOutQuint", "easeOutInQuint", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeOutInCirc", "easeInBack", "easeOutBack", "easeInOutBack", "easeOutInBack", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeOutInQuad", "easeInQuart", "easeOutQuart", "easeInOutQuart", "easeOutInQuart", "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeOutInExpo", "easeInElastic", "easeOutElastic", "easeInOutElastic", "easeOutInElastic", "easeInBounce", "easeOutBounce", "easeInOutBounce", "easeOutInBounce", "easeInOutBack");
			?>
			
			<tr>
				<td>
					<br/><hr><br/><br/>
					<strong>Piecemaker Transitions</strong><br/>
					<small>You can add as many transitions to the Piecemaker as you want. These transitions will be started in the order<br/>
					they are specified in the XML file. This order is entirely independent from the order of contents. Once the last transition<br/>
					is reached, it starts over again with the first transition. Every transition needs to have the following six attributes assigned to it: </small><br/><br/><br/>
				</td>
			</tr>
			<tr>
				<td>
					<small><strong>Pieces</strong></small><br />
					<small>Number of pieces to which the image is sliced</small><br /><br />
					<?php if (!$slider_piecemaker_pieces) $slider_piecemaker_pieces = '9'; ?>
					<input style="width: 600px" name="slider_piecemaker_pieces" value="<?php echo $slider_piecemaker_pieces; ?>" /><br /><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<small><strong>Time</strong></small><br />
					<small>Time for one cube to turn</small><br /><br />
					<?php if (!$slider_piecemaker_time) $slider_piecemaker_time = '1.2'; ?>
					<input style="width: 600px" name="slider_piecemaker_time" value="<?php echo $slider_piecemaker_time; ?>" /><br /><br /><br />
				</td>
			</tr>
			<tr>
				<td>
					<small><strong>Transition type</strong></small><br />
					<small>Transition type of the Tweener class. For more info on these types see the official Tweener Documentation<br/>
					and go to <strong>Transition Types</strong>. The best results are achieved by those transition types, which begin with <strong>easeInOut</strong>.</small><br /><br />
					<?php if (!$slider_piecemaker_transition) $slider_piecemaker_transition = 'easeInOutBack'; ?>
					<select name="slider_piecemaker_transition" id="slider_piecemaker_transition">
						<?php foreach ($tween_types as $option) { ?>
							<option <?php if ($slider_piecemaker_transition == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
						<?php } ?>
					</select>
					<!--input style="width: 600px" name="slider_piecemaker_transition" value="<?php echo $slider_piecemaker_transition; ?>" /><br /><br /><br /-->
				</td>
			</tr>		
			<tr>
				<td>
					<small><strong>Delay</strong></small><br />
					<small>Delay between the start of one cube to the start of the next cube.</small><br /><br />
					<?php if (!$slider_piecemaker_delay) $slider_piecemaker_delay = '0.1'; ?>
					<input style="width: 600px" name="slider_piecemaker_delay" value="<?php echo $slider_piecemaker_delay; ?>" /><br /><br /><br />
				</td>
			</tr>	
			<tr>
				<td>
					<small><strong>DepthOffset</strong></small><br />
					<small>The offset during transition on the z-axis. Value between 100 and 1000 are recommended.</small><br /><br />
					<?php if (!$slider_piecemaker_depthoffset) $slider_piecemaker_depthoffset = '300'; ?>
					<input style="width: 600px" name="slider_piecemaker_depthoffset" value="<?php echo $slider_piecemaker_depthoffset; ?>" /><br /><br /><br />
				</td>
			</tr>				
			<tr>
				<td>
					<small><strong>CubeDistance</strong></small><br />
					<small>The distance between the cubes during transition. Values between 5 and 50 are recommended. </small><br /><br />
					<?php if (!$slider_piecemaker_cubedistance) $slider_piecemaker_cubedistance = '30'; ?>
					<input style="width: 600px" name="slider_piecemaker_cubedistance" value="<?php echo $slider_piecemaker_cubedistance; ?>" /><br /><br /><br />
				</td>
			</tr>				
			<?php } ?>
			
		</table>
	</div><!--end slider-options-->
<?php
}

function update_slider_website_url(){
	global $post, $shortname;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	} else {
		$selected_slider = get_option($shortname.'_slider_type');

		//set the options if the slider is Accordion
		if ( ($selected_slider == 'Accordion Slider') || ($selected_slider == 'Nivo Slider') ) {
			update_post_meta($post->ID, "slider_title", $_POST["slider_title"]);
			update_post_meta($post->ID, "slider_description", $_POST["slider_description"]);
			update_post_meta($post->ID, "slider_website_url", $_POST["slider_website_url"]);
		}

		//set the options if the slider is Piecemaker
		if ($selected_slider == 'Piecemaker Slider') {	
			update_post_meta($post->ID, "slider_title", $_POST["slider_title"]);
			update_post_meta($post->ID, "slider_description", $_POST["slider_description"]);
			update_post_meta($post->ID, "slider_website_url", $_POST["slider_website_url"]);
			
			update_post_meta($post->ID, "slider_piecemaker_pieces", $_POST["slider_piecemaker_pieces"]);
			update_post_meta($post->ID, "slider_piecemaker_time", $_POST["slider_piecemaker_time"]);
			update_post_meta($post->ID, "slider_piecemaker_transition", $_POST["slider_piecemaker_transition"]);
			update_post_meta($post->ID, "slider_piecemaker_delay", $_POST["slider_piecemaker_delay"]);
			update_post_meta($post->ID, "slider_piecemaker_depthoffset", $_POST["slider_piecemaker_depthoffset"]);
			update_post_meta($post->ID, "slider_piecemaker_cubedistance", $_POST["slider_piecemaker_cubedistance"]);
		}
		
		//set the options if the slider is OneByOne
		if ($selected_slider == 'OneByOne Slider') {		
			//update content align option
			update_post_meta($post->ID, "slider_text_align", $_POST["slider_text_align"]);
			
			//update title options
			update_post_meta($post->ID, "slider_title", $_POST["slider_title"]);
			update_post_meta($post->ID, "slider_title_color", $_POST["slider_title_color"]);
			update_post_meta($post->ID, "slider_title_color_checkbox", $_POST["slider_title_color_checkbox"]);
			update_post_meta($post->ID, "slider_title_bgcolor", $_POST["slider_title_bgcolor"]);
			update_post_meta($post->ID, "slider_title_bgcolor_checkbox", $_POST["slider_title_bgcolor_checkbox"]);

			//update subtitle options
			update_post_meta($post->ID, "slider_subtitle", $_POST["slider_subtitle"]);
			update_post_meta($post->ID, "slider_subtitle_color", $_POST["slider_subtitle_color"]);
			update_post_meta($post->ID, "slider_subtitle_color_checkbox", $_POST["slider_subtitle_color_checkbox"]);
			update_post_meta($post->ID, "slider_subtitle_bgcolor", $_POST["slider_subtitle_bgcolor"]);
			update_post_meta($post->ID, "slider_subtitle_bgcolor_checkbox", $_POST["slider_subtitle_bgcolor_checkbox"]);

			//update description options
			update_post_meta($post->ID, "slider_description", $_POST["slider_description"]);
			update_post_meta($post->ID, "slider_description_color", $_POST["slider_description_color"]);
			update_post_meta($post->ID, "slider_description_color_checkbox", $_POST["slider_description_color_checkbox"]);
			update_post_meta($post->ID, "slider_description_bgcolor", $_POST["slider_description_bgcolor"]);
			update_post_meta($post->ID, "slider_description_bgcolor_checkbox", $_POST["slider_description_bgcolor_checkbox"]);			
			
			//update button options
			update_post_meta($post->ID, "slider_website_url", $_POST["slider_website_url"]);
			update_post_meta($post->ID, "slider_button_text", $_POST["slider_button_text"]);
			update_post_meta($post->ID, "slider_button_color", $_POST["slider_button_color"]);
			update_post_meta($post->ID, "slider_button_color_checkbox", $_POST["slider_button_color_checkbox"]);
			update_post_meta($post->ID, "slider_button_bgcolor", $_POST["slider_button_bgcolor"]);
			update_post_meta($post->ID, "slider_button_bgcolor_checkbox", $_POST["slider_button_bgcolor_checkbox"]);			
			
			//update piecemaker transitions options
			update_post_meta($post->ID, "slider_piecemaker_pieces", $_POST["slider_piecemaker_pieces"]);
			update_post_meta($post->ID, "slider_piecemaker_time", $_POST["slider_piecemaker_time"]);
			update_post_meta($post->ID, "slider_piecemaker_transition", $_POST["slider_piecemaker_transition"]);
			update_post_meta($post->ID, "slider_piecemaker_delay", $_POST["slider_piecemaker_delay"]);
			update_post_meta($post->ID, "slider_piecemaker_depthoffset", $_POST["slider_piecemaker_depthoffset"]);
			update_post_meta($post->ID, "slider_piecemaker_cubedistance", $_POST["slider_piecemaker_cubedistance"]);			
		}
	}
}
?>