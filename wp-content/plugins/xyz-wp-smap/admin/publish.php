<?php

//add_action('publish_post', 'xyz_link_premium_publish');
//add_action('publish_page', 'xyz_link_premium_publish');
//add_action('admin_init', 'xyz_link_premium_custtypes_publish');
//add_action('future_to_publish', 'xyz_link_premium_future_to_publish');
add_action(  'transition_post_status',  'xyz_link_premium_future_to_publish', 10, 3 );
add_action('save_post', 'xyz_link_premium_save_data');

// $xyz_smap_future_to_publish=get_option('xyz_smap_future_to_publish');

//if($xyz_smap_future_to_publish==1)
//	add_action('future_to_publish', 'xyz_link_premium_future_to_publish');

function xyz_link_premium_future_to_publish($new_status, $old_status, $post){
if(!isset($GLOBALS['xyz_smap_dup_publish']))
       $GLOBALS['xyz_smap_dup_publish']=array();	
	//
	$fbarray=array();$twarray=array();$lnarray=array();$piarray=array();$gparray=array();
	$postid =$post->ID;
	$get_post_meta=get_post_meta($postid,"xyz_smap",true);                           //	prevent duplicate publishing
	$post_permissin=get_option('xyz_smap_premium_include_posts');
	$post_twitter_permission=get_option('xyz_smap_premium_include_posts');
	$lnposting_permission=get_option('xyz_smap_premium_include_posts');
	$piposting_permission=get_option('xyz_smap_premium_include_posts');
	$gpposting_permission=get_option('xyz_smap_premium_include_posts');
	
	if(isset($_POST['xyz_smap_fb_tableid']))
		$fbarray=$_POST['xyz_smap_fb_tableid'];
	if(isset($_POST['xyz_smap_tw_tableid']))
		$twarray=$_POST['xyz_smap_tw_tableid'];
	if(isset($_POST['xyz_smap_ln_tableid']))
		$lnarray=$_POST['xyz_smap_ln_tableid'];
	if(isset($_POST['xyz_smap_pi_tableid']))
		$piarray=$_POST['xyz_smap_pi_tableid'];
	if(isset($_POST['xyz_smap_gp_tableid']))
		$gparray=$_POST['xyz_smap_gp_tableid'];
	if(!(isset($_POST['xyz_smap_fb_tableid']) || isset($_POST['xyz_smap_tw_tableid']) || isset($_POST['xyz_smap_ln_tableid']) || isset($_POST['xyz_smap_pi_tableid']) || isset($_POST['xyz_smap_gp_tableid'])))
	{
		
		if($post_permissin == 1 || $post_twitter_permission == 1 || $lnposting_permission == 1 || $piposting_permission == 1 || $gpposting_permission ==1) 
		{

			if($new_status == 'publish')
			{
				
				if ($get_post_meta == 1 ) {
					return;
				}
			}
			else return;
		}
	}	
	
	if($post_permissin == 1 || $post_twitter_permission == 1 || $lnposting_permission == 1 || $piposting_permission == 1 || $gpposting_permission ==1)
	{
	if ( $new_status == 'publish' )
	{
		$postid =$post->ID;
     if(!in_array($postid,$GLOBALS['xyz_smap_dup_publish'])) {
                 $GLOBALS['xyz_smap_dup_publish'][]=$postid; 
	         xyz_link_premium_publish($postid);
             }
          else return;
	}
	}
	//
  /*if ( $new_status == 'publish' ) {
	$postid =$post->ID;
	xyz_link_premium_publish($postid);
    }*/
	
}
function xyz_link_premium_save_data($post_ID){

	global $wpdb;
	$fbarray=array();$twarray=array();$lnarray=array();$piarray=array();$gparray=array();$futToPubDataArray=array();
	$poststat= get_post($post_ID);
	$posttype=$poststat->post_type;

// 	if ($poststat->post_status == 'future' || $poststat->post_status == 'publish')
// 	{

		if(isset($_POST['xyz_smap_fb_tableid']))
			$fbarray=$_POST['xyz_smap_fb_tableid'];

		if(count($fbarray)==0)
		{
			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_fb_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

			$n1=0;
			foreach( $entries as $entry ) {
				$fbarray[$n1]=$entry->id;$n1++;
			}
		}

		if(isset($_POST['xyz_smap_tw_tableid']))
			$twarray=$_POST['xyz_smap_tw_tableid'];


		if(count($twarray)==0)
		{
			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_tw_details WHERE xyz_smap_account_status=%d ORDER BY id DESC',array(1)));

			$n2=0;
			foreach( $entries as $entry ) {

				$twarray[$n2]=$entry->id;$n2++;
			}
		}

		if(isset($_POST['xyz_smap_ln_tableid']))
			$lnarray=$_POST['xyz_smap_ln_tableid'];

		if(count($lnarray)==0)
		{
			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_ln_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

			$n3=0;
			foreach( $entries as $entry ) {

				$lnarray[$n3]=$entry->id;$n3++;
			}
		}

		if(isset($_POST['xyz_smap_pi_tableid']))
			$piarray=$_POST['xyz_smap_pi_tableid'];

		if(count($piarray)==0)
		{
			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_pi_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

			$n4=0;
			foreach( $entries as $entry ) {

				$piarray[$n4]=$entry->id;$n4++;
			}
		}

		if(isset($_POST['xyz_smap_gp_tableid']))
			$gparray=$_POST['xyz_smap_gp_tableid'];

		if(count($gparray)==0)
		{
			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_gp_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

			$n5=0;
			foreach( $entries as $entry ) {

				$gparray[$n5]=$entry->id;$n5++;
			}
		}

		for($i=0;$i<count($fbarray);$i++)
		{
			$message="";$posting_method="";
			$post_permissin=get_option('xyz_smap_premium_include_posts');
			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_fb_details WHERE id=%d LIMIT 0,1',array($fbarray[$i]) ));


			foreach( $entries as $entry ) {
				$posting_method=$entry->xyz_smap_po_method;
				$xyz_smap_premium_fb_default_cat_sel=$entry->xyz_smap_premium_fb_default_cat_sel;
				$xyz_smap_premium_fb_include_categories=$entry->xyz_smap_premium_fb_include_categories;
				$xyz_smap_premium_fb_spec_cat=$entry->xyz_smap_premium_fb_spec_cat;
				$xyz_smap_premium_fb_default_custtype_sel=$entry->xyz_smap_premium_fb_default_custtype_sel;
				$xyz_smap_premium_fb_include_customposttypes=$entry->xyz_smap_premium_fb_include_customposttypes;
				$message=$entry->xyz_smap_message;
			}
			if(isset($_POST['xyz_smap_post_fbpermission']))
			{
				$post_permissin=$_POST['xyz_smap_post_fbpermission'];
				$post_permissin=$post_permissin[$i];
			}

			if(isset($_POST['xyz_smap_po_method']))
			{
				$posting_method=$_POST['xyz_smap_po_method'];
				$posting_method=$posting_method[$i];
			}

			if(isset($_POST['xyz_smap_message']))
			{
				$message=$_POST['xyz_smap_message'];
				$message=$message[$i];
			}

			if($message=="")
			{
				$message=get_option('xyz_smap_fbmessage_format');
			}


			$futToPubDataArray['fb-'.$fbarray[$i]]=array('post_permissin'	=>	$post_permissin,
								'post_method'	=>	$posting_method,
								'message'	=>	$message);
		}

		for($i=0;$i<count($twarray);$i++)
		{
			$messagetopost="";
			$post_twitter_permission=get_option('xyz_smap_premium_include_posts');
			$post_twitter_image_permission="";
			$xyz_smap_premium_tw_default_cat_sel="";$xyz_smap_premium_tw_include_categories="";$xyz_smap_premium_tw_spec_cat="";
			$entries1 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tw_details WHERE id=%d LIMIT 0,1',array($twarray[$i]) ));

			foreach( $entries1 as $entry ) {
				$post_twitter_image_permission=$entry-> 	xyz_smap_post_image_permission;
				$xyz_smap_premium_tw_default_cat_sel=$entry->xyz_smap_premium_tw_default_cat_sel;
				$xyz_smap_premium_tw_include_categories=$entry->xyz_smap_premium_tw_include_categories;
				$xyz_smap_premium_tw_spec_cat=$entry->xyz_smap_premium_tw_spec_cat;
				$xyz_smap_premium_tw_default_custtype_sel=$entry->xyz_smap_premium_tw_default_custtype_sel;
				$xyz_smap_premium_tw_include_customposttypes=$entry->xyz_smap_premium_tw_include_customposttypes;
				$messagetopost=$entry->xyz_smap_message;
			}

			if(isset($_POST['xyz_smap_twmessage']))
			{
				$messagetopost=$_POST['xyz_smap_twmessage'];
				$messagetopost=$messagetopost[$i];
			}

			if($messagetopost=="")
			{
				$messagetopost=get_option('xyz_smap_twmessage_format');
			}
			if(isset($_POST['xyz_smap_twpost_permission']))
			{
				$post_twitter_permission=$_POST['xyz_smap_twpost_permission'];
				$post_twitter_permission=$post_twitter_permission[$i];
			}

			if(isset($_POST['xyz_smap_twpost_image_permission']))
			{
				$post_twitter_image_permission=$_POST['xyz_smap_twpost_image_permission'];
				$post_twitter_image_permission=$post_twitter_image_permission[$i];
			}

			$futToPubDataArray['tw-'.$twarray[$i]]=array( 'post_twitter_permission'	=>	$post_twitter_permission,
					'post_twitter_image_permission'	=>	$post_twitter_image_permission,
					'message'	=>	$messagetopost);
		}

		for($i=0;$i<count($lnarray);$i++)
		{
			$lmessagetopost="";
			$lnposting_permission=get_option('xyz_smap_premium_include_posts');
			$post_ln_image_permission="";
			$xyz_smap_premium_ln_default_cat_sel="";$xyz_smap_premium_ln_include_categories="";$xyz_smap_premium_ln_spec_cat="";

			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_ln_details WHERE id=%d LIMIT 0,1',array($lnarray[$i]) ));
			foreach( $entries as $entry ) {
				$post_ln_image_permission=$entry->xyz_smap_post_image_permission;
				$xyz_smap_premium_ln_default_cat_sel=$entry->xyz_smap_premium_ln_default_cat_sel;
				$xyz_smap_premium_ln_include_categories=$entry->xyz_smap_premium_ln_include_categories;
				$xyz_smap_premium_ln_spec_cat=$entry->xyz_smap_premium_ln_spec_cat;
				$xyz_smap_premium_ln_default_custtype_sel=$entry->xyz_smap_premium_ln_default_custtype_sel;
				$xyz_smap_premium_ln_include_customposttypes=$entry->xyz_smap_premium_ln_include_customposttypes;
				$lmessagetopost=$entry->xyz_smap_lnmessage;
			}

			if(isset($_POST['xyz_smap_post_lnpermission']))
			{
				$lnposting_permission=$_POST['xyz_smap_post_lnpermission'];
				$lnposting_permission=$lnposting_permission[$i];
			}

			if(isset($_POST['xyz_smap_lnpost_image_permission']))
			{
				$post_ln_image_permission=$_POST['xyz_smap_lnpost_image_permission'];
				$post_ln_image_permission=$post_ln_image_permission[$i];
			}

			if(isset($_POST['xyz_smap_lnmessage']))
			{
				$lmessagetopost=$_POST['xyz_smap_lnmessage'];
				$lmessagetopost=$lmessagetopost[$i];
			}

			if($lmessagetopost=="")
			{
				$lmessagetopost=get_option('xyz_smap_lnmessage_format');
			}

			$futToPubDataArray['ln-'.$lnarray[$i]]=array('lnposting_permission'	=>	$lnposting_permission,
					'xyz_smap_lnpost_image_permission'	=>	$post_ln_image_permission,
					'message'	=>	$lmessagetopost);
		}

		for($i=0;$i<count($piarray);$i++)
		{
			$piposting_permission=get_option('xyz_smap_premium_include_posts');
			$pmessagetopost="";
			$xyz_smap_premium_pi_default_cat_sel="";$xyz_smap_premium_pi_include_categories="";$xyz_smap_premium_pi_spec_cat="";

			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_pi_details WHERE id=%d LIMIT 0,1',array($piarray[$i]) ));
			foreach( $entries as $entry ) {

				$xyz_smap_premium_pi_default_cat_sel=$entry->xyz_smap_premium_pi_default_cat_sel;
				$xyz_smap_premium_pi_include_categories=$entry->xyz_smap_premium_pi_include_categories;
				$xyz_smap_premium_pi_spec_cat=$entry->xyz_smap_premium_pi_spec_cat;
				$xyz_smap_premium_pi_default_custtype_sel=$entry->xyz_smap_premium_pi_default_custtype_sel;
				$xyz_smap_premium_pi_include_customposttypes=$entry->xyz_smap_premium_pi_include_customposttypes;
				$pmessagetopost=$entry->xyz_smap_pimessage;

			}

			if(isset($_POST['xyz_smap_post_pipermission']))
			{
				$piposting_permission=$_POST['xyz_smap_post_pipermission'];
				$piposting_permission=$piposting_permission[$i];
			}

			if(isset($_POST['xyz_smap_pimessage']))
			{
				$pmessagetopost=$_POST['xyz_smap_pimessage'];
				$pmessagetopost=$pmessagetopost[$i];
			}

			if($pmessagetopost=="")
			{
				$pmessagetopost=get_option('xyz_smap_pimessage_format');
			}

			$futToPubDataArray['pi-'.$piarray[$i]]=array('piposting_permission'	=>	$piposting_permission,
					 'message'	=>	$pmessagetopost);
		}
		for($i=0;$i<count($gparray);$i++)
		{
			$xyz_smap_gppost_method="";$gpposting_permission=get_option('xyz_smap_premium_include_posts');
			$gmessagetopost="";
			$xyz_smap_premium_gp_default_cat_sel="";$xyz_smap_premium_gp_include_categories="";$xyz_smap_premium_gp_spec_cat="";

			$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_gp_details WHERE id=%d LIMIT 0,1',array($gparray[$i]) ));
			foreach( $entries as $entry ) {
				$xyz_smap_gppost_method=$entry->xyz_smap_gppost_method;
				$xyz_smap_premium_gp_default_cat_sel=$entry->xyz_smap_premium_gp_default_cat_sel;
				$xyz_smap_premium_gp_include_categories=$entry->xyz_smap_premium_gp_include_categories;
				$xyz_smap_premium_gp_spec_cat=$entry->xyz_smap_premium_gp_spec_cat;
				$xyz_smap_premium_gp_default_custtype_sel=$entry->xyz_smap_premium_gp_default_custtype_sel;
				$xyz_smap_premium_gp_include_customposttypes=$entry->xyz_smap_premium_gp_include_customposttypes;
				$gmessagetopost=$entry->xyz_smap_gpmessage;
			}

			if(isset($_POST['xyz_smap_post_gppermission']))
			{
				$gpposting_permission=$_POST['xyz_smap_post_gppermission'];
				$gpposting_permission=$gpposting_permission[$i];
			}

			if(isset($_POST['xyz_smap_gpmessage']))
			{
				$gmessagetopost=$_POST['xyz_smap_gpmessage'];
				$gmessagetopost=$gmessagetopost[$i];
			}

			if($gmessagetopost=="")
			{
				$gmessagetopost=get_option('xyz_smap_gpmessage_format');
			}

			if(isset($_POST['xyz_smap_gppost_method']))
			{
				$xyz_smap_gppost_method=$_POST['xyz_smap_gppost_method'];
				$xyz_smap_gppost_method=$xyz_smap_gppost_method[$i];
			}

			$futToPubDataArray['gp-'.$gparray[$i]]=array('gpposting_permission'	=>	$gpposting_permission,
					'xyz_smap_gppost_method'	=>	$xyz_smap_gppost_method,
					'message'	=>	$gmessagetopost);
		}
// 		$postmetaQuery=$wpdb->get_results( $wpdb->prepare( "SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `post_id`=%d AND `meta_key`='xyz_smap_future_to_publish'",$post_ID));
// 		if (empty($postmetaQuery))
// 			add_post_meta($post_ID, "xyz_smap_future_to_publish", $futToPubDataArray);
// 		else
			update_post_meta($post_ID, "xyz_smap_future_to_publish", $futToPubDataArray);
// 		print_r(get_post_meta($post_ID, "xyz_smap_future_to_publish", $futToPubDataArray));die;
// 	}
}


