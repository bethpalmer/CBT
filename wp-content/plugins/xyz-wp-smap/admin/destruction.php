<?php

function smap_premium_network_destroy($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				smap_premium_destroy();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	smap_premium_destroy();
}

function smap_premium_destroy()
{
	global $wpdb;
	
	if(get_option('xyz_credit_link')=="smap")
	{
		update_option("xyz_credit_link", '0');
	}
	delete_option('xyz_smap_fbmessage_format');
	delete_option('xyz_smap_twmessage_format');
	delete_option('xyz_smap_lnmessage_format');
	delete_option('xyz_smap_pimessage_format');
	delete_option('xyz_smap_gpmessage_format');
	
	delete_option('xyz_smap_fb_image_url');
	delete_option('xyz_smap_tw_image_url');
	delete_option('xyz_smap_ln_image_url');
	delete_option('xyz_smap_pi_image_url');
	delete_option('xyz_smap_gp_image_url');
// 	delete_option('xyz_smap_pi_board_pattern');
	
	delete_option('xyz_smap_post_publish_percron');
	delete_option('xyz_smap_min_timedelay_post_publish_value');
	delete_option('xyz_smap_min_timedealy_post_publish_period');
	
	delete_option('xyz_smap_premium_include_pages');
	delete_option('xyz_smap_premium_include_posts');
	delete_option('xyz_smap_premium_include_categories');
	delete_option('xyz_smap_premium_include_customposttypes');
	delete_option('xyz_smap_premium_peer_verification');
	delete_option('xyz_smap_premium_default_selection_create_postORpage');
	delete_option('xyz_smap_premium_default_selection_edit');
	delete_option('xyz_smap_premium_page_size');
	delete_option('xyz_smap_premium_image_preference');
	delete_option('xyz_smap_premium_image_metakey_name');
	delete_option('xyz_smap_premium_hash_tags');
	
	delete_option('xyz_smap_task_type');
	
	delete_option('xyz_smap_clearlogs_interval');
	delete_option('xyz_wp_smap_license_key');
	delete_option('xyz_smap_apply_filters');
	delete_option('xyz_smap_premium_default_cat_sel');
	
	delete_option('xyz_smap_premium_last_check_time');
	delete_option('xyz_smap_premium_version');
	delete_option('xyz_smap_premium_change_log');
	delete_option('xyz_smap_premium_utf_decode');
	
	$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_smap_fb_details");
	
	$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_smap_ln_details");
	
	$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_smap_pi_details");
	
	$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_smap_gp_details");
	
	$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_smap_tasks");
	
	$wpdb->query("DROP TABLE ".$wpdb->prefix."xyz_smap_tw_details");
	xyz_smap_include_addon_file('destruction.php');
}

register_uninstall_hook(XYZ_SMAP_PLUGIN_FILE_PREMIUM,'smap_premium_network_destroy');


?>