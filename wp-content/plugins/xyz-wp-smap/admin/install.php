<?php

function smap_premium_network_install($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				smap_install_premium();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	smap_install_premium();
}

function smap_install_premium()
{
	
	global $wpdb;
	$wpdb->show_errors();
	$pluginName = 'social-media-auto-publish/social-media-auto-publish.php';
	if (is_plugin_active($pluginName)) {
		wp_die( "The plugin XYZ WP Social Media Auto Publish cannot be activated unless the free version of this plugin is deactivated. Back to <a href='".admin_url()."plugins.php'>Plugin Installation</a>." );
	}
	
	global $current_user;
	wp_get_current_user();
	if(get_option('xyz_credit_link')=="")
	{
		add_option("xyz_credit_link", '0');
	}
	
	
	$is_fb_import_flag=0;$is_tw_import_flag=0;$is_ln_import_flag=0;
	
	
	if(count($wpdb->get_results("SHOW TABLES LIKE '".$wpdb->prefix."xyz_smap_fb_details'"))==0)
		$is_fb_import_flag=1;
	
	if(count($wpdb->get_results("SHOW TABLES LIKE '".$wpdb->prefix."xyz_smap_tw_details'"))==0)
		$is_tw_import_flag=1;
	
	if(count($wpdb->get_results("SHOW TABLES LIKE '".$wpdb->prefix."xyz_smap_ln_details'"))==0)
		$is_ln_import_flag=1;                                           

	if(get_option('xyz_smap_free_version')!="")                             // free to premium import
	{
		$fmessagetopost=get_option('xyz_smap_message');
		$tmessagetopost=get_option('xyz_smap_twmessage');
		$lmessagetopost=get_option('xyz_smap_lnmessage');
		
		add_option('xyz_smap_fbmessage_format', $fmessagetopost);
		add_option('xyz_smap_twmessage_format', $tmessagetopost);
		add_option('xyz_smap_lnmessage_format', $lmessagetopost);
		$media="smap";
		smap_free_to_premium_import($media);
	}
	else 
	{
		if(get_option('xyz_fbap_free_version')!="")
	    {
			$fmessagetopost=get_option('xyz_fbap_message');
			add_option('xyz_smap_fbmessage_format', $fmessagetopost);
			$media="fbap";
			smap_free_to_premium_import($media);
	    }
	    if(get_option('xyz_twap_free_version')!="")
	     {
			$tmessagetopost=get_option('xyz_twap_twmessage');
			add_option('xyz_smap_twmessage_format', $tmessagetopost);
			$media="twap";
			smap_free_to_premium_import($media);
		}
		if(get_option('xyz_lnap_free_version')!="")
		{
			$lmessagetopost=get_option('xyz_lnap_lnmessage');
			add_option('xyz_smap_lnmessage_format', $lmessagetopost);
			$media="lnap";
			smap_free_to_premium_import($media);
		}
	}
		add_option('xyz_smap_fbmessage_format', 'New post added at {BLOG_TITLE} - {POST_TITLE}');
		add_option('xyz_smap_twmessage_format', '{POST_TITLE} - {PERMALINK}');
		add_option('xyz_smap_lnmessage_format', '{POST_TITLE} - {PERMALINK}');
		add_option('xyz_smap_premium_include_pages', '0');
		add_option('xyz_smap_premium_include_posts', '1');
		add_option('xyz_smap_premium_include_categories', 'All');
		add_option('xyz_smap_premium_include_customposttypes', '');
		add_option('xyz_smap_premium_peer_verification', '1');
		add_option('xyz_smap_premium_default_selection_edit', '0');
		add_option('xyz_smap_apply_filters', '');
		
		$xyz_utf_decode = get_option('xyz_utf_decode');
		if($xyz_utf_decode != false)
			add_option("xyz_smap_premium_utf_decode", $xyz_utf_decode);
		else	
		add_option("xyz_smap_premium_utf_decode", '0');
		
		delete_option('xyz_utf_decode');

	$xyz_smap_pi_image_url = plugins_url()."/xyz-wp-smap/admin/images/pinterest.jpg";
		
	add_option('xyz_smap_pimessage_format', '{POST_TITLE} - {PERMALINK}');
	add_option('xyz_smap_gpmessage_format', '{POST_TITLE} - {PERMALINK}');
	add_option('xyz_smap_fb_image_url', '');
	add_option('xyz_smap_tw_image_url', '');
	add_option('xyz_smap_ln_image_url', '');
	add_option('xyz_smap_pi_image_url', $xyz_smap_pi_image_url);
	add_option('xyz_smap_gp_image_url', '');
// 	add_option('xyz_smap_pi_board_pattern', '/<li(.+?)data-id="(.+?)"(.+?)<\/div>(.+?)<\/li>/is');
	add_option('xyz_smap_post_publish_percron', '10');
	add_option('xyz_smap_min_timedelay_post_publish_value', '0');
	add_option('xyz_smap_min_timedealy_post_publish_period', '1');
	
	
	$currentversion=xyz_smap_premium_plugin_get_version();
	
	update_option('xyz_smap_premium_version', $currentversion);
	
	add_option('xyz_smap_premium_default_selection_create_postORpage', '1');
	
	add_option('xyz_smap_premium_page_size', '20');
	add_option('xyz_smap_premium_image_preference', '1,2,3,4');
	add_option('xyz_smap_premium_image_metakey_name', '');
	add_option('xyz_smap_premium_hash_tags', '');
	
	add_option('xyz_smap_task_type', '2');
	add_option('xyz_smap_clearlogs_interval', '30');
	add_option('xyz_wp_smap_license_key', '');
	add_option('xyz_smap_premium_default_cat_sel', '1');

	
	$queryMapping = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix."xyz_smap_fb_details (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `xyz_smap_application_id` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_application_name` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_fb_id` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_application_secret` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_message` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_po_method` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_access_token` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_authorization_flag` text COLLATE utf8_unicode_ci NOT NULL COMMENT '0-authorized, 1 - need authorization link',
	  `xyz_smap_page_ids` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_fb_numericid` text COLLATE utf8_unicode_ci NOT NULL,
	  `xyz_smap_account_status` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
	
	$wpdb->query($queryMapping);
	
	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
    if(in_array("xyz_smap_post_permission", $tblcolums))
    {
		
    	$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details DROP `xyz_smap_post_permission`");
    }
    
    $new_col_flag=0;
//     $tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
    if(in_array("xyz_smap_premium_default_includePage", $tblcolums))
    	$new_col_flag=1;
    
    if($new_col_flag==0)
    {
    	$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_default_includePage` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
    }
    
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_fb_default_cat_sel", $tblcolums))
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details CHANGE xyz_smap_premium_fb_default_cat_sel xyz_smap_premium_fb_default_cat_sel int");
		$new_col_flag=1;
	}
	
	if($new_col_flag==0)
	{
	
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_fb_default_cat_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_include_pages", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_include_pages` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_include_posts", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_include_posts` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_fb_include_categories", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_fb_include_categories` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'All-all categories, Specific-specific categories'");
	}

	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_fb_spec_cat", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_fb_spec_cat` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'specific categories'");
	}

	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_fb_default_custtype_sel", $tblcolums))
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details CHANGE xyz_smap_premium_fb_default_custtype_sel xyz_smap_premium_fb_default_custtype_sel int");
			$new_col_flag=1;
	}
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_fb_default_custtype_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}

	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_fb_include_customposttypes", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_fb_include_customposttypes` text COLLATE utf8_unicode_ci NOT NULL");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_fb_details");
	if(in_array("xyz_smap_premium_fb_preferred_link_attach", $tblcolums))
		$new_col_flag=1;
	if($new_col_flag==0)
	{
// 		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_fb_preferred_link_attach` text COLLATE utf8_unicode_ci NOT NULL COMMENT '1-Link from Content, 0-Permalink'");
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_fb_preferred_link_attach` INT NOT NULL COMMENT '1-Link from Content, 0-Permalink'");
	}
	if(!(in_array("xyz_smap_premium_default_timedelay", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_default_timedelay` int  NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	if(!(in_array("xyz_smap_min_timedelay_post_publish_value", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_min_timedelay_post_publish_value` float  NOT NULL DEFAULT '0' ");
	if(!(in_array("xyz_smap_min_timedealy_post_publish_period", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_min_timedealy_post_publish_period` int  NOT NULL DEFAULT '1' COMMENT '1-Minutes, 2-Hours, 3-Days'");
	
	$queryMapping = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix."xyz_smap_ln_details (
	 `id` int(11) NOT NULL AUTO_INCREMENT,
  `xyz_smap_application_name` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_authorization_flag` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_lnapikey` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_lnapisecret` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_post_image_permission` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_ln_shareprivate` text COLLATE utf8_unicode_ci NOT NULL COMMENT '0-public,1-connections only',
  `xyz_smap_lnmessage` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_application_lnarray` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_account_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
	
	$wpdb->query($queryMapping);
	
$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_lnpost_permission", $tblcolums))
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details DROP `xyz_smap_lnpost_permission`");
	
	if(in_array("xyz_smap_lnoauth_token", $tblcolums))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details DROP `xyz_smap_lnoauth_token`");
	if(in_array("xyz_smap_lnoauth_secret", $tblcolums))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details DROP `xyz_smap_lnoauth_secret`");
	if(in_array("xyz_smap_lnoauth_verifier", $tblcolums))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details DROP `xyz_smap_lnoauth_verifier`");
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_default_includePage", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_default_includePage` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	  
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_ln_sharingmethod", $tblcolums))
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details DROP `xyz_smap_ln_sharingmethod`");
		  
    $new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_ln_default_cat_sel", $tblcolums))
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details CHANGE xyz_smap_premium_ln_default_cat_sel xyz_smap_premium_ln_default_cat_sel int");
		$new_col_flag=1;
	}
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_ln_default_cat_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_include_pages", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_include_pages` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_include_posts", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_include_posts` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_ln_include_categories", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_ln_include_categories` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'All-all categories, Specific-specific categories'");
	}


	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_ln_spec_cat", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_ln_spec_cat` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'specific categories'");
	}


	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_ln_default_custtype_sel", $tblcolums))
	{
			$new_col_flag=1;
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details CHANGE xyz_smap_premium_ln_default_custtype_sel xyz_smap_premium_ln_default_custtype_sel int");
			
	}
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_ln_default_custtype_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}


	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_ln_include_customposttypes", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_ln_include_customposttypes` text COLLATE utf8_unicode_ci NOT NULL");
	}



	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_ln_share_post", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_ln_share_post` text COLLATE utf8_unicode_ci NOT NULL COMMENT '0-profile,1-company,2-group'");
	}

	$new_col_flag=0;
	if(in_array("xyz_smap_ln_share_post_profile", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_ln_share_post_profile` INT NOT NULL COMMENT '0-Yes,1-No'");
	
		
		$company_fetch=$wpdb->get_results("SELECT * FROM `".$wpdb->prefix."xyz_smap_ln_details` WHERE `xyz_smap_ln_share_post`=1");
		
		if(count($company_fetch)>0)
		{
			foreach($company_fetch as $post_company)
			{
				$lnacid=$post_company->id;
				$wpdb->query($wpdb->prepare("UPDATE `".$wpdb->prefix."xyz_smap_ln_details` SET `xyz_smap_ln_share_post_profile`='1' WHERE `id`=%d",$lnacid));
			}
		}
	}
	$new_col_flag=0;
	if(in_array("xyz_smap_ln_auth_time", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_ln_auth_time` INT NOT NULL");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_ln_company_fetch", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_ln_company_fetch` INT NOT NULL COMMENT '0:Company Name, 1:Company ID'");
	}
	
    $new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_ln_company_name", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_ln_company_name` text COLLATE utf8_unicode_ci NOT NULL");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_ln_company_id", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_ln_company_id` text COLLATE utf8_unicode_ci NOT NULL");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_ln_group_id", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_ln_group_id` text COLLATE utf8_unicode_ci NOT NULL");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_ln_details");
	if(in_array("xyz_smap_premium_ln_preferred_link_attach", $tblcolums))
		$new_col_flag=1;
	if($new_col_flag==0)
	{
		// 		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_fb_details ADD `xyz_smap_premium_ln_preferred_link_attach` text COLLATE utf8_unicode_ci NOT NULL COMMENT '1-Link from Content, 0-Permalink'");
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_ln_preferred_link_attach` INT NOT NULL COMMENT '1-Link from Content, 0-Permalink'");
	}
	if(!(in_array("xyz_smap_premium_default_timedelay", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_premium_default_timedelay` int  NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	if(!(in_array("xyz_smap_min_timedelay_post_publish_value", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_min_timedelay_post_publish_value` float  NOT NULL DEFAULT '0' ");
	if(!(in_array("xyz_smap_min_timedealy_post_publish_period", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_ln_details ADD `xyz_smap_min_timedealy_post_publish_period` int  NOT NULL DEFAULT '1' COMMENT '1-Minutes, 2-Hours, 3-Days'");
	
	
	
	$queryMapping = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix."xyz_smap_pi_details (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `xyz_smap_application_name` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_authorization_flag` int(11) NOT NULL,
  `xyz_smap_pi_email` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_pi_password` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_pi_board_ids` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_pimessage` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_account_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
	$wpdb->query($queryMapping);
	
	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_pipost_permission", $tblcolums))
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details DROP `xyz_smap_pipost_permission`");
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_default_includePage", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_premium_default_includePage` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
    $new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_pi_default_cat_sel", $tblcolums))
		{
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details CHANGE xyz_smap_premium_pi_default_cat_sel xyz_smap_premium_pi_default_cat_sel int");
			$new_col_flag=1;
		}
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_premium_pi_default_cat_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_include_pages", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_premium_include_pages` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_include_posts", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_premium_include_posts` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_pi_include_categories", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_premium_pi_include_categories` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'All-all categories, Specific-specific categories'");
	}


	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_pi_spec_cat", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details  ADD `xyz_smap_premium_pi_spec_cat` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'specific categories'");
	}

	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_pi_default_custtype_sel", $tblcolums))
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details CHANGE xyz_smap_premium_pi_default_custtype_sel xyz_smap_premium_pi_default_custtype_sel int");
			$new_col_flag=1;
	}
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details  ADD `xyz_smap_premium_pi_default_custtype_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}


	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_pi_details");
	if(in_array("xyz_smap_premium_pi_include_customposttypes", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details  ADD `xyz_smap_premium_pi_include_customposttypes` text COLLATE utf8_unicode_ci NOT NULL");
	}
	if(!(in_array("xyz_smap_premium_default_timedelay", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_premium_default_timedelay` int  NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	if(!(in_array("xyz_smap_min_timedelay_post_publish_value", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_min_timedelay_post_publish_value` float  NOT NULL DEFAULT '0' ");
	if(!(in_array("xyz_smap_min_timedealy_post_publish_period", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_pi_details ADD `xyz_smap_min_timedealy_post_publish_period` int  NOT NULL DEFAULT '1' COMMENT '1-Minutes, 2-Hours, 3-Days'");
	
	$queryMapping = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix."xyz_smap_gp_details (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xyz_smap_application_name` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_authorization_flag` int(11) NOT NULL,
  `xyz_smap_gp_email` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_gp_password` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_gpmessage` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_gppost_method` int(11) NOT NULL COMMENT '1-simple,2-image,3-blog',
  `xyz_smap_gp_pageid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_account_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
	
	$wpdb->query($queryMapping);
	
	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_gppost_permission", $tblcolums))
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details DROP `xyz_smap_gppost_permission`");
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_default_includePage", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_premium_default_includePage` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_gp_default_cat_sel", $tblcolums))
		{
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details CHANGE xyz_smap_premium_gp_default_cat_sel xyz_smap_premium_gp_default_cat_sel int");
			$new_col_flag=1;
		}
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_premium_gp_default_cat_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_include_pages", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_premium_include_pages` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_include_posts", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_premium_include_posts` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_gp_include_categories", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_premium_gp_include_categories` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'All-all categories, Specific-specific categories'");
	}
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_gp_spec_cat", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details  ADD `xyz_smap_premium_gp_spec_cat` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'specific categories'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_gp_default_custtype_sel", $tblcolums))
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details CHANGE xyz_smap_premium_gp_default_custtype_sel xyz_smap_premium_gp_default_custtype_sel int");
			$new_col_flag=1;
	}
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details  ADD `xyz_smap_premium_gp_default_custtype_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_premium_gp_include_customposttypes", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details  ADD `xyz_smap_premium_gp_include_customposttypes` text COLLATE utf8_unicode_ci NOT NULL");
	}
	if(!(in_array("xyz_smap_premium_default_timedelay", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_premium_default_timedelay` int  NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	
	if(!(in_array("xyz_smap_min_timedelay_post_publish_value", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_min_timedelay_post_publish_value` float  NOT NULL DEFAULT '0' ");
	
	if(!(in_array("xyz_smap_min_timedealy_post_publish_period", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details ADD `xyz_smap_min_timedealy_post_publish_period` int  NOT NULL DEFAULT '1' COMMENT '1-Minutes, 2-Hours, 3-Days'");

	
	$new_col_flag=0;
//	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_gp_details");
	if(in_array("xyz_smap_gp_select_page_or_prof", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_gp_details  ADD `xyz_smap_gp_select_page_or_prof` text COLLATE utf8_unicode_ci NOT NULL COMMENT '1-Page, 0-Profile/Page-login'");
	
	
		$pgids_notnull = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_gp_details WHERE `xyz_smap_gp_pageid`<>''" );
	
	
		if(count($pgids_notnull)>0)
		{
			foreach($pgids_notnull as $pgid)
			{
				$gpacid=$pgid->id;
				$wpdb->query($wpdb->prepare("UPDATE `".$wpdb->prefix."xyz_smap_gp_details` SET `xyz_smap_gp_select_page_or_prof`='1' WHERE `id`=%d",$gpacid));
			}
		}
	
		$pgids_null = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_gp_details WHERE `xyz_smap_gp_pageid`=''" );
		if(count($pgids_null)>0)
		{
			foreach($pgids_null as $pgid)
			{
				$gpacid=$pgid->id;
				$wpdb->query($wpdb->prepare("UPDATE `".$wpdb->prefix."xyz_smap_gp_details` SET `xyz_smap_gp_select_page_or_prof`='0' WHERE `id`=%d",$gpacid));
			}
		}
	
	}
	
	
	
	
	
	
	$queryMapping = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix."xyz_smap_tasks (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` bigint(20) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `acc_type` int(11) NOT NULL COMMENT '1-fb,2-tw,3-li,4-pi,5-gp',
  `inserttime` int(11) NOT NULL,
  `publishtime` int(11) NOT NULL,
  `status` text COLLATE utf8_unicode_ci NOT NULL COMMENT '0 - queued, 1- processed, other value gives the error message for each posting',
  `post_method` int(11) NOT NULL COMMENT '0-Scheduled, 1-Instantaneous',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
	
	$wpdb->query($queryMapping);

	
	$new_col_flag=0;
	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tasks");
	if(in_array("post_config_value", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tasks ADD `post_config_value` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'post values from the metabox'");
	}
	
	
	$new_col_flag=0;
	//$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tasks");
	if(in_array("post_message_format", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tasks ADD `post_message_format` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'message from the message format textarea in metabox'");
	}
	
	$new_col_flag=0;
	
	if(!(in_array("scheduletime", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tasks ADD `scheduletime` INT(11) NOT NULL");
	
	
	$queryMapping = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix."xyz_smap_tw_details (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xyz_smap_application_name` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_consumer_id` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_consumer_secret` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_tw_id` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_access_token` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_access_token_secret` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_message` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_post_image_permission` text COLLATE utf8_unicode_ci NOT NULL,
  `xyz_smap_account_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
	
	$wpdb->query($queryMapping);
	
	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_post_permission", $tblcolums))
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details DROP `xyz_smap_post_permission`");
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_default_includePage", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_default_includePage` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_tw_default_cat_sel", $tblcolums))
		{
			$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details CHANGE xyz_smap_premium_tw_default_cat_sel xyz_smap_premium_tw_default_cat_sel int");
			$new_col_flag=1;
		}
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_tw_default_cat_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}

	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_include_pages", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_include_pages` int NOT NULL COMMENT '1-Yes, 0-No'");
	}
	
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_include_posts", $tblcolums))
		$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_include_posts` int NOT NULL COMMENT '1-Yes, 0-No'");
	}

	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_tw_include_categories", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_tw_include_categories` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'All-all categories, Specific-specific categories'");
	}

	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_tw_spec_cat", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_tw_spec_cat` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'specific categories'");
	}


	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_tw_default_custtype_sel", $tblcolums))
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details CHANGE xyz_smap_premium_tw_default_custtype_sel xyz_smap_premium_tw_default_custtype_sel int");
			$new_col_flag=1;
	}
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_tw_default_custtype_sel` INT NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	}
	
	$new_col_flag=0;
// 	$tblcolums = $wpdb->get_col("SHOW COLUMNS FROM  ".$wpdb->prefix."xyz_smap_tw_details");
	if(in_array("xyz_smap_premium_tw_include_customposttypes", $tblcolums))
			$new_col_flag=1;
	
	if($new_col_flag==0)
	{
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_tw_include_customposttypes` text COLLATE utf8_unicode_ci NOT NULL");
	}
	if(!(in_array("xyz_smap_premium_default_timedelay", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_premium_default_timedelay` int  NOT NULL DEFAULT '1' COMMENT '1-default settings, 0-override settings'");
	if(!(in_array("xyz_smap_min_timedelay_post_publish_value", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_min_timedelay_post_publish_value` float  NOT NULL DEFAULT '0' ");
	if(!(in_array("xyz_smap_min_timedealy_post_publish_period", $tblcolums)))
		$wpdb->query("ALTER TABLE ".$wpdb->prefix."xyz_smap_tw_details ADD `xyz_smap_min_timedealy_post_publish_period` int  NOT NULL DEFAULT '1' COMMENT '1-Minutes, 2-Hours, 3-Days'");
	
   if($is_fb_import_flag==1)
	{
		
		//FROM SMAP
		if(get_option('xyz_smap_application_id')!=""){
			
		$xyz_smap_application_id=get_option('xyz_smap_application_id');
		$xyz_smap_application_name="Facebook App - SMAP";
		//$xyz_smap_fb_id=get_option('xyz_smap_fb_id');
		$xyz_smap_application_secret=get_option('xyz_smap_application_secret');
		$xyz_smap_message=get_option('xyz_smap_message');
		$xyz_smap_po_method=get_option('xyz_smap_po_method');
		$xyz_smap_access_token=get_option('xyz_smap_current_appln_token');
		$xyz_smap_authorization_flag=get_option('xyz_smap_af');
		$xyz_smap_page_ids=get_option('xyz_smap_pages_ids');
		$xyz_smap_fb_numericid=get_option('xyz_smap_fb_numericid');
		$xyz_smap_post_permission=get_option('xyz_smap_post_permission');
		
		if($xyz_smap_post_permission==1)
			$xyz_smap_account_status=1;
		else
			$xyz_smap_account_status=0;
			
		
		$wpdb->insert($wpdb->prefix."xyz_smap_fb_details",array(
				'xyz_smap_application_id'	=>	$xyz_smap_application_id,
				'xyz_smap_application_name'	=>	$xyz_smap_application_name,
				//'xyz_smap_fb_id'	=>	$xyz_smap_fb_id,
				'xyz_smap_application_secret'	=>	$xyz_smap_application_secret,
				'xyz_smap_message'	=>	$xyz_smap_message,
				'xyz_smap_po_method'	=>	$xyz_smap_po_method,
				'xyz_smap_access_token'	=>	$xyz_smap_access_token,
				'xyz_smap_authorization_flag'	=>	$xyz_smap_authorization_flag,
				'xyz_smap_page_ids'	=>	$xyz_smap_page_ids,
				'xyz_smap_fb_numericid'	=>	$xyz_smap_fb_numericid,
				'xyz_smap_premium_fb_default_cat_sel'	=>	1,
				'xyz_smap_premium_default_includePage'	=>	1,
				'xyz_smap_premium_fb_default_custtype_sel'	=>	1,
				'xyz_smap_account_status'	=>	$xyz_smap_account_status
		));
		}
		
		//FROM FBAP
		if(get_option('xyz_fbap_application_id')!=""){
			
		$xyz_fbap_application_id=get_option('xyz_fbap_application_id');
		$xyz_fbap_application_name="Facebook App - FBAP";
		$xyz_fbap_fb_id=get_option('xyz_fbap_fb_id');
		$xyz_fbap_application_secret=get_option('xyz_fbap_application_secret');
		$xyz_fbap_message=get_option('xyz_fbap_message');
		$xyz_fbap_po_method=get_option('xyz_fbap_po_method');
		$xyz_fbap_current_appln_token=get_option('xyz_fbap_current_appln_token');
		$xyz_fbap_af=get_option('xyz_fbap_af');
		$xyz_fbap_pages_ids=get_option('xyz_fbap_pages_ids');
		$xyz_fbap_fb_numericid=get_option('xyz_fbap_fb_numericid');
		$xyz_fbap_post_permission=get_option('xyz_fbap_post_permission');
		
		if($xyz_fbap_post_permission==1)
			$xyz_fbap_account_status=1;
		else
			$xyz_fbap_account_status=0;
			
		
		$wpdb->insert($wpdb->prefix."xyz_smap_fb_details",array(
				'xyz_smap_application_id'	=>	$xyz_fbap_application_id,
				'xyz_smap_application_name'	=>	$xyz_fbap_application_name,
				//'xyz_smap_fb_id'	=>	$xyz_fbap_fb_id,
				'xyz_smap_application_secret'	=>	$xyz_fbap_application_secret,
				'xyz_smap_message'	=>	$xyz_fbap_message,
				'xyz_smap_po_method'	=>	$xyz_fbap_po_method,
				'xyz_smap_access_token'	=>	$xyz_fbap_current_appln_token,
				'xyz_smap_authorization_flag'	=>	$xyz_fbap_af,
				'xyz_smap_page_ids'	=>	$xyz_fbap_pages_ids,
				'xyz_smap_fb_numericid'	=>	$xyz_fbap_fb_numericid,
				'xyz_smap_premium_fb_default_cat_sel'	=>	1,
				'xyz_smap_premium_default_includePage'	=>	1,
				'xyz_smap_premium_fb_default_custtype_sel'	=>	1,
				'xyz_smap_account_status'	=>	$xyz_fbap_account_status
		));
		}
		
		
	}
	
	if($is_tw_import_flag==1)
	{
		
		//FROM SMAP
		if(get_option('xyz_smap_twconsumer_id')!=""){
			
		$xyz_smap_application_name="Twitter App - SMAP";
		$xyz_smap_consumer_id=get_option('xyz_smap_twconsumer_id');
		$xyz_smap_consumer_secret=get_option('xyz_smap_twconsumer_secret');
		$xyz_smap_tw_id=get_option('xyz_smap_tw_id');
		$xyz_smap_access_token=get_option('xyz_smap_current_twappln_token');
		$xyz_smap_access_token_secret=get_option('xyz_smap_twaccestok_secret');
		$xyz_smap_message=get_option('xyz_smap_twmessage');
		$xyz_smap_post_image_permission=get_option('xyz_smap_twpost_image_permission');
		$xyz_smap_twpost_permission=get_option('xyz_smap_twpost_permission');
		
		if($xyz_smap_twpost_permission==1)
			$xyz_smap_account_status=1;
		else
			$xyz_smap_account_status=0;
		
		$wpdb->insert($wpdb->prefix."xyz_smap_tw_details",array(
				'xyz_smap_application_name'	=>	$xyz_smap_application_name,
				'xyz_smap_consumer_id'	=>	$xyz_smap_consumer_id,
				'xyz_smap_consumer_secret'	=>	$xyz_smap_consumer_secret,
				'xyz_smap_tw_id'	=>	$xyz_smap_tw_id,
				'xyz_smap_access_token'	=>	$xyz_smap_access_token,
				'xyz_smap_access_token_secret'	=>	$xyz_smap_access_token_secret,
				'xyz_smap_message'	=>	$xyz_smap_message,
				'xyz_smap_post_image_permission'	=>	$xyz_smap_post_image_permission,
				'xyz_smap_premium_tw_default_cat_sel'	=>	1,
				'xyz_smap_premium_default_includePage'	=>	1,
				'xyz_smap_premium_tw_default_custtype_sel'	=>	1,
				'xyz_smap_account_status'	=>	$xyz_smap_account_status
		));
		}
		
		
		//FROM TWAP
		if(get_option('xyz_twap_twconsumer_id')!=""){

			$xyz_twap_application_name="Twitter App - TWAP";
			$xyz_twap_twconsumer_id=get_option('xyz_twap_twconsumer_id');
			$xyz_twap_twconsumer_secret=get_option('xyz_twap_twconsumer_secret');
			$xyz_twap_tw_id=get_option('xyz_twap_tw_id');
			$xyz_twap_current_twappln_token=get_option('xyz_twap_current_twappln_token');
			$xyz_twap_twaccestok_secret=get_option('xyz_twap_twaccestok_secret');
			$xyz_twap_twmessage=get_option('xyz_twap_twmessage');
			$xyz_twap_twpost_image_permission=get_option('xyz_twap_twpost_image_permission');
			$xyz_twap_twpost_permission=get_option('xyz_twap_twpost_permission');
			
			if($xyz_twap_twpost_permission==1)
				$xyz_twap_account_status=1;
			else
				$xyz_twap_account_status=0;
			
			$wpdb->insert($wpdb->prefix."xyz_smap_tw_details",array(
					'xyz_smap_application_name'	=>	$xyz_twap_application_name,
					'xyz_smap_consumer_id'	=>	$xyz_twap_twconsumer_id,
					'xyz_smap_consumer_secret'	=>	$xyz_twap_twconsumer_secret,
					'xyz_smap_tw_id'	=>	$xyz_twap_tw_id,
					'xyz_smap_access_token'	=>	$xyz_twap_current_twappln_token,
					'xyz_smap_access_token_secret'	=>	$xyz_twap_twaccestok_secret,
					'xyz_smap_message'	=>	$xyz_twap_twmessage,
					'xyz_smap_post_image_permission'	=>	$xyz_twap_twpost_image_permission,
					'xyz_smap_premium_tw_default_cat_sel'	=>	1,
					'xyz_smap_premium_default_includePage'	=>	1,
					'xyz_smap_premium_tw_default_custtype_sel'	=>	1,
					'xyz_smap_account_status'	=>	$xyz_twap_account_status
			));
		}
		
	}
	
	if($is_ln_import_flag==1)
	{
		//FROM SMAP
		if(get_option('xyz_smap_lnapikey')!=""){
			
		$xyz_smap_application_name="LinkedIn App - SMAP";
		$xyz_smap_authorization_flag=get_option('xyz_smap_lnaf');
		$xyz_smap_lnapikey=get_option('xyz_smap_lnapikey');
		$xyz_smap_lnapisecret=get_option('xyz_smap_lnapisecret');
		$xyz_smap_post_image_permission=get_option('xyz_smap_lnpost_image_permission');
		$xyz_smap_ln_shareprivate=get_option('xyz_smap_ln_shareprivate');
		$xyz_smap_lnmessage=get_option('xyz_smap_lnmessage');
// 		$xyz_smap_lnoauth_token=get_option('xyz_smap_lnoauth_token');
// 		$xyz_smap_lnoauth_secret=get_option('xyz_smap_lnoauth_secret');
// 		$xyz_smap_lnoauth_verifier=get_option('xyz_smap_lnoauth_verifier');
		$xyz_smap_application_lnarray=maybe_serialize(get_option('xyz_smap_application_lnarray'));
		$xyz_smap_lnpost_permission=get_option('xyz_smap_lnpost_permission');
		if($xyz_smap_lnpost_permission==1)
			$xyz_smap_account_status=1;
		else
			$xyz_smap_account_status=0;
		$wpdb->insert($wpdb->prefix."xyz_smap_ln_details",array(
				'xyz_smap_application_name'	=>	$xyz_smap_application_name,
				'xyz_smap_authorization_flag'	=>	$xyz_smap_authorization_flag,
				'xyz_smap_lnapikey'	=>	$xyz_smap_lnapikey,
				'xyz_smap_lnapisecret'	=>	$xyz_smap_lnapisecret,
				'xyz_smap_post_image_permission'	=>	$xyz_smap_post_image_permission,
				'xyz_smap_ln_shareprivate'	=>	$xyz_smap_ln_shareprivate,
				'xyz_smap_lnmessage'	=>	$xyz_smap_lnmessage,
// 				'xyz_smap_lnoauth_token'	=>	$xyz_smap_lnoauth_token,
// 				'xyz_smap_lnoauth_secret'	=>	$xyz_smap_lnoauth_secret,
// 				'xyz_smap_lnoauth_verifier'	=>	$xyz_smap_lnoauth_verifier,
				'xyz_smap_application_lnarray'	=>	$xyz_smap_application_lnarray,
				'xyz_smap_premium_ln_default_cat_sel'	=>	1,
				'xyz_smap_premium_default_includePage'	=>	1,
				'xyz_smap_premium_ln_default_custtype_sel'	=>	1,
				'xyz_smap_account_status'	=>	$xyz_smap_account_status
		));
		}
		
		//FROM LNAP
		if(get_option('xyz_lnap_lnapikey')!=""){

			$xyz_lnap_application_name="LinkedIn App - LNAP";
			$xyz_lnap_lnaf=get_option('xyz_lnap_lnaf');
			$xyz_lnap_lnapikey=get_option('xyz_lnap_lnapikey');
			$xyz_lnap_lnapisecret=get_option('xyz_lnap_lnapisecret');
			$xyz_lnap_lnpost_image_permission=get_option('xyz_lnap_lnpost_image_permission');
			$xyz_lnap_ln_shareprivate=get_option('xyz_lnap_ln_shareprivate');
			$xyz_lnap_lnmessage=get_option('xyz_lnap_lnmessage');
// 			$xyz_lnap_lnoauth_token=get_option('xyz_lnap_lnoauth_token');
// 			$xyz_lnap_lnoauth_secret=get_option('xyz_lnap_lnoauth_secret');
// 			$xyz_lnap_lnoauth_verifier=get_option('xyz_lnap_lnoauth_verifier');
			$xyz_lnap_application_lnarray=maybe_serialize(get_option('xyz_lnap_application_lnarray'));
			$xyz_lnap_lnpost_permission=get_option('xyz_lnap_lnpost_permission');
			
			if($xyz_lnap_lnpost_permission==1)
				$xyz_lnap_account_status=1;
			else
				$xyz_lnap_account_status=0;
			
			$wpdb->insert($wpdb->prefix."xyz_smap_ln_details",array(
					'xyz_smap_application_name'	=>	$xyz_lnap_application_name,
					'xyz_smap_authorization_flag'	=>	$xyz_lnap_lnaf,
					'xyz_smap_lnapikey'	=>	$xyz_lnap_lnapikey,
					'xyz_smap_lnapisecret'	=>	$xyz_lnap_lnapisecret,
					'xyz_smap_post_image_permission'	=>	$xyz_lnap_lnpost_image_permission,
					'xyz_smap_ln_shareprivate'	=>	$xyz_lnap_ln_shareprivate,
					'xyz_smap_lnmessage'	=>	$xyz_lnap_lnmessage,
// 					'xyz_smap_lnoauth_token'	=>	$xyz_lnap_lnoauth_token,
// 					'xyz_smap_lnoauth_secret'	=>	$xyz_lnap_lnoauth_secret,
// 					'xyz_smap_lnoauth_verifier'	=>	$xyz_lnap_lnoauth_verifier,
					'xyz_smap_application_lnarray'	=>	$xyz_lnap_application_lnarray,
					'xyz_smap_premium_ln_default_cat_sel'	=>	1,
					'xyz_smap_premium_default_includePage'	=>	1,
					'xyz_smap_premium_ln_default_custtype_sel'	=>	1,
					'xyz_smap_account_status'	=>	$xyz_lnap_account_status
			));
			
		}
		
	}
		
	

}

register_activation_hook(XYZ_SMAP_PLUGIN_FILE_PREMIUM,'smap_premium_network_install');
//////////addon table///
$queryMapping = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."xyz_smap_addons (
`id` int(11) NOT NULL AUTO_INCREMENT,
`addons_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
`addons_status` int(1) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
$wpdb->query($queryMapping);

?>