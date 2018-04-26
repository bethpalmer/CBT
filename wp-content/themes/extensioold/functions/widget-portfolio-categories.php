<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'portfolio_categories_links_load_widgets' );

/**
 * Register our widget.
 * 'portfolio_categories_links_Widget' is the widget class used below.
 */
function portfolio_categories_links_load_widgets() {
	register_widget( 'portfolio_categories_links_Widget' );
}

/**
 * portfolio_categories_links Widget class.
 */
class portfolio_categories_links_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function portfolio_categories_links_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'portfolio_categories_links', 'description' => 'Portfolio Categories list.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'portfolio_categories_links-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'portfolio_categories_links-widget', 'Extensio - Portfolio Categories', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );		
		
		/* Before widget (defined by themes). */			
		echo $before_widget;
		
		global $shortname, $post, $wp_query;
		
		$thePostID = $post->ID;
		
		$type = 'portfolio';
		$args=array(
			'post_type' => $type,
			'post_status' => 'publish',
			'posts_per_page' => -1
		);
	
		$temp = $wp_query;  // assign original query to temp variable for later use   
		$wp_query = null;
		
		$cats_ungategorized = array();
		
		$wp_query = new WP_Query($args);
		if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();						
			
			$item_categories = get_the_terms( $id, 'portfolio_entries' );
			if(is_object($item_categories) || is_array($item_categories)) {
				foreach ($item_categories as $cat) {
					$duplicate_cat = 0;
					for ($i=0;$i<count($cats_ungategorized);$i++) {
						if ($cats_ungategorized[$i] ==  $cat->slug.'###'.$cat->name) {
							$duplicate_cat = 1;
						}
					}
					if ($duplicate_cat != 1) {
						$cats_ungategorized[] = $cat->slug.'###'.$cat->name;
					} else { $duplicate_cat = 0; }
				}
			}

		endwhile;
		endif;
		$wp_query = null;
		$wp_query = $temp;
		
		asort($cats_ungategorized);

		/* Display the widget title if one was input (before and after defined by themes). */
		if ($title) $title_output = $before_title . $title . $after_title;			
		echo '

				'.$title_output.'
				<ul>
		';
		foreach ($cats_ungategorized as $key => $val) {
			$cats_chunks = explode("###", $val);
			echo '<li><a href="'.get_term_link($cats_chunks[0], 'portfolio_entries').'">'.$cats_chunks[1].'</a></li>
			';
		}
		echo '
				</ul>

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

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'description' => 'Portfolio Categories' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
?>