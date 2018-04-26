<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'featured_project_load_widgets' );

/**
 * Register our widget.
 * 'Last_Comments_Widget' is the widget class used below.
 */
function featured_project_load_widgets() {
	register_widget( 'featured_project_Widget' );
}

/**
 * featured_project Widget class.
 */
class featured_project_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function featured_project_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Featured Project', 'description' => 'The Featured Project' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'featured-project-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'featured-project-widget', 'Extensio - Featured Project', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$post_page_id = $instance['post_page_id'];

		/* Before widget (defined by themes). */			
		echo $before_widget;		

		echo '
			<!-- featured -->
				<section class="box featured">
		';
		
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) echo $before_title . $title . $after_title;		
		
		global $wpdb;
		global $shortname;

		$sql = 'select DISTINCT * from '.$wpdb->posts.' 
			WHERE '.$wpdb->posts.'.ID='.$post_page_id;
			
		$posts = $wpdb->get_results($sql);
		$output = '';

		foreach ($posts as $post) {

			$post_title = $post->post_title;
			/*if ( (!$titletrim) &&( strlen($post_title) > 17 )) {
				$post_title = substr($post_title,0,17).'...';
			}*/
			
			if ($post->post_excerpt) { $post_description = $post->post_excerpt; } else { $post_description = $post->post_content; }
			if ( strlen($post_description) > 55 ) {
				$post_description = substr($post_description,0,115).'...';
			}			
			$post_description = str_replace('[dropcap]','',$post_description);
			$post_description = str_replace('[/dropcap] ','',$post_description);
			$post_description = str_replace('[/dropcap]','',$post_description);

			$featured_project_thumb = get_the_post_thumbnail($post->ID, 'featured_project');
			
			$output = '
				<figure class="photo">'.$featured_project_thumb.'</figure>
				<h4><a href="'.get_permalink($post->ID).'">'.$post_title.'</a></h4>
				'.$post_description.'
			';
		}
		
		$output .= '</section>';
		echo $output;

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and comments count to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_page_id'] = strip_tags( $new_instance['post_page_id'] );
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Featured Project', 'post_page_id' => '', 'description' => 'The Featured Project' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'post_page_id' ); ?>"><?php echo 'Post, Portfolio or Slider ID:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'post_page_id' ); ?>" name="<?php echo $this->get_field_name( 'post_page_id' ); ?>" value="<?php echo $instance['post_page_id']; ?>" style="width:100%;" />
		</p>		

	<?php
	}
}

?>