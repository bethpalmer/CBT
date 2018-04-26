<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'search_links_load_widgets' );

/**
 * Register our widget.
 * 'search_links_Widget' is the widget class used below.
 */
function search_links_load_widgets() {
	register_widget( 'search_links_Widget' );
}

/**
 * search_links Widget class.
 */
class search_links_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function search_links_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'search_links', 'description' => 'A Search from your site.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'search_links-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'search_links-widget', 'Extensio - Search', $widget_ops, $control_ops );
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
		
		/* Display the widget title if one was input (before and after defined by themes). */
		if ($title) { 
			$title = $before_title . $title . $after_title; 
		} 
?>	

		<!-- form search -->
		<?php echo $title; ?>
		<form action="<?php echo home_url(); ?>" method="get" class="search">
			<fieldset>
				<input type="text" name="s" id="s" value="<?php _e('Click or type here to search','extensio'); ?>" class="text" >
				<input type="submit" value="go" class="submit" >
			</fieldset>
		</form>		

<?php
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
		$defaults = array( 'title' => '', 'description' => 'A Search from your site.' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
?>