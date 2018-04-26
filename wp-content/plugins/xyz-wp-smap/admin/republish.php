<?php
    $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
	global $wpdb;
	//$reg_exUrl = "@(https?)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?$@iS";
	$reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/\S*)?/";
	$task_ids=$_GET['task_ids'];
		$entries1 = $wpdb->get_results(  'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tasks WHERE ID IN('.$task_ids.')' );

	foreach( $entries1 as $entry0 ) {

		$post_ID=$entry0->postid;

		global $xyz_wp_smap_page_datas;
		$permalink=get_permalink($post_ID);

    $xyz_wp_smap_page_datas=wp_remote_get($permalink);
    if( is_array($xyz_wp_smap_page_datas) ) {
      $xyz_wp_smap_page_datas = $xyz_wp_smap_page_datas['body']; // use the content
    }
    else {
      $xyz_wp_smap_page_datas='';
    }
		$content_title='';
		$content_desc='';
		$utf="UTF-8";
// 		$og_datas = new DOMDocument();
// 		@$og_datas->loadHTML($xyz_wp_smap_page_datas);
// 		$xpath = new DOMXPath($og_datas);
// 		$ogmetaContentAttributeNodes_tit = $xpath->query("/html/head/meta[@property='og:title']/@content");
// 		foreach($ogmetaContentAttributeNodes_tit as $ogmetaContentAttributeNode_tit) {
// 			$content_title=$ogmetaContentAttributeNode_tit->nodeValue;
// 		}
// 		if(strcmp(get_option('blog_charset'),$utf)==0)
// 			$content_title=utf8_decode($content_title);
// 		$ogmetaContentAttributeNodes_desc = $xpath->query("/html/head/meta[@property='og:description']/@content");
// 		foreach($ogmetaContentAttributeNodes_desc as $ogmetaContentAttributeNode_desc) {
// 			$content_desc=$ogmetaContentAttributeNode_desc->nodeValue;
// 		}
// 		if(strcmp(get_option('blog_charset'),$utf)==0)
// 			$content_desc=utf8_decode($content_desc);
		
		$postpp= get_post($post_ID);

        if(count($postpp)==0 ||  $postpp->post_status=='trash')
        {
	        $wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE postid=%d and status=%d',array($post_ID,0)));
	        continue;
        }

		$entries2 = $wpdb->get_results( $wpdb->prepare( 'SELECT user_nicename FROM '.$wpdb->prefix.'users WHERE ID=%d',array($postpp->post_author)));
		foreach( $entries2 as $entry2 ) {
		$user_nicename=$entry2->user_nicename;}
		$posttype=$postpp->post_type;

		$category = get_the_category($post_ID);
		$POST_CATEGORY="";
		foreach( $category as $entry ) {

			$POST_CATEGORY.=$entry->cat_name.",";
		}
		$POST_CATEGORY=rtrim($POST_CATEGORY,",");

		$pluginName = 'bitly/bitly.php';

		if (is_plugin_active($pluginName)) {
			remove_all_filters('post_link');
		}
		$link = get_permalink($postpp->ID);
		$shortlink=wp_get_shortlink($postpp->ID);
		$shortlink_filtered= apply_filters('xyz_wp_smap_custom_shortlink', array('id'=>$postpp->ID,'shortlink'=>$shortlink));
		$shortlink=$shortlink_filtered['shortlink'];
		$xyz_smap_apply_filters=get_option('xyz_smap_apply_filters');
		$ar2=explode(",",$xyz_smap_apply_filters);
		$con_flag=$exc_flag=$tit_flag=0;
		if(isset($ar2[0]))
			if($ar2[0]==1) $con_flag=1;
		if(isset($ar2[1]))
			if($ar2[1]==2) $exc_flag=1;
		if(isset($ar2[2]))
			if($ar2[2]==3) $tit_flag=1;


		$content = $postpp->post_content;
		if($con_flag==1)
			$content = apply_filters('the_content', $content);

		$content = html_entity_decode($content, ENT_QUOTES, get_bloginfo('charset'));
		$excerpt = $postpp->post_excerpt;
		if($exc_flag==1)
			$excerpt = apply_filters('the_excerpt', $excerpt);

		$excerpt = html_entity_decode($excerpt, ENT_QUOTES, get_bloginfo('charset'));
		$content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $content);
		$excerpt = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $excerpt);

		if($excerpt=="")
		{
			if($content!="")
			{
				$content1=$content;
				$content1=strip_tags($content1);
				$content1=strip_shortcodes($content1);

				$excerpt=implode(' ', array_slice(explode(' ', $content1), 0, 50));
			}
		}
		else
		{
			$excerpt=strip_tags($excerpt);
			$excerpt=strip_shortcodes($excerpt);
		}
		$description = $content;
		$description_org=$description;

		$xyz_smap_premium_image_preference=esc_html(get_option('xyz_smap_premium_image_preference'));
		if($xyz_smap_premium_image_preference=="")
			$xyz_smap_premium_image_preference="1,2,3,4";
		$attachmenturl=xyz_smap_premium_getimage($post_ID, $postpp->post_content,$xyz_smap_premium_image_preference);
		
		$meta_image_url=apply_filters('xyz_wp_smap_custom_image_autopost',array('postid'=>$post_ID,'attachmenturl'=>$attachmenturl)); //filter to run addon codes
		
		if(is_string($meta_image_url))
			$attachmenturl=$meta_image_url;
		
	
		$name = $postpp->post_title;
