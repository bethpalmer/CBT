<?php
add_action('init', 'portfolio_register');
function portfolio_register() {
	  $labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio Entry',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Portfolio Entry',
		'edit_item' => 'Edit Portfolio Entry',
		'new_item' => 'New Portfolio Entry',
		'view_item' => 'View Portfolio Entry',
		'search_items' => 'Search Portfolio Entries',
		'not_found' =>  'No Portfolio Entries found',
		'not_found_in_trash' => 'No Portfolio Entries found in Trash', 
		'parent_item_colon' => ''
	  );

	$slugRule = get_option('category_base');

	global $paged;
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'rewrite' => array('slug'=>'portfolios','with_front'=>false),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'show_in_nav_menus'=> false,
		'query_var' => true,
		'paged' => $paged,			
		'menu_position' => 5,
		'supports' => array('title','thumbnail','excerpt','editor','comments')
	);

	register_post_type('portfolio' , $args);
	
	
	register_taxonomy("portfolio_entries", 
						array("portfolio"), 
						array(	"hierarchical" => true, 
								"label" => "Portfolio Categories", 
								"singular_label" => "Portfolio Categories", 
								'rewrite' => array('slug' => 'portfolio-category'),
								"query_var" => true,
								'paged' => $paged
							));  
	flush_rewrite_rules( false );	
}

add_action('admin_init', 'add_portfolio');
flush_rewrite_rules(false);

add_action('save_post', 'update_portfolio');
function add_portfolio(){
	add_meta_box("portfolio_details", "Portfolio Options", "portfolio_options", "portfolio", "normal", "low");
}
function portfolio_options(){
	global $post, $shortname;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
	
	$custom = get_post_custom($post->ID);
			
	$custom_page_heading = $custom["custom_page_heading"][0];
	$portfolio_video_url = $custom["portfolio_video_url"][0];
	$current_sidebar = $custom["current_sidebar"][0];
	$custom_footer = $custom["custom_footer"][0];		
	$footer_widget_enable = $custom["footer_widget_enable"][0];
	$subfooter_enable = $custom["subfooter_enable"][0];
?>
<div id="portfolio-options">
	<table>		

		<tr>
			<td valign="top">
				<label><strong>Page Heading:&nbsp;&nbsp;</strong></label>
			</td>
			<td>
				
			</td>
			<td>
				<input style="width: 50%;" name="custom_page_heading" value="<?php echo $custom_page_heading; ?>" /><br/>
				<small>Enter page heading.</small><br/><br/><br/>					
			</td>
		</tr>				
		<tr>
			<td valign="top">
				<label><strong>Portfolio Video URL:&nbsp;&nbsp;</strong></label>
			</td>
			<td>
				
			</td>
			<td>
				<input style="width: 50%;" name="portfolio_video_url" value="<?php echo $portfolio_video_url; ?>" /><br/>
				<small>Enter <strong>Portfolio Video URL</strong> or enter other image url to load in lightbox</small><br/><br/><br/>					
			</td>
		</tr>			
		<?php 
			$get_custom_options = get_option($shortname.'_sidebars_cp');
			
			if ($get_custom_options[$shortname.'_sidebars_cp_url_1']) {
		?>
		<tr>
			<td>
				<label><strong>Select Sidebar: </strong></label><br/><br/>
			</td>
			<td>
				
			</td>
			<td>
				<?php				
					echo '<select name="current_sidebar">';	
					echo '<option value=""></option>';		
					
					
					$get_custom_options = get_option($shortname.'_sidebars_cp');
					$m = 0;
					for($i = 1; $i <= 200; $i++) 
					{
						if ($get_custom_options[$shortname.'_sidebars_cp_url_'.$i])
						{	
							if ( $current_sidebar == $get_custom_options[$shortname.'_sidebars_cp_url_'.$i] ) { 
								?>
									<option selected value='<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?>'>&nbsp;&nbsp;&nbsp;<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?></option>";
								<?php	
							} else {
								?>
									<option value='<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?>'>&nbsp;&nbsp;&nbsp;<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?></option>";
								<?php 
							}
						}
					}
					
					echo '</select>';
				?>
				<br/><label>Select custom page sidebar.</label><br/><br/>
			</td>
		</tr>			
		<?php } ?>
		
		<?php 
			$get_custom_options = get_option($shortname.'_sidebars_cp');
			
			if ($get_custom_options[$shortname.'_sidebars_cp_url_1']) {
		?>
		<tr>
			<td>
				<label><strong>Select Footer Widget: </strong></label><br/><br/>
			</td>
			<td>
				
			</td>
			<td>
				<?php				
					echo '<select name="custom_footer">';	
					echo '<option value=""></option>';
					
					$get_custom_options = get_option($shortname.'_sidebars_cp');
					$m = 0;
					for($i = 1; $i <= 200; $i++) 
					{
						if ($get_custom_options[$shortname.'_sidebars_cp_url_'.$i])
						{	
							if ( $custom_footer == $get_custom_options[$shortname.'_sidebars_cp_url_'.$i] ) { 
								?>
									<option selected value='<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?>'>&nbsp;&nbsp;&nbsp;<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?></option>";
								<?php	
							} else {
								?>
									<option value='<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?>'>&nbsp;&nbsp;&nbsp;<?php echo $get_custom_options[$shortname.'_sidebars_cp_url_'.$i]; ?></option>";
								<?php 
							}
						}
					}
					
					echo '</select>';
				?>
				<br/><label>Select footer widget. You can show another information in footer for this page. By default are displayed the Footer Widgets Sidebars.</label><br/><br/>
			</td>
		</tr>			
		<?php } ?>			
	
		<tr>
			<td valign="top">
				<label><strong>Disable Footer:</strong></label>
			</td>
			<td>
				
			</td>
			<td>
				<input type="checkbox" name="footer_widget_enable" id="<?php echo $footer_widget_enable; ?>" <?php echo $footer_widget_enable_checked = ($footer_widget_enable == 'on') ? ' checked="checked"' : ''; ?> />
				<small>Check this option to hide the entire footer section from this portfolio item details page.</small><br/><br/><br/>
			</td>
		</tr>

		<tr>
			<td valign="top">
				<label><strong>Disable SubFooter:</strong></label>
			</td>
			<td>
				
			</td>
			<td>
				<input type="checkbox" name="subfooter_enable" id="<?php echo $subfooter_enable; ?>" <?php echo $subfooter_enable_checked = ($subfooter_enable == 'on') ? ' checked="checked"' : ''; ?> />
				<small>Check this option to hide the entire subfooter section from this portfolio item details page.</small><br/><br/><br/>
			</td>
		</tr>

	</table>
</div><!--end portfolio-options-->   
<?php
}

function update_portfolio(){
	global $post, $shortname;		
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	} else {
		update_post_meta($post->ID, "custom_page_heading", $_POST["custom_page_heading"]);
		update_post_meta($post->ID, "portfolio_video_url", $_POST["portfolio_video_url"]);
		update_post_meta($post->ID, "current_sidebar", $_POST["current_sidebar"]);
		update_post_meta($post->ID, "custom_footer", $_POST["custom_footer"]);
		update_post_meta($post->ID, "footer_widget_enable", $_POST["footer_widget_enable"]);
		update_post_meta($post->ID, "subfooter_enable", $_POST["subfooter_enable"]);
	}
}
?>