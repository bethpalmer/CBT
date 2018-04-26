<?php
add_action('wp_ajax_xyz_smap_premium_preference_reorder', 'xyz_smap_premium_preference_reorder');

function xyz_smap_premium_preference_reorder()
{
	    $image_preference_array = $_POST['image_preference'];
		$xyz_smap_premium_image_preference = implode(",",$image_preference_array);
		update_option('xyz_smap_premium_image_preference', $xyz_smap_premium_image_preference);
		echo "<span style='color:green;'>Image Preference Reordered Successfully.</span>";
	   die;
}


?>