// 		$name = html_entity_decode(get_the_title($postpp->ID), ENT_QUOTES, get_bloginfo('charset'));
		$caption = html_entity_decode(get_bloginfo('title'), ENT_QUOTES, get_bloginfo('charset'));
		
		if($tit_flag==1)
			$name = apply_filters('the_title', $name);

		$name = html_entity_decode($name, ENT_QUOTES, get_bloginfo('charset'));
		$name=strip_tags($name);
		$name=strip_shortcodes($name);

		$description=strip_tags($description);
		$description=strip_shortcodes($description);

		$description=str_replace("&nbsp;","",$description);

		$excerpt=str_replace("&nbsp;","",$excerpt);

		$time=time();

		$appid="";$appsecret="";$useracces_token="";$message="";
		$fbid="";$posting_method="";$user_page_id="";$xyz_smap_pages_ids="";$fbstatus="";

		$tappid="";$tappsecret="";$twid="";$taccess_token="";$taccess_token_secret="";
		$messagetopost="";$post_twitter_image_permission="";$twstatus="";

		$lnid="";$lnappikey="";$lnapisecret="";$lmessagetopost="";
		$post_ln_image_permission="";
		$xyz_smap_ln_shareprivate="";
		$xyz_smap_authorization_flag="";$lnstatus="";
		
		$xyz_smap_ln_share_post_profile="";
		$xyz_smap_ln_company_id="";
		