function xyz_link_premium_custtypes_publish(){

	$args=array(
			'public'   => true,
			'_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	$post_types=get_post_types($args,$output,$operator);

$xyz_smap_premium_include_customposttypes_sel=get_option('xyz_smap_premium_include_customposttypes');
	$arr1=explode(",",$xyz_smap_premium_include_customposttypes_sel);
	foreach ($post_types  as $post_type ) {

		//if(in_array($post_type, $arr1))
		add_action('publish_'.$post_type, 'xyz_link_premium_publish');
	}

}

function xyz_link_premium_publish($post_ID) {
	$_POST_CPY=$_POST;
	$_POST=stripslashes_deep($_POST);

	$t = wp_get_post_tags($post_ID,array( 'fields' => 'names' ));
	$post_tags = implode(',', $t);

	$xyz_smap_pre_post=0;
	if(isset($_POST['xyz_smap_pre_post']))
		$xyz_smap_pre_post=$_POST['xyz_smap_pre_post'];

	if($xyz_smap_pre_post==0){
	$get_post_meta=get_post_meta($post_ID,"xyz_smap",true);
	if($get_post_meta!=1)
		add_post_meta($post_ID, "xyz_smap", "1");
	}
	if (isset($_POST['_inline_edit'])) {
		if (get_option('xyz_smap_premium_default_selection_edit') == 0)
		{
			$_POST=$_POST_CPY;
			return;
		}
	}

	global $wpdb;
	global $xyz_wp_smap_page_datas;
	//$reg_exUrl = "@(https?)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?$@iS";
	$reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/\S*)?/";
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
	/*$og_datas = new DOMDocument();
	@$og_datas->loadHTML($xyz_wp_smap_page_datas);
	$xpath = new DOMXPath($og_datas);
	$ogmetaContentAttributeNodes_tit = $xpath->query("/html/head/meta[@property='og:title']/@content");
	foreach($ogmetaContentAttributeNodes_tit as $ogmetaContentAttributeNode_tit) {
		$content_title=$ogmetaContentAttributeNode_tit->nodeValue;
	}
	$ogmetaContentAttributeNodes_desc = $xpath->query("/html/head/meta[@property='og:description']/@content");
	foreach($ogmetaContentAttributeNodes_desc as $ogmetaContentAttributeNode_desc) {
		$content_desc=$ogmetaContentAttributeNode_desc->nodeValue;
	}*/


	$postpp= get_post($post_ID);


	$entries0 = $wpdb->get_results( $wpdb->prepare( 'SELECT user_nicename FROM '.$wpdb->prefix.'users WHERE ID=%d',array($postpp->post_author)));
	foreach( $entries0 as $entry ) {
		$user_nicename=$entry->user_nicename;}

	$posttype=$postpp->post_type;

	$category = get_the_category($post_ID);
	$POST_CATEGORY="";
	foreach( $category as $entry ) {

		$POST_CATEGORY.=$entry->cat_name.",";
	}
	$POST_CATEGORY=rtrim($POST_CATEGORY,",");

	include_once ABSPATH.'wp-admin/includes/plugin.php';
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


	$fb_metaArray=array();$tw_metaArray=array();$ln_metaArray=array();$pi_metaArray=array();$gp_metaArray=array();
	$get_post_meta_future_data=get_post_meta($post_ID,"xyz_smap_future_to_publish",true);

	if (!empty($get_post_meta_future_data))
	{
		foreach ($get_post_meta_future_data as $key => $val)
		{
			$pos_fb = strpos($key, 'fb-');
			if ($pos_fb !== false)
				$fb_metaArray[$key]=$val;
			$pos_tw = strpos($key, 'tw-');
			if ($pos_tw !== false)
				$tw_metaArray[$key]=$val;
			$pos_ln = strpos($key, 'ln-');
			if ($pos_ln !== false)
				$ln_metaArray[$key]=$val;
			$pos_pi = strpos($key, 'pi-');
			if ($pos_pi !== false)
				$pi_metaArray[$key]=$val;
			$pos_gp = strpos($key, 'gp-');
			if ($pos_gp !== false)
				$gp_metaArray[$key]=$val;
		}
	}

	$xyz_smap_premium_image_preference=esc_html(get_option('xyz_smap_premium_image_preference'));
	if($xyz_smap_premium_image_preference=="")
		$xyz_smap_premium_image_preference="1,2,3,4";
	$attachmenturl=xyz_smap_premium_getimage($post_ID, $postpp->post_content,$xyz_smap_premium_image_preference);
	
	$meta_image_url=apply_filters('xyz_wp_smap_custom_image_autopost',array('postid'=>$post_ID,'attachmenturl'=>$attachmenturl)); //filter to run addon codes
	
	if(is_string($meta_image_url))
		$attachmenturl=$meta_image_url;
	
	$name = $postpp->post_title;
// 	$name = html_entity_decode(get_the_title($postpp->ID), ENT_QUOTES, get_bloginfo('charset'));
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



	$fbarray=array();$twarray=array();$lnarray=array();$piarray=array();$gparray=array();

	if(isset($_POST['xyz_smap_fb_tableid']))
	$fbarray=$_POST['xyz_smap_fb_tableid'];

	if(count($fbarray)==0)
	{
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_fb_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

		$n1=0;
		foreach( $entries as $entry ) {

			$fbarray[$n1]=$entry->id;$n1++;
		}
	}

	if(isset($_POST['xyz_smap_tw_tableid']))
	$twarray=$_POST['xyz_smap_tw_tableid'];

	if(count($twarray)==0)
	{
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_tw_details WHERE xyz_smap_account_status=%d ORDER BY id DESC',array(1)));

		$n2=0;
		foreach( $entries as $entry ) {

			$twarray[$n2]=$entry->id;$n2++;
		}
	}

	if(isset($_POST['xyz_smap_ln_tableid']))
    $lnarray=$_POST['xyz_smap_ln_tableid'];

	if(count($lnarray)==0)
	{
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_ln_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

		$n3=0;
		foreach( $entries as $entry ) {

			$lnarray[$n3]=$entry->id;$n3++;
		}
	}

	if(isset($_POST['xyz_smap_pi_tableid']))
    $piarray=$_POST['xyz_smap_pi_tableid'];

	if(count($piarray)==0)
	{
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_pi_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

		$n4=0;
		foreach( $entries as $entry ) {

			$piarray[$n4]=$entry->id;$n4++;
		}
	}

	if(isset($_POST['xyz_smap_gp_tableid']))
		$gparray=$_POST['xyz_smap_gp_tableid'];

	if(count($gparray)==0)
	{
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT id FROM '.$wpdb->prefix.'xyz_smap_gp_details WHERE xyz_smap_account_status=%d and xyz_smap_authorization_flag=%d ORDER BY id DESC',array(1,0)));

		$n5=0;
		foreach( $entries as $entry ) {

			$gparray[$n5]=$entry->id;$n5++;
		}
	}

	$search=esc_html(get_option('xyz_smap_premium_hash_tags'));
	$search=str_replace(' ', '', $search);
	$search=explode(',',$search);

	$xyz_smap_task_type=get_option('xyz_smap_task_type');
    $time=time();
	for($i=0;$i<count($fbarray);$i++)
	{


		$appid="";$post_permissin="";$appsecret="";$useracces_token="";$message="";
		$fbid="";$posting_method="";$user_page_id="";$xyz_smap_pages_ids="";$post_permissin=0;
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_fb_details WHERE id=%d LIMIT 0,1',array($fbarray[$i]) ));


		foreach( $entries as $entry ) {
			$appid=$entry->xyz_smap_application_id;
			$appsecret=$entry->xyz_smap_application_secret;
			$useracces_token=$entry->xyz_smap_access_token;
			$message=$entry->xyz_smap_message;
			//$fbid=$entry->xyz_smap_fb_id;
			$posting_method=$entry->xyz_smap_po_method;
			$user_page_id=$entry->xyz_smap_fb_numericid;
			$xyz_smap_pages_ids=$entry->xyz_smap_page_ids;
			$fbstatus=$entry->xyz_smap_account_status;
			$xyz_smap_premium_fb_include_pages=$entry->xyz_smap_premium_include_pages;
			$xyz_smap_premium_fb_default_includePage=$entry->xyz_smap_premium_default_includePage;
			$xyz_smap_premium_fb_default_cat_sel=$entry->xyz_smap_premium_fb_default_cat_sel;
			$xyz_smap_premium_fb_include_posts=$entry->xyz_smap_premium_include_posts;
			$xyz_smap_premium_fb_include_categories=$entry->xyz_smap_premium_fb_include_categories;
			$xyz_smap_premium_fb_spec_cat=$entry->xyz_smap_premium_fb_spec_cat;
			$xyz_smap_premium_fb_default_custtype_sel=$entry->xyz_smap_premium_fb_default_custtype_sel;
			$xyz_smap_premium_fb_include_customposttypes=$entry->xyz_smap_premium_fb_include_customposttypes;
			$xyz_smap_premium_fb_pref_link_sel=$entry->xyz_smap_premium_fb_preferred_link_attach;
		}


		if(isset($_POST['xyz_smap_post_fbpermission']))
		{
			$post_permissin=$_POST['xyz_smap_post_fbpermission'];
			$post_permissin=$post_permissin[$i];
			if($post_permissin==0)
				continue;
		}
		else if (!empty($fb_metaArray))
		{
			foreach ($fb_metaArray as $key => $val)
			{
				$ac_id_fb=substr($key, 3);

				if($fbarray[$i]==$ac_id_fb)
				{
					$post_permissin=$val['post_permissin'];
				}
			}

			if($post_permissin==0)
				continue;
		}



		if ($posttype=="page")
		{
			if($xyz_smap_premium_fb_default_includePage==1)
			{
				$xyz_smap_premium_include_pages=get_option('xyz_smap_premium_include_pages');
				if($xyz_smap_premium_include_pages==0)
					continue;
			}
			else
			{
				if($xyz_smap_premium_fb_include_pages==0)
					continue;
			}
		}

		else if($posttype=="post")
		{

			if($xyz_smap_premium_fb_default_cat_sel==1){

				$xyz_smap_premium_include_posts=get_option('xyz_smap_premium_include_posts');
				if($xyz_smap_premium_include_posts==0)
					continue;

				$xyz_smap_premium_include_categories=get_option('xyz_smap_premium_include_categories');
				if($xyz_smap_premium_include_categories!="All")
				{
					$carr1=explode(',', $xyz_smap_premium_include_categories);

					$defaults = array('fields' => 'ids');
					$carr2=wp_get_post_categories( $post_ID, $defaults );
					$retflag=1;
					foreach ($carr2 as $key=>$catg_ids)
					{
						if(in_array($catg_ids, $carr1))
							$retflag=0;
					}


					if($retflag==1)
						continue;
				}


			}
			else if($xyz_smap_premium_fb_default_cat_sel==0)
			{
				if($xyz_smap_premium_fb_include_posts==0)
					continue;
				else
				{
					if($xyz_smap_premium_fb_include_categories=="Specific")
					{
						$carr1=explode(',', $xyz_smap_premium_fb_spec_cat);

						$defaults = array('fields' => 'ids');
						$carr2=wp_get_post_categories( $post_ID, $defaults );
						$retflag=1;
						foreach ($carr2 as $key=>$catg_ids)
						{
							if(in_array($catg_ids, $carr1))
								$retflag=0;
						}


						if($retflag==1)
							continue;
					}
				}
			}

		}

		else {


			if($xyz_smap_premium_fb_default_custtype_sel==1)
			{
				$xyz_smap_premium_include_customposttypes_sel=get_option('xyz_smap_premium_include_customposttypes');
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{

					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}
			else if($xyz_smap_premium_fb_default_custtype_sel==0)
			{
				$xyz_smap_premium_include_customposttypes_sel=esc_html($xyz_smap_premium_fb_include_customposttypes);
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}


		}

		if (!empty($fb_metaArray))
		{
			foreach ($fb_metaArray as $key => $val)
			{
				$ac_id_fb=substr($key, 3);

				if($fbarray[$i]==$ac_id_fb)
				{
					$posting_method= $val['post_method'];
					$message=$val['message'];
				}
			}
		}
		if(isset($_POST['xyz_smap_po_method']))
		{
			$posting_method=$_POST['xyz_smap_po_method'];
			$posting_method=$posting_method[$i];
		}


		if(isset($_POST['xyz_smap_message']))
		{
			$message=$_POST['xyz_smap_message'];
			$message=$message[$i];
		}

		if($message=="")
		{
			$message=get_option('xyz_smap_fbmessage_format');
		}
		////////
		$xyz_smap_fb_min_timedelay_post_publish_value=get_option('xyz_smap_min_timedelay_post_publish_value');
		$xyz_smap_fb_min_timedealy_post_publish_period=get_option('xyz_smap_min_timedealy_post_publish_period');
		$a=0;
		$schedule=0;

			if($entry->xyz_smap_premium_default_timedelay == 0)//override
			{
				$xyz_smap_fb_min_timedelay_post_publish_value=$entry->xyz_smap_min_timedelay_post_publish_value;
				$xyz_smap_fb_min_timedealy_post_publish_period=$entry->xyz_smap_min_timedealy_post_publish_period;
			}

		if($xyz_smap_task_type==1)
		{

			if($xyz_smap_fb_min_timedealy_post_publish_period==1)
				$a=$xyz_smap_fb_min_timedelay_post_publish_value*60;
			else if($xyz_smap_fb_min_timedealy_post_publish_period==2)
				$a=$xyz_smap_fb_min_timedelay_post_publish_value*60*60;
			else if($xyz_smap_fb_min_timedealy_post_publish_period==3)
				$a=$xyz_smap_fb_min_timedelay_post_publish_value*60*60*24;

			$schedule=time()+$a;


		}
		////////
		
		
		if($xyz_smap_task_type==1  && $fbstatus==1)
		{
			$task_entry_fb = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM ".$wpdb->prefix."xyz_smap_tasks WHERE `postid`=%d AND `acc_type`=%d AND `acc_id`=%d AND `publishtime`=%d",array($post_ID,1,$fbarray[$i],0)) );
			if($task_entry_fb==0)
			{
			$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
					'postid'	=>	$post_ID,
					'acc_id'	=>	$fbarray[$i],
					'acc_type'	=>	1,
					'inserttime'	=>	$time,
					'publishtime'	=>	0,
					'post_method'	=>	0,
					'post_config_value'	=>	$posting_method,
					'post_message_format'	=>	$message,
					'status'	=>	0,
					'scheduletime' => $schedule
			));
			}
			else 
			{
				$wpdb->update(
						$wpdb->prefix."xyz_smap_tasks",
						array(
								'scheduletime'	=>	$schedule),
						array( 'postid' => $post_ID,'acc_type' => 1,'acc_id'=>$fbarray[$i],'status'=> 0 )
				
				);
				
			}
			continue;
		}
		if ($postpp->post_status == 'publish' )
		{


// 			$search=esc_html(get_option('xyz_smap_premium_hash_tags'));
// 			$search=explode(',',$search);
			if($useracces_token!="" && $appsecret!="" && $appid!="" && $fbstatus==1)
			{
				
				$fb_publish_status_insert=xyz_smap_premium_facebook_publish($useracces_token,$appsecret,$appid,$fbstatus,$description,$content_title,$content_desc,$xyz_smap_pages_ids,$user_page_id, $name, $message, $caption,$link, $excerpt, $user_nicename, $post_ID, $post_tags, $POST_CATEGORY,$search,$attachmenturl,$posting_method,$shortlink,$reg_exUrl,$xyz_smap_premium_fb_pref_link_sel);
				
				
				$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
						'postid'	=>	$post_ID,
						'acc_id'	=>	$fbarray[$i],
						'acc_type'	=>	1,
						'inserttime'	=>	$time,
						'publishtime'	=>	$time,
					    'post_method'	=>	1,
						'status'	=>	$fb_publish_status_insert

				));
			}
		}

	}
	for($i=0;$i<count($twarray);$i++)
	{


		$tappid="";$tappsecret="";$twid="";$taccess_token="";$taccess_token_secret="";
		$messagetopost="";$post_twitter_permission=0;$post_twitter_image_permission="";
		$xyz_smap_premium_tw_default_cat_sel="";$xyz_smap_premium_tw_include_categories="";$xyz_smap_premium_tw_spec_cat="";
		$entries1 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tw_details WHERE id=%d LIMIT 0,1',array($twarray[$i]) ));

		foreach( $entries1 as $entry ) {
			$tappid=$entry->xyz_smap_consumer_id;
			$tappsecret=$entry->xyz_smap_consumer_secret;
			$twid=$entry->xyz_smap_tw_id;
			$taccess_token=$entry->xyz_smap_access_token;
			$taccess_token_secret=$entry->xyz_smap_access_token_secret;
			$messagetopost=$entry->xyz_smap_message;
			$post_twitter_image_permission=$entry->xyz_smap_post_image_permission;
			$twstatus=$entry->xyz_smap_account_status;
			$xyz_smap_premium_tw_include_pages=$entry->xyz_smap_premium_include_pages;
			$xyz_smap_premium_tw_default_includePage=$entry->xyz_smap_premium_default_includePage;
			$xyz_smap_premium_tw_default_cat_sel=$entry->xyz_smap_premium_tw_default_cat_sel;
			$xyz_smap_premium_tw_include_categories=$entry->xyz_smap_premium_tw_include_categories;
			$xyz_smap_premium_tw_include_posts=$entry->xyz_smap_premium_include_posts;
			$xyz_smap_premium_tw_spec_cat=$entry->xyz_smap_premium_tw_spec_cat;
			$xyz_smap_premium_tw_default_custtype_sel=$entry->xyz_smap_premium_tw_default_custtype_sel;
			$xyz_smap_premium_tw_include_customposttypes=$entry->xyz_smap_premium_tw_include_customposttypes;
		}

		if(isset($_POST['xyz_smap_twpost_permission']))
		{
			$post_twitter_permission=$_POST['xyz_smap_twpost_permission'];
			$post_twitter_permission=$post_twitter_permission[$i];


			if($post_twitter_permission==0)
				continue;
		}

		else if (!empty($tw_metaArray))
		{
			foreach ($tw_metaArray as $key => $val)
			{
				$ac_id_tw=substr($key, 3);

				if($twarray[$i]==$ac_id_tw)
				{
					$post_twitter_permission=$val['post_twitter_permission'];
				}
			}
			if($post_twitter_permission==0)
				continue;
		}

		if (!empty($tw_metaArray))
		{
			foreach ($tw_metaArray as $key => $val)
			{
				$ac_id_tw=substr($key, 3);

				if($twarray[$i]==$ac_id_tw)
				{
					$post_twitter_image_permission= $val['post_twitter_image_permission'];
					$messagetopost=$val['message'];
				}
			}

		}

		if(isset($_POST['xyz_smap_twpost_image_permission']))
		{
			$post_twitter_image_permission=$_POST['xyz_smap_twpost_image_permission'];
			$post_twitter_image_permission=$post_twitter_image_permission[$i];
		}

		if(isset($_POST['xyz_smap_twmessage']))
		{
			$messagetopost=$_POST['xyz_smap_twmessage'];
			$messagetopost=$messagetopost[$i];
		}
		if($messagetopost=="")
		{
			$messagetopost=get_option('xyz_smap_twmessage_format');
		}
		
		
		if ($posttype=="page")
		{
			if($xyz_smap_premium_tw_default_includePage==1)
			{
				$xyz_smap_premium_include_pages=get_option('xyz_smap_premium_include_pages');
				if($xyz_smap_premium_include_pages==0)
					continue;
			}
			else
			{
				if($xyz_smap_premium_tw_include_pages==0)
					continue;
			}
		}

		else if($posttype=="post")
		{

			if($xyz_smap_premium_tw_default_cat_sel==1)
			{
				$xyz_smap_premium_include_posts=get_option('xyz_smap_premium_include_posts');
				if($xyz_smap_premium_include_posts==0)
					continue;

				$xyz_smap_premium_include_categories=get_option('xyz_smap_premium_include_categories');
				if($xyz_smap_premium_include_categories!="All")
				{
					$carr1=explode(',', $xyz_smap_premium_include_categories);

					$defaults = array('fields' => 'ids');
					$carr2=wp_get_post_categories( $post_ID, $defaults );
					$retflag=1;
					foreach ($carr2 as $key=>$catg_ids)
					{
						if(in_array($catg_ids, $carr1))
							$retflag=0;
					}


					if($retflag==1)
						continue;
				}

			}
			else if($xyz_smap_premium_tw_default_cat_sel==0)
			{

				if($xyz_smap_premium_tw_include_posts==0)
					continue;
				else
				{
					if($xyz_smap_premium_tw_include_categories=="Specific")
					{
						$carr1=explode(',', $xyz_smap_premium_tw_spec_cat);

						$defaults = array('fields' => 'ids');
						$carr2=wp_get_post_categories( $post_ID, $defaults );
						$retflag=1;
						foreach ($carr2 as $key=>$catg_ids)
						{
							if(in_array($catg_ids, $carr1))
								$retflag=0;
						}


						if($retflag==1)
							continue;
					}
				}
			}


		}
		else
		{
			if($xyz_smap_premium_tw_default_custtype_sel==1)
			{
				$xyz_smap_premium_include_customposttypes_sel=get_option('xyz_smap_premium_include_customposttypes');
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}
			else if($xyz_smap_premium_tw_default_custtype_sel==0)
			{
				$xyz_smap_premium_include_customposttypes_sel=$xyz_smap_premium_tw_include_customposttypes;
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}

		}
		///////////////////
		$xyz_smap_tw_min_timedelay_post_publish_value=get_option('xyz_smap_min_timedelay_post_publish_value');
		$xyz_smap_tw_min_timedealy_post_publish_period=get_option('xyz_smap_min_timedealy_post_publish_period');
		$a=0;
		$schedule=0;

			if($entry->xyz_smap_premium_default_timedelay == 0)//override
			{
				$xyz_smap_tw_min_timedelay_post_publish_value=$entry->xyz_smap_min_timedelay_post_publish_value;
				$xyz_smap_tw_min_timedealy_post_publish_period=$entry->xyz_smap_min_timedealy_post_publish_period;
			}

		if($xyz_smap_task_type==1)
		{

			if($xyz_smap_tw_min_timedealy_post_publish_period==1)
				$a=$xyz_smap_tw_min_timedelay_post_publish_value*60;
			else if($xyz_smap_tw_min_timedealy_post_publish_period==2)
				$a=$xyz_smap_tw_min_timedelay_post_publish_value*60*60;
			else if($xyz_smap_tw_min_timedealy_post_publish_period==3)
				$a=$xyz_smap_tw_min_timedelay_post_publish_value*60*60*24;

			$schedule=time()+$a;


		}
		/////////
		
		if($xyz_smap_task_type==1 && $twstatus==1)
		{
			$task_entry_tw = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM ".$wpdb->prefix."xyz_smap_tasks WHERE `postid`=%d AND `acc_type`=%d AND `acc_id`=%d AND `publishtime`=%d",array($post_ID,2,$twarray[$i],0)) );
			if($task_entry_tw==0)
			{
			$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
					'postid'	=>	$post_ID,
					'acc_id'	=>	$twarray[$i],
					'acc_type'	=>	2,
					'inserttime'	=>	$time,
					'publishtime'	=>	0,
					'post_method'	=>	0,
					'post_config_value'	=>	$post_twitter_image_permission,
					'post_message_format'	=>	$messagetopost,
					'status'	=>	0,
					'scheduletime' => $schedule
			));
			}
			else
			{
				$wpdb->update(
						$wpdb->prefix."xyz_smap_tasks",
						array(
								'scheduletime'	=>	$schedule),
						array( 'postid' => $post_ID,'acc_type' => 2,'acc_id'=>$twarray[$i],'status'=> 0 )
			
				);
			
			}
			continue;
		}


		if ($postpp->post_status == 'publish')
		{

			if($taccess_token!="" && $taccess_token_secret!="" && $tappid!="" && $tappsecret!="" && $twstatus==1)
			{
				$tw_publish_status_insert=xyz_smap_premium_twitter_publish($taccess_token,$taccess_token_secret,$tappid,$tappsecret,$twstatus,$attachmenturl,$post_twitter_image_permission,$messagetopost,$description,$name, $caption,$link, $excerpt, $user_nicename, $post_ID, $post_tags,$POST_CATEGORY,$search,$shortlink,$reg_exUrl);

				$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
						'postid'	=>	$post_ID,
						'acc_id'	=>	$twarray[$i],
						'acc_type'	=>	2,
						'inserttime'	=>	$time,
						'publishtime'	=>	$time,
						'post_method'	=>	1,
						'status'	=>	$tw_publish_status_insert

				));


			}

		}
	}

	for($i=0;$i<count($lnarray);$i++)
	{


		$lnid="";$lnappikey="";$lnapisecret="";$lmessagetopost="";
		$lnposting_permission=0;$xyz_smap_ln_shareprivate="";$xyz_smap_authorization_flag="";
		$xyz_smap_premium_ln_default_cat_sel="";$xyz_smap_premium_ln_include_categories="";$xyz_smap_premium_ln_spec_cat="";
		$xyz_smap_ln_share_post_profile="";
		$xyz_smap_ln_company_id="";
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_ln_details WHERE id=%d LIMIT 0,1',array($lnarray[$i]) ));


		foreach( $entries as $entry ) {
			$lnid=$entry->id;
			$lnappikey=$entry->xyz_smap_lnapikey;
			$lnapisecret=$entry->xyz_smap_lnapisecret;
			$lmessagetopost=$entry->xyz_smap_lnmessage;
			$post_ln_image_permission=$entry->xyz_smap_post_image_permission;
			$xyz_smap_ln_shareprivate=$entry->xyz_smap_ln_shareprivate;
			
			$lnaf=$entry->xyz_smap_authorization_flag;
			$xyz_smap_application_lnarray=$entry->xyz_smap_application_lnarray;
			$lnstatus=$entry->xyz_smap_account_status;
			$xyz_smap_premium_ln_include_pages=$entry->xyz_smap_premium_include_pages;
			$xyz_smap_premium_ln_default_includePage=$entry->xyz_smap_premium_default_includePage;
			$xyz_smap_premium_ln_default_cat_sel=$entry->xyz_smap_premium_ln_default_cat_sel;
			$xyz_smap_premium_ln_include_categories=$entry->xyz_smap_premium_ln_include_categories;
			$xyz_smap_premium_ln_include_posts=$entry->xyz_smap_premium_include_posts;
			$xyz_smap_premium_ln_spec_cat=$entry->xyz_smap_premium_ln_spec_cat;
			$xyz_smap_premium_ln_default_custtype_sel=$entry->xyz_smap_premium_ln_default_custtype_sel;
			$xyz_smap_premium_ln_include_customposttypes=$entry->xyz_smap_premium_ln_include_customposttypes;
			$xyz_smap_ln_share_post_profile=$entry->xyz_smap_ln_share_post_profile;
			$xyz_smap_ln_company_id=$entry->xyz_smap_ln_company_id;
			$xyz_smap_premium_ln_pref_link_sel=$entry->xyz_smap_premium_ln_preferred_link_attach;
		}



	if(isset($_POST['xyz_smap_post_lnpermission']))
		{
			$lnposting_permission=$_POST['xyz_smap_post_lnpermission'];
			$lnposting_permission=$lnposting_permission[$i];

			if($lnposting_permission==0)
				continue;
		}
		else if (!empty($ln_metaArray))
		{
			foreach ($ln_metaArray as $key => $val)
			{
				$ac_id_ln=substr($key, 3);

				if($lnarray[$i]==$ac_id_ln)
				{
					$lnposting_permission=$val['lnposting_permission'];
				}
			}
			if($lnposting_permission==0)
				continue;
		}




		if ($posttype=="page")
		{
		if($xyz_smap_premium_ln_default_includePage==1)
			{
				$xyz_smap_premium_include_pages=get_option('xyz_smap_premium_include_pages');
				if($xyz_smap_premium_include_pages==0)
					continue;
			}
			else
			{
				if($xyz_smap_premium_ln_include_pages==0)
					continue;
			}
		}

		else if($posttype=="post")
		{

			if($xyz_smap_premium_ln_default_cat_sel==1)
			{
				$xyz_smap_premium_include_posts=get_option('xyz_smap_premium_include_posts');
				if($xyz_smap_premium_include_posts==0)
					continue;

				$xyz_smap_premium_include_categories=get_option('xyz_smap_premium_include_categories');
				if($xyz_smap_premium_include_categories!="All")
				{
					$carr1=explode(',', $xyz_smap_premium_include_categories);

					$defaults = array('fields' => 'ids');
					$carr2=wp_get_post_categories( $post_ID, $defaults );
					$retflag=1;
					foreach ($carr2 as $key=>$catg_ids)
					{
						if(in_array($catg_ids, $carr1))
							$retflag=0;
					}


					if($retflag==1)
						continue;
				}
			}
			else if($xyz_smap_premium_ln_default_cat_sel==0)
			{
				if($xyz_smap_premium_ln_include_posts==0)
					continue;
				else
				{
					if($xyz_smap_premium_ln_include_categories=="Specific")
					{
						$carr1=explode(',', $xyz_smap_premium_ln_spec_cat);

						$defaults = array('fields' => 'ids');
						$carr2=wp_get_post_categories( $post_ID, $defaults );
						$retflag=1;
						foreach ($carr2 as $key=>$catg_ids)
						{
							if(in_array($catg_ids, $carr1))
								$retflag=0;
						}


						if($retflag==1)
							continue;
					}
				}
			}


		}
		else
		{


			if($xyz_smap_premium_ln_default_custtype_sel==1)
			{
				$xyz_smap_premium_include_customposttypes_sel=get_option('xyz_smap_premium_include_customposttypes');
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}
			else if($xyz_smap_premium_ln_default_custtype_sel==0)
			{
				$xyz_smap_premium_include_customposttypes_sel=$xyz_smap_premium_ln_include_customposttypes;
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}


		}
		if (!empty($ln_metaArray))
		{
			foreach ($ln_metaArray as $key => $val)
			{
				$ac_id_ln=substr($key, 3);

				if($lnarray[$i]==$ac_id_ln)
				{
					$post_ln_image_permission= $val['xyz_smap_lnpost_image_permission'];
					$lmessagetopost=$val['message'];
				}
			}

		}
		if(isset($_POST['xyz_smap_lnpost_image_permission']))
		{
			$post_ln_image_permission=$_POST['xyz_smap_lnpost_image_permission'];
			$post_ln_image_permission=$post_ln_image_permission[$i];
		}

		if(isset($_POST['xyz_smap_ln_shareprivate']))
		{
			$xyz_smap_ln_shareprivate=$_POST['xyz_smap_ln_shareprivate'];
			$xyz_smap_ln_shareprivate=$xyz_smap_ln_shareprivate[$i];
		}
		if(isset($_POST['xyz_smap_ln_share_post_profile']))
		{
			$xyz_smap_ln_share_post_profile=$_POST['xyz_smap_ln_share_post_profile'];
			$xyz_smap_ln_share_post_profile=$xyz_smap_ln_share_post_profile[$i];
		}
		if(isset($_POST['xyz_smap_lnmessage']))
		{
			$lmessagetopost=$_POST['xyz_smap_lnmessage'];
			$lmessagetopost=$lmessagetopost[$i];
		}
		if($lmessagetopost=="")
		{
			$lmessagetopost=get_option('xyz_smap_lnmessage_format');
		}
		$post_config_value="";
		//if($xyz_smap_ln_share_post_profile==0)//profile
		//	$post_config_value.=$post_ln_image_permission."{ln_splitter03}".'0'."{ln_splitter03}".$xyz_smap_ln_shareprivate;
		//else 
		$post_config_value.=$post_ln_image_permission."{ln_splitter03}".$xyz_smap_ln_share_post_profile."{ln_splitter03}".$xyz_smap_ln_shareprivate;
		$post_config_value=$post_config_value."{ln_splitter04}";
		if($xyz_smap_ln_company_id!='')//company
			$post_config_value.=$xyz_smap_ln_company_id;
		
		///////////
		$xyz_smap_ln_min_timedelay_post_publish_value=get_option('xyz_smap_min_timedelay_post_publish_value');
		$xyz_smap_ln_min_timedealy_post_publish_period=get_option('xyz_smap_min_timedealy_post_publish_period');
		$a=0;
		$schedule=0;

			if($entry->xyz_smap_premium_default_timedelay == 0)//override
			{
				$xyz_smap_ln_min_timedelay_post_publish_value=$entry->xyz_smap_min_timedelay_post_publish_value;
				$xyz_smap_ln_min_timedealy_post_publish_period=$entry->xyz_smap_min_timedealy_post_publish_period;
			}

		if($xyz_smap_task_type==1)
		{

			if($xyz_smap_ln_min_timedealy_post_publish_period==1)
				$a=$xyz_smap_ln_min_timedelay_post_publish_value*60;
			else if($xyz_smap_ln_min_timedealy_post_publish_period==2)
				$a=$xyz_smap_ln_min_timedelay_post_publish_value*60*60;
			else if($xyz_smap_ln_min_timedealy_post_publish_period==3)
				$a=$xyz_smap_ln_min_timedelay_post_publish_value*60*60*24;

			$schedule=time()+$a;


		}
		///////////
	
		
		if($xyz_smap_task_type==1 && $lnstatus==1)
		{
			$task_entry_ln = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM ".$wpdb->prefix."xyz_smap_tasks WHERE `postid`=%d AND `acc_type`=%d AND `acc_id`=%d AND `publishtime`=%d",array($post_ID,3,$lnarray[$i],0)) );
			if($task_entry_ln==0)
			{
			$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
					'postid'	=>	$post_ID,
					'acc_id'	=>	$lnarray[$i],
					'acc_type'	=>	3,
					'inserttime'	=>	$time,
					'publishtime'	=>	0,
					'post_method'	=>	0,
					'post_config_value'	=>	$post_config_value,
					'post_message_format'	=>	$lmessagetopost,
					'status'	=>	0,
					'scheduletime' => $schedule


			));
			}
			else
			{
				$wpdb->update(
						$wpdb->prefix."xyz_smap_tasks",
						array(
								'scheduletime'	=>	$schedule),
						array( 'postid' => $post_ID,'acc_type' => 3,'acc_id'=>$lnarray[$i],'status'=> 0 )
			
				);
			
			}
			continue;
		}



		if ($postpp->post_status == 'publish')
		{
			if($lnappikey!="" && $lnapisecret!="" && $lnstatus==1)
			{
				
				$ln_publish_status_insert=xyz_smap_premium_linkedin_publish($lnappikey,$lnapisecret,$lnstatus,$description,$content_title,$content_desc,$caption,$name,$lmessagetopost,$link,$excerpt,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$attachmenturl,$post_ln_image_permission,$xyz_smap_application_lnarray,$xyz_smap_ln_share_post_profile,$xyz_smap_ln_shareprivate,$xyz_smap_ln_company_id,$xyz_smap_authorization_flag,$shortlink,$reg_exUrl,$xyz_smap_premium_ln_pref_link_sel);
				
				$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
						'postid'	=>	$post_ID,
						'acc_id'	=>	$lnarray[$i],
						'acc_type'	=>	3,
						'inserttime'	=>	$time,
						'publishtime'	=>	$time,
						'post_method'	=>	1,
						'status'	=>	$ln_publish_status_insert

				));
			}
		}
	}


	for($i=0;$i<count($piarray);$i++)
	{
		$xyz_smap_pi_email="";$xyz_smap_pi_password="";
		$xyz_smap_pi_board_ids="";
		$piposting_permission=0;$pmessagetopost="";$xyz_smap_account_status="";
		$xyz_smap_premium_pi_default_cat_sel="";$xyz_smap_premium_pi_include_categories="";$xyz_smap_premium_pi_spec_cat="";
		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_pi_details WHERE id=%d LIMIT 0,1',array($piarray[$i]) ));


		foreach( $entries as $entry ) {

			$xyz_smap_pi_email=$entry->xyz_smap_pi_email;
			$xyz_smap_pi_password=base64_decode($entry->xyz_smap_pi_password);
			$xyz_smap_pi_board_ids=$entry->xyz_smap_pi_board_ids;
			$pmessagetopost=$entry->xyz_smap_pimessage;
			$pistatus=$entry->xyz_smap_account_status;
			$xyz_smap_premium_pi_include_pages=$entry->xyz_smap_premium_include_pages;
			$xyz_smap_premium_pi_default_includePage=$entry->xyz_smap_premium_default_includePage;
			$xyz_smap_premium_pi_default_cat_sel=$entry->xyz_smap_premium_pi_default_cat_sel;
			$xyz_smap_premium_pi_include_categories=$entry->xyz_smap_premium_pi_include_categories;
			$xyz_smap_premium_pi_include_posts=$entry->xyz_smap_premium_include_posts;
			$xyz_smap_premium_pi_spec_cat=$entry->xyz_smap_premium_pi_spec_cat;
			$xyz_smap_premium_pi_default_custtype_sel=$entry->xyz_smap_premium_pi_default_custtype_sel;
			$xyz_smap_premium_pi_include_customposttypes=$entry->xyz_smap_premium_pi_include_customposttypes;

		}
		$pi_image_url=get_option('xyz_smap_pi_image_url');
		if($attachmenturl!="")
			$pi_image_url=$attachmenturl;




		if(isset($_POST['xyz_smap_post_pipermission']))
		{
			$piposting_permission=$_POST['xyz_smap_post_pipermission'];
			$piposting_permission=$piposting_permission[$i];

			if($piposting_permission==0)
				continue;
		}

		else if (!empty($pi_metaArray))
		{
			foreach ($pi_metaArray as $key => $val)
			{
				$ac_id_pi=substr($key, 3);

				if($piarray[$i]==$ac_id_pi)
				{
					$piposting_permission=$val['piposting_permission'];
				}
			}
			if($piposting_permission==0)
				continue;
		}



		if ($posttype=="page")
		{
		if($xyz_smap_premium_pi_default_includePage==1)
			{
				$xyz_smap_premium_include_pages=get_option('xyz_smap_premium_include_pages');
				if($xyz_smap_premium_include_pages==0)
					continue;
			}
			else
			{
				if($xyz_smap_premium_pi_include_pages==0)
					continue;
			}
		}

		else if($posttype=="post")
		{

			if($xyz_smap_premium_pi_default_cat_sel==1)
			{
				$xyz_smap_premium_include_posts=get_option('xyz_smap_premium_include_posts');
				if($xyz_smap_premium_include_posts==0)
					continue;

				$xyz_smap_premium_include_categories=get_option('xyz_smap_premium_include_categories');
				if($xyz_smap_premium_include_categories!="All")
				{
					$carr1=explode(',', $xyz_smap_premium_include_categories);

					$defaults = array('fields' => 'ids');
					$carr2=wp_get_post_categories( $post_ID, $defaults );
					$retflag=1;
					foreach ($carr2 as $key=>$catg_ids)
					{
						if(in_array($catg_ids, $carr1))
							$retflag=0;
					}


					if($retflag==1)
						continue;
				}
			}
			else if($xyz_smap_premium_pi_default_cat_sel==0)
			{
				if($xyz_smap_premium_pi_include_posts==0)
					continue;
				else
				{
					if($xyz_smap_premium_pi_include_categories=="Specific")
					{
						$carr1=explode(',', $xyz_smap_premium_pi_spec_cat);

						$defaults = array('fields' => 'ids');
						$carr2=wp_get_post_categories( $post_ID, $defaults );
						$retflag=1;
						foreach ($carr2 as $key=>$catg_ids)
						{
							if(in_array($catg_ids, $carr1))
								$retflag=0;
						}


						if($retflag==1)
							continue;
					}
				}
			}

		}
		else
		{


			if($xyz_smap_premium_pi_default_custtype_sel==1)
			{
				$xyz_smap_premium_include_customposttypes_sel=get_option('xyz_smap_premium_include_customposttypes');
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}
			else if($xyz_smap_premium_pi_default_custtype_sel==0)
			{
				$xyz_smap_premium_include_customposttypes_sel=$xyz_smap_premium_pi_include_customposttypes;
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}


		}
		if (!empty($pi_metaArray))
		{
			foreach ($pi_metaArray as $key => $val)
			{
				$ac_id_pi=substr($key, 3);

				if($piarray[$i]==$ac_id_pi)
				{
					$pmessagetopost=$val['message'];
				}
			}

		}
		if(isset($_POST['xyz_smap_pimessage']))
		{
			$pmessagetopost=$_POST['xyz_smap_pimessage'];
			$pmessagetopost=$pmessagetopost[$i];
		}

		if($pmessagetopost=="")
		{
			$pmessagetopost=get_option('xyz_smap_pimessage_format');
		}
		///////////
		$xyz_smap_pi_min_timedelay_post_publish_value=get_option('xyz_smap_min_timedelay_post_publish_value');
		$xyz_smap_pi_min_timedealy_post_publish_period=get_option('xyz_smap_min_timedealy_post_publish_period');
		$a=0;
		$schedule=0;

			if($entry->xyz_smap_premium_default_timedelay == 0)//override
			{
				$xyz_smap_pi_min_timedelay_post_publish_value=$entry->xyz_smap_min_timedelay_post_publish_value;
				$xyz_smap_pi_min_timedealy_post_publish_period=$entry->xyz_smap_min_timedealy_post_publish_period;
			}

		if($xyz_smap_task_type==1)
		{

			if($xyz_smap_pi_min_timedealy_post_publish_period==1)
				$a=$xyz_smap_pi_min_timedelay_post_publish_value*60;
			else if($xyz_smap_pi_min_timedealy_post_publish_period==2)
				$a=$xyz_smap_pi_min_timedelay_post_publish_value*60*60;
			else if($xyz_smap_pi_min_timedealy_post_publish_period==3)
				$a=$xyz_smap_pi_min_timedelay_post_publish_value*60*60*24;

			$schedule=time()+$a;


		}
		/////////
		if($xyz_smap_task_type==1 && $pistatus==1)
		{
			$task_entry_pi = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM ".$wpdb->prefix."xyz_smap_tasks WHERE `postid`=%d AND `acc_type`=%d AND `acc_id`=%d AND `publishtime`=%d",array($post_ID,4,$piarray[$i],0)) );
			if($task_entry_pi==0)
			{
			$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
					'postid'	=>	$post_ID,
					'acc_id'	=>	$piarray[$i],
					'acc_type'	=>	4,
					'inserttime'	=>	$time,
					'publishtime'	=>	0,
					'post_method'	=>	0,
					'post_message_format'	=>	$pmessagetopost,
					'status'	=>	0,
					'scheduletime' => $schedule
			));
			}
			else
			{
				$wpdb->update(
						$wpdb->prefix."xyz_smap_tasks",
						array(
								'scheduletime'	=>	$schedule),
						array( 'postid' => $post_ID,'acc_type' => 4,'acc_id'=>$piarray[$i],'status'=> 0 )
			
				);
			
			}
			continue;
		}



		if ($postpp->post_status == 'publish')
		{

			if($xyz_smap_pi_email!="" && $xyz_smap_pi_password!="" && $xyz_smap_pi_board_ids!="" && $pistatus==1)
			{
				$pi_publish_status_insert=xyz_smap_premium_pinteret_publish($xyz_smap_pi_email,$xyz_smap_pi_password,$xyz_smap_pi_board_ids,$pistatus,$name,$caption,$pmessagetopost,$link,$excerpt,$description,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$search,$pi_image_url,$shortlink,$reg_exUrl);
		
				$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
						'postid'	=>	$post_ID,
						'acc_id'	=>	$piarray[$i],
						'acc_type'	=>	4,
						'inserttime'	=>	$time,
						'publishtime'	=>	$time,
						'post_method'	=>	1,
						'status'	=>	$pi_publish_status_insert

				));



			}



		}
	}


	for($i=0;$i<count($gparray);$i++)
	{
		$xyz_smap_gp_email="";$xyz_smap_gp_password="";
		$xyz_smap_gp_pageid="";$xyz_smap_gppost_method="";
		$gpposting_permission=0;$gmessagetopost="";$xyz_smap_account_status="";
		$xyz_smap_premium_gp_default_cat_sel="";$xyz_smap_premium_gp_include_categories="";$xyz_smap_premium_gp_spec_cat="";

		$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_gp_details WHERE id=%d LIMIT 0,1',array($gparray[$i]) ));


		foreach( $entries as $entry ) {

		$xyz_smap_gp_email=$entry->xyz_smap_gp_email;
		$xyz_smap_gp_password=base64_decode($entry->xyz_smap_gp_password);
		$xyz_smap_gp_pageid=$entry->xyz_smap_gp_pageid;
		$gmessagetopost=$entry->xyz_smap_gpmessage;
		$xyz_smap_gppost_method=$entry->xyz_smap_gppost_method;
		$gpstatus=$entry->xyz_smap_account_status;
		$xyz_smap_premium_gp_include_pages=$entry->xyz_smap_premium_include_pages;
		$xyz_smap_premium_gp_default_includePage=$entry->xyz_smap_premium_default_includePage;
		$xyz_smap_premium_gp_default_cat_sel=$entry->xyz_smap_premium_gp_default_cat_sel;
		$xyz_smap_premium_gp_include_categories=$entry->xyz_smap_premium_gp_include_categories;
		$xyz_smap_premium_gp_include_posts=$entry->xyz_smap_premium_include_posts;
		$xyz_smap_premium_gp_spec_cat=$entry->xyz_smap_premium_gp_spec_cat;
		$xyz_smap_premium_gp_default_custtype_sel=$entry->xyz_smap_premium_gp_default_custtype_sel;
		$xyz_smap_premium_gp_include_customposttypes=$entry->xyz_smap_premium_gp_include_customposttypes;
		$xyz_smap_gp_select_page_or_prof=$entry->xyz_smap_gp_select_page_or_prof;
		
		}



		if(isset($_POST['xyz_smap_post_gppermission']))
		{
			$gpposting_permission=$_POST['xyz_smap_post_gppermission'];
			$gpposting_permission=$gpposting_permission[$i];

			if($gpposting_permission==0)
				continue;
		}
		else if (!empty($gp_metaArray))
		{
			foreach ($gp_metaArray as $key => $val)
			{
				$ac_id_gp=substr($key, 3);

				if($gparray[$i]==$ac_id_gp)
				{
					$gpposting_permission=$val['gpposting_permission'];
				}
			}
			if($gpposting_permission==0)
				continue;
		}




		if ($posttype=="page")
		{
			if($xyz_smap_premium_gp_default_includePage==1)
			{
				$xyz_smap_premium_include_pages=get_option('xyz_smap_premium_include_pages');
				if($xyz_smap_premium_include_pages==0)
					continue;
			}
			else
			{
				if($xyz_smap_premium_gp_include_pages==0)
					continue;
			}
		}

		else if($posttype=="post")
		{

			if($xyz_smap_premium_gp_default_cat_sel==1)
			{
				$xyz_smap_premium_include_posts=get_option('xyz_smap_premium_include_posts');
				if($xyz_smap_premium_include_posts==0)
					continue;

				$xyz_smap_premium_include_categories=get_option('xyz_smap_premium_include_categories');
				if($xyz_smap_premium_include_categories!="All")
				{
					$carr1=explode(',', $xyz_smap_premium_include_categories);

					$defaults = array('fields' => 'ids');
					$carr2=wp_get_post_categories( $post_ID, $defaults );
					$retflag=1;
					foreach ($carr2 as $key=>$catg_ids)
					{
						if(in_array($catg_ids, $carr1))
							$retflag=0;
					}


					if($retflag==1)
						continue;
				}
			}
			else if($xyz_smap_premium_gp_default_cat_sel==0)
			{
				if($xyz_smap_premium_gp_include_posts==0)
					continue;
				else
				{
					if($xyz_smap_premium_gp_include_categories=="Specific")
					{
						$carr1=explode(',', $xyz_smap_premium_gp_spec_cat);

						$defaults = array('fields' => 'ids');
						$carr2=wp_get_post_categories( $post_ID, $defaults );
						$retflag=1;
						foreach ($carr2 as $key=>$catg_ids)
						{
							if(in_array($catg_ids, $carr1))
								$retflag=0;
						}


						if($retflag==1)
							continue;
					}
				}
			}

		}
		else
		{

			if($xyz_smap_premium_gp_default_custtype_sel==1)
			{
				$xyz_smap_premium_include_customposttypes_sel=get_option('xyz_smap_premium_include_customposttypes');
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}
			else if($xyz_smap_premium_gp_default_custtype_sel==0)
			{
				$xyz_smap_premium_include_customposttypes_sel=$xyz_smap_premium_gp_include_customposttypes;
				if($xyz_smap_premium_include_customposttypes_sel!='')
				{
					$caus1=explode(',', $xyz_smap_premium_include_customposttypes_sel);
					if(!in_array($posttype, $caus1))
						continue;
				}
				else
					continue;
			}


		}
		if (!empty($gp_metaArray))
		{
			foreach ($gp_metaArray as $key => $val)
			{
				$ac_id_gp=substr($key, 3);

				if($gparray[$i]==$ac_id_gp)
				{
					$xyz_smap_gppost_method= $val['xyz_smap_gppost_method'];
					$gmessagetopost=$val['message'];
				}
			}

		}
		if(isset($_POST['xyz_smap_gpmessage']))
		{
			$gmessagetopost=$_POST['xyz_smap_gpmessage'];
			$gmessagetopost=$gmessagetopost[$i];
		}

		if($gmessagetopost=="")
		{
			$gmessagetopost=get_option('xyz_smap_gpmessage_format');
		}

		if(isset($_POST['xyz_smap_gppost_method']))
		{
			$xyz_smap_gppost_method=$_POST['xyz_smap_gppost_method'];
			$xyz_smap_gppost_method=$xyz_smap_gppost_method[$i];
		}
		///////////
		$xyz_smap_gp_min_timedelay_post_publish_value=get_option('xyz_smap_min_timedelay_post_publish_value');
		$xyz_smap_gp_min_timedealy_post_publish_period=get_option('xyz_smap_min_timedealy_post_publish_period');
		$a=0;
		$schedule=0;

			if($entry->xyz_smap_premium_default_timedelay == 0)//override
			{
				$xyz_smap_gp_min_timedelay_post_publish_value=$entry->xyz_smap_min_timedelay_post_publish_value;
				$xyz_smap_gp_min_timedealy_post_publish_period=$entry->xyz_smap_min_timedealy_post_publish_period;
			}

		if($xyz_smap_task_type==1)
		{

			if($xyz_smap_gp_min_timedealy_post_publish_period==1)
				$a=$xyz_smap_gp_min_timedelay_post_publish_value*60;
			else if($xyz_smap_gp_min_timedealy_post_publish_period==2)
				$a=$xyz_smap_gp_min_timedelay_post_publish_value*60*60;
			else if($xyz_smap_gp_min_timedealy_post_publish_period==3)
				$a=$xyz_smap_gp_min_timedelay_post_publish_value*60*60*24;

			$schedule=time()+$a;


		}
		///////////
		
		if($xyz_smap_task_type==1  && $gpstatus==1)
		{
			$task_entry_gp = $wpdb->get_var( $wpdb->prepare( "SELECT count(id) FROM ".$wpdb->prefix."xyz_smap_tasks WHERE `postid`=%d AND `acc_type`=%d AND `acc_id`=%d AND `publishtime`=%d",array($post_ID,5,$gparray[$i],0)) );
			if($task_entry_gp==0)
			{
			$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
					'postid'	=>	$post_ID,
					'acc_id'	=>	$gparray[$i],
					'acc_type'	=>	5,
					'inserttime'	=>	$time,
					'publishtime'	=>	0,
					'post_method'	=>	0,
					'post_config_value'	=>	$xyz_smap_gppost_method,
					'post_message_format'	=>	$gmessagetopost,
					'status'	=>	0,
					'scheduletime' => $schedule
			));
			}
			else
			{
				$wpdb->update(
						$wpdb->prefix."xyz_smap_tasks",
						array(
								'scheduletime'	=>	$schedule),
						array( 'postid' => $post_ID,'acc_type' => 5,'acc_id'=>$gparray[$i],'status'=> 0 )
			
				);
			
			}
			continue;
		}



		if ($postpp->post_status == 'publish')
		{
			if($xyz_smap_gp_email!="" && $xyz_smap_gp_password!="" && $xyz_smap_gppost_method!="" && $gpstatus==1)
			{
			
				$gp_publish_status_insert=xyz_smap_premium_gplus_publish($xyz_smap_gp_email,$xyz_smap_gp_password,$xyz_smap_gppost_method,$gpstatus,$gmessagetopost,$name,$caption,$link,$excerpt,$description,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$search,$xyz_smap_gp_pageid,$attachmenturl,$xyz_smap_gp_select_page_or_prof,$shortlink,$reg_exUrl);
						
				$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
				'postid'	=>	$post_ID,
				'acc_id'	=>	$gparray[$i],
				'acc_type'	=>	5,
				'inserttime'	=>	$time,
				'publishtime'	=>	$time,
				'post_method'	=>	1,
				'status'	=>	$gp_publish_status_insert
				));

			}
		}
	}
	$_POST=$_POST_CPY;

}
?>
