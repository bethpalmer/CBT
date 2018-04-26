<?php
	wp_reset_query();
	global $shortname;
?>


			</div>
			<!-- footer -->
			<footer id="footer">
				<div class="footer-holder">
				
					<?php if (get_option($shortname."_footer_columns") != 'Hide Footer') ?>
					<?php if (get_post_meta($post->ID, 'footer_widget_enable',true) != 'on') { ?>
					<div class="container">
						<div class="case">
						
							<?php
								$custom = get_post_custom($post->ID);
								$current_sidebar = '';
								
								if (!is_home() && !is_front_page() && !is_page_template('frontpage.php') && !is_page_template('frontpage-light.php') ) {
									$current_sidebar = $custom["custom_footer"][0];
								}
								
								if ($current_sidebar) {
									if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($current_sidebar) ) :
									endif;
								} else {
							?>
							<div class="container">
								<?php								
									$footer_columns_count = get_option($shortname."_footer_columns");
										
									if ($footer_columns_count == '1/1') { $col_number = '11'; }
									else if ($footer_columns_count == '1/2+1/2') { $col_number = '12'; }
									else if ($footer_columns_count == '1/3+1/3+1/3') { $col_number = '13'; }
									else if ($footer_columns_count == '1/4+1/4+1/4+1/4') { $col_number = '14'; }
									else if ($footer_columns_count == '1/4+3/4') { $col_number = '14'; }
									else if ($footer_columns_count == '3/4+1/4') { $col_number = '34'; }
									else if ($footer_columns_count == '1/3+2/3') { $col_number = '13'; }
									else if ($footer_columns_count == '2/3+1/3') { $col_number = '23'; }
									else if ($footer_columns_count == '1/4+1/4+1/2') { $col_number = '14'; }
									else if ($footer_columns_count == '1/4+1/2+1/4') { $col_number = '14'; }
									else if ($footer_columns_count == '1/2+1/4+1/4') { $col_number = '12'; }
								?>
								<article class="col-<?php echo $col_number; ?>">
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 1") ) : ?>
									<?php endif; ?>
								</article>
								<?php
									if ($footer_columns_count != '1/1') {								
										if ($footer_columns_count == '1/2+1/2') { $col_number = '12'; }
										else if ($footer_columns_count == '1/3+1/3+1/3') { $col_number = '13'; }
										else if ($footer_columns_count == '1/4+1/4+1/4+1/4') { $col_number = '14'; }
										else if ($footer_columns_count == '1/4+3/4') { $col_number = '34'; }
										else if ($footer_columns_count == '3/4+1/4') { $col_number = '14'; }
										else if ($footer_columns_count == '1/3+2/3') { $col_number = '23'; }
										else if ($footer_columns_count == '2/3+1/3') { $col_number = '13'; }									
										else if ($footer_columns_count == '1/4+1/4+1/2') { $col_number = '14'; }
										else if ($footer_columns_count == '1/4+1/2+1/4') { $col_number = '12'; }
										else if ($footer_columns_count == '1/2+1/4+1/4') { $col_number = '14'; }
								?>
								<article class="col-<?php echo $col_number; ?>">
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 2") ) : ?>
									<?php endif; ?>
								</article>
								<?php } ?>
								<?php
									if ( ($footer_columns_count != '1/1') && ($footer_columns_count != '1/2+1/2') 
											&& ($footer_columns_count != '1/4+3/4') && ($footer_columns_count != '3/4+1/4') 
											&& ($footer_columns_count != '1/3+2/3') && ($footer_columns_count != '2/3+1/3') ) {

										if ($footer_columns_count == '1/3+1/3+1/3') { $col_number = '13'; }
										else if ($footer_columns_count == '1/4+1/4+1/4+1/4') { $col_number = '14'; }
										else if ($footer_columns_count == '1/4+1/4+1/2') { $col_number = '12'; }
										else if ($footer_columns_count == '1/4+1/2+1/4') { $col_number = '14'; }
										else if ($footer_columns_count == '1/2+1/4+1/4') { $col_number = '14'; }
								?>
								<article class="col-<?php echo $col_number; ?>">
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 3") ) : ?>
									<?php endif; ?>
								</article>
								<?php } ?>
								<?php
									if ($footer_columns_count == '1/4+1/4+1/4+1/4') {
										$col_number = '14';
								?>							
								<article class="col-<?php echo $col_number; ?>">
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column 4") ) : ?>
									<?php endif; ?>
								</article>
								<?php } ?>
							</div>
							<?php } //end to check if custom footer was enabled ?>
							
						</div>
					</div>
					<?php } ?>
					
					<?php if (get_option($shortname."_subfooter_columns") == 'Show') ?>
					<?php if (get_post_meta($post->ID, 'subfooter_enable',true) != 'on') { ?>
					<!-- add -->
					<div class="add">
						<div class="case">
							<strong class="copyright"><?php echo stripslashes(get_option($shortname.'_footer'));  ?></strong>
							<nav class="add-nav">
								<?php
									wp_nav_menu(array(
									'menu'              => 'Footer Menu',
									'container'         => '',
									'container_class'   => '',
									'container_id'      => '',
									'menu_class'        => '',
									'menu_id'           => '',
									'echo'              => true,
									'fallback_cb'       => '',
									'before'            => '',
									'after'             => '',
									'link_before'       => '',
									'link_after'        => '',
									'depth'             => 0,
									'walker'            => '',
									'theme_location'    => 'footer_menu'
									));
								?>
							</nav>
						</div>
					</div>
					<?php } ?>
					
				</div>
			</footer>
		</div>
	</div>
	
	<?php
		if (get_option($shortname.'_slider_type') == 'Nivo Slider') {
	?>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/nivo-slider/jquery.nivo.slider.js"></script>		
		<script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider({
				effect: '<?php echo get_option($shortname."_slider_effect"); ?>',
				slices: <?php echo get_option($shortname."_slider_slices"); ?>,
				boxCols: <?php echo get_option($shortname."_slider_boxCols"); ?>,
				boxRows: <?php echo get_option($shortname."_slider_boxRows"); ?>,
				animSpeed: <?php echo get_option($shortname."_slider_animSpeed"); ?>,
				pauseTime: <?php echo get_option($shortname."_slider_pauseTime"); ?>,
				directionNav: <?php echo get_option($shortname."_slider_directionNav"); ?>,
				directionNavHide: false,
				controlNav: <?php echo get_option($shortname."_slider_controlNav"); ?>,
				pauseOnHover: <?php echo get_option($shortname."_slider_pauseOnHover"); ?>,				
				startSlide: 0,				
				controlNavThumbs: false,
				controlNavThumbsFromRel: false,
				controlNavThumbsSearch: '.jpg',
				controlNavThumbsReplace: '_thumb.jpg',
				keyboardNav: true,
				manualAdvance: false,
				captionOpacity: 0.8,
				prevText: 'Prev',
				nextText: 'Next',
				beforeChange: function(){},
				afterChange: function(){},
				slideshowEnd: function(){},
				lastSlide: function(){},
				afterLoad: function(){}
			});
		});
		</script>
	<?php } ?>
	
	<script type="text/javascript">
		$('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).attr('data-rel')).removeAttr('data-rel');
		});
	</script>

<?php wp_footer(); ?>

<?php echo stripslashes(get_option($shortname.'_tracking_code'));  ?>

</body>
</html>