// 		$xyz_smap_ln_share_post="";$xyz_smap_ln_company_name="";$xyz_smap_ln_company_id="";
// 		$xyz_smap_ln_company_fetch="";
// 		$xyz_smap_ln_group_id="";
	
		$xyz_smap_pi_email="";$xyz_smap_pi_password="";
		$xyz_smap_pi_board_ids="";
		$pmessagetopost="";$xyz_smap_account_status="";

		$xyz_smap_gp_email="";$xyz_smap_gp_password="";
		$xyz_smap_gp_pageid="";$xyz_smap_gppost_method="";
		$gmessagetopost="";$xyz_smap_account_status="";

		$search=esc_html(get_option('xyz_smap_premium_hash_tags'));
		$search=str_replace(' ', '', $search);
		$search=explode(',',$search);


		if($entry0->acc_type==1)
		{

			$entries3 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_fb_details WHERE id=%d LIMIT %d,%d',array($entry0->acc_id,0,1)) );
			if(count($entries3)==0)
			{
				$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE acc_id=%d and acc_type=%d',array($entry0->acc_id,1)) ) ;

			}
			foreach( $entries3 as $entry ) {
				$appid=$entry->xyz_smap_application_id;
				$appsecret=$entry->xyz_smap_application_secret;
				$useracces_token=$entry->xyz_smap_access_token;

				$message=$entry0->post_message_format;
				if($message=="")
					$message=$entry->xyz_smap_message;
				
				//$fbid=$entry->xyz_smap_fb_id;

				$posting_method=$entry0->post_config_value;
				if($posting_method=="")
					$posting_method=$entry->xyz_smap_po_method;

				$user_page_id=$entry->xyz_smap_fb_numericid;
				$xyz_smap_pages_ids=$entry->xyz_smap_page_ids;
				$fbstatus=$entry->xyz_smap_account_status;
				$xyz_smap_premium_fb_pref_link_sel=$entry->xyz_smap_premium_fb_preferred_link_attach;
				if($message=="")
				{
					$message=get_option('xyz_smap_fbmessage_format');
				}
			}
		}
		else if($entry0->acc_type==2)
		{

			$entries3 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tw_details WHERE id=%d LIMIT %d,%d',array($entry0->acc_id,0,1) ));

			if(count($entries3)==0)
			{
				$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE acc_id=%d and acc_type=%d',array($entry0->acc_id,2) )) ;

			}
			foreach( $entries3 as $entry ) {
				$tappid=$entry->xyz_smap_consumer_id;
				$tappsecret=$entry->xyz_smap_consumer_secret;
				$twid=$entry->xyz_smap_tw_id;
				$taccess_token=$entry->xyz_smap_access_token;
				$taccess_token_secret=$entry->xyz_smap_access_token_secret;

				$messagetopost=$entry0->post_message_format;
				if($messagetopost=="")
					$messagetopost=$entry->xyz_smap_message;

				$post_twitter_image_permission=$entry0->post_config_value;

				if($post_twitter_image_permission=="")
					$post_twitter_image_permission=$entry->xyz_smap_post_image_permission;

				$twstatus=$entry->xyz_smap_account_status;

				if($messagetopost=="")
				{
					$messagetopost=get_option('xyz_smap_twmessage_format');
				}
			}
		}
		else if($entry0->acc_type==3)
		{


			$entries3 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_ln_details WHERE id=%d LIMIT %d,%d',array($entry0->acc_id,0,1) ));

			if(count($entries3)==0)
			{
				$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE acc_id=%d and acc_type=%d',array($entry0->acc_id,3) )) ;

			}
			foreach( $entries3 as $entry ) {
				$lnid=$entry->id;
				$lnappikey=$entry->xyz_smap_lnapikey;
				$lnapisecret=$entry->xyz_smap_lnapisecret;
// 				$xyz_smap_ln_company_fetch=$entry->xyz_smap_ln_company_fetch;
				$lmessagetopost=$entry0->post_message_format;
				if($lmessagetopost=="")
					$lmessagetopost=$entry->xyz_smap_lnmessage;
				$xyz_smap_premium_ln_pref_link_sel=$entry->xyz_smap_premium_ln_preferred_link_attach;
              if($entry0->post_config_value!=""){
              	
              	$post_config_value_prof_and_comp=explode('{ln_splitter04}',$entry0->post_config_value);
              	$post_config_value_prof=explode('{ln_splitter03}',$post_config_value_prof_and_comp[0]);
              	//$post_config_value_comp=explode('{ln_splitter03}',$post_config_value_prof_and_comp[1]);
                       	
              	$post_ln_image_permission=$post_config_value_prof[0];
              	$xyz_smap_ln_share_post_profile=$post_config_value_prof[1];
              	$xyz_smap_ln_shareprivate=$post_config_value_prof[2];
              	if(strpos($post_config_value_prof_and_comp[1],'{ln_splitter03}') === false)                //remove in future
              	$xyz_smap_ln_company_id=$post_config_value_prof_and_comp[1];
              	else
              	{
              		$post_config_value_comp=explode('{ln_splitter03}',$post_config_value_prof_and_comp[1]);
              		$xyz_smap_ln_company_id=$post_config_value_comp[2];
              	}
     			
              }
			else
			{
				$post_ln_image_permission=$entry->xyz_smap_post_image_permission;
				$xyz_smap_ln_shareprivate=$entry->xyz_smap_ln_shareprivate;
					
				$xyz_smap_ln_share_post_profile=$entry->xyz_smap_ln_share_post_profile;
				$xyz_smap_ln_company_id=$entry->xyz_smap_ln_company_id;
			}
				
				$lnaf=$entry->xyz_smap_authorization_flag;
				$xyz_smap_application_lnarray=$entry->xyz_smap_application_lnarray;
				$lnstatus=$entry->xyz_smap_account_status;
				if($lmessagetopost=="")
				{
					$lmessagetopost=get_option('xyz_smap_lnmessage_format');
				}

			}

		}
	else if($entry0->acc_type==4)
		{
			$entries3 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_pi_details WHERE id=%d LIMIT %d,%d',array($entry0->acc_id,0,1) ));

			if(count($entries3)==0)
			{
				$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE acc_id=%d and acc_type=%d',array($entry0->acc_id,4) )) ;

			}
			foreach( $entries3 as $entry ) {

				$xyz_smap_pi_email=$entry->xyz_smap_pi_email;
				$xyz_smap_pi_password=base64_decode($entry->xyz_smap_pi_password);
				$xyz_smap_pi_board_ids=$entry->xyz_smap_pi_board_ids;
				$pmessagetopost=$entry0->post_message_format;
				if($pmessagetopost=="")
					$pmessagetopost=$entry->xyz_smap_pimessage;
				$pistatus=$entry->xyz_smap_account_status;
				$pi_image_url=get_option('xyz_smap_pi_image_url');
				if($attachmenturl!="")
					$pi_image_url=$attachmenturl;

				if($pmessagetopost=="")
				{
					$pmessagetopost=get_option('xyz_smap_pimessage_format');
				}

			}
		}
		else if($entry0->acc_type==5)
		{
			$entries3 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_gp_details WHERE id=%d LIMIT %d,%d',array($entry0->acc_id,0,1) ));

			if(count($entries3)==0)
			{
				$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE acc_id=%d and acc_type=%d',array($entry0->acc_id,5) )) ;

			}
			foreach( $entries3 as $entry ) {

				$xyz_smap_gp_email=$entry->xyz_smap_gp_email;
				$xyz_smap_gp_password=base64_decode($entry->xyz_smap_gp_password);
				$xyz_smap_gp_pageid=$entry->xyz_smap_gp_pageid;
				$xyz_smap_gp_select_page_or_prof=$entry->xyz_smap_gp_select_page_or_prof;
				$gmessagetopost=$entry0->post_message_format;
				if($gmessagetopost=="")
					$gmessagetopost=$entry->xyz_smap_gpmessage;
				$xyz_smap_gppost_method=$entry0->post_config_value;
				if($xyz_smap_gppost_method=="")
					$xyz_smap_gppost_method=$entry->xyz_smap_gppost_method;
				
				$gpstatus=$entry->xyz_smap_account_status;
	
				if($gmessagetopost=="")
				{
					$gmessagetopost=get_option('xyz_smap_gpmessage_format');
				}
					
			}
		}
	
		if ($postpp->post_status == 'publish')
		{
			
			$t = wp_get_post_tags($post_ID,array( 'fields' => 'names' ));
			$post_tags = implode(',', $t);
			
			if($useracces_token!="" && $appsecret!="" && $appid!="" && $fbstatus==1)
			{
					
				$fb_publish_status_insert=xyz_smap_premium_facebook_publish($useracces_token,$appsecret,$appid,$fbstatus,$description,$content_title,$content_desc,$xyz_smap_pages_ids,$user_page_id, $name, $message, $caption,$link, $excerpt, $user_nicename, $post_ID, $post_tags, $POST_CATEGORY,$search,$attachmenturl,$posting_method,$shortlink,$reg_exUrl,$xyz_smap_premium_fb_pref_link_sel);
				
				if($entry0->publishtime)
				{
					$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
							'postid'	=>	$entry0->postid,
							'acc_id'	=>	$entry0->acc_id,
							'acc_type'	=>	$entry0->acc_type,
							'inserttime'	=>	$time,
							'publishtime'	=>	$time,
							'post_method'	=>	1,
							'post_config_value'	=>	$entry0->post_config_value,
							'post_message_format'	=>	$entry0->post_message_format,
							'status'	=>	$fb_publish_status_insert
					));
				}
				else{

					$wpdb->update($wpdb->prefix."xyz_smap_tasks",array(
							'publishtime'	=>	$time,
							'status'	=>	$fb_publish_status_insert
					),array('id'=>$entry0->id));

				}

			}

			//tw

			if($taccess_token!="" && $taccess_token_secret!="" && $tappid!="" && $tappsecret!="" && $twstatus==1)
			{
					
					
				$tw_publish_status_insert=xyz_smap_premium_twitter_publish($taccess_token,$taccess_token_secret,$tappid,$tappsecret,$twstatus,$attachmenturl,$post_twitter_image_permission,$messagetopost,$description,$name, $caption,$link, $excerpt, $user_nicename, $post_ID, $post_tags,$POST_CATEGORY,$search,$shortlink,$reg_exUrl);
				
				if($entry0->publishtime)
				{
					$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
							'postid'	=>	$entry0->postid,
							'acc_id'	=>	$entry0->acc_id,
							'acc_type'	=>	$entry0->acc_type,
							'inserttime'	=>	$time,
							'publishtime'	=>	$time,
							'post_method'	=>	1,
							'post_config_value'	=>	$entry0->post_config_value,
							'post_message_format'	=>	$entry0->post_message_format,
							'status'	=>	$tw_publish_status_insert
					));
				}
				else{
	
					$wpdb->update($wpdb->prefix."xyz_smap_tasks",array(
							'publishtime'	=>	$time,
							'status'	=>	$tw_publish_status_insert
					),array('id'=>$entry0->id));
					
				}
	
			}
				
			//ln
			if($lnappikey!="" && $lnapisecret!="" && $lnstatus==1)
			{
			
				$ln_publish_status_insert=xyz_smap_premium_linkedin_publish($lnappikey,$lnapisecret,$lnstatus,$description,$content_title,$content_desc,$caption,$name,$lmessagetopost,$link,$excerpt,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$attachmenturl,$post_ln_image_permission,$xyz_smap_application_lnarray,$xyz_smap_ln_share_post_profile,$xyz_smap_ln_shareprivate,$xyz_smap_ln_company_id,$xyz_smap_authorization_flag,$shortlink,$reg_exUrl,$xyz_smap_premium_ln_pref_link_sel);
				
				if($entry0->publishtime)
				{
					$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
							'postid'	=>	$entry0->postid,
							'acc_id'	=>	$entry0->acc_id,
							'acc_type'	=>	$entry0->acc_type,
							'inserttime'	=>	$time,
							'publishtime'	=>	$time,
							'post_method'	=>	1,
							'post_config_value'	=>	$entry0->post_config_value,
							'post_message_format'	=>	$entry0->post_message_format,
							'status'	=>	$ln_publish_status_insert
					));
				}
				else{
					
					$wpdb->update($wpdb->prefix."xyz_smap_tasks",array(
							'publishtime'	=>	$time,
							'status'	=>	$ln_publish_status_insert
					),array('id'=>$entry0->id));
				
				}
					
					
			}
				
			if($xyz_smap_pi_email!="" && $xyz_smap_pi_password!=""&& $xyz_smap_pi_board_ids!="" && $pistatus==1)
			{
				$pi_publish_status_insert=xyz_smap_premium_pinteret_publish($xyz_smap_pi_email,$xyz_smap_pi_password,$xyz_smap_pi_board_ids,$pistatus,$name,$caption,$pmessagetopost,$link,$excerpt,$description,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$search,$pi_image_url,$shortlink,$reg_exUrl);
				
				if($entry0->publishtime)
				{
					$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
							'postid'	=>	$entry0->postid,
							'acc_id'	=>	$entry0->acc_id,
							'acc_type'	=>	$entry0->acc_type,
							'inserttime'	=>	$time,
							'publishtime'	=>	$time,
							'post_method'	=>	1,
							'post_config_value'	=>	$entry0->post_config_value,
							'post_message_format'	=>	$entry0->post_message_format,
							'status'	=>	$pi_publish_status_insert
					));
				}
				else{
	
				$wpdb->update($wpdb->prefix."xyz_smap_tasks",array(
						'publishtime'	=>	$time,
						'status'	=>	$pi_publish_status_insert
				),array('id'=>$entry0->id));
				
				}
					
			}

			if($xyz_smap_gp_email!="" && $xyz_smap_gp_password!="" && $xyz_smap_gppost_method!="" && $gpstatus==1)
			{				
				$gp_publish_status_insert=xyz_smap_premium_gplus_publish($xyz_smap_gp_email,$xyz_smap_gp_password,$xyz_smap_gppost_method,$gpstatus,$gmessagetopost,$name,$caption,$link,$excerpt,$description,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$search,$xyz_smap_gp_pageid,$attachmenturl,$xyz_smap_gp_select_page_or_prof,$shortlink,$reg_exUrl);
				if($entry0->publishtime)
				{
					$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
							'postid'	=>	$entry0->postid,
							'acc_id'	=>	$entry0->acc_id,
							'acc_type'	=>	$entry0->acc_type,
							'inserttime'	=>	$time,
							'publishtime'	=>	$time,
							'post_method'	=>	1,
							'post_config_value'	=>	$entry0->post_config_value,
							'post_message_format'	=>	$entry0->post_message_format,
							'status'	=>	$gp_publish_status_insert
					));
				}
				else{
				
						$wpdb->update($wpdb->prefix."xyz_smap_tasks",array(
								'publishtime'	=>	$time,
								'status'	=>	$gp_publish_status_insert
						),array('id'=>$entry0->id));	
				}		
			}
		}
	}

	header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium'.'&pagenum='.$pagenum.'&msg=1'));
	exit();



?>
