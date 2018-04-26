<style type="text/css">
<?php
// get Custom CSS if exists
if (get_option($shortname.'_custom_css')) {
echo get_option($shortname.'_custom_css');
}

//get the header line settings
$header_line_background_color = get_option($shortname."_header_line_background_color");
$header_line_background_image = get_option($shortname."_header_line_background_image");
$header_line_height = get_option($shortname."_header_line_height");

$header_line_bodybgcolor_class = '';
if ($header_line_background_color && !$header_line_background_image) {
$header_line_bodybgcolor_class = 'background:'.$header_line_background_color.';';
} else if ($header_line_background_image) {
$site_background_image_position = get_option($shortname.'_site_background_image_position');
$site_background_image_repeat = get_option($shortname.'_site_background_image_repeat');
if (!$header_line_background_color) $header_line_background_color = "#fff";
$header_line_bodybgcolor_class = 'background:'.$header_line_background_color." url(".$header_line_background_image."); background-position: left top; background-repeat: repeat;";
}

echo '
	.line {
		height:'.$header_line_height.'px;
		'.$header_line_bodybgcolor_class.'
		margin-bottom:-4px;
	}
';




//get the header menu section settings
$header_menu_font = get_option($shortname."_header_menu_font");

$header_menu_font_size = '14';
$header_menu_font_size_heigth = '17';
$header_menu_font_size = get_option($shortname."_header_menu_font_size");
$header_menu_font_color = get_option($shortname."_header_menu_font_color");
$header_menu_onhover_font_color = get_option($shortname."_header_menu_onhover_font_color");
$header_submenu_font_color = get_option($shortname."_header_submenu_font_color");
$header_submenu_onhover_font_color = get_option($shortname."_header_submenu_onhover_font_color");

if ($header_menu_font_size > 14) $header_menu_font_size_heigth = round(17+($header_menu_font_size-14)/2);

if ($header_menu_font != 'Open+Sans') {
echo '
	#nav {
		font:'.$header_menu_font_size.'px/'.$header_menu_font_size_heigth.'px "'.str_replace('+',' ',$header_menu_font).'", Arial, Helvetica, sans-serif;
	}
';
} else {
echo '
	#nav {
		font:'.$header_menu_font_size.'px/'.$header_menu_font_size_heigth.'px "Open Sans", Arial, Helvetica, sans-serif;
	}
';		
}

if ($header_menu_font_color) {
echo '
	#nav ul a {
		color: '.$header_menu_font_color.' !important;
	}
';
}
if ($header_menu_onhover_font_color) {
echo '
	#nav ul a:hover {
		color: '.$header_menu_onhover_font_color.' !important;
	}
';
}	
if ($header_submenu_font_color) {
echo '
	#nav ul ul a {
		color: '.$header_submenu_font_color.' !important;
	}
';
}
if ($header_submenu_onhover_font_color) {
echo '
	#nav ul ul  a:hover {
		color: '.$header_submenu_onhover_font_color.' !important;
	}
';
}



//get the header intro section settings
$header_slider_background_color = get_option($shortname."_header_slider_background_color");
$header_pages_intro_background_color = get_option($shortname."_header_pages_intro_background_color");
$header_pages_intro_font_color = get_option($shortname."_header_pages_intro_font_color"); 
if ( (($header_slider_background_color) && (is_home())) || (($header_slider_background_color) && (is_front_page()))  ) {
echo '
	.intro {
		background:'.$header_slider_background_color.';
	}
';
} else if ( (($header_pages_intro_background_color) && (!is_home())) || (($header_pages_intro_background_color) && (!is_front_page())) ) {
echo '
	.intro {
		background:'.$header_pages_intro_background_color.';
	}
';		
}
$header_pages_intro_font_color_style =  ($header_pages_intro_font_color) ? 'color:'.$header_pages_intro_font_color.';' : '';		
if ($header_pages_intro_font_color_style) {
echo '
	.intro {
		'.$header_pages_intro_font_color_style.'
	}
';
}



//get the footer section settings
$footer_background_color = get_option($shortname."_footer_background_color");
$footer_background_image = get_option($shortname."_footer_background_image");
$footer_headers_color = get_option($shortname."_footer_headers_color");
$footer_font_color = get_option($shortname."_footer_font_color");
$footer_link_color = get_option($shortname."_footer_link_color");
$footer_link_hover_color = get_option($shortname."_footer_link_hover_color");

