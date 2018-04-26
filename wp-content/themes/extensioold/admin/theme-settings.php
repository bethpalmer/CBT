<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

//$themename = "EXTENSIO";
//$shortname = "mi";
global $themename, $shortname;

//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');

//Access the WordPress Pages via an Array
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tt_pages_obj as $tt_page) {
$tt_pages[$tt_page->ID] = $tt_page->post_name; }
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:"); 

//Access the WordPress Categories via an Array
$tt_categories = array();  
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "Select a category:");


//Sample Array for demo purposes
$sample_array = array("1","2","3","4","5");
//Sample Advanced Array - The actual value differs from what the user sees
$sample_advanced_array = array("image" => "The Image","post" => "The Post"); 
//Folder Paths for "type" => "images"
$sampleurl =  get_template_directory_uri() . '/admin/images/sample-layouts/';


$theme_styles = array("Wide Style","Boxed Style");

$theme_fonts = array("Abel", "Abril+Fatface", "Aclonica", "Actor", "Adamina", "Aguafina+Script", "Aladin", "Aldrich", "Alice", "Alike+Angular", "Alike", "Allan", "Allerta+Stencil", "Allerta", "Amaranth", "Amatic+SC", "Andada", "Andika", "Annie+Use+Your+Telescope", "Anonymous+Pro", "Antic", "Anton", "Arapey", "Architects+Daughter", "Arimo", "Artifika", "Arvo", "Asset", "Astloch", "Atomic+Age", "Aubrey", "Bangers", "Bentham", "Bevan", "Bigshot+One", "Bitter", "Black+Ops+One", "Bowlby+One+SC", "Bowlby+One", "Brawler", "Bubblegum+Sans", "Buda", "Butcherman+Caps", "Cabin+Condensed", "Cabin+Sketch", "Cabin", "Cagliostro", "Calligraffitti", "Candal", "Cantarell", "Cardo", "Carme", "Carter+One", "Caudex", "Cedarville+Cursive", "Changa+One", "Cherry+Cream+Soda", "Chewy", "Chicle", "Chivo", "Coda+Caption", "Coda", "Comfortaa", "Coming+Soon", "Contrail+One", "Convergence", "Cookie", "Copse", "Corben", "Cousine", "Coustard", "Covered+By+Your+Grace", "Crafty+Girls", "Creepster+Caps", "Crimson+Text", "Crushed", "Cuprum", "Damion", "Dancing+Script", "Dawning+of+a+New+Day", "Days+One", "Delius+Swash+Caps", "Delius+Unicase", "Delius", "Devonshire", "Didact+Gothic", "Dorsa", "Dr+Sugiyama", "Droid+Sans+Mono", "Droid+Sans", "Droid+Serif", "EB+Garamond", "Eater+Caps", "Expletus+Sans", "Fanwood+Text", "Federant", "Federo", "Fjord+One", "Fondamento", "Fontdiner+Swanky", "Forum", "Francois+One", "Gentium+Basic", "Gentium+Book+Basic", "Geo", "Geostar+Fill", "Geostar", "Give+You+Glory", "Gloria+Hallelujah", "Goblin+One", "Gochi+Hand", "Goudy+Bookletter+1911", "Gravitas+One", "Gruppo", "Hammersmith+One", "Herr+Von+Muellerhoff", "Holtwood+One+SC", "Homemade+Apple", "IM+Fell+DW+Pica+SC", "IM+Fell+DW+Pica", "IM+Fell+Double+Pica+SC", "IM+Fell+Double+Pica", "IM+Fell+English+SC", "IM+Fell+English", "IM+Fell+French+Canon+SC", "IM+Fell+French+Canon", "IM+Fell+Great+Primer+SC", "IM+Fell+Great+Primer", "Iceland", "Inconsolata", "Indie+Flower", "Irish+Grover", "Istok+Web", "Jockey+One", "Josefin+Sans", "Josefin+Slab", "Judson", "Julee", "Jura", "Just+Another+Hand", "Just+Me+Again+Down+Here", "Kameron", "Kelly+Slab", "Kenia", "Knewave", "Kranky", "Kreon", "Kristi", "La+Belle+Aurore", "Lancelot", "Lato", "League+Script", "Leckerli+One", "Lekton", "Lemon", "Limelight", "Linden+Hill", "Lobster+Two", "Lobster", "Lora", "Love+Ya+Like+A+Sister", "Loved+by+the+King", "Luckiest+Guy", "Maiden+Orange", "Mako", "Marck+Script", "Marvel", "Mate+SC", "Mate", "Maven+Pro", "Meddon", "MedievalSharp", "Megrim", "Merienda+One", "Merriweather", "Metrophobic", "Michroma", "Miltonian+Tattoo", "Miltonian", "Miss+Fajardose", "Miss+Saint+Delafield", "Modern+Antiqua", "Molengo", "Monofett", "Monoton", "Monsieur+La+Doulaise", "Montez", "Mountains+of+Christmas", "Mr+Bedford", "Mr+Dafoe", "Mr+De+Haviland", "Mrs+Sheppards", "Muli", "Neucha", "Neuton", "News+Cycle", "Niconne", "Nixie+One", "Nobile", "Nosifer+Caps", "Nothing+You+Could+Do", "Nova+Cut", "Nova+Flat", "Nova+Mono", "Nova+Oval", "Nova+Round", "Nova+Script", "Nova+Slim", "Nova+Square", "Numans", "Nunito", "Old+Standard+TT", "Open+Sans+Condensed", "Open+Sans", "Orbitron", "Oswald", "Over+the+Rainbow", "Ovo", "PT+Sans+Caption", "PT+Sans+Narrow", "PT+Sans", "PT+Serif+Caption", "PT+Serif", "Pacifico", "Passero+One", "Patrick+Hand", "Paytone+One", "Permanent+Marker", "Petrona", "Philosopher", "Piedra", "Pinyon+Script", "Play", "Playfair+Display", "Podkova", "Poller+One", "Poly", "Pompiere", "Prata", "Prociono", "Puritan", "Quattrocento+Sans", "Quattrocento", "Questrial", "Quicksand", "Radley", "Raleway", "Rammetto+One", "Rancho", "Rationale", "Redressed", "Reenie+Beanie", "Ribeye+Marrow", "Ribeye", "Righteous", "Rochester", "Rock+Salt", "Rokkitt", "Rosario", "Ruslan+Display", "Salsa", "Sancreek", "Sansita+One", "Satisfy", "Schoolbell", "Shadows+Into+Light", "Shanti", "Short+Stack", "Sigmar+One", "Signika+Negative", "Signika", "Six+Caps", "Slackey", "Smokum", "Smythe", "Sniglet", "Snippet", "Sorts+Mill+Goudy", "Special+Elite", "Spinnaker", "Spirax", "Stardos+Stencil", "Sue+Ellen+Francisco", "Sunshiney", "Supermercado+One", "Swanky+and+Moo+Moo", "Syncopate", "Tangerine", "Tenor+Sans", "Terminal+Dosis", "The+Girl+Next+Door", "Tienne", "Tinos", "Tulpen+One", "Ubuntu+Condensed", "Ubuntu+Mono", "Ubuntu", "Ultra", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "Unna", "VT323", "Varela+Round", "Varela", "Vast+Shadow", "Vibur", "Vidaloka", "Volkhov", "Vollkorn", "Voltaire", "Waiting+for+the+Sunrise", "Wallpoet", "Walter+Turncoat", "Wire+One", "Yanone+Kaffeesatz", "Yellowtail", "Yeseva+One");

