<?php echo '<?xml version="1.0" encoding="utf-8" ?>';
$wp_load_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_load_include) && $i++ < 9) {
	$wp_load_include = "../$wp_load_include";
}
//required to include wordpress file
require($wp_load_include);
?>
<Piecemaker>
  <Contents>
<?php
	$type = 'slider';					
	$args=array(
	'post_type' => $type,
	'post_status' => 'publish',
	'posts_per_page' => $slider_items_count,
	'orderby' => 'menu_order',
	'order' => 'asc'
	);
	$temp = $wp_query;  // assign original query to temp variable for later use
			
	$output_transitions = '';
	
	$n = 0; // variable $n, if $n = 1 then get 1st slider image
	$wp_query = null;
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
		$n++;
		$slider_image_original = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
		$slider_images[$n] = $slider_image_original[0];
		
		$custom = get_post_custom($post->ID);
		$slider_title[$n] = str_replace('<br/>','',$custom["slider_title"][0]);
		$slider_description[$n] = $custom["slider_description"][0];
		$slider_website_url[$n] = $custom["slider_website_url"][0];

		$get_attachment_preview_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider_piecemaker', false );
		$slider_images[$n] = $get_attachment_preview_src[0];		

		$output_title = '';
		$output_description = '';
		$output_url = '';
		
		if ($slider_title[$n]) $output_title = '<h1>'.$slider_title[$n].'</h1>';
		if ($slider_website_url[$n]) $output_url = '<Hyperlink URL="'.$slider_website_url[$n].'" Target="_blank"/>';
		if ($slider_description[$n]) {
			$output_description = '
				<Text>
				  '.$output_title.'<p>'.$slider_description[$n].'</p>
				</Text>
			';
		}
		
		//if (($output_description == '') && ($output_url) {
		
		echo '
			<Image Source="'.$slider_images[$n].'" Title="'.$slider_title[$n].'">'.$output_description.$output_url.'</Image>
		';
		
		
		$custom = get_post_custom($post->ID);
		
		$slider_piecemaker_pieces = $custom["slider_piecemaker_pieces"][0];
		$slider_piecemaker_time = $custom["slider_piecemaker_time"][0];
		$slider_piecemaker_transition = $custom["slider_piecemaker_transition"][0];
		$slider_piecemaker_delay = $custom["slider_piecemaker_delay"][0];
		$slider_piecemaker_depthoffset = $custom["slider_piecemaker_depthoffset"][0];
		$slider_piecemaker_cubedistance = $custom["slider_piecemaker_cubedistance"][0];
		
		$output_transitions .= '
			<Transition Pieces="'.$slider_piecemaker_pieces.'" Time="'.$slider_piecemaker_time.'" Transition="'.$slider_piecemaker_transition.'" Delay="'.$slider_piecemaker_delay.'" DepthOffset="'.$slider_piecemaker_depthoffset.'" CubeDistance="'.$slider_piecemaker_cubedistance.'"></Transition>
		' ;
		
	endwhile; endif;
	$wp_query = null;
	$wp_query = $temp;
	
	$LoaderColor  = trim(get_option($shortname."_piecemaker_LoaderColor"));
	$InnerSideColor  = trim(get_option($shortname."_piecemaker_InnerSideColor"));
	$SideShadowAlpha  = trim(get_option($shortname."_piecemaker_SideShadowAlpha"));
	$DropShadowAlpha  = trim(get_option($shortname."_piecemaker_DropShadowAlpha"));
	$DropShadowDistance  = trim(get_option($shortname."_piecemaker_DropShadowDistance"));
	$DropShadowScale  = trim(get_option($shortname."_piecemaker_DropShadowScale"));
	$DropShadowBlurX  = trim(get_option($shortname."_piecemaker_DropShadowBlurX"));
	$DropShadowBlurY  = trim(get_option($shortname."_piecemaker_DropShadowBlurY"));
	$MenuDistanceX  = trim(get_option($shortname."_piecemaker_MenuDistanceX"));
	$MenuDistanceY  = trim(get_option($shortname."_piecemaker_MenuDistanceY"));
	$MenuColor1  = trim(get_option($shortname."_piecemaker_MenuColor1"));
	$MenuColor2  = trim(get_option($shortname."_piecemaker_MenuColor2"));
	$MenuColor3  = trim(get_option($shortname."_piecemaker_MenuColor3"));
	$ControlSize  = trim(get_option($shortname."_piecemaker_ControlSize"));
	$ControlDistance  = trim(get_option($shortname."_piecemaker_ControlDistance"));
	$ControlColor1  = trim(get_option($shortname."_piecemaker_ControlColor1"));
	$ControlColor2  = trim(get_option($shortname."_piecemaker_ControlColor2"));
	$ControlAlpha  = trim(get_option($shortname."_piecemaker_ControlAlpha"));
	$ControlAlphaOver  = trim(get_option($shortname."_piecemaker_ControlAlphaOver"));
	$ControlsX  = trim(get_option($shortname."_piecemaker_ControlsX"));
	$ControlsY  = trim(get_option($shortname."_piecemaker_ControlsY"));
	$ControlsAlign  = trim(get_option($shortname."_piecemaker_ControlsAlign"));
	$TooltipHeight  = trim(get_option($shortname."_piecemaker_TooltipHeight"));
	$TooltipColor  = trim(get_option($shortname."_piecemaker_TooltipColor"));
	$TooltipTextY  = trim(get_option($shortname."_piecemaker_TooltipTextY"));
	$TooltipTextStyle  = trim(get_option($shortname."_piecemaker_TooltipTextStyle"));
	$TooltipTextColor  = trim(get_option($shortname."_piecemaker_TooltipTextColor"));
	$TooltipMarginLeft  = trim(get_option($shortname."_piecemaker_TooltipMarginLeft"));
	$TooltipMarginRight  = trim(get_option($shortname."_piecemaker_TooltipMarginRight"));
	$TooltipTextSharpness  = trim(get_option($shortname."_piecemaker_TooltipTextSharpness"));
	$TooltipTextThickness  = trim(get_option($shortname."_piecemaker_TooltipTextThickness"));
	$InfoWidth  = trim(get_option($shortname."_piecemaker_InfoWidth"));
	$InfoBackground  = trim(get_option($shortname."_piecemaker_InfoBackground"));
	$InfoBackgroundAlpha  = trim(get_option($shortname."_piecemaker_InfoBackgroundAlpha"));
	$InfoMargin  = trim(get_option($shortname."_piecemaker_InfoMargin"));
	$InfoSharpness  = trim(get_option($shortname."_piecemaker_InfoSharpness"));
	$InfoThickness  = trim(get_option($shortname."_piecemaker_InfoThickness"));
	$Autoplay  = trim(get_option($shortname."_piecemaker_Autoplay"));
	$FieldOfView  = trim(get_option($shortname."_piecemaker_FieldOfView"));
?>

  </Contents>
  <Settings ImageWidth="940" ImageHeight="397" LoaderColor="0x<?php echo str_replace('#','',$LoaderColor); ?>" InnerSideColor="0x<?php echo str_replace('#','',$InnerSideColor); ?>" SideShadowAlpha="<?php echo $SideShadowAlpha; ?>" DropShadowAlpha="<?php echo $DropShadowAlpha; ?>" DropShadowDistance="<?php echo $DropShadowDistance; ?>" DropShadowScale="<?php echo $DropShadowScale; ?>" DropShadowBlurX="<?php echo $DropShadowBlurX; ?>" DropShadowBlurY="<?php echo $DropShadowBlurY; ?>" MenuDistanceX="<?php echo $MenuDistanceX; ?>" MenuDistanceY="<?php echo $MenuDistanceY; ?>" MenuColor1="0x<?php echo str_replace('#','',$MenuColor1); ?>" MenuColor2="0x<?php echo str_replace('#','',$MenuColor2); ?>" MenuColor3="0x<?php echo str_replace('#','',$MenuColor3); ?>" ControlSize="<?php echo $ControlSize; ?>" ControlDistance="<?php echo $ControlDistance; ?>" ControlColor1="0x<?php echo str_replace('#','',$ControlColor1); ?>" ControlColor2="0x<?php echo str_replace('#','',$ControlColor2); ?>" ControlAlpha="<?php echo $ControlAlpha; ?>" ControlAlphaOver="<?php echo $ControlAlphaOver; ?>" ControlsX="<?php echo $ControlsX; ?>" ControlsY="<?php echo $ControlsY; ?>" ControlsAlign="<?php echo $ControlsAlign; ?>" TooltipHeight="<?php echo $TooltipHeight; ?>" TooltipColor="0x<?php echo str_replace('#','',$TooltipColor); ?>" TooltipTextY="<?php echo $TooltipTextY; ?>" TooltipTextStyle="<?php echo $TooltipTextStyle; ?>" TooltipTextColor="0x<?php echo str_replace('#','',$TooltipTextColor); ?>" TooltipMarginLeft="<?php echo $TooltipMarginLeft; ?>" TooltipMarginRight="<?php echo $TooltipMarginRight; ?>" TooltipTextSharpness="<?php echo $TooltipTextSharpness; ?>" TooltipTextThickness="<?php echo $TooltipTextThickness; ?>" InfoWidth="<?php echo $InfoWidth; ?>" InfoBackground="0x<?php echo str_replace('#','',$InfoBackground); ?>" InfoBackgroundAlpha="<?php echo $InfoBackgroundAlpha; ?>" InfoMargin="<?php echo $InfoMargin; ?>" InfoSharpness="<?php echo $InfoSharpness; ?>" InfoThickness="<?php echo $InfoThickness; ?>" Autoplay="<?php echo $Autoplay; ?>" FieldOfView="<?php echo $FieldOfView; ?>"></Settings>
  
  <Transitions>
	<?php echo $output_transitions; ?>
  </Transitions>
</Piecemaker>