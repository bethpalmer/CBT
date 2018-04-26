f<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'recent_works_links_load_widgets' );

/**
 * Register our widget.
 * 'recent_works_links_Widget' is the widget class used below.
 */
function recent_works_links_load_widgets() {
	register_widget( 'recent_works_links_Widget' );
}

/**
 * recent_works_links Widget class.
 */
class recent_works_links_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function recent_works_links_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'recent_works_links', 'description' => 'recent_works list.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'recent_works_links-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'recent_works_links-widget', 'Extensio - Recent Works', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		$number = $instance['number'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		echo '
			<div class="block_resent_works">
				'.$before_title . $title . $after_title.'
				<div id="recent_works" class="block_general_pic">
		';

		global $wpdb;
		$type = 'portfolio';
		$args=array(
			'post_type' => $type,
			'post_status' => 'publish',
			'posts_per_page' => $number,
			'sort_column' => 'menu_order',
			'order' => 'desc'
		);		

		$temp = $wp_query;  // assign original query to temp variable for later use   
		$wp_query = null;
		$wp_query = new WP_Query($args); 

		$i = 0;
		$items_carousel_output = '';
		if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();

			$item_categories = get_the_terms( $id, 'portfolio_entries' );
			if(is_object($item_categories) || is_array($item_categories)) {
				$cat_slug = '';
				foreach ($item_categories as $cat) {
					$cat_slug = $cat->slug;
				}
			}
			
			// get full image from featured image if was not see full image url in Portfolio
			$get_custom_options = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false );
			$image_preview_url = $get_custom_options[0];
			$portfolio_image_thumb = get_the_post_thumbnail($post->ID, 'recent_works', array('class' => 'r_conner_pic', 'alt' => the_title_attribute('echo=0')));
			
			$custom = get_post_custom($post->ID);
			$portfolio_video_url = $custom["portfolio_video_url"][0];						
			if ($portfolio_video_url) $image_preview_url = $portfolio_video_url;
			
			$items_carousel_output .= '
				<div><a href="'.$image_preview_url.'" data-rel="prettyPhoto[gallery1]" title="'.get_the_title().'" class="hover_1">'.$portfolio_image_thumb.'<span class="block_hover">&nbsp;</span></a></div>
			';
			
		endwhile;
		endif;	

		$wp_query = null;
		$wp_query = $temp;
		
		echo $items_carousel_output;
		
		echo '
				</div>
				<div id="recent_works_nav"></div>
			</div>		
		';
		
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'number' => '5', 'description' => 'Recent Portfolio Works' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo 'Count:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
?>