$theme_slider_effects = array("sliceDownRight","sliceDownLeft","sliceUpRight","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");

$theme_100_size_length = array(
"1","2","3","4","5","6","7","8","9","10",
"11","12","13","14","15","16","17","18","19","20",
"21","22","23","24","25","26","27","28","29","30",
"31","32","33","34","35","36","37","38","39","40",
"41","42","43","44","45","46","47","48","49","50",
"51","52","53","54","55","56","57","58","59","60",
"61","62","63","64","65","66","67","68","69","70",
"71","72","73","74","75","76","77","78","79","80",
"81","82","83","84","85","86","87","88","89","90",
"91","92","93","94","95","96","97","98","99","100"
);

/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall



		


/*
#############################
####General Theme Options#### 
#############################
*/
$options[] = array( "name" => __('General Settings','extensio'),
			"type" => "heading");
			
$options[] = array( "name" => __('Website Logo','extensio'),
			"desc" => __('Upload a custom logo for your site.','extensio'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Logo Image Width','extensio'),
			"desc" => __('Enter the Logo image width (in <strong>px</strong>).','extensio'),
			"id" => $shortname."_logo_width",
			"std" => "109",
			"type" => "text");		
			
$options[] = array( "name" => __('Logo Image Height','extensio'),
			"desc" => __('Enter the Logo image height (in <strong>px</strong>).','extensio'),
			"id" => $shortname."_logo_height",
			"std" => "35",
			"type" => "text");			
			
$options[] = array( "name" => __('Favicon','extensio'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>','extensio'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");
			
$options[] = array( "name" => __('WordPress Admin Bar','extensio'),
			"desc" => __('Here you can enable/disable WordPress Admin Bar.','extensio'),
			"id" => $shortname."_admin_bar",
			"std" => "No",
			"type" => "select",
			"options" => array("Yes","No"));
			
$options[] = array( "name" => __('Custom CSS','extensio'),
			"desc" => __('Use this area to add custom CSS to your website.','extensio'),
			"id" => $shortname."_custom_css",
			"std" => "",
			"type" => "textarea");


			
			
			
			
/*
#############################
####Theme Style Options#### 
#############################
*/
$options[] = array( "name" => __('Theme Style','extensio'),
			"type" => "heading");
		
$options[] = array( "name" => __('Backgound Type','extensio'),
			"desc" => __('Select Boxed or Wide background.','extensio'),
			"id" => $shortname."_theme_background",
			"std" => "Wide",
			"type" => "select",
			"options" => array("Wide","Boxed"));
			
$options[] = array( "name" => __('Color Schemes','extensio'),
			"desc" => __('Select color scheme.','extensio'),
			"id" => $shortname."_theme_color",
			"std" => "Blue Style",
			"type" => "select",
			"options" => array("Blue Style","Green Style","Magenta Style","Orange Style", "Red Style"));
			
			

/*
#############################
#######Contact Options########
#############################
*/
$options[] = array( "name" => __('Contact Settings','extensio'),
			"type" => "heading");
$options[] = array( "name" => __('Contact Email','extensio'),
			"desc" => __('Please enter your email for contact form.','extensio'),
			"id" => $shortname."_contact_email",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Google Map URL','extensio'),
			"desc" => __('Put the Google Map URL, that will be used in Contact page template. <br /><br /><em>Be sure that the link has at the end: <strong>&amp;output=embed</strong></em>','extensio'),
			"id" => $shortname."_google_map",
			"std" => "",
			"type" => "textarea");			

$options[] = array( "name" => __('reCpatcha','extensio'),
			"desc" => "",
			"std" => "Enable reCaptcha and put your public key and private key.",
			"type" => "info");

$options[] = array( "name" => __('Enable reCAPTCHA','extensio'),
			"desc" => "Check to enable reCAPTCHA in contact form.",
			"id" => $shortname."_recaptcha_enabled",
			"std" => "false",
			"type" => "checkbox");		

$options[] = array( "name" => __('reCAPTCHA public key','extensio'),
			"desc" => __('Enter reCAPTCHA public key.','extensio'),
			"id" => $shortname."_recaptcha_publickey",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('reCAPTCHA private key','extensio'),
			"desc" => __('Enter reCAPTCHA private key.','extensio'),
			"id" => $shortname."_recaptcha_privatekey",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('reCaptcha theme','extensio'),
			"desc" => __('Once you\'ve successfully installed reCAPTCHA on your site, you may want to change the way it looks.','extensio'),
			"id" => $shortname."_recaptcha_theme",
			"std" => "Red",
			"type" => "select",
			"options" => array("red","white","blackglass","clean") );

$options[] = array( "name" => __('reCaptcha lang','extensio'),
			"desc" => __('Defines which theme to use for reCAPTCHA. The red, white, blackglass, and clean themes are pre-defined themes where reCAPTCHA provides the user interface. In the custom theme, your site has full control over the reCAPTCHA appearance.','extensio'),
			"id" => $shortname."_recaptcha_lang",
			"std" => "en",
			"type" => "select",
			"options" => array("en","nl","fr","de","pt","ru","es","tr") );			

			


			
			
/*
#############################
####Theme Menu Options#### 
#############################
*/
$options[] = array( "name" => __('Menu Settings','extensio'),
			"type" => "heading");


$options[] = array( "name" => __('Middle Header Menu Section','extensio'),
			"desc" => "",
			"std" => "In this section you can set the menu navigation settings.",
			"type" => "info" );
			
$options[] = array( "name" => __('Menu Font Name','extensio'),
			"desc" => __('Set the menu font.','extensio'),
			"id" => $shortname."_header_menu_font",
			"std" => "Open+Sans",
			"type" => "select",
			"options" => $theme_fonts );
$start = 0;
$times = 1;
$answer = array();
for ($start; $start <= 100; $start++) {
	$header_menu_size[$start] = $start * $times;
}
$options[] = array( "name" => __('Menu Font Size','extensio'),
			"desc" => __('Set the menu font size.','extensio'),
			"id" => $shortname."_header_menu_font_size",
			"std" => "14",
			"type" => "select",
			"options" => $header_menu_size );			

$options[] = array( "name" => __('Main Menu Font Color','extensio'),
			"desc" => __('Click to change the Main Menu Font Color.','extensio'),
			"id" => $shortname."_header_menu_font_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('Main Menu On Hover Font Color','extensio'),
			"desc" => __('Click to change the Main Menu On Hover Font Color.','extensio'),
			"id" => $shortname."_header_menu_onhover_font_color",
			"std" => "",
			"type" => "color");			
$options[] = array( "name" => __('SubMenu Font Color','extensio'),
			"desc" => __('Click to change the SubMenu Font Color.','extensio'),
			"id" => $shortname."_header_submenu_font_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('SubMenu On Hover Font Color','extensio'),
			"desc" => __('Click to change the SubMenu On Hover Font Color.','extensio'),
			"id" => $shortname."_header_submenu_onhover_font_color",
			"std" => "",
			"type" => "color");						
			
			
			
			
			
			
/*
#############################
#######Slider Options########
#############################
*/		
$options[] = array( "name" => __('Slider Settings','extensio'),
			"type" => "heading");
			
$options[] = array( "name" => __('Slides Type','extensio'),
			"desc" => "Select the slider type.",
			"id" => $shortname."_slider_type",
			"std" => "Basic Slider",
			"type" => "select",
			"options" => array("OneByOne Slider", "Accordion Slider", "CarouFredSel Slider", "Nivo Slider", "Piecemaker Slider"));
$options[] = array( "name" => __('Slides Count','extensio'),
			"desc" => "Set the numbers of how many slides to show in homepage slider. Will be listed slides ordered by menu order.",
			"id" => $shortname."_slides_count",
			"std" => "3",
			"type" => "select",
			"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"));


$options[] = array( "name" => __('Use Video or Static Image instead the slider','extensio'),
			"desc" => "",
			"std" => "Enter full Image URL or Video URL (Vimeo, YouTube) <br />to display it instead the slider.",
			"type" => "info");
$options[] = array( "name" => __('Activate Video/Image URL','extensio'),
			"desc" => "Select <strong>Image</strong> or <strong>Video</strong> to disable the slider and to display Static Image or Video.",
			"id" => $shortname."_slider_image_or_video",
			"std" => "No",
			"type" => "select",
			"options" => array("No", "Image", "Video"));
$options[] = array( "name" => __('Video/Image URL','extensio'),
			"desc" => "Enter full URL path.",
			"id" => $shortname."_slider_image_or_video_url",
			"std" => "",
			"type" => "text");


			

$options[] = array( "name" => __('OneByOne Slider Settings','extensio'),
			"desc" => "",
			"std" => "Set OneByOne Slider settings in this section.",
			"type" => "info");
$options[] = array( "name" => __('easeType Animation Style','extensio'),
			"desc" => __('The easeType animation style.','extensio'),
			"id" => $shortname."_slider_onebyone_easeType",
			"std" => "fadeInDown",
			"type" => "select",
			"options" => array("random", "rollIn", "fadeIn", "fadeInUp", "fadeInDown", "fadeInLeft", "fadeInRight", "fadeInRight", "bounceIn", "bounceInDown", "bounceInUp", "bounceInLeft", "bounceInRight", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight"));
$options[] = array( "name" => __('Delay','extensio'),
			"desc" => "The delay of the touch/drag tween.",
			"id" => $shortname."_slider_onebyone_delay",
			"std" => "300",
			"type" => "text");
$options[] = array( "name" => __('Tolerance','extensio'),
			"desc" => "The tolerance of the touch/drag.",
			"id" => $shortname."_slider_onebyone_tolerance",
			"std" => "0.25",
			"type" => "text");			
$options[] = array( "name" => __('Slide Show Delay','extensio'),
			"desc" => "The delay millisecond of the slidershow.",
			"id" => $shortname."_slider_onebyone_slideShowDelay",
			"std" => "3000",
			"type" => "text");
$options[] = array( "name" => __('Eable Drag','extensio'),
			"desc" => "Enable or disable the drag function by mouse.",
			"id" => $shortname."_slider_onebyone_enableDrag",
			"std" => "true",
			"type" => "checkbox");
$options[] = array( "name" => __('Show Arrow','extensio'),
			"desc" => "Display the previous/next arrow or not.",
			"id" => $shortname."_slider_onebyone_showArrow",
			"std" => "false",
			"type" => "checkbox");
$options[] = array( "name" => __('Show Button','extensio'),
			"desc" => "Display the circle buttons or not.",
			"id" => $shortname."_slider_onebyone_showButton",
			"std" => "true",
			"type" => "checkbox");
$options[] = array( "name" => __('Slide Show','extensio'),
			"desc" => "Auto play the slider or not.",
			"id" => $shortname."_slider_onebyone_slideShow",
			"std" => "true",
			"type" => "checkbox");			
 			
			
			
			
			
			
$options[] = array( "name" => __('Nivo Slider Settings','extensio'),
			"desc" => "",
			"std" => "Set Nivo Slider settings in this section.",
			"type" => "info");
$options[] = array( "name" => __('Slider Effects','extensio'),
			"desc" => __('Select the effect for Nivo slider.','extensio'),
			"id" => $shortname."_slider_effect",
			"std" => "fade",
			"type" => "select",
			"options" => $theme_slider_effects);
$options[] = array( "name" => __('Slider Slices','extensio'),
			"desc" => "Enter number of slider slices.",
			"id" => $shortname."_slider_slices",
			"std" => "15",
			"type" => "select",
			"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"));
$options[] = array( "name" => __('Slider boxCols','extensio'),
			"desc" => "Set number of slider Box Cols.",
			"id" => $shortname."_slider_boxCols",
			"std" => "7",
			"type" => "select",
			"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"));
$options[] = array( "name" => __('Slider boxRows','extensio'),
			"desc" => "Set number of slider Box Rows.",
			"id" => $shortname."_slider_boxRows",
			"std" => "5",
			"type" => "select",
			"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"));
$options[] = array( "name" => __('Slider Animation Speed','extensio'),
			"desc" => "Enter slider speed (1000 = 1 second).",
			"id" => $shortname."_slider_animSpeed",
			"std" => "800",
			"type" => "select",
			"options" => array("100","200","300","400","500","600","700","800","900","1000","1100","1200","1300","1400","1500","1600","1700","1800","1900","2000"));
$options[] = array( "name" => __('Slider Pause Time','extensio'),
			"desc" => "Enter slider pause between slides (1000 = 1 second).",
			"id" => $shortname."_slider_pauseTime",
			"std" => "2500",
			"type" => "select",
			"options" => array("500","600","700","800","900","1000","1100","1200","1300","1400","1500","1600","1700","1800","1900","2000","2500","3000","3500","4000","4500","5000","5500","6000","6500","7000","7500","8000","8500","9000","9500","10000"));
$options[] = array( "name" => __('pauseOnHover','extensio'),
			"desc" => "Pause the slideshow when hovering over slider, then resume when no longer hovering.",
			"id" => $shortname."_slider_pauseOnHover",
			"std" => "true",
			"type" => "checkbox");
$options[] = array( "name" => __('controlNav','extensio'),
			"desc" => "Activate circles navigation.",
			"id" => $shortname."_slider_controlNav",
			"std" => "true",
			"type" => "checkbox");			
$options[] = array( "name" => __('directionNav','extensio'),
			"desc" => "Show Next & Prev navigation.",
			"id" => $shortname."_slider_directionNav",
			"std" => "true",
			"type" => "checkbox");



$options[] = array( "name" => __('Piecemaker 3D Settings','extensio'),
			"desc" => "",
			"std" => "Set Piecemaker Slider settings in this section.",
			"type" => "info");			 
			
$options[] = array( "name" => "LoaderColor",
			 "desc" => "Color of the cubes before the first image appears, also the color of the back sides of the cube, which become visible at some transition types.",
			 "id" => $shortname."_piecemaker_LoaderColor",
			 "std" => "f2f2f2",
			 "type" => "text" );
	 
$options[] = array(	"name" => "InnerSideColor",
			"desc" => "Color of the inner sides of the cube when sliced.",
			"id" => $shortname."_piecemaker_InnerSideColor",
			"std" => "f2f2f2",
			"type" => "text" );
			
$options[] = array(	"name" => "SideShadowAlpha",
			"desc" => "Sides get darker when moved away from the front. This is the degree of darkness:<br/> 0 == no change<br/> 1 == 100% black.",
			"id" => $shortname."_piecemaker_SideShadowAlpha",
			"std" => "0.5",
			"type" => "text" );
$options[] = array(	"name" => "DropShadowAlpha",
			"desc" => "Alpha of the drop shadow:<br/> 0 == no shadow<br/> 1 == opaque.",
			"id" => $shortname."_piecemaker_DropShadowAlpha",
			"std" => "0.3",
			"type" => "text" );						
$options[] = array(	"name" => "DropShadowDistance",
			"desc" => "Distance of the shadow from the bottom of the image.",
			"id" => $shortname."_piecemaker_DropShadowDistance",
			"std" => "5",
			"type" => "text" );	
$options[] = array(	"name" => "DropShadowScale",
			"desc" => "As the shadow is blurred, it appears wider that the actual image, when not resized. Thus it's a good idea to make it slightly smaller. - 1 would be no resizing at all.",
			"id" => $shortname."_piecemaker_DropShadowScale",
			"std" => "0.9",
			"type" => "text" );		
$options[] = array(	"name" => "DropShadowBlurX",
			"desc" => "Blur of the drop shadow on the x-axis.",
			"id" => $shortname."_piecemaker_DropShadowBlurX",
			"std" => "40",
			"type" => "text" );	
$options[] = array(	"name" => "DropShadowBlurY",
			"desc" => "Blur of the drop shadow on the y-axis.",
			"id" => $shortname."_piecemaker_DropShadowBlurY",
			"std" => "4",
			"type" => "text" );
$options[] = array(	"name" => "MenuDistanceX",
			"desc" => "Distance between two menu items (from center to center).",
			"id" => $shortname."_piecemaker_MenuDistanceX",
			"std" => "20",
			"type" => "text" );
$options[] = array(	"name" => "MenuDistanceY",
			"desc" => "Distance of the menu from the bottom of the image.",
			"id" => $shortname."_piecemaker_MenuDistanceY",
			"std" => "20",
			"type" => "text" );
$options[] = array(	"name" => "MenuColor1",
			"desc" => "Color of an inactive menu item.",
			"id" => $shortname."_piecemaker_MenuColor1",
			"std" => "999999",
			"type" => "text" );							
$options[] = array(	"name" => "MenuColor2",
			"desc" => "Color of an active menu item.",
			"id" => $shortname."_piecemaker_MenuColor2",
			"std" => "333333",
			"type" => "text" );							
$options[] = array(	"name" => "MenuColor3",
			"desc" => "Color of the inner circle of an active menu item. Should equal the background color of the whole thing.",
			"id" => $shortname."_piecemaker_MenuColor3",
			"std" => "FFFFFF",
			"type" => "text" );
$options[] = array(	"name" => "ControlSize",
			"desc" => "Size of the controls, which appear on rollover (play, stop, info, link).",
			"id" => $shortname."_piecemaker_ControlSize",
			"std" => "1",
			"type" => "text" );
$options[] = array(	"name" => "ControlDistance",
			"desc" => "Distance between the controls (from the borders).",
			"id" => $shortname."_piecemaker_ControlDistance",
			"std" => "20",
			"type" => "text" );
$options[] = array(	"name" => "ControlColor1",
			"desc" => "Background color of the controls.",
			"id" => $shortname."_piecemaker_ControlColor1",
			"std" => "222222",
			"type" => "text" );
$options[] = array(	"name" => "ControlColor2",
			"desc" => "Font color of the controls.",
			"id" => $shortname."_piecemaker_ControlColor2",
			"std" => "FFFFFF",
			"type" => "text" );
$options[] = array(	"name" => "ControlAlpha",
			"desc" => "Alpha of a control, when mouse is not over.",
			"id" => $shortname."_piecemaker_ControlAlpha",
			"std" => "0.8",
			"type" => "text" );						
$options[] = array(	"name" => "ControlAlphaOver",
			"desc" => "Alpha of a control, when mouse is over.",
			"id" => $shortname."_piecemaker_ControlAlphaOver",
			"std" => "0.95",
			"type" => "text" );						
$options[] = array(	"name" => "ControlsX",
			"desc" => "X-position of the point, which aligns the controls (measured from [0,0] of the image).",
			"id" => $shortname."_piecemaker_ControlsX",
			"std" => "450",
			"type" => "text" );							
$options[] = array(	"name" => "ControlsY",
			"desc" => "Y-position of the point, which aligns the controls (measured from [0,0] of the image).",
			"id" => $shortname."_piecemaker_ControlsY",
			"std" => "280",
			"type" => "text" );
$options[] = array(	"name" => "ControlsAlign",
			"desc" => 'Type of alignment from the point [controlsX, controlsY] - can be "center", "left" or "right".',
			"id" => $shortname."_piecemaker_ControlsAlign",
			"std" => "center",
			"type" => "text" );							
$options[] = array(	"name" => "TooltipHeight",
			"desc" => "Height of the tooltip surface in the menu.",
			"id" => $shortname."_piecemaker_TooltipHeight",
			"std" => "30",
			"type" => "text" );								
$options[] = array(	"name" => "TooltipColor",
			"desc" => "Height of the tooltip surface in the menu.",
			"id" => $shortname."_piecemaker_TooltipColor",
			"std" => "222222",
			"type" => "text" );								
$options[] = array(	"name" => "TooltipTextY",
			"desc" => "Y-distance of the tooltip text field from the top of the tooltip.",
			"id" => $shortname."_piecemaker_TooltipTextY",
			"std" => "5",
			"type" => "text" );							
$options[] = array(	"name" => "TooltipTextStyle",
			"desc" => "The style of the tooltip text, specified in the CSS file.",
			"id" => $shortname."_piecemaker_TooltipTextStyle",
			"std" => "P-Italic",
			"type" => "text" );	
$options[] = array(	"name" => "TooltipTextColor",
			"desc" => "Color of the tooltip text.",
			"id" => $shortname."_piecemaker_TooltipTextColor",
			"std" => "FFFFFF",
			"type" => "text" );	
$options[] = array(	"name" => "TooltipMarginLeft",
			"desc" => "Margin of the text to the left end of the tooltip.",
			"id" => $shortname."_piecemaker_TooltipMarginLeft",
			"std" => "5",
			"type" => "text" );
$options[] = array(	"name" => "TooltipMarginRight",
			"desc" => "Margin of the text to the right end of the tooltip.",
			"id" => $shortname."_piecemaker_TooltipMarginRight",
			"std" => "7",
			"type" => "text" );
$options[] = array(	"name" => "TooltipTextSharpness",
			"desc" => "Sharpness of the tooltip text<br/> (-400 to 400).",
			"id" => $shortname."_piecemaker_TooltipTextSharpness",
			"std" => "50",
			"type" => "text" );	
$options[] = array(	"name" => "TooltipTextThickness",
			"desc" => "Thickness of the tooltip text<br/> (-400 to 400).",
			"id" => $shortname."_piecemaker_TooltipTextThickness",
			"std" => "-100",
			"type" => "text" );	
$options[] = array(	"name" => "InfoWidth",
			"desc" => "The width of the info text field.",
			"id" => $shortname."_piecemaker_InfoWidth",
			"std" => "400",
			"type" => "text" );	
$options[] = array(	"name" => "InfoBackground",
			"desc" => "The background color of the info text field.",
			"id" => $shortname."_piecemaker_InfoBackground",
			"std" => "FFFFFF",
			"type" => "text" );
$options[] = array(	"name" => "InfoBackgroundAlpha",
			"desc" => "The alpha of the background of the info text, the image shines through, when smaller than 1.",
			"id" => $shortname."_piecemaker_InfoBackgroundAlpha",
			"std" => "0.95",
			"type" => "text" );							
$options[] = array(	"name" => "InfoMargin",
			"desc" => "The margin of the text field in the info section to all sides.",
			"id" => $shortname."_piecemaker_InfoMargin",
			"std" => "15",
			"type" => "text" );								
$options[] = array(	"name" => "InfoSharpness",
			"desc" => "Sharpness of the info text (see above).",
			"id" => $shortname."_piecemaker_InfoSharpness",
			"std" => "0",
			"type" => "text" );
$options[] = array(	"name" => "InfoThickness",
			"desc" => "Thickness of the info text (see above).",
			"id" => $shortname."_piecemaker_InfoThickness",
			"std" => "0",
			"type" => "text" );
$options[] = array(	"name" => "Autoplay",
			"desc" => "Number of seconds from one transition to another, if not stopped. Set to 0 to disable autoplay.",
			"id" => $shortname."_piecemaker_Autoplay",
			"std" => "3",
			"type" => "text" );
$options[] = array(	"name" => "FieldOfView",
			"desc" => "See the official Adobe Docs.",
			"id" => $shortname."_piecemaker_FieldOfView",
			"std" => "45",
			"type" => "text" );
							
							
			
			
			
			
/*
#############################
#######Blog Settings#########
#############################
*/		
$options[] = array( "name" => __('Blog Settings','extensio'),
			"type" => "heading");

$options[] = array( "name" => __('Assign Blog Page to a Category','extensio'),
			"desc" => __('Select a Page to display Blog Category.','extensio'),
			"id" => $shortname."_blog_add",
			"type" => "blog_add_cats");

$options[] = array( "name" => __('Blog posts per page','extensio'),
			"desc" => "Enter how many posts to display in Blog listing.",
			"id" => $shortname."_blog_posts_count",
			"std" => "5",
			"type" => "select",
			"options" => array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"));
			
$options[] = array( "name" => __('Order By','extensio'),
			"desc" => __('Select by what to order blog posts in page (by menu_order, date, title, slug, id).','extensio'),
			"id" => $shortname."_blog_order_by",
			"std" => "id",
			"type" => "select",
			"options" => array("menu_order", "date", "title", "slug", "id"));
			
$options[] = array( "name" => __('Order','extensio'),
			"desc" => __('Select how to order blog posts in page (ascendant, descendant).','extensio'),
			"id" => $shortname."_blog_order",
			"std" => "DESC",
			"type" => "select",
			"options" => array("asc","desc"));			
			
$options[] = array( "name" => __('Comments','extensio'),
			"desc" => __('Enable comments in blog posts.','extensio'),
			"id" => $shortname."_blog_post_comments",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('About Author','extensio'),
			"desc" => __('Enable About Author section in blog posts.','extensio'),
			"id" => $shortname."_blog_post_authorinfo",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array( "name" => __('Recent Posts','extensio'),
			"desc" => __('Enable Recent Posts section in blog posts.','extensio'),
			"id" => $shortname."_blog_recent_posts_enable",
			"std" => "true",
			"type" => "checkbox");


/*
#############################
#######portfolio Settings#########
#############################
*/		
$options[] = array( "name" => __('Portfolio Settings','extensio'),
			"type" => "heading");
			
$options[] = array( "name" => __('Assign Portfolio Page to a Category','extensio'),
			"desc" => __('Select a Page to display Portfolio Category.','extensio'),
			"id" => $shortname."_portfolio_add",
			"type" => "portfolio_add_cats");			

$options[] = array( "name" => __('Portfolio images per page','extensio'),
			"desc" => "Set how many items to show in Portfolio per page. <br /><br /><em>Use <strong>All</strong> to display all portfolio items on Portfolio page.</em>",
			"id" => $shortname."_portfolio_items_count",
			"std" => "All",
			"type" => "select",
			"options" => array("All","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"));

$options[] = array( "name" => __('Order By','extensio'),
			"desc" => __('Select by what to order portfolio items in page (by menu_order, date, title, slug, id).','extensio'),
			"id" => $shortname."_portfolio_order_by",
			"std" => "id",
			"type" => "select",
			"options" => array("menu_order", "date", "title", "slug", "id"));
			
$options[] = array( "name" => __('Order','extensio'),
			"desc" => __('Select how to order portfolio items in page (ascendant, descendant).','extensio'),
			"id" => $shortname."_portfolio_order",
			"std" => "DESC",
			"type" => "select",
			"options" => array("asc","desc"));
			
$options[] = array( "name" => __('Recent Projects','extensio'),
			"desc" => __('Enable Recent Projects section in portfolio details page.','extensio'),
			"id" => $shortname."_portfolio_last_items_enable",
			"std" => "true",
			"type" => "checkbox");			
			
			
/*
#############################
####Socials Links Options#### 
#############################
*/
$options[] = array( "name" => __('Socials Links','extensio'),
			"type" => "heading");
			
$options[] = array( "name" => __('1. Facebook URL','extensio'),
			"desc" => "Enter Facebook URL.",
			"id" => $shortname."_social_links_facebook",
			"std" => "",
			"type" => "text");	
$options[] = array( "name" => __('Facebook Caption','extensio'),
			"desc" => "Enter Facebook Caption.",
			"id" => $shortname."_social_links_facebook_caption",
			"std" => "Like us on Facebook",
			"type" => "text");			
$options[] = array( "name" => __('2. Twitter URL','extensio'),
			"desc" => "Enter Twitter URL.",
			"id" => $shortname."_social_links_twitter",
			"std" => "",
			"type" => "text");			
$options[] = array( "name" => __('Twitter Caption','extensio'),
			"desc" => "Enter Twitter Caption.",
			"id" => $shortname."_social_links_twitter_caption",
			"std" => "Follow us on Twitter",
			"type" => "text");						
$options[] = array( "name" => __('3. Dribbble URL','extensio'),
			"desc" => "Enter  Dribbble URL.",
			"id" => $shortname."_social_links_dribbble",
			"std" => "",
			"type" => "text");			
$options[] = array( "name" => __('Dribbble Caption','extensio'),
			"desc" => "Enter  Dribbble Caption.",
			"id" => $shortname."_social_links_dribbble_caption",
			"std" => "Dribbble Shots",
			"type" => "text");						
$options[] = array( "name" => __('4. YouTube URL','extensio'),
			"desc" => "Enter YouTube URL.",
			"id" => $shortname."_social_links_youtube",
			"std" => "",
			"type" => "text");
$options[] = array( "name" => __('YouTube Caption','extensio'),
			"desc" => "Enter YouTube Caption.",
			"id" => $shortname."_social_links_youtube_caption",
			"std" => "Youtube Channel",
			"type" => "text");			
$options[] = array( "name" => __('5. Google+ URL','extensio'),
			"desc" => "Enter Google+ URL.",
			"id" => $shortname."_social_links_googleplus",
			"std" => "",
			"type" => "text");
$options[] = array( "name" => __('Google+ Caption','extensio'),
			"desc" => "Enter Google+ Caption.",
			"id" => $shortname."_social_links_googleplus_caption",
			"std" => "Google+ Page",
			"type" => "text");			
$options[] = array( "name" => __('6. LinkedIn URL','extensio'),
			"desc" => "Enter LinkedIn URL.",
			"id" => $shortname."_social_links_linkedin",
			"std" => "",
			"type" => "text");
$options[] = array( "name" => __('LinkedIn Caption','extensio'),
			"desc" => "Enter LinkedIn Caption.",
			"id" => $shortname."_social_links_linkedin_caption",
			"std" => "Follow us on LinkedIn",
			"type" => "text");			

	
	


/*
#############################
#######Search Options########
#############################
*/		
$options[] = array( "name" => __('Search Settings','extensio'),
			"type" => "heading");

$options[] = array( "name" => __('Search results per page','extensio'),
			"desc" => "Set how many search results to show in Search page. <br /><br /><em>Use <strong>All</strong> to display all search results in one page.</em>",
			"id" => $shortname."_search_result_items_count",
			"std" => "All",
			"type" => "select",
			"options" => array("All","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"));
			
$options[] = array( "name" => __('Pages Search Form','extensio'),
			"desc" => "Here you can show or hide the search from Pages.",
			"id" => $shortname."_search_pages",
			"std" => "true",
			"type" => "checkbox");
$options[] = array( "name" => __('Blog Pages Search Form','extensio'),
			"desc" => "Here you can show or hide the search from Blog pages.",
			"id" => $shortname."_search_blogs",
			"std" => "false",
			"type" => "checkbox");
$options[] = array( "name" => __('Portfolio Pages Search Form','extensio'),
			"desc" => "Here you can show or hide the search from Portfolio pages.",
			"id" => $shortname."_search_portfolio",
			"std" => "true",
			"type" => "checkbox");
$options[] = array( "name" => __('Contact Page Search Form','extensio'),
			"desc" => "Here you can show or hide the search from Contact page.",
			"id" => $shortname."_search_contact",
			"std" => "false",
			"type" => "checkbox");

$options[] = array( "name" => __('Search Resluts','extensio'),
			"desc" => "Select the option to set which results to display while searching.",
			"id" => $shortname."_search_results",
			"std" => "post",
			"type" => "select",
			"options" => array("post","page","portfolio","post, portfolio","post, page","page, portfolio","post, page, portfolio"));
			
/*
#############################
#######Footer Options########
#############################
*/		
$options[] = array( "name" => __('Footer Settings','extensio'),
			"type" => "heading");

$options[] = array( "name" => __('Footer Columns','extensio'),
			"desc" => __('Here you can set how many columns and which type of columns to use in footer.<br /><br /><em>Select the option <strong>Hide footer</strong> to disable the footer on entire web site.</em>','extensio'),
			"id" => $shortname."_footer_columns",
			"std" => "1/4+1/4+1/4+1/4",
			"type" => "select",
			"options" => array("Hide Footer","1/1","1/2+1/2","1/3+1/3+1/3","1/4+1/4+1/4+1/4","1/4+3/4","3/4+1/4","1/3+2/3","2/3+1/3","1/4+1/4+1/2","1/4+1/2+1/4","1/2+1/4+1/4"));

$options[] = array( "name" => __('Sub Footer Columns','extensio'),
			"desc" => __('Here you can Show/Hide the subfooter section.','extensio'),
			"id" => $shortname."_subfooter_columns",
			"std" => "Show",
			"type" => "select",
			"options" => array("Show","Hide"));
			
$options[] = array( "name" => __('Footer (Copyright)','extensio'),
			"desc" => "Enter in the company that is copyrighting site content. <br />This will show up in the subfooter.",
			"id" => $shortname."_footer",
			"std" => "&copy; Copyright 2012. All Rights Reserved.",
			"type" => "textarea");
		
$options[] = array( "name" => __('Tracking Code','extensio'),
			"desc" => __('Paste Google Analytics (or other) tracking code here. <br /><br />Need Help? Click <a href="http://www.google.com/support/analytics/bin/answer.py?hl=en&answer=55603" target="_blank">here</a>.','extensio'),
			"id" => $shortname."_tracking_code",
			"std" => "",
			"type" => "textarea");

/*
#############################
#######Sidebars Options########
#############################
*/
$options[] = array( "name" => __('Custom Sidebars','extensio'),
			"type" => "heading");

$options[] = array( "name" => __('Add, Edit, Remove sidebars','extensio'),
			"desc" => "Add new sidebars for posts, portfolio items, pages when you are editing pages, posts, footer! <br /><br />Then select the sidebar in the <strong>Page Options</strong>, <strong>Post Options</strong>.<br /><br /><em>In <strong>Appearance > Widgets</strong> you can add info for these sidebars.<br/><br/><strong>Note:</strong> To delete one sidebar, just leave it empty and click button <strong>Save All Changes</strong>.</em>",
			"id" => $shortname."_sidebars_cp",
			"std" => "",
			"type" => "custom_sidebars_panel");
											
	
				

/*
#############################
####Theme Header Color Options#### 
#############################
*/
$options[] = array( "name" => __('Header Color Settings','extensio'),
			"type" => "heading");

$options[] = array( "name" => __('Top Header Line Section','extensio'),
			"desc" => "",
			"std" => "This is the Background Section where you can set Background Color, Background Pattern or Header Line Height.",
			"type" => "info");	
$options[] = array( "name" => __('Header Line Background Color','extensio'),
			"desc" => __('Click to change the Header Line Background Color.','extensio'),
			"id" => $shortname."_header_line_background_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('Header Line Background Pattern','extensio'),
			"desc" => __('Upload a pattern for Header Line Background.','extensio'),
			"id" => $shortname."_header_line_background_image",
			"std" => "",
			"type" => "upload");

$start = 0;
$times = 1;
$answer = array();
for ($start; $start <= 100; $start++) {
	$header_line_height[$start] = $start * $times;
}
$options[] = array( "name" => __('Header Line Height','extensio'),
			"desc" => "Select height for Header Line <br />(default is 5 pixels).<br />Select <strong>0</strong> (zero) to hide it.",
			"id" => $shortname."_header_line_height",
			"std" => "5",
			"type" => "select",
			"options" => $header_line_height );

			
			

$options[] = array( "name" => __('Slider Header & Pages Intro Sections','extensio'),
			"desc" => "",
			"std" => "In this section you can set the color for Slider Section and for Intro Section under the Middle Header Menu Section in inner pages.",
			"type" => "info" );
			
$options[] = array( "name" => __('Homepage Slider Background Color','extensio'),
			"desc" => "",
			"desc" => __('Click to change the Slder Background color.','extensio'),
			"id" => $shortname."_header_slider_background_color",
			"std" => "",
			"type" => "color" );

$options[] = array( "name" => __('Pages Intro Background Color','extensio'),
			"desc" => "",
			"desc" => __('Click to change the Pages Intro Background color.','extensio'),
			"id" => $shortname."_header_pages_intro_background_color",
			"std" => "",
			"type" => "color" );

$options[] = array( "name" => __('Pages Intro Font Color','extensio'),
			"desc" => "",
			"desc" => __('Click to change the Pages Intro Font color.','extensio'),
			"id" => $shortname."_header_pages_intro_font_color",
			"std" => "",
			"type" => "color" );
			

/*
################################################
####Theme Footer Color Options#### 
################################################
*/
$options[] = array( "name" => __('Footer Color Settings','extensio'),
			"type" => "heading");

$options[] = array( "name" => __('Footer Section','extensio'),
			"desc" => "",
			"std" => "This is the Footer Background Section where you can set Background Color or Background Pattern.",
			"type" => "info");	
$options[] = array( "name" => __('Footer Background Color','extensio'),
			"desc" => __('Click to change the Footer Background Color.','extensio'),
			"id" => $shortname."_footer_background_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('Footer Background Pattern','extensio'),
			"desc" => __('Upload a pattern for Footer Background.','extensio'),
			"id" => $shortname."_footer_background_image",
			"std" => "",
			"type" => "upload");
$options[] = array( "name" => __('Footer Background Headers Color','extensio'),
			"desc" => __('Click to change the Footer Headers Color (h1, h2, h3, h4, h5, h6).','extensio'),
			"id" => $shortname."_footer_headers_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('Footer Background Font Color','extensio'),
			"desc" => __('Click to change the Footer Font Color.','extensio'),
			"id" => $shortname."_footer_font_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('Footer Background Links Color','extensio'),
			"desc" => __('Click to change the Footer Links Color.','extensio'),
			"id" => $shortname."_footer_link_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('Footer Background Link Hover Color','extensio'),
			"desc" => __('Click to change the Footer Link Hover Color.','extensio'),
			"id" => $shortname."_footer_link_hover_color",
			"std" => "",
			"type" => "color");




/*
################################################
####Theme SubFooter Color Options#### 
################################################
*/
$options[] = array( "name" => __('SubFooter Color Settings','extensio'),
			"type" => "heading");			
			
$options[] = array( "name" => __('SubFooter Section','extensio'),
			"desc" => "",
			"std" => "This is the SubFooter Background Section where you can set Background Color or Background Pattern.",
			"type" => "info");	
$options[] = array( "name" => __('SubFooter Background Color','extensio'),
			"desc" => __('Click to change the SubFooter Background Color.','extensio'),
			"id" => $shortname."_subfooter_background_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('SubFooter Background Pattern','extensio'),
			"desc" => __('Upload a pattern for SubFooter Background.','extensio'),
			"id" => $shortname."_subfooter_background_image",
			"std" => "",
			"type" => "upload");
$options[] = array( "name" => __('SubFooter Background Headers Color','extensio'),
			"desc" => __('Click to change the SubFooter Headers Color (h1, h2, h3, h4, h5, h6).','extensio'),
			"id" => $shortname."_subfooter_headers_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('SubFooter Background Font Color','extensio'),
			"desc" => __('Click to change the SubFooter Font Color.','extensio'),
			"id" => $shortname."_subfooter_font_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('SubFooter Background Links Color','extensio'),
			"desc" => __('Click to change the SubFooter Links Color.','extensio'),
			"id" => $shortname."_subfooter_link_color",
			"std" => "",
			"type" => "color");
$options[] = array( "name" => __('SubFooter Background Link Hover Color','extensio'),
			"desc" => __('Click to change the SubFooter Link Hover Color.','extensio'),
			"id" => $shortname."_subfooter_link_hover_color",
			"std" => "",
			"type" => "color");			

			

			
											
/*
#############################
####Background Settings######
#############################
*/		
$options[] = array( "name" => __('Site Background Settings','extensio'),
			"type" => "heading");

$options[] = array( "name" => __('Site Backgorund (when is used [Boxed] background type)','extensio'),
			"desc" => "",
			"std" => "This is the Site Background section where you can set Site Background Color or Site Background Image or Pattern.",
			"type" => "info");
			
$options[] = array( "name" => __('Background Color','extensio'),
			"desc" => __('Click to change Site Background Color.','extensio'),
			"id" => $shortname."_site_background_color",
			"std" => "",
			"type" => "color");
			
$options[] = array( "name" => __('Background Image','extensio'),
			"desc" => __('Upload Site Background Image or Pattern.','extensio'),
			"id" => $shortname."_site_background_image",
			"std" => "",
			"type" => "upload");
$options[] = array( "name" => __('Background Image Display Options','extensio'),
			"desc" => __('Background image <strong>Position</strong> option.','extensio'),
			"id" => $shortname."_site_background_image_position",
			"std" => "left",
			"type" => "radio",
			"options" => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right'
				));
$options[] = array( /*"name" => __('Background Image Position','extensio'),*/
			"desc" => __('Background image <strong>Repeat</strong> option.','extensio'),
			"id" => $shortname."_site_background_image_repeat",
			"std" => "no-repeat",
			"type" => "radio",
			"options" => array(
				'repeat' => 'Repeat',
				'no-repeat' => 'No Repeat',
				'repeat-x' => 'Tile Horizontally',
				'repeat-y' => 'Tile Vertically'
				));


				
			
			
update_option('of_template',$options);
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>