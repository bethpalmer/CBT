<?php	
	global $shortname;
	if (get_option($shortname.'_favicon')) {
		echo '<link rel="shortcut icon" href="'.get_option($shortname."_favicon").'">';
	}

	if (get_option($shortname.'_slider_type') == 'Piecemaker Slider') {
?>
<script type="text/javascript">
	var flashvars = {};
		flashvars.cssSource = "<?php echo get_template_directory_uri(); ?>/js/piecemaker/piecemaker.css";
		flashvars.xmlSource = "<?php echo get_template_directory_uri(); ?>/js/piecemaker/piecemaker.php";
	var params = {};
		params.play = "true";
		params.menu = "false";
		params.scale = "showall";
		params.wmode = "transparent";
		params.allowfullscreen = "true";
		params.allowscriptaccess = "always";
		params.allownetworking = "all";
	swfobject.embedSWF('<?php echo get_template_directory_uri(); ?>/js/piecemaker/piecemaker.swf', 'piecemaker', '990', '466', '10', null, flashvars, params, null);
</script>
<?php }

if (is_page_template('portfolio-three-sortable.php')) { ?>


<script>
$(function(){
	var $container = $('#works-container');
	$container.isotope({itemSelector : '.element'});

	var $optionSets = $('#options .option-set'),$optionLinks = $optionSets.find('a');
		$optionLinks.click(function(){
		var $this = $(this);
		
		// don't proceed if already selected
		if ( $this.hasClass('selected') ) {
			return false;
		}
		var $optionSet = $this.parents('.option-set');
		$optionSet.find('.selected').removeClass('selected');
		$this.addClass('selected');

		// make option object dynamically, i.e. { filter: '.my-filter-class' }
		var options = {},
		key = $optionSet.attr('data-option-key'),
		value = $this.attr('data-option-value');
		
		// parse 'false' as false boolean
		value = value === 'false' ? false : value;
		options[ key ] = value;
		if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
			// changes in layout modes need extra logic
			changeLayoutMode( $this, options )
		} else {
			// otherwise, apply new options
			$container.isotope( options );
		}
		return false;
	});
});
</script>
<?php } ?>

<script type="text/javascript">
//	$(function() {
//		//	Scrolled by user interaction
//		$('#portfolio_carousel').carouFredSel({
//			pagination: "#carousel_pager",
//			auto: false
//		});
//
//		//	Basic carousel + timer
//		$('#carouFredSel').carouFredSel({
//			auto: {
//				pauseOnHover: 'resume',
//				onPauseStart: function( percentage, duration ) {
//					$(this).trigger( 'configuration', ['width', function( value ) { 
//						$('#timer_carousel').stop().animate({
//							width: value
//						}, {
//							duration: duration,
//							easing: 'linear'
//						});
//					}]);
//				},
//				onPauseEnd: function( percentage, duration ) {
//					$('#timer_carousel').stop().width( 0 );
//				},
//				onPausePause: function( percentage, duration ) {
//					$('#timer_carousel').stop();
//				}
//			}
//		});
//			
//	});
</script>

<script type="text/javascript">
//  $(document).ready(function(){
//	$("a[rel^='prettyPhoto']").prettyPhoto({
//		animation_speed: 'fast', /* fast/slow/normal */
//		slideshow: 5000, /* false OR interval time in ms */
//		autoplay_slideshow: false, /* true/false */
//		opacity: 0.70, /* Value between 0 and 1 */
//		show_title: true, /* true/false */
//		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
//		default_width: 800,
//		default_height: 544,
//		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
//		theme: 'facebook' /* light_rounded / dark_rounded / light_square / dark_square / facebook */
//	});
//  });
</script>

<script type="text/javascript">
//	jQuery(document).ready(function(){
//		// binds form submission and fields to the validation engine
//		jQuery("#cont_form").validationEngine();
//		jQuery("#main_comment_form").validationEngine();
//	});
</script>	

<?php
		//set the theme background color, patterns, background
		$theme_background = get_option($shortname."_theme_background");

		$theme_bodypattern_class = '';
		$theme_bodybgcolor_class = '';
		if ($theme_background == 'Boxed') {
			//set the id for theme backgground pattern
			$theme_bodybgcolor = get_option($shortname."_site_background_color");
			$theme_bodybgimage = get_option($shortname."_site_background_image");
			
			if ($theme_bodybgcolor && !$theme_bodybgimage) {
				$theme_bodybgcolor_class = ' style="background:'.$theme_bodybgcolor.';"';
			} else if ($theme_bodybgimage) {
				$site_background_image_position = get_option($shortname.'_site_background_image_position');
				$site_background_image_repeat = get_option($shortname.'_site_background_image_repeat');
				if (!$theme_bodybgcolor) $theme_bodybgcolor = "#fff";
				$theme_bodybgimage_class = $theme_bodybgcolor." url(".$theme_bodybgimage."); background-position: ".$site_background_image_position." top; background-repeat: ".$site_background_image_repeat.";";
				$theme_bodybgcolor_class = ' style="background:'.$theme_bodybgimage_class.'"';
			}
		}

?>