$footer_bodybgcolor_class = '';
if ($footer_background_color && !$footer_background_image) {
	$footer_bodybgcolor_class = 'background:'.$footer_background_color.';';
} else if ($footer_background_image) {
	$site_background_image_position = get_option($shortname.'_site_background_image_position');
	$site_background_image_repeat = get_option($shortname.'_site_background_image_repeat');
	if (!$footer_background_color) $footer_background_color = "#fff";
	$footer_bodybgcolor_class = 'background:'.$footer_background_color." url(".$footer_background_image."); background-position: left top; background-repeat: repeat;";
}

$boxed_case_class = ($theme_background == 'boxed') ? '.case' : '';
$footer_headers_color_css = ($footer_headers_color) ? 'color:'.$footer_headers_color.' !important;' : '';
$footer_font_color_css = ($footer_font_color) ? 'color:'.$footer_font_color.';' : '';
$footer_link_color_css = ($footer_link_color) ? 'color:'.$footer_link_color.';' : '';
$footer_link_hover_color_css = ($footer_link_hover_color) ? 'color:'.$footer_link_hover_color.';' : '';

if ($footer_font_color_css) {
echo '
	#footer .footer-holder .container {
		'.$footer_font_color_css.'
	}
';
}

if ($footer_link_color_css) {
echo'
	#footer .footer-holder .container a {
		'.$footer_link_color_css.'
	}
';
}

if ($footer_link_color_css && !$footer_link_hover_color_css) $footer_link_hover_color_css = $footer_link_color_css.' text-decoration:underline;';
if ($footer_link_hover_color_css) {
echo'
	#footer .footer-holder .container a:hover {
		'.$footer_link_hover_color_css.'
	}
';
}

if ($footer_bodybgcolor_class) {
echo '
	#footer .footer-holder .container '.$boxed_case_class.' {
		'.$footer_bodybgcolor_class.'
	}
	#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6 {
		background:none;
		'.$footer_headers_color_css.'
	}
	#footer .footer-holder .container '.$boxed_case_class.' .container {
		background:none;
	}
';
}


//get the subfooter section settings
$subfooter_background_color = get_option($shortname."_subfooter_background_color");
$subfooter_background_image = get_option($shortname."_subfooter_background_image");
$subfooter_font_color = get_option($shortname."_subfooter_font_color");
$subfooter_link_color = get_option($shortname."_subfooter_link_color");
$subfooter_link_hover_color = get_option($shortname."_subfooter_link_hover_color");

$subfooter_bodybgcolor_class = '';
if ($subfooter_background_color && !$subfooter_background_image) {
	$subfooter_bodybgcolor_class = 'background:'.$subfooter_background_color.';';
} else if ($subfooter_background_image) {
	$site_background_image_position = get_option($shortname.'_site_background_image_position');
	$site_background_image_repeat = get_option($shortname.'_site_background_image_repeat');
	if (!$subfooter_background_color) $subfooter_background_color = "#fff";
	$subfooter_bodybgcolor_class = 'background:'.$subfooter_background_color." url(".$subfooter_background_image."); background-position: left top; background-repeat: repeat;";
}

$subfooter_boxed_case_class = ($theme_background == 'boxed') ? '.case' : '';
$subfooter_font_color_css = ($subfooter_font_color) ? 'color:'.$subfooter_font_color.';' : '';
$subfooter_link_color_css = ($subfooter_link_color) ? 'color:'.$subfooter_link_color.';' : '';
$subfooter_link_hover_color_css = ($subfooter_link_hover_color) ? 'color:'.$subfooter_link_hover_color.';' : '';

if ($subfooter_font_color_css) {
echo '
	#footer .footer-holder .add .case, #footer .footer-holder .add .case .copyright {
		'.$subfooter_font_color_css.'
	}
';
}

if ($subfooter_link_color_css) {
echo'
	#footer .footer-holder .add .case a {
		'.$subfooter_link_color_css.'
	}
';
}

if ($subfooter_link_color_css && !$subfooter_link_hover_color_css) $subfooter_link_hover_color_css = $subfooter_link_color_css.' text-decoration:underline;';
if ($subfooter_link_hover_color_css) {
echo'
	#footer .footer-holder .add .case a:hover {
		'.$subfooter_link_hover_color_css.'
	}
';
}

if ($subfooter_bodybgcolor_class) {
echo '
	#footer .footer-holder .add .case {
		background: none;
	}
';
}
?>

</style>