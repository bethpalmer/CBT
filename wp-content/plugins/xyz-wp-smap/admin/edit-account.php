<?php
global $wpdb;

$imgpath= plugins_url()."/xyz-wp-smap/admin/images/";
$heimg=$imgpath."support.png";
$xyz_smap_accountId = $_GET['id'];
$xyz_smap_account_type= $_GET['type'];
$table=xyz_smap_get_table($xyz_smap_account_type);
$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT %d,%d',array($xyz_smap_accountId,0,1) )) ;

if($accountCount==0){
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type='.$xyz_smap_account_type));
	exit();
}
else
{
	$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT %d,%d',array($xyz_smap_accountId,0,1) ));
	foreach( $entries as $entry ) {
		
		if($xyz_smap_account_type==1)
		{

			$appidO=esc_html($entry->xyz_smap_application_id);
			$xyz_smap_fbapplication_nameO=esc_html($entry->xyz_smap_application_name);
			$appsecretO=esc_html($entry->xyz_smap_application_secret);
			//$fbidO=esc_html($entry->xyz_smap_fb_id);
			$posting_methodO=esc_html($entry->xyz_smap_po_method);
			$fb_preferred_link0=$entry->xyz_smap_premium_fb_preferred_link_attach;
			$access_tokenO=esc_html($entry->xyz_smap_access_token);
			$messagetopostO=esc_textarea($entry->xyz_smap_message);
			$page_idsO=esc_html($entry->xyz_smap_page_ids);
			$xyz_smap_authorization_flagO=esc_html($entry->xyz_smap_authorization_flag);
			$xyz_smap_premium_include_pages0=esc_html($entry->xyz_smap_premium_include_pages);	
			$xyz_smap_premium_default_includePage0=esc_html($entry->xyz_smap_premium_default_includePage);
			$xyz_smap_premium_default_cat_sel0=esc_html($entry->xyz_smap_premium_fb_default_cat_sel);
			$xyz_smap_premium_include_posts0= esc_html($entry->xyz_smap_premium_include_posts);
			$smap_category_ids0=esc_html($entry->xyz_smap_premium_fb_include_categories);
			$spec_cat0=esc_html($entry->xyz_smap_premium_fb_spec_cat);
			$xyz_smap_premium_default_custtype_sel0=esc_html($entry->xyz_smap_premium_fb_default_custtype_sel);
			$smap_customtype_ids0=esc_html($entry->xyz_smap_premium_fb_include_customposttypes);
			
		}
		else if($xyz_smap_account_type==2)
		{
			$xyz_smap_twapplication_nameO=esc_html($entry->xyz_smap_application_name);
			$tappidO=esc_html($entry->xyz_smap_consumer_id);
			$tappsecretO=esc_html($entry->xyz_smap_consumer_secret);
			$twidO=esc_html($entry->xyz_smap_tw_id);
			$taccess_tokenO=esc_html($entry->xyz_smap_access_token);
			$taccess_token_secretO=esc_html($entry->xyz_smap_access_token_secret);
			$tposting_image_permissionO=esc_html($entry->xyz_smap_post_image_permission);
			$tmessagetopostO=esc_textarea($entry->xyz_smap_message);
			$xyz_smap_account_statusO=esc_html($entry->xyz_smap_account_status);
			$xyz_smap_premium_include_pages0=esc_html($entry->xyz_smap_premium_include_pages);
			$xyz_smap_premium_default_includePage0=esc_html($entry->xyz_smap_premium_default_includePage);
			$xyz_smap_premium_default_cat_sel0=esc_html($entry->xyz_smap_premium_tw_default_cat_sel);
			$xyz_smap_premium_include_posts0= esc_html($entry->xyz_smap_premium_include_posts);
			$smap_category_ids0=esc_html($entry->xyz_smap_premium_tw_include_categories);
			$spec_cat0=esc_html($entry->xyz_smap_premium_tw_spec_cat);
			$xyz_smap_premium_default_custtype_sel0=esc_html($entry->xyz_smap_premium_tw_default_custtype_sel);
			$smap_customtype_ids0=esc_html($entry->xyz_smap_premium_tw_include_customposttypes);
			
		}
		else if($xyz_smap_account_type==3)
		{
			$xyz_smap_lnapplication_nameO=esc_html($entry->xyz_smap_application_name);
			$lnappikeyO=esc_html($entry->xyz_smap_lnapikey);
			$lnapisecretO=esc_html($entry->xyz_smap_lnapisecret);
			$lmessagetopostO=esc_textarea($entry->xyz_smap_lnmessage);
			$lposting_image_permissionO=esc_html($entry->xyz_smap_post_image_permission);
			$ln_sh_post_profile0=$entry->xyz_smap_ln_share_post_profile;
			$ln_preferred_link0=$entry->xyz_smap_premium_ln_preferred_link_attach;

			$xyz_smap_ln_shareprivateO=esc_html($entry->xyz_smap_ln_shareprivate);
			$xyz_smap_ln_company_names0=esc_html($entry->xyz_smap_ln_company_name);
			$xyz_smap_ln_company_ids0=esc_html($entry->xyz_smap_ln_company_id);
			
			$xyz_ln_accesstoken0=$entry->xyz_smap_application_lnarray;
			
			$xyz_smap_authorization_flagO=esc_html($entry->xyz_smap_authorization_flag);
			$xyz_smap_premium_include_pages0=esc_html($entry->xyz_smap_premium_include_pages);
			$xyz_smap_premium_default_includePage0=esc_html($entry->xyz_smap_premium_default_includePage);
			$xyz_smap_premium_default_cat_sel0=esc_html($entry->xyz_smap_premium_ln_default_cat_sel);
			$xyz_smap_premium_include_posts0= esc_html($entry->xyz_smap_premium_include_posts);
			$smap_category_ids0=esc_html($entry->xyz_smap_premium_ln_include_categories);
			$spec_cat0=esc_html($entry->xyz_smap_premium_ln_spec_cat);
			$xyz_smap_premium_default_custtype_sel0=esc_html($entry->xyz_smap_premium_ln_default_custtype_sel);
			$smap_customtype_ids0=esc_html($entry->xyz_smap_premium_ln_include_customposttypes);

			
		}
		else if($xyz_smap_account_type==4)
		{
			$xyz_smap_piapplication_nameO=esc_html($entry->xyz_smap_application_name);
			$xyz_smap_pi_emailO=esc_html($entry->xyz_smap_pi_email);
			
			$xyz_smap_pi_passwordO=esc_html($entry->xyz_smap_pi_password);
			$xyz_smap_pi_password_decr = base64_decode($xyz_smap_pi_passwordO);
			
			$xyz_smap_pi_board_idsO=esc_html($entry->xyz_smap_pi_board_ids);
			$xyz_smap_pimessageO=esc_textarea($entry->xyz_smap_pimessage);
			$xyz_smap_account_statusO=esc_html($entry->xyz_smap_account_status);
			$xyz_smap_authorization_flagO=esc_html($entry->xyz_smap_authorization_flag);
			$xyz_smap_premium_include_pages0=esc_html($entry->xyz_smap_premium_include_pages);
			$xyz_smap_premium_default_includePage0=esc_html($entry->xyz_smap_premium_default_includePage);
			$xyz_smap_premium_default_cat_sel0=esc_html($entry->xyz_smap_premium_pi_default_cat_sel);
			$xyz_smap_premium_include_posts0= esc_html($entry->xyz_smap_premium_include_posts);
			$smap_category_ids0=esc_html($entry->xyz_smap_premium_pi_include_categories);
			$spec_cat0=esc_html($entry->xyz_smap_premium_pi_spec_cat);
			$xyz_smap_premium_default_custtype_sel0=esc_html($entry->xyz_smap_premium_pi_default_custtype_sel);
			$smap_customtype_ids0=esc_html($entry->xyz_smap_premium_pi_include_customposttypes);
			
		}
		else if($xyz_smap_account_type==5)
		{
			$xyz_smap_gpapplication_nameO=esc_html($entry->xyz_smap_application_name);
			$xyz_smap_gp_emailO=esc_html($entry->xyz_smap_gp_email);			
			$xyz_smap_gp_passwordO=esc_html($entry->xyz_smap_gp_password);
			$xyz_smap_gp_password_decr = base64_decode($xyz_smap_gp_passwordO);
			
			$xyz_smap_gp_pageidO=esc_html($entry->xyz_smap_gp_pageid);
			$xyz_smap_gpmessageO=esc_textarea($entry->xyz_smap_gpmessage);
			$xyz_smap_gppost_methodO=esc_html($entry->xyz_smap_gppost_method);
			$xyz_smap_account_statusO=esc_html($entry->xyz_smap_account_status);
			$xyz_smap_authorization_flagO=esc_html($entry->xyz_smap_authorization_flag);
			$xyz_smap_premium_include_pages0=esc_html($entry->xyz_smap_premium_include_pages);
			$xyz_smap_premium_default_includePage0=esc_html($entry->xyz_smap_premium_default_includePage);
			$xyz_smap_premium_default_cat_sel0=esc_html($entry->xyz_smap_premium_gp_default_cat_sel);
			$xyz_smap_premium_include_posts0= esc_html($entry->xyz_smap_premium_include_posts);
			$smap_category_ids0=esc_html($entry->xyz_smap_premium_gp_include_categories);
			$spec_cat0=esc_html($entry->xyz_smap_premium_gp_spec_cat);
			$xyz_smap_premium_default_custtype_sel0=esc_html($entry->xyz_smap_premium_gp_default_custtype_sel);
			$smap_customtype_ids0=esc_html($entry->xyz_smap_premium_gp_include_customposttypes);
			$xyz_smap_gp_page_or_prof_val0=$entry->xyz_smap_gp_select_page_or_prof;
		}
		$xyz_smap_premium_default_timedelay=esc_html($entry->xyz_smap_premium_default_timedelay);
		$xyz_smap_min_timedelay_post_publish_value=esc_html($entry->xyz_smap_min_timedelay_post_publish_value);
		$xyz_smap_min_timedealy_post_publish_period=esc_html($entry->xyz_smap_min_timedealy_post_publish_period);
		
	}
}

$cat_flag=isset($xyz_smap_premium_default_cat_sel0)?$xyz_smap_premium_default_cat_sel0:'';
$post_flag=isset($xyz_smap_premium_include_posts0)?$xyz_smap_premium_include_posts0:'';
$page_flag=isset($xyz_smap_premium_default_includePage0)?$xyz_smap_premium_default_includePage0:'';
$custtype_flag=isset($xyz_smap_premium_default_custtype_sel0)?$xyz_smap_premium_default_custtype_sel0:'';
$categ_radio=isset($smap_category_ids0)?$smap_category_ids0:'';
$ln_sh_post_profile=isset($ln_sh_post_profile0)?$ln_sh_post_profile0:'';
$posting_methodO=isset($posting_methodO)?$posting_methodO:'';
$timedelay_flag=isset($xyz_smap_premium_default_timedelay)?$xyz_smap_premium_default_timedelay:1;

$ms1="";
$ms2="";
$ms3="";
$ms4="";
$ms5="";

$erf=0;

if($_POST)
{
	$xyz_smap_premium_default_timedelay=intval($_POST['xyz_smap_premium_default_timedelay']);
	$timedelay_flag=$xyz_smap_premium_default_timedelay;
	$xyz_smap_min_timedelay_post_publish_value=floatval($_POST['xyz_smap_min_timedelay_post_publish_value']);
	$xyz_smap_min_timedealy_post_publish_period=intval($_POST['xyz_smap_min_timedealy_post_publish_period']);
}

if(isset($_POST['fb']))
{
$applidold=$appidO;
$applsecretold=$appsecretO;
//$fbidold=$fbidO;

$xyz_smap_fbapplication_name=$_POST['xyz_smap_fbapplication_name'];
$posting_method=$_POST['xyz_smap_po_method'];
$fb_preferred_link=0;
if($posting_method==1||$posting_method==2)
	$fb_preferred_link=$_POST['xyz_smap_fb_preferred_link'];
$appid=$_POST['xyz_smap_application_id'];
$appsecret=$_POST['xyz_smap_application_secret'];
$messagetopost=$_POST['xyz_smap_message'];
//$fbid=$_POST['xyz_smap_fb_id'];
$xyz_smap_premium_default_cat_sel=$_POST['xyz_smap_premium_default_cat_sel'];
$xyz_smap_premium_default_includePage=$_POST['xyz_smap_premium_default_includePage'];
$xyz_smap_premium_default_custtype_sel=$_POST['xyz_smap_premium_default_custtype_sel'];
$xyz_customtypes="";
if(isset($_POST['post_types']))
	$xyz_customtypes=$_POST['post_types'];

$spec_cat="";
$smap_category_ids="";
$xyz_smap_premium_include_posts="";

if($xyz_smap_premium_default_cat_sel==0)
{
	$xyz_smap_premium_include_posts= $_POST['xyz_smap_premium_include_posts'];
	if($xyz_smap_premium_include_posts==1)
	{
		if($smap_category_ids=="All")
		{
			$smap_category_ids=$_POST['xyz_smap_cat_all_fb'];//All
		}
		else
		{
			$smap_category_ids=$_POST['xyz_smap_cat_all_fb'];//Specific
			$spec_cat=$_POST['xyz_smap_sel_cat_fb'];
		}
	}
}
if($xyz_smap_premium_default_includePage==0)
{
	$xyz_smap_premium_include_pages=$_POST['xyz_smap_premium_include_pages'];
}

$cat_flag=$xyz_smap_premium_default_cat_sel;
$post_flag=$xyz_smap_premium_include_posts;
$page_flag=$xyz_smap_premium_default_includePage;
$custtype_flag=$xyz_smap_premium_default_custtype_sel;
$categ_radio=$smap_category_ids;

if($xyz_smap_fbapplication_name=="")
{
	$ms4="Please fill application name";
	$erf=1;
}
else if($appid=="" )
	{
	$ms1="Please fill application id.";
	$erf=1;
}
elseif($appsecret=="" )
{
$ms2="Please fill application secret.";
	$erf=1;
}
/*elseif($fbid=="" )
{
$ms3="Please fill facebook user id.";
	$erf=1;
}*/
else
{
	$erf=0;	
	$xyz_smap_authorization_flag=$xyz_smap_authorization_flagO;
	if($appid!=$applidold || $appsecret!=$applsecretold)
	{
		$xyz_smap_authorization_flag=1;
		
	}
	
	
	
	$ss=array();
	$ss=$_POST['smap_pages_list'];
	
	
	$smap_pages_list_ids="";
	
	
	if($ss!="" && count($ss)>0)
	{
		for($i=0;$i<count($ss);$i++)
		{
		$smap_pages_list_ids.=$ss[$i].",";
		}
	
	}
		else
			$smap_pages_list_ids.=-1;
	
		$smap_pages_list_ids=rtrim($smap_pages_list_ids,',');

		
	
	$table=xyz_smap_get_table($xyz_smap_account_type);
	$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE xyz_smap_application_name=%s AND id!=%d LIMIT %d,%d',array($xyz_smap_fbapplication_name,$xyz_smap_accountId,0,1) )) ;
	if($accountCount>0){
		$erf=1;
		$ms5="Application name already exist.";
	}
	
	if($erf==0){
	/*
	$url = 'https://graph.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/me';
	$contentget=wp_remote_get($url);$page_id='';
	if(is_array($contentget))
	{
		$result1=$contentget['body'];
		$pagearray = json_decode($result1);
		$page_id=$pagearray->id;
	}
*/
	$smap_customtype_ids="";
	
	if($xyz_customtypes!="")
	{
		for($i=0;$i<count($xyz_customtypes);$i++)
		{
		$smap_customtype_ids.=$xyz_customtypes[$i].",";
	}
	
	}
	$smap_customtype_ids=rtrim($smap_customtype_ids,',');
	if($xyz_smap_premium_default_custtype_sel==1)
	{
		$smap_customtype_ids="";
	}
	$wpdb->update($wpdb->prefix.$table,array(
			'xyz_smap_application_id'	=>	$appid,
			'xyz_smap_application_name'	=>	$xyz_smap_fbapplication_name,
			//'xyz_smap_fb_id'	=>	$fbid,
			'xyz_smap_application_secret'	=>	$appsecret,
			'xyz_smap_premium_default_includePage'	=> $xyz_smap_premium_default_includePage,
			'xyz_smap_premium_include_pages' =>  $xyz_smap_premium_include_pages,
			'xyz_smap_premium_fb_default_cat_sel'  =>  $xyz_smap_premium_default_cat_sel,
			'xyz_smap_premium_include_posts'  =>  $xyz_smap_premium_include_posts,
			'xyz_smap_premium_fb_include_categories'  =>  $smap_category_ids,
			'xyz_smap_premium_fb_spec_cat' => $spec_cat,
			'xyz_smap_premium_fb_default_custtype_sel'  =>  $xyz_smap_premium_default_custtype_sel,
			'xyz_smap_premium_fb_include_customposttypes' => $smap_customtype_ids,
			'xyz_smap_message'	=>	$messagetopost,
			'xyz_smap_premium_fb_preferred_link_attach'	=>	$fb_preferred_link,
			'xyz_smap_po_method'	=>	$posting_method,
			/*'xyz_smap_fb_numericid'	=>	$page_id,*/
			'xyz_smap_authorization_flag'	=>	$xyz_smap_authorization_flag,
			'xyz_smap_page_ids'	=>	$smap_pages_list_ids,
			'xyz_smap_premium_default_timedelay'	=>	$xyz_smap_premium_default_timedelay,
			'xyz_smap_min_timedelay_post_publish_value'	=>	$xyz_smap_min_timedelay_post_publish_value,
			'xyz_smap_min_timedealy_post_publish_period'	=>	$xyz_smap_min_timedealy_post_publish_period
			
	),
			array('id'=>$xyz_smap_accountId));
	
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=3&account_type='.$xyz_smap_account_type));
	exit();
	}
			
}	

}

$tms1="";
$tms2="";
$tms3="";
$tms4="";
$tms5="";
$tms6="";
$tms7="";
$tredirecturl=admin_url('admin.php?page=social-media-auto-publish-settings-premium&authtwit=1');

$terf=0;
if(isset($_POST['twit']))
{

	$xyz_smap_twapplication_name=$_POST['xyz_smap_twapplication_name'];
	$tappid=$_POST['xyz_smap_twconsumer_id'];
	$tappsecret=$_POST['xyz_smap_twconsumer_secret'];
	$twid=$_POST['xyz_smap_tw_id'];
	$taccess_token=$_POST['xyz_smap_current_twappln_token'];
	$taccess_token_secret=$_POST['xyz_smap_twaccestok_secret'];
	$tposting_image_permission=$_POST['xyz_smap_twpost_image_permission'];
	$tmessagetopost=$_POST['xyz_smap_twmessage'];
	$xyz_smap_premium_default_includePage=$_POST['xyz_smap_premium_default_includePage'];
	$xyz_smap_premium_default_cat_sel=$_POST['xyz_smap_premium_default_cat_sel'];
    $xyz_smap_premium_default_custtype_sel=$_POST['xyz_smap_premium_default_custtype_sel'];
	
	$xyz_customtypes="";
	if(isset($_POST['post_types']))
		$xyz_customtypes=$_POST['post_types'];
	
	$spec_cat="";
	$smap_category_ids="";
	$xyz_smap_premium_include_posts="";
	
	if($xyz_smap_premium_default_cat_sel==0)
	{
		$xyz_smap_premium_include_posts= $_POST['xyz_smap_premium_include_posts'];
		if($xyz_smap_premium_include_posts==1)
		{
			if($smap_category_ids=="All")
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_tw'];//All
			}
			else
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_tw'];//Specific
				$spec_cat=$_POST['xyz_smap_sel_cat_tw'];
			}
		}
	}
	if($xyz_smap_premium_default_includePage==0)
	{
		$xyz_smap_premium_include_pages=$_POST['xyz_smap_premium_include_pages'];
	}
	$cat_flag=$xyz_smap_premium_default_cat_sel;
	$post_flag=$xyz_smap_premium_include_posts;
	$page_flag=$xyz_smap_premium_default_includePage;
	$custtype_flag=$xyz_smap_premium_default_custtype_sel;
	$categ_radio=$smap_category_ids;
	
	if($xyz_smap_twapplication_name=="")
	{
		$tms6="Please fill application name";
		$terf=1;
	}
	else if($tappid=="" )
	{
		$terf=1;
		$tms1="Please fill api key.";

	}
	elseif($tappsecret=="" )
	{
		$tms2="Please fill api secret.";
		$terf=1;
	}
	elseif($twid=="" )
	{
		$tms3="Please fill twitter username.";
		$terf=1;
	}
	elseif($taccess_token=="" )
	{
		$tms4="Please fill access token.";
		$terf=1;
	}
	elseif($taccess_token_secret=="" )
	{
		$tms5="Please fill access token secret.";
		$terf=1;
	}
	else
	{
		$terf=0;
		$table=xyz_smap_get_table($xyz_smap_account_type);
	$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE xyz_smap_application_name=%s AND id!=%d LIMIT %d,%d',array($xyz_smap_twapplication_name,$xyz_smap_accountId,0,1) )) ;
	if($accountCount>0){
		$terf=1;
		$tms7="Application name already exist.";
	}
		
	if($terf==0){
		$xyz_smap_account_status=$xyz_smap_account_statusO;
		if($tappid=="" || $tappsecret=="" || $twid=="" || $taccess_token=="" || $taccess_token_secret=="")
			$xyz_smap_account_status=0;
	
		$smap_customtype_ids="";
		
		if($xyz_customtypes!="")
		{
			for($i=0;$i<count($xyz_customtypes);$i++)
			{
			$smap_customtype_ids.=$xyz_customtypes[$i].",";
		}
		
		}
		$smap_customtype_ids=rtrim($smap_customtype_ids,',');
		if($xyz_smap_premium_default_custtype_sel==1)
		{
			$smap_customtype_ids="";
		}
		$wpdb->update($wpdb->prefix.$table,array(
				'xyz_smap_application_name'	=>	$xyz_smap_twapplication_name,
				'xyz_smap_consumer_id'	=>	$tappid,
				'xyz_smap_consumer_secret'	=>	$tappsecret,
				'xyz_smap_tw_id'	=>	$twid,
				'xyz_smap_access_token'	=>	$taccess_token,
				'xyz_smap_access_token_secret'	=>	$taccess_token_secret,
				'xyz_smap_message'	=>	$tmessagetopost,
				'xyz_smap_post_image_permission'	=>	$tposting_image_permission,
				'xyz_smap_account_status'	=>	$xyz_smap_account_status,
				'xyz_smap_premium_default_includePage'	=> $xyz_smap_premium_default_includePage,
				'xyz_smap_premium_include_pages' =>  $xyz_smap_premium_include_pages,
				'xyz_smap_premium_tw_default_cat_sel'  =>  $xyz_smap_premium_default_cat_sel,
				'xyz_smap_premium_include_posts'  =>  $xyz_smap_premium_include_posts,
				'xyz_smap_premium_tw_include_categories'  =>  $smap_category_ids,
				'xyz_smap_premium_tw_spec_cat' => $spec_cat,
				'xyz_smap_premium_tw_default_custtype_sel'  =>  $xyz_smap_premium_default_custtype_sel,
				'xyz_smap_premium_tw_include_customposttypes' => $smap_customtype_ids,
				'xyz_smap_premium_default_timedelay'	=>	$xyz_smap_premium_default_timedelay,
				'xyz_smap_min_timedelay_post_publish_value'	=>	$xyz_smap_min_timedelay_post_publish_value,
				'xyz_smap_min_timedealy_post_publish_period'	=>	$xyz_smap_min_timedealy_post_publish_period
		),
			array('id'=>$xyz_smap_accountId));
		
		
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=3&account_type='.$xyz_smap_account_type));
		exit();
	}
}	
}
$lms1="";
$lms2="";
$lms3="";
$lms4="";
$lms6="";
$lms7="";
$lms8="";
$lms9="";
$lerf=0;

if(isset($_POST['linkdn']))
{
	
	$lnappikeyold=$lnappikeyO;
	$lnapisecretold=$lnapisecretO;
	
	$xyz_smap_lnapplication_name=$_POST['xyz_smap_lnapplication_name'];
	$lnappikey=$_POST['xyz_smap_lnapikey'];
	$lnapisecret=$_POST['xyz_smap_lnapisecret'];
	$lmessagetopost=trim($_POST['xyz_smap_lnmessage']);
	
	$ln_preferred_link=$_POST['xyz_smap_ln_preferred_link'];
	$lposting_image_permission=$_POST['xyz_smap_lnpost_image_permission'];
	$xyz_smap_premium_default_includePage=$_POST['xyz_smap_premium_default_includePage'];
	$xyz_smap_premium_default_cat_sel=$_POST['xyz_smap_premium_default_cat_sel'];
	$xyz_smap_premium_default_custtype_sel=$_POST['xyz_smap_premium_default_custtype_sel'];
	
	$xyz_smap_ln_share_post_profile=$_POST['xyz_smap_ln_share_post_profile'];
	$xyz_smap_ln_share_post_company=array();
	if(isset($_POST['xyz_smap_ln_share_post_company']))
		$xyz_smap_ln_share_post_company=$_POST['xyz_smap_ln_share_post_company'];
	$xyz_smap_ln_company_ids='';$xyz_smap_ln_company_names='';
	if(count($xyz_smap_ln_share_post_company)>0)
	{
		for($i=0;$i<count($xyz_smap_ln_share_post_company);$i++)
		{
			$xyz_smap_ln_share_post_company_ids_and_names=explode('-',$xyz_smap_ln_share_post_company[$i] );
			$xyz_smap_ln_company_ids.=$xyz_smap_ln_share_post_company_ids_and_names[0].',';
			$xyz_smap_ln_company_names.=$xyz_smap_ln_share_post_company_ids_and_names[1].',';
		}
		$xyz_smap_ln_company_ids=rtrim($xyz_smap_ln_company_ids,',');
		$xyz_smap_ln_company_names=rtrim($xyz_smap_ln_company_names,',');
	}
	
	$xyz_customtypes="";
	if(isset($_POST['post_types']))
		$xyz_customtypes=$_POST['post_types'];
	
	$spec_cat="";
	$smap_category_ids="";
	$xyz_smap_premium_include_posts="";

	if($xyz_smap_premium_default_cat_sel==0)
	{
		$xyz_smap_premium_include_posts= $_POST['xyz_smap_premium_include_posts'];
		if($xyz_smap_premium_include_posts==1)
		{
			if($smap_category_ids=="All")
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_ln'];//All
			}
			else
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_ln'];//Specific
				$spec_cat=$_POST['xyz_smap_sel_cat_ln'];
			}
		}
	}
	if($xyz_smap_premium_default_includePage==0)
	{
		$xyz_smap_premium_include_pages=$_POST['xyz_smap_premium_include_pages'];
	}
	
	$xyz_smap_ln_shareprivate="";
	
	

	if($xyz_smap_ln_share_post_profile==0)
			$xyz_smap_ln_shareprivate=$_POST['xyz_smap_ln_shareprivate'];
	
	$cat_flag=$xyz_smap_premium_default_cat_sel;
	$post_flag=$xyz_smap_premium_include_posts;
	$page_flag=$xyz_smap_premium_default_includePage;
	$custtype_flag=$xyz_smap_premium_default_custtype_sel;
	$categ_radio=$smap_category_ids;

	if($xyz_smap_lnapplication_name=="")
	{
		$lms3="Please fill application name";
		$lerf=1;

	}
	else if($lnappikey=="" )
	{
		$lms1="Please fill linkedin api key";
		$lerf=1;
	}
	else if($lnapisecret==""  )
	{
		$lms2="Please fill linked api secret";
		$lerf=1;
	}
	else if(($xyz_smap_ln_share_post_profile==1)&&($xyz_smap_ln_company_ids==""))
	{
		$lms8="Please select share post to profile or company page";
		$lerf=1;
	}
	else
	{

		$lerf=0;
		$table=xyz_smap_get_table($xyz_smap_account_type);
		$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE xyz_smap_application_name=%s AND id!=%d LIMIT %d,%d',array($xyz_smap_lnapplication_name,$xyz_smap_accountId,0,1) )) ;
		if($accountCount>0){
			$lerf=1;
			$lms4="Application name already exist.";
		}
	
	if($lerf==0){
		
		$xyz_smap_authorization_flag=$xyz_smap_authorization_flagO;
		if($lnappikey!=$lnappikeyold || $lnapisecret!=$lnapisecretold )
		{
			$xyz_smap_authorization_flag=1;
		}
	
		$smap_customtype_ids="";
		
		if($xyz_customtypes!="")
		{
			for($i=0;$i<count($xyz_customtypes);$i++)
			{
			$smap_customtype_ids.=$xyz_customtypes[$i].",";
		}
		
		}
		$smap_customtype_ids=rtrim($smap_customtype_ids,',');
		if($xyz_smap_premium_default_custtype_sel==1)
		{
			$smap_customtype_ids="";
		}
		

		$wpdb->update($wpdb->prefix.$table,array(
				'xyz_smap_application_name'	=>	$xyz_smap_lnapplication_name,
				'xyz_smap_lnapikey'	=>	$lnappikey,
				'xyz_smap_lnapisecret'	=>	$lnapisecret,
				'xyz_smap_lnmessage'	=>	$lmessagetopost, 
				'xyz_smap_post_image_permission'	=>	$lposting_image_permission,
				'xyz_smap_premium_ln_preferred_link_attach'	=>$ln_preferred_link,
				'xyz_smap_ln_share_post_profile'=>  $xyz_smap_ln_share_post_profile,
				'xyz_smap_ln_shareprivate'	=>	$xyz_smap_ln_shareprivate,
				'xyz_smap_ln_company_name'	=>	$xyz_smap_ln_company_names,
				'xyz_smap_ln_company_id'	=>	$xyz_smap_ln_company_ids,
				'xyz_smap_premium_default_includePage'	=> $xyz_smap_premium_default_includePage,
				'xyz_smap_premium_include_pages' =>  $xyz_smap_premium_include_pages,
				'xyz_smap_premium_ln_default_cat_sel'  =>  $xyz_smap_premium_default_cat_sel,
				'xyz_smap_premium_include_posts'  =>  $xyz_smap_premium_include_posts,
				'xyz_smap_premium_ln_include_categories'  =>  $smap_category_ids,
				'xyz_smap_premium_ln_spec_cat' => $spec_cat,
				'xyz_smap_premium_ln_default_custtype_sel'  =>  $xyz_smap_premium_default_custtype_sel,
				'xyz_smap_premium_ln_include_customposttypes' => $smap_customtype_ids,
				'xyz_smap_authorization_flag'	=>	$xyz_smap_authorization_flag,
				'xyz_smap_premium_default_timedelay'	=>	$xyz_smap_premium_default_timedelay,
				'xyz_smap_min_timedelay_post_publish_value'	=>	$xyz_smap_min_timedelay_post_publish_value,
				'xyz_smap_min_timedealy_post_publish_period'	=>	$xyz_smap_min_timedealy_post_publish_period,
				//'xyz_smap_ln_auth_time'	=> time()
		),
				array('id'=>$xyz_smap_accountId));
		
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=3&account_type='.$xyz_smap_account_type));
		exit();

	}
	}
}	


$pms1="";
$pms2="";
$pms3="";
$pms5="";
$pms6="";
$pms7="";
$perf=0;

if(isset($_POST['pinit']))
{
	
	$xyz_smap_piapplication_name=$_POST['xyz_smap_piapplication_name'];
	$xyz_smap_pi_email=$_POST['xyz_smap_pi_email'];
	$xyz_smap_pi_password=$_POST['xyz_smap_pi_password'];
	$xyz_smap_pimessage=trim($_POST['xyz_smap_pimessage']);
	$xyz_smap_premium_default_includePage=$_POST['xyz_smap_premium_default_includePage'];
	$xyz_smap_premium_default_cat_sel=$_POST['xyz_smap_premium_default_cat_sel'];
	$xyz_smap_premium_default_custtype_sel=$_POST['xyz_smap_premium_default_custtype_sel'];
	
	$xyz_customtypes="";
	if(isset($_POST['post_types']))
		$xyz_customtypes=$_POST['post_types'];
	
	$spec_cat="";
	$smap_category_ids="";
	$xyz_smap_premium_include_posts="";
	
	if($xyz_smap_premium_default_cat_sel==0)
	{
		$xyz_smap_premium_include_posts= $_POST['xyz_smap_premium_include_posts'];
		if($xyz_smap_premium_include_posts==1)
		{
			if($smap_category_ids=="All")
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_pi'];//All
			}
			else
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_pi'];//Specific
				$spec_cat=$_POST['xyz_smap_sel_cat_pi'];
			}
		}
	}
	if($xyz_smap_premium_default_includePage==0)
	{
		$xyz_smap_premium_include_pages=$_POST['xyz_smap_premium_include_pages'];
	}
	$cat_flag=$xyz_smap_premium_default_cat_sel;
	$post_flag=$xyz_smap_premium_include_posts;
	$page_flag=$xyz_smap_premium_default_includePage;
	$custtype_flag=$xyz_smap_premium_default_custtype_sel;
	$categ_radio=$smap_category_ids;

	if($xyz_smap_piapplication_name=="" && $perf==0)
	{
		$pms1="Please fill application name";
		$perf=1;
	
	}
	 if($xyz_smap_pi_email=="" && $perf==0 )
	{
		$pms2="Please fill email";
		$perf=1;
	}
	 if($xyz_smap_pi_email!="" && $perf==0 )
	{
		
		if (!filter_var($xyz_smap_pi_email, FILTER_VALIDATE_EMAIL)) {
			$pms2="Please fill a valid email";
		     $perf=1;
		} 
	}
	 if($xyz_smap_pi_password=="" && $perf==0 )
	{
		$pms3="Please fill password";
		$perf=1;
	}
	 
	$ss=array();
	$ss=$_POST['xyz_smap_pi_board_ids'];
	$xyz_smap_pi_board_ids="";
	
	$board_check=1;
	if($xyz_smap_pi_email!=$xyz_smap_pi_emailO || $xyz_smap_pi_password!=$xyz_smap_pi_password_decr)
	{
		$board_check=0;
	}
	if($ss!="" && count($ss)>0)
	{
		for($i=0;$i<count($ss);$i++)
		{
		$xyz_smap_pi_board_ids.=$ss[$i].",";
		}
		$xyz_smap_pi_board_ids=rtrim($xyz_smap_pi_board_ids,',');
	}
	else 
		{
			if($perf==0 && $board_check==1)
			{
			$pms5="Please select atleast one board for auto publish";
			$perf=1;
			}
		}
	
		if($perf==0 ){
			$loginError = xyzsmap_logtopinterest($xyz_smap_pi_email, $xyz_smap_pi_password);
			if ($loginError)
			{
				$pms6="Invalid details. Unable to access pinterest account.";
				$perf=1;
			}		
		}	
			
	if($perf==0)
	{

		$table=xyz_smap_get_table($xyz_smap_account_type);
		
		$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE xyz_smap_application_name=%s AND id!=%d LIMIT %d,%d',array($xyz_smap_piapplication_name,$xyz_smap_accountId,0,1) )) ;
		if($accountCount>0){
			$perf=1;
			$pms7="Application name already exist.";
		}
		
		if($perf==0){
			
		$xyz_smap_pi_encpassword=base64_encode($xyz_smap_pi_password);
		 
		$xyz_smap_authorization_flag=$xyz_smap_authorization_flagO;$xyz_smap_account_status=$xyz_smap_account_statusO;
		if($xyz_smap_pi_email!=$xyz_smap_pi_emailO || $xyz_smap_pi_password!=$xyz_smap_pi_password_decr)
		{
			$xyz_smap_authorization_flag=1;$xyz_smap_account_status=0;
		}
		else if($xyz_smap_pi_board_ids!="")
			$xyz_smap_authorization_flag=0;
		
		$smap_customtype_ids="";
	
		if($xyz_customtypes!="")
		{
			for($i=0;$i<count($xyz_customtypes);$i++)
			{
			$smap_customtype_ids.=$xyz_customtypes[$i].",";
		}
		
		}
		$smap_customtype_ids=rtrim($smap_customtype_ids,',');
		if($xyz_smap_premium_default_custtype_sel==1)
		{
			$smap_customtype_ids="";
		}
		$wpdb->update($wpdb->prefix.$table,array(
				'xyz_smap_application_name'	=>	$xyz_smap_piapplication_name,
				'xyz_smap_pi_email'	=>	$xyz_smap_pi_email,
				'xyz_smap_pi_password'	=>	$xyz_smap_pi_encpassword,
				'xyz_smap_pi_board_ids'	=>	$xyz_smap_pi_board_ids,
				'xyz_smap_pimessage'	=>	$xyz_smap_pimessage,
				'xyz_smap_authorization_flag'	=>	$xyz_smap_authorization_flag,
				'xyz_smap_premium_default_includePage'	=> $xyz_smap_premium_default_includePage,
				'xyz_smap_premium_include_pages' =>  $xyz_smap_premium_include_pages,
				'xyz_smap_premium_pi_default_cat_sel'  =>  $xyz_smap_premium_default_cat_sel,
				'xyz_smap_premium_include_posts'  =>  $xyz_smap_premium_include_posts,
				'xyz_smap_premium_pi_include_categories'  =>  $smap_category_ids,
				'xyz_smap_premium_pi_spec_cat' => $spec_cat,
				'xyz_smap_premium_pi_default_custtype_sel'  =>  $xyz_smap_premium_default_custtype_sel,
				'xyz_smap_premium_pi_include_customposttypes' => $smap_customtype_ids,
				'xyz_smap_account_status'	=>	$xyz_smap_account_status,
				'xyz_smap_premium_default_timedelay'	=>	$xyz_smap_premium_default_timedelay,
				'xyz_smap_min_timedelay_post_publish_value'	=>	$xyz_smap_min_timedelay_post_publish_value,
				'xyz_smap_min_timedealy_post_publish_period'	=>	$xyz_smap_min_timedealy_post_publish_period
				
		),
				array('id'=>$xyz_smap_accountId));

		header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=3&account_type='.$xyz_smap_account_type));
		exit();
		
		}

	}
}


$gms1="";
$gms2="";
$gms3="";
$gms4="";
$gms5="";
$gerf=0;

if(isset($_POST['gp']))
{
	require_once( ABSPATH . 'wp-content/plugins/xyz-wp-smap/api/googleplus.php'  );
	$page_flag1=0;
	$xyz_smap_gpapplication_name=$_POST['xyz_smap_gpapplication_name'];
	$xyz_smap_gp_email=$_POST['xyz_smap_gp_email'];
	$xyz_smap_gp_password=$_POST['xyz_smap_gp_password'];
	$xyz_smap_gpmessage=trim($_POST['xyz_smap_gpmessage']);
	$xyz_smap_gppost_method=trim($_POST['xyz_smap_gppost_method']);
	$xyz_smap_premium_default_includePage=$_POST['xyz_smap_premium_default_includePage'];
	$xyz_smap_premium_default_cat_sel=$_POST['xyz_smap_premium_default_cat_sel'];
	$xyz_smap_premium_default_custtype_sel=$_POST['xyz_smap_premium_default_custtype_sel'];

	if(isset($_POST['gp_pg_prof']))
	{
		$xyz_smap_gp_page_or_prof_val_arr=$_POST['gp_pg_prof'];
		$xyz_smap_gp_page_or_prof_val=implode(',', $xyz_smap_gp_page_or_prof_val_arr);
		if(in_array(1, $xyz_smap_gp_page_or_prof_val_arr)==true)
		{
			$xyz_smap_gp_pageid=trim($_POST['xyz_smap_gp_pageid']);
			$page_flag1=1;
		}
	}
	
	$xyz_customtypes="";
	if(isset($_POST['post_types']))
		$xyz_customtypes=$_POST['post_types'];
	
	$spec_cat="";
	$smap_category_ids="";
	$xyz_smap_premium_include_posts="";
	
	if($xyz_smap_premium_default_cat_sel==0)
	{
		$xyz_smap_premium_include_posts= $_POST['xyz_smap_premium_include_posts'];
		if($xyz_smap_premium_include_posts==1)
		{
			if($smap_category_ids=="All")
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_gp'];//All
			}
			else
			{
				$smap_category_ids=$_POST['xyz_smap_cat_all_gp'];//Specific
				$spec_cat=$_POST['xyz_smap_sel_cat_gp'];
			}
		}
	}
	if($xyz_smap_premium_default_includePage==0)
	{
		$xyz_smap_premium_include_pages=$_POST['xyz_smap_premium_include_pages'];
	}
	$cat_flag=$xyz_smap_premium_default_cat_sel;
	$post_flag=$xyz_smap_premium_include_posts;
	$page_flag=$xyz_smap_premium_default_includePage;
	$custtype_flag=$xyz_smap_premium_default_custtype_sel;
	$categ_radio=$smap_category_ids;

	if($xyz_smap_gpapplication_name=="" && $gerf==0)
	{
		$gms1="Please fill application name";
		$gerf=1;

	}
	if($xyz_smap_gp_email=="" && $gerf==0 )
	{
		$gms2="Please fill email";
		$gerf=1;
	}
	if($xyz_smap_gp_email!="" && $gerf==0 )
	{

		if (!filter_var($xyz_smap_gp_email, FILTER_VALIDATE_EMAIL)) {
			$gms2="Please fill a valid email";
			$gerf=1;
		}
	}
	if($xyz_smap_gp_password=="" && $gerf==0 )
	{
		$gms3="Please fill password";
		$gerf=1;
	}
	if($page_flag1==1 && $xyz_smap_gp_pageid=='' && $gerf==0 )
	{
		$gms1="Please fill page id";
		$gerf=1;
	}
	
	$xyz_smap_authorization_flag=$xyz_smap_authorization_flagO;
	$xyz_smap_account_status=$xyz_smap_account_statusO;
	
	$loginError = xyzsmap_connectToGooglePlus($xyz_smap_gp_email, $xyz_smap_gp_password);//print_r($loginError);die;
if($gerf==0  ){
		
		if ($loginError)
		{
			$gms4="Invalid details. Unable to access google plus account.";
			$gerf=1;
		}
		else
		{
			$xyz_smap_authorization_flag=0;
		}
   }
		
		if($gerf==0 ){
			if ($loginError)
			{
				$xyz_smap_authorization_flag=1;
			}
			else
			{
				$xyz_smap_authorization_flag=0;
			}
	}
	
	if($xyz_smap_gp_email=="" || $xyz_smap_gp_password=="")
	  {$xyz_smap_account_status=0;$xyz_smap_authorization_flag=1;}
	
	if($gerf==0)
	{

		$xyz_smap_gp_encpassword=base64_encode($xyz_smap_gp_password);		
		$table=xyz_smap_get_table($xyz_smap_account_type);
		
		$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE xyz_smap_application_name=%s AND id!=%d LIMIT %d,%d',array($xyz_smap_gpapplication_name,$xyz_smap_accountId,0,1) )) ;
		if($accountCount>0){
			$gerf=1;
			$gms5="Application name already exist.";
		}

		if($gerf==0)
		{
	
			$smap_customtype_ids="";
			
			if($xyz_customtypes!="")
			{
				for($i=0;$i<count($xyz_customtypes);$i++)
				{
				$smap_customtype_ids.=$xyz_customtypes[$i].",";
			}
			
			}
			$smap_customtype_ids=rtrim($smap_customtype_ids,',');
			if($xyz_smap_premium_default_custtype_sel==1)
			{
				$smap_customtype_ids="";
			}
			$wpdb->update($wpdb->prefix.$table,array(
					'xyz_smap_application_name'	=>	$xyz_smap_gpapplication_name,
					'xyz_smap_gp_email'	=>	$xyz_smap_gp_email,
					'xyz_smap_gp_password'	=>	$xyz_smap_gp_encpassword,
					'xyz_smap_gp_pageid'	=>	$xyz_smap_gp_pageid,
					'xyz_smap_gp_select_page_or_prof'=>$xyz_smap_gp_page_or_prof_val,
					'xyz_smap_gpmessage'	=>	$xyz_smap_gpmessage,
					'xyz_smap_gppost_method'	=>	$xyz_smap_gppost_method,
					'xyz_smap_authorization_flag'	=>	$xyz_smap_authorization_flag,
					'xyz_smap_premium_default_includePage'	=> $xyz_smap_premium_default_includePage,
					'xyz_smap_premium_include_pages' =>  $xyz_smap_premium_include_pages,
					'xyz_smap_premium_gp_default_cat_sel'  =>  $xyz_smap_premium_default_cat_sel,
					'xyz_smap_premium_include_posts'  =>  $xyz_smap_premium_include_posts,
					'xyz_smap_premium_gp_include_categories'  =>  $smap_category_ids,
					'xyz_smap_premium_gp_spec_cat' => $spec_cat,
					'xyz_smap_premium_gp_default_custtype_sel'  =>  $xyz_smap_premium_default_custtype_sel,
					'xyz_smap_premium_gp_include_customposttypes' => $smap_customtype_ids,
					'xyz_smap_account_status'	=>	$xyz_smap_account_status,
					'xyz_smap_premium_default_timedelay'	=>	$xyz_smap_premium_default_timedelay,
					'xyz_smap_min_timedelay_post_publish_value'	=>	$xyz_smap_min_timedelay_post_publish_value,
					'xyz_smap_min_timedealy_post_publish_period'	=>	$xyz_smap_min_timedealy_post_publish_period
					
			),
				array('id'=>$xyz_smap_accountId));

			header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=3&account_type='.$xyz_smap_account_type));
			exit();
		}

	}
}

?>
<script type="text/javascript">
function detdisplay(id)
{
	
document.getElementById(id).style.display='';

}
function dethide(id)
{

	 document.getElementById(id).style.display='none';

}
</script>
<div>
<div id='xyz_smap_cssmenu'>
<ul>
   <li <?php if($xyz_smap_account_type==1){?>class="xyz_smap_cssmenu_selected" <?php }?> ><a href='<?php
				 echo admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type=1'); ?>'><span class="xyz_smap_fb"> Facebook</span></a></li>
   <li <?php if($xyz_smap_account_type==2){?>class="xyz_smap_cssmenu_selected" <?php }?> ><a href='<?php
				 echo admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type=2'); ?>'><span class="xyz_smap_tw">Twitter</span></a></li>
   <li <?php if($xyz_smap_account_type==3){?>class="xyz_smap_cssmenu_selected" <?php }?> ><a href='<?php
				 echo admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type=3'); ?>'><span class="xyz_smap_linkedin">LinkedIn</span></a></li>
  <li <?php if($xyz_smap_account_type==4){?>class="xyz_smap_cssmenu_selected" <?php }?> ><a href='<?php
				 echo admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type=4'); ?>'><span class="xyz_smap_pi">Pinterest</span></a></li>
  <li <?php if($xyz_smap_account_type==5){?>class="xyz_smap_cssmenu_selected" <?php }?> ><a href='<?php
				 echo admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type=5'); ?>'><span class="xyz_smap_gp">Google Plus</span></a></li>


	</ul>
</div>
<fieldset
			style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
<legend><h3>Edit Account</h3></legend>
<?php 
if((isset($_POST['twit']) && $terf==1)|| (isset($_POST['fb']) && $erf==1)|| (isset($_POST['linkdn']) && $lerf==1)|| (isset($_POST['pinit']) && $perf==1) || (isset($_POST['gp']) && $gerf==1))
{
?>
<div class="system_notice_area_style0" id="system_notice_area">
	<?php 
    if(isset($_POST['fb']))
	{echo $ms1;echo $ms2;echo $ms3;echo $ms4;echo $ms5;}
	else  if(isset($_POST['twit']))
	{echo $tms1;echo $tms2;echo $tms3;echo $tms4;echo $tms5;echo $tms6;echo $tms7;}
	else  if(isset($_POST['linkdn']))
	{echo $lms1;echo $lms2;echo $lms3;echo $lms4;echo $lms6;echo $lms7;echo $lms8;echo $lms9;}
	else  if(isset($_POST['pinit']))
	{echo $pms1;echo $pms2;echo $pms3;echo $pms5;echo $pms6;echo $pms7;}
	else  if(isset($_POST['gp']))
	{echo $gms1;echo $gms2;echo $gms3;echo $gms4;echo $gms5;}
	?> &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php }

if($xyz_smap_account_type==1){ 
?>


<table class="widefat" style="width: 99%;background-color: #FFFBCC">
	<tr>
	<td id="bottomBorderNone">
	
	<div>


		<b>Note :</b> You have to create a Facebook application before filling the following details.
		<b><a href="https://developers.facebook.com/apps" target="_blank">Click here</a></b> to create new Facebook application. 
		<br>In the application page in facebook, navigate to <b>Apps > Settings > Edit settings > Website > Site URL</b>. Set the site url as : 
		<span style="color: red;"><?php echo  (is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST']; ?>	</span>

	</div>

	</td>
	</tr>
	</table>
	<br>
	
	<form method="post" >
	<input type="hidden" value="config">
	
	<div>

	<span><strong>You have to fill in the following:</strong></span>
	<table class="widefat xyz_smap_premium_table" style="width:98%;padding-top: 10px;">
	  <tr valign="top"><td width="50%" style="border-top:0px;">
		Application name  <span class="mandatory">*</span> 
	</td>
	<td style="border-top:0px;">
		<input id="xyz_smap_fbapplication_name"  name="xyz_smap_fbapplication_name" type="text" value="<?php if($ms4=="") {echo $xyz_smap_fbapplication_nameO;}?>"/>
	<a href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/creating-facebook-application" target="_blank">How can I create a Facebook Application?</a>
	</td></tr>
	
	<tr valign="top"><td>
		Application id  <span class="mandatory">*</span> 
	</td>
	<td>
		<input id="xyz_smap_application_id"  name="xyz_smap_application_id" type="text" value="<?php if($ms1=="") {echo $appidO;}?>"/>
	</td></tr>

	<tr valign="top"><td>
		Application secret  <span class="mandatory">*</span> 
	</td><td>
		<input id="xyz_smap_application_secret"  name="xyz_smap_application_secret" type="text" value="<?php if($ms2=="") {echo $appsecretO;}?>" />
	</td></tr>
	<!-- <tr valign="top"><td>
		Facebook user id  <span class="mandatory">*</span> 
	</td>
	<td>
		<input id="xyz_smap_fb_id"  name="xyz_smap_fb_id" type="text"/>
		<a href="http://kb.xyzscripts.com/how-can-i-find-my-facebook-user-id" target="_blank">How can I find my Facebook user id?</a>
	</td></tr>-->
	<tr valign="top">
		<td scope="row" colspan="1">Publish wordpress `pages` to social media	<span class="mandatory">*</span></td>
		<td>
		<select name="xyz_smap_premium_default_includePage" id="xyz_smap_premium_default_includePage" onchange="xyz_smap_premium_show_includePage(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_includePage0=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_includePage0=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
		</td>
	</tr>
	<tr id="selIncludePage_premium"><td></td>
		<td style="border-top:0px;"><select name="xyz_smap_premium_include_pages" >
		
		<option value ="1" <?php if($xyz_smap_premium_include_pages0=='1') echo 'selected'; ?> >Yes, publish pages </option>
		
		<option value ="0" <?php if($xyz_smap_premium_include_pages0=='0') echo 'selected'; ?> >No, dont publish pages </option>
		</select>
		</td>
	</tr>
	<tr valign="top">

<td scope="row" colspan="1">Publish wordpress `posts` to social media  <span class="mandatory">*</span> 	 </td>
<td>
<select name="xyz_smap_premium_default_cat_sel" id="xyz_smap_premium_default_cat_sel" onchange="xyz_smap_premium_show_postCategory(this.value);">

<option value ="1" id="xyz_smap_premium_fb_default_cat_sel_def_set"  <?php if($xyz_smap_premium_default_cat_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0"  id="xyz_smap_premium_fb_default_cat_sel_ovrd_set"  <?php if($xyz_smap_premium_default_cat_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>
</td></tr>

<tr id="selPostCat_premium"><td></td>
	<td>
	<select name="xyz_smap_premium_include_posts" id="xyz_smap_premium_include_posts" onchange="dropdown_def_cat_sel(this.value);">

			<option value="1"
			<?php if($xyz_smap_premium_include_posts0=='1') echo 'selected'; ?>>Yes, publish posts</option>

			<option value="0"
			<?php if($xyz_smap_premium_include_posts0=='0') echo 'selected'; ?>>No, dont publish posts</option>
	</select>
	</td>
</tr>

<tr id="cat_sel_rad_tr"><td></td><td>

<input type="hidden" value="<?php echo $spec_cat0;?>" name="xyz_smap_sel_cat_fb" id="xyz_smap_sel_cat_fb">

<input type="radio" name="xyz_smap_cat_all_fb" id="xyz_smap_cat_all" value="All" onchange="rd_cat_chn(-1)" <?php if($smap_category_ids0!="Specific") echo "checked"?> >All categories<font style="padding-left: 10px;"></font>
<input type="radio" name="xyz_smap_cat_all_fb" id="xyz_smap_cat_spec" value="Specific" onchange="rd_cat_chn(1)" <?php if($smap_category_ids0=="Specific") echo "checked"?>>Specific categories

<span id="cat_dropdown_span"><br /><br />
 
<?php 


$args = array(
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'show_last_update'   => 0,
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => '1 3',
		'hierarchical'       => 1,
		'id'                 => 'xyz_smap_catlist_fb',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'category',
		'hide_if_empty'      => false );

if(count(get_categories($args))>0)
{
	$args['name']='xyz_smap_catlist_fb';
	echo str_replace( "<select", "<select multiple onClick=setcat_fb(this) style='width:200px;height:auto !important;border:1px solid #cccccc;'", wp_dropdown_categories($args));
}
else
echo "NA";

?><br /><br />
</span>
</td></tr>

<tr valign="top">

<td scope="row" colspan="1">Select wordpress custom post types for auto publish</td>
<td>
<select name="xyz_smap_premium_default_custtype_sel" id="xyz_smap_premium_default_custtype_sel" onchange="dropdown_def_custtype_sel(this.value)">

<option value ="1" id="xyz_smap_premium_default_custtype_sel_def_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0" id="xyz_smap_premium_default_custtype_sel_ovrd_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>

</td>

</tr>

<tr id="custtype_dropdown_span">
<td>&nbsp;</td>
<td>
<?php 
	
	$args=array(
			'public'   => true,
			'_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	$post_types=get_post_types($args,$output,$operator);
	
	$ar1=explode(",",$smap_customtype_ids0);
	$cnt=count($post_types);

  foreach ($post_types  as $post_type ) {

echo '<input type="checkbox" name="post_types[]" value="'.$post_type.'" ';
if(in_array($post_type, $ar1))
{
	echo 'checked="checked"/>';
}
else
	echo '/>';

echo '<label>'.$post_type.'</label><br/>';

  }
   if($cnt==0)
  	echo 'No custom posttypes';
?>
</td></tr>
	
	
	<tr valign="top"><td>
	Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_fb')" onmouseout="dethide('xyz_fb')">
						<div id="xyz_fb" class="informationdiv" style="display: none;">
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div><br><span style="color: green;">[Leave this empty to use default value]</span>
		</td>
		<td>
			<select name="xyz_smap_premium_fb_info" id="xyz_smap_premium_fb_info" onchange="xyz_smap_premium_fb_info_insert(this)">
		<option value ="0" selected="selected">--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select> </td></tr>
		
		<tr><td>&nbsp;</td><td>
		<textarea id="xyz_smap_message"  name="xyz_smap_message" style="height:80px;"><?php echo $messagetopostO;?></textarea>
	</td></tr>
	<tr valign="top"><td>
		Posting method  <span class="mandatory">*</span> 
	</td>
	<td>
	
	<select id="xyz_smap_po_method" name="xyz_smap_po_method"  onchange="fb_rd_for_preferred_link(this.value)">
							<option value="3"
				<?php  if($posting_methodO==3) echo 'selected';?>>Simple text message</option>
				
				<optgroup label="Text message with image">
					<option value="4"
					<?php  if($posting_methodO==4) echo 'selected';?>>Upload image to app album</option>
					<option value="5"
					<?php  if($posting_methodO==5) echo 'selected';?>>Upload image to timeline album</option>
				</optgroup>
				
				<optgroup label="Text message with attached link">
					<option value="1"
					<?php  if($posting_methodO==1) echo 'selected';?>>Attach
						your blog post</option>
					<option value="2"
					<?php  if($posting_methodO==2) echo 'selected';?>>
						Share a link to your blog post</option>
					</optgroup>
					</select>
	</td></tr>
	<tr valign="top" id="fb_rd_for_preferred_link_id"><td>
		Preferred link to be attached 	
	</td>
	<td>
		<input type="radio" name="xyz_smap_fb_preferred_link" id=xyz_smap_fb_preferred_link value="0" <?php if($fb_preferred_link0=="0") echo "checked"?>>
		Permalink<font style="padding-left: 10px;"></font>
		<input type="radio" name=xyz_smap_fb_preferred_link id=xyz_smap_fb_preferred_link value="1" <?php if($fb_preferred_link0=="1") echo "checked"?>>
		Link from Content
	</td>
	</tr>
	
		<?php 
	
	$xyz_acces_token=$access_tokenO;
	if($xyz_acces_token!=""){

$offset=0;$limit=100;$data=array();
//$fbid=$fbidO;


do
{
	$result1="";$pagearray1="";
$pp=wp_remote_get("https://graph.facebook.com/".XYZ_SMAP_FB_API_VERSION."/me/accounts?access_token=$xyz_acces_token&limit=$limit&offset=$offset");


if(is_array($pp))
{
$result1=$pp['body'];
$pagearray1 = json_decode($result1);
//if(is_array($pagearray1))
if(is_array($pagearray1->data))
$data = array_merge($data, $pagearray1->data);
}
else
	break;
$offset += $limit;
// if(!is_array($pagearray1->paging))
// 	break;
}while(isset($pagearray1->paging->next));




$count=count($data);


if($count>0)
{
$smap_pages_ids1=$page_idsO;
$smap_pages_ids0=array();
if($smap_pages_ids1!="")	
	$smap_pages_ids0=explode(",",$smap_pages_ids1);

$smap_pages_ids=array();
for($i=0;$i<count($smap_pages_ids0);$i++)
{
if($smap_pages_ids0[$i]!="-1")
	$smap_pages_ids[$i]=trim(substr($smap_pages_ids0[$i],0,strpos($smap_pages_ids0[$i],"-")));
	else
	$smap_pages_ids[$i]=$smap_pages_ids0[$i];
}






?>

<tr valign="top"><td>
		Select pages for auto publish
	</td>
	<td>
	<select name="smap_pages_list[]" multiple="multiple" style="height:auto !important;">
	<option value="-1" <?php if(in_array(-1, $smap_pages_ids)) echo "selected" ?> >Profile Page</option>
	<?php 
	for($i=0;$i<$count;$i++)
	{
	?>
	<option value="<?php  echo $data[$i]->id."-".$data[$i]->access_token;?>"
	
	<?php if(in_array($data[$i]->id, $smap_pages_ids)) echo "selected" ?>>
	
	<?php echo $data[$i]->name; ?></option>
	<?php }?>
	</select>
		</td></tr>

		
<?php }	}?>
	<tr valign="top" >

<td scope="row" colspan="1">Min. time delay for auto publishing  in case of scheduled publishing		</td>
<td><select name="xyz_smap_premium_default_timedelay" id="xyz_smap_premium_default_timedelay" onchange="xyz_smap_premium_show_timedelay(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_timedelay=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_timedelay=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
</td></tr><tr valign="top" id="sel_timedelay_premium">

<td scope="row" colspan="1"></td>
<td>
<input id="xyz_smap_min_timedelay_post_publish_value"  name="xyz_smap_min_timedelay_post_publish_value" type="text" value="<?php echo $xyz_smap_min_timedelay_post_publish_value;?>"/>

<select name="xyz_smap_min_timedealy_post_publish_period" id="xyz_smap_min_timedealy_post_publish_period" >

<option value ="1" <?php if($xyz_smap_min_timedealy_post_publish_period=='1') echo 'selected'; ?> >Minutes </option>

<option value ="2" <?php if($xyz_smap_min_timedealy_post_publish_period=='2') echo 'selected'; ?> >Hours </option>

<option value ="3" <?php if($xyz_smap_min_timedealy_post_publish_period=='3') echo 'selected'; ?> >Days </option>
</select> 
</td></tr>
<tr>
 <td   id="bottomBorderNone">&nbsp;</td>
 <td   id="bottomBorderNone" style="height: 50px">
	<input type="submit" class="submit_smap_new" style=" margin-top: 10px;" name="fb" value="Save" />
 </td>
</tr>
				
				

</table>
</div>

</form>

<?php }else if($xyz_smap_account_type==2){?>


<table class="widefat" style="width: 99%;background-color: #FFFBCC">
<tr>
<td id="bottomBorderNone">
	<div>
		<b>Note :</b> You have to create a Twitter application before filling in following fields. 	
		<br><b><a href="https://dev.twitter.com/apps/new" target="_blank">Click here</a></b> to create new application. Specify the website for the application as :	<span style="color: red;"><?php echo  (is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST']; ?>		 </span> 
		 <br>In the twitter application, navigate to	<b>Settings > Application Type > Access</b>. Select <b>Read and Write</b> option. 
		 <br>After updating access, navigate to <b>Details > Your access token</b> in the application and	click <b>Create my access token</b> button.
		

	</div>
</td>
</tr>
</table>
<br>

	<form method="post" >
	
	
	<div>

	<span><strong>You have to fill in the following:</strong></span>
	<table class="widefat xyz_smap_premium_table" style="width:98%;padding-top: 10px;">
	
	<tr valign="top"><td width="50%" style="border-top:0px;">
		Application name  <span class="mandatory">*</span> 
	</td>
	<td style="border-top:0px;">
		<input id="xyz_smap_twapplication_name"  name="xyz_smap_twapplication_name" type="text" value="<?php if($tms6=="") {echo $xyz_smap_twapplication_nameO;}?>"/>
		<a href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/creating-twitter-application" target="_blank">How can I create a Twitter Application?</a>
	</td></tr>
	
	<tr valign="top"><td>
		API key <span class="mandatory">*</span> 
	</td>
	<td>
		<input id="xyz_smap_twconsumer_id"  name="xyz_smap_twconsumer_id" type="text" value="<?php if($tms1=="") {echo $tappidO;}?>"/>
	</td></tr>

	<tr valign="top"><td>
		API secret  <span class="mandatory">*</span> 
	</td><td>
		<input id="xyz_smap_twconsumer_secret"  name="xyz_smap_twconsumer_secret" type="text" value="<?php if($tms2=="") {echo $tappsecretO;}?>" />
	</td></tr>
	<tr valign="top"><td>
		Twitter username  <span class="mandatory">*</span> 
	</td>
	<td>
		<input id="xyz_smap_tw_id" class="al2tw_text" name="xyz_smap_tw_id" type="text" value="<?php if($tms3=="") {echo $twidO;}?>"/>
	</td></tr>
<tr valign="top"><td>
		Access token  <span class="mandatory">*</span> 
	</td>
	<td>
		<input id="xyz_smap_current_twappln_token" class="al2tw_text" name="xyz_smap_current_twappln_token" type="text" value="<?php if($tms4=="") {echo $taccess_tokenO;}?>"/>
	</td></tr>
	<tr valign="top"><td>
		Access token secret  <span class="mandatory">*</span> 
	</td>
	<td>
		<input id="xyz_smap_twaccestok_secret" class="al2tw_text" name="xyz_smap_twaccestok_secret" type="text" value="<?php if($tms5=="") {echo $taccess_token_secretO;}?>"/>
	</td></tr>
	<tr valign="top">
		<td scope="row" colspan="1">Publish wordpress `pages` to social media	<span class="mandatory">*</span></td>
		<td>
		<select name="xyz_smap_premium_default_includePage" id="xyz_smap_premium_default_includePage" onchange="xyz_smap_premium_show_includePage(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_includePage0=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_includePage0=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
		</td>
	</tr>
	<tr id="selIncludePage_premium"><td></td>
		<td style="border-top:0px;"><select name="xyz_smap_premium_include_pages" >
		
		<option value ="1" <?php if($xyz_smap_premium_include_pages0=='1') echo 'selected'; ?> >Yes, publish pages </option>
		
		<option value ="0" <?php if($xyz_smap_premium_include_pages0=='0') echo 'selected'; ?> >No, dont publish pages </option>
		</select>
		</td>
	</tr>
	
	<tr valign="top">

<td scope="row" colspan="1">Publish wordpress `posts` to social media  <span class="mandatory">*</span> 	 </td>
<td>
<select name="xyz_smap_premium_default_cat_sel" id="xyz_smap_premium_default_cat_sel" onchange="xyz_smap_premium_show_postCategory(this.value);">

<option value ="1" id="xyz_smap_premium_tw_default_cat_sel_def_set"  <?php if($xyz_smap_premium_default_cat_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0"  id="xyz_smap_premium_tw_default_cat_sel_ovrd_set"  <?php if($xyz_smap_premium_default_cat_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>
</td></tr>

<tr id="selPostCat_premium"><td></td>
	<td>
	<select name="xyz_smap_premium_include_posts" id="xyz_smap_premium_include_posts" onchange="dropdown_def_cat_sel(this.value);">

			<option value="1"
			<?php if($xyz_smap_premium_include_posts0=='1') echo 'selected'; ?>>Yes, publish posts</option>

			<option value="0"
			<?php if($xyz_smap_premium_include_posts0=='0') echo 'selected'; ?>>No, dont publish posts</option>
	</select>
	</td>
</tr>

<tr id="cat_sel_rad_tr"><td></td><td>

<input type="hidden" value="<?php echo $spec_cat0;?>" name="xyz_smap_sel_cat_tw" id="xyz_smap_sel_cat_tw">

<input type="radio" name="xyz_smap_cat_all_tw" id="xyz_smap_cat_all" value="All" onchange="rd_cat_chn(-1)" <?php if($smap_category_ids0!="Specific") echo "checked"?> >All categories<font style="padding-left: 10px;"></font>
<input type="radio" name="xyz_smap_cat_all_tw" id="xyz_smap_cat_spec" value="Specific" onchange="rd_cat_chn(1)" <?php if($smap_category_ids0=="Specific") echo "checked"?>>Specific categories

<span id="cat_dropdown_span"><br /><br />
 
<?php 


$args = array(
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'show_last_update'   => 0,
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => '1 3',
		'hierarchical'       => 1,
		'id'                 => 'xyz_smap_catlist_tw',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'category',
		'hide_if_empty'      => false );

if(count(get_categories($args))>0)
{
	$args['name']='xyz_smap_catlist_tw';
	echo str_replace( "<select", "<select multiple onClick=setcat_tw(this) style='width:200px;height:auto !important;border:1px solid #cccccc;'", wp_dropdown_categories($args));
}
else
echo "NA";

?><br /><br />
</span>
</td></tr>

<tr valign="top">

<td scope="row" colspan="1">Select wordpress custom post types for auto publish</td>
<td>
<select name="xyz_smap_premium_default_custtype_sel" id="xyz_smap_premium_default_custtype_sel" onchange="dropdown_def_custtype_sel(this.value)">

<option value ="1" id="xyz_smap_premium_default_custtype_sel_def_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0" id="xyz_smap_premium_default_custtype_sel_ovrd_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>

</td>

</tr>

<tr id="custtype_dropdown_span">
<td>&nbsp;</td>
<td>
<?php 
	
	$args=array(
			'public'   => true,
			'_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	$post_types=get_post_types($args,$output,$operator);
	
	$ar1=explode(",",$smap_customtype_ids0);
	$cnt=count($post_types);
	
	 foreach ($post_types  as $post_type ) {

echo '<input type="checkbox" name="post_types[]" value="'.$post_type.'" ';
if(in_array($post_type, $ar1))
{
	echo 'checked="checked"/>';
}
else
	echo '/>';

echo '<label>'.$post_type.'</label><br/>';

  }
  if($cnt==0)
  	echo 'No custom posttypes';
?>
</td></tr>
	
	<tr valign="top"><td>
	Message format for posting	<img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_tw')" onmouseout="dethide('xyz_tw')">
						<div id="xyz_tw" class="informationdiv"
							style="display: none; font-weight: normal;"> 
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div><br><span style="color: green;">[Leave this empty to use default value]</span>
		</td>
		<td>
		<select name="xyz_smap_premium_tw_info" id="xyz_smap_premium_tw_info" onchange="xyz_smap_premium_tw_info_insert(this)">
		<option value ="0" selected="selected">--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select> </td></tr>
		
		<tr><td>&nbsp;</td><td>
		<textarea id="xyz_smap_twmessage"  name="xyz_smap_twmessage" style="height:80px;" ><?php echo $tmessagetopostO;?></textarea>
	</td></tr>
	
	
	<tr valign="top"><td>
		Attach image to twitter post  <span class="mandatory">*</span> 
	</td>
	<td>
		<select id="xyz_smap_twpost_image_permission"  name="xyz_smap_twpost_image_permission" > <option value="0" <?php  if($tposting_image_permissionO==0) echo 'selected';?> >
No</option><option value="1" <?php  if($tposting_image_permissionO==1) echo 'selected';?> >Yes</option></select>
	</td></tr>
	<tr valign="top" >

<td scope="row" colspan="1">Min. time delay for auto publishing  in case of scheduled publishing		</td>
<td><select name="xyz_smap_premium_default_timedelay" id="xyz_smap_premium_default_timedelay" onchange="xyz_smap_premium_show_timedelay(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_timedelay=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_timedelay=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
</td></tr><tr valign="top" id="sel_timedelay_premium">

<td scope="row" colspan="1"></td>
<td>
<input id="xyz_smap_min_timedelay_post_publish_value"  name="xyz_smap_min_timedelay_post_publish_value" type="text" value="<?php echo $xyz_smap_min_timedelay_post_publish_value;?>"/>

<select name="xyz_smap_min_timedealy_post_publish_period" id="xyz_smap_min_timedealy_post_publish_period" >

<option value ="1" <?php if($xyz_smap_min_timedealy_post_publish_period=='1') echo 'selected'; ?> >Minutes </option>

<option value ="2" <?php if($xyz_smap_min_timedealy_post_publish_period=='2') echo 'selected'; ?> >Hours </option>

<option value ="3" <?php if($xyz_smap_min_timedealy_post_publish_period=='3') echo 'selected'; ?> >Days </option>
</select> 
</td></tr>
<tr>
 <td   id="bottomBorderNone">&nbsp;</td>
 <td   id="bottomBorderNone" style="height: 50px">
	<input type="submit" class="submit_smap_new" style=" margin-top: 10px;" name="twit" value="Save" />
 </td>
</tr>

</table>
</div>

</form>
<?php }else if($xyz_smap_account_type==3){ ?>

<table class="widefat" style="width: 99%;background-color: #FFFBCC">
	<tr>
	<td id="bottomBorderNone">
	
	<div>


		<b>Note :</b> You have to create a Linkedin application before filling the following details.
		<b><a href="https://www.linkedin.com/secure/developer?newapp" target="_blank">Click here</a></b> to create new Linkedin application. 
		<br>Set the website url as : 
		<span style="color: red;"><?php echo  (is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST']; ?></span>
		<br>Specify the authorized redirect url as :  
		<span style="color: red;"><?php echo  admin_url().'admin.php'; ?></span>
<br>For detailed step by step instructions <b><a href="http://docs.xyzscripts.com/wordpress-plugins/xyz-wp-smap/creating-linkedin-application/" target="_blank">Click here</a></b>.
	</div>

	</td>
	</tr>
	</table>
 
     <br>
 
	<form method="post" >
	<div> 
	<span><strong>You have to fill in the following:</strong></span>
	
	<table class="widefat xyz_smap_premium_table" style="width:98%;padding-top: 10px;">

	<tr valign="top">
	<td width="50%" style="border-top:0px;">Application name <span class="mandatory">*</span> </td>					
	<td style="border-top:0px;">
		<input id="xyz_smap_lnapplication_name" name="xyz_smap_lnapplication_name" type="text" value="<?php if($lms3=="") {echo $xyz_smap_lnapplication_nameO;}?>"/>
		<a href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/creating-linkedin-application" target="_blank">How can I create a Linkedin Application?</a>
	</td></tr>
	
	<tr valign="top">
	<td width="50%">Client ID <span class="mandatory">*</span>  </td>					
	<td>
		<input id="xyz_smap_lnapikey" name="xyz_smap_lnapikey" type="text" value="<?php if($lms1=="") {echo $lnappikeyO;}?>"/>
	</td></tr>
	

	<tr valign="top"><td>Client Secret <span class="mandatory">*</span> </td>
	<td>
		<input id="xyz_smap_lnapisecret" name="xyz_smap_lnapisecret" type="text" value="<?php if($lms2=="") { echo $lnapisecretO; }?>" />
	</td></tr>
	<tr valign="top">
		<td scope="row" colspan="1">Publish wordpress `pages` to social media	<span class="mandatory">*</span></td>
		<td>
		<select name="xyz_smap_premium_default_includePage" id="xyz_smap_premium_default_includePage" onchange="xyz_smap_premium_show_includePage(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_includePage0=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_includePage0=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
		</td>
	</tr>
	<tr id="selIncludePage_premium"><td></td>
		<td style="border-top:0px;"><select name="xyz_smap_premium_include_pages" >
		
		<option value ="1" <?php if($xyz_smap_premium_include_pages0=='1') echo 'selected'; ?> >Yes, publish pages </option>
		
		<option value ="0" <?php if($xyz_smap_premium_include_pages0=='0') echo 'selected'; ?> >No, dont publish pages </option>
		</select>
		</td>
	</tr>
	
	<tr valign="top">

<td scope="row" colspan="1">Publish wordpress `posts` to social media  <span class="mandatory">*</span>  </td>
<td>
<select name="xyz_smap_premium_default_cat_sel" id="xyz_smap_premium_default_cat_sel" onchange="xyz_smap_premium_show_postCategory(this.value);">

<option value ="1" id="xyz_smap_premium_ln_default_cat_sel_def_set"  <?php if($xyz_smap_premium_default_cat_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0"  id="xyz_smap_premium_ln_default_cat_sel_ovrd_set"  <?php if($xyz_smap_premium_default_cat_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>
</td></tr>

<tr id="selPostCat_premium"><td></td>
	<td>
	<select name="xyz_smap_premium_include_posts" id="xyz_smap_premium_include_posts" onchange="dropdown_def_cat_sel(this.value);">

			<option value="1"
			<?php if($xyz_smap_premium_include_posts0=='1') echo 'selected'; ?>>Yes, publish posts</option>

			<option value="0"
			<?php if($xyz_smap_premium_include_posts0=='0') echo 'selected'; ?>>No, dont publish posts</option>
	</select>
	</td>
</tr>

<tr id="cat_sel_rad_tr"><td></td><td>

<input type="hidden" value="<?php echo $spec_cat0;?>" name="xyz_smap_sel_cat_ln" id="xyz_smap_sel_cat_ln">

<input type="radio" name="xyz_smap_cat_all_ln" id="xyz_smap_cat_all" value="All" onchange="rd_cat_chn(-1)" <?php if($smap_category_ids0!="Specific") echo "checked"?> >All categories<font style="padding-left: 10px;"></font>
<input type="radio" name="xyz_smap_cat_all_ln" id="xyz_smap_cat_spec" value="Specific" onchange="rd_cat_chn(1)" <?php if($smap_category_ids0=="Specific") echo "checked"?>>Specific categories

<span id="cat_dropdown_span"><br /><br />
 
<?php 


$args = array(
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'show_last_update'   => 0,
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => '1 3',
		'hierarchical'       => 1,
		'id'                 => 'xyz_smap_catlist_ln',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'category',
		'hide_if_empty'      => false );

if(count(get_categories($args))>0)
{
	$args['name']='xyz_smap_catlist_ln';
	echo str_replace( "<select", "<select multiple onClick=setcat_ln(this) style='width:200px;height:auto !important;border:1px solid #cccccc;'", wp_dropdown_categories($args));
}
else
echo "NA";

?><br /><br />
</span>
</td></tr>
	
	
<tr valign="top">

<td scope="row" colspan="1">Select wordpress custom post types for auto publish</td>
<td>
<select name="xyz_smap_premium_default_custtype_sel" id="xyz_smap_premium_default_custtype_sel" onchange="dropdown_def_custtype_sel(this.value)">

<option value ="1" id="xyz_smap_premium_default_custtype_sel_def_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0" id="xyz_smap_premium_default_custtype_sel_ovrd_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>

</td>

</tr>

<tr id="custtype_dropdown_span">
<td>&nbsp;</td>
<td>
<?php 
	
	$args=array(
			'public'   => true,
			'_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	$post_types=get_post_types($args,$output,$operator);
	
	$ar1=explode(",",$smap_customtype_ids0);
	$cnt=count($post_types);
	foreach ($post_types  as $post_type ) {

echo '<input type="checkbox" name="post_types[]" value="'.$post_type.'" ';
if(in_array($post_type, $ar1))
{
	echo 'checked="checked"/>';
}
else
	echo '/>';

echo '<label>'.$post_type.'</label><br/>';

  }
  if($cnt==0)
  	echo 'No custom posttypes';
?>
</td></tr>
	
	<tr valign="top">
					<td>Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_ln')" onmouseout="dethide('xyz_ln')">
						<div id="xyz_ln" class="informationdiv"
							style="display: none; font-weight: normal;"> 
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
					<td>
		 <select name="xyz_smap_premium_ln_info" id="xyz_smap_premium_ln_info" onchange="xyz_smap_premium_ln_info_insert(this)">
		<option value ="0" selected="selected">--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select></td> </tr><tr><td>&nbsp;</td><td>
<textarea id="xyz_smap_lnmessage" name="xyz_smap_lnmessage"	><?php echo $lmessagetopostO;?></textarea>
					</td>
				</tr>

	<tr valign="top"><td>
		Attach image to linkedin post <span class="mandatory">*</span> 
	</td>
	<td>
		<select id="xyz_smap_lnpost_image_permission"  name="xyz_smap_lnpost_image_permission" > <option value="0" <?php  if($lposting_image_permissionO==0) echo 'selected';?> >
No</option><option value="1" <?php  if($lposting_image_permissionO==1) echo 'selected';?> >Yes</option></select>
	</td></tr>
	
	<tr valign="top" id="ln_rd_for_preferred_link_id"><td>
		Preferred link to be attached 	
	</td>
	<td>
		<input type="radio" name="xyz_smap_ln_preferred_link" id="xyz_smap_ln_preferred_link" value="0" <?php if($ln_preferred_link0=="0") echo "checked"?>>
		Permalink<font style="padding-left: 10px;"></font>
		<input type="radio" name="xyz_smap_ln_preferred_link" id="xyz_smap_ln_preferred_link" value="1" <?php if($ln_preferred_link0=="1") echo "checked"?>>
		Link from Content
	</td>
	</tr>
	
	<tr valign="top" id="share_post_profile"><td>Share post to profile	<span class="mandatory">*</span> </td>
		<td>
			<select id="xyz_smap_ln_share_post_profile" style="height: auto ! important;" name="xyz_smap_ln_share_post_profile" onchange="share_post_profile(this.value);" > 
				<option value="0"  <?php if($ln_sh_post_profile0=='0') echo 'selected'; ?> >Yes</option>
		    	<option value="1"  <?php if($ln_sh_post_profile0=='1') echo 'selected'; ?> >No</option>
		    </select>
		</td>
	</tr> 
	
	<tr valign="top" id="share_post_profile_type"><td></td>
		<td>
			<select id="xyz_smap_ln_shareprivate" style="height: auto ! important;" name="xyz_smap_ln_shareprivate" > 
				<option value="0"  <?php if($xyz_smap_ln_shareprivateO=='0') echo 'selected'; ?> >Public</option>
		    	<option value="1"  <?php if($xyz_smap_ln_shareprivateO=='1') echo 'selected'; ?> >Connections only</option>
		    </select>
		</td>
	</tr> 
	
	
	
	
	<tr valign="top" id="share_post_company"><td>Share post to company page </td>
		<td>
			<?php 
			
			$xyz_smap_ln_company_idArray=explode(',',$xyz_smap_ln_company_ids0);
			
				$ln_acc_tok_jsonarr=json_decode($xyz_ln_accesstoken0);
				
				if(isset($ln_acc_tok_jsonarr->access_token))
				{
					$ObjLinkedin = new SMAPLinkedInOAuth2($ln_acc_tok_jsonarr->access_token);
					$ar = $ObjLinkedin->getAdminCompanies();
					if (isset($ar['_total'])&&$ar['_total']>0)
					{
						?>
						<select id="xyz_smap_ln_share_post_company" style="height: auto ! important;" multiple="multiple" name="xyz_smap_ln_share_post_company[]" > 
						<?php 
						foreach ($ar['values'] as $ark => $arv)
						{
							?>
							<option value="<?php echo $arv['id']."-".$arv['name']; ?>" <?php if(in_array($arv['id'], $xyz_smap_ln_company_idArray)) echo "selected" ?>><?php echo $arv['id']."-".$arv['name']; ?></option>
							<?php 
						}
						?>
						</select>
						<?php 
					}
					else
					{
						echo "No companies found.";
					}
				}
				else 
				{
					echo "No companies found.";
				}
				?>
		</td>
	</tr> 
	
	
	<tr valign="top" >

<td scope="row" colspan="1">Min. time delay for auto publishing  in case of scheduled publishing		</td>
<td><select name="xyz_smap_premium_default_timedelay" id="xyz_smap_premium_default_timedelay" onchange="xyz_smap_premium_show_timedelay(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_timedelay=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_timedelay=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
</td></tr><tr valign="top" id="sel_timedelay_premium">

<td scope="row" colspan="1"></td>
<td>
<input id="xyz_smap_min_timedelay_post_publish_value"  name="xyz_smap_min_timedelay_post_publish_value" type="text" value="<?php echo $xyz_smap_min_timedelay_post_publish_value;?>"/>

<select name="xyz_smap_min_timedealy_post_publish_period" id="xyz_smap_min_timedealy_post_publish_period" >

<option value ="1" <?php if($xyz_smap_min_timedealy_post_publish_period=='1') echo 'selected'; ?> >Minutes </option>

<option value ="2" <?php if($xyz_smap_min_timedealy_post_publish_period=='2') echo 'selected'; ?> >Hours </option>

<option value ="3" <?php if($xyz_smap_min_timedealy_post_publish_period=='3') echo 'selected'; ?> >Days </option>
</select> 
</td></tr>		
			
		<tr>
			<td   id="bottomBorderNone"></td>
					<td   id="bottomBorderNone" style="height: 50px">
							<input type="submit" class="submit_smap_new"
								style=" margin-top: 10px; "
								name="linkdn" value="Save" />
					</td>
				</tr>

</table>
</div>

</form>

<?php }else if($xyz_smap_account_type==4){?>


	<form method="post" >
	<div> 
	<span><strong>You have to fill in the following:</strong></span>
	
	<table class="widefat xyz_smap_premium_table" style="width:98%;padding-top: 10px;">

	<tr valign="top">
	<td width="50%" style="border-top:0px;">Application name  <span class="mandatory">*</span><br><span style="color: green;">[This is just for tracking purpose]</span> </td>					
	<td style="border-top:0px;">
		<input id="xyz_smap_piapplication_name" name="xyz_smap_piapplication_name" type="text" value="<?php if($pms1=="") {echo $xyz_smap_piapplication_nameO;}?>"/>
	</td></tr>
	
	<tr valign="top">
	<td width="50%">Pinterest email  <span class="mandatory">*</span>  </td>					
	<td>
		<input id="xyz_smap_pi_email" name="xyz_smap_pi_email" type="text" value="<?php if($pms2=="") {echo $xyz_smap_pi_emailO;}?>"/>
	</td></tr>
	

	<tr valign="top"><td>Pinterest password  <span class="mandatory">*</span> </td>
	<td>
		<input id="xyz_smap_pi_password" name="xyz_smap_pi_password" type="password" value="<?php if($pms3=="") { echo $xyz_smap_pi_password_decr; }?>" />
	</td></tr>
	
	
	<tr valign="top"><td>Select boards for auto publish  <span class="mandatory">*</span> </td>
	<td>
	<?php 
	
	$loginError = xyzsmap_logtopinterest($xyz_smap_pi_emailO, $xyz_smap_pi_password_decr);
	if (!$loginError)
	{
		$response1=$GLOBALS['xyzsmap_gPNBoards'];
	}
	else
	{
		//header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=7&account_type='.$xyz_smap_account_type));
		//exit();
		echo "<span style=\"color: red;\">".$loginError."</sapn>";
	}
	
	if($response1!="" && $loginError==""){
?>
	<select name="xyz_smap_pi_board_ids[]" id="xyz_smap_pi_board_ids[]" multiple="multiple" style="height:auto !important;">
	<?php 
	
	foreach ($response1 as $key=>$value){
	echo "<option value='".$key."'>$value</option>"; }?>
</select>

<?php }else if($loginError==""){?>
<span style="color: red;">Please create atleast one board for auto publish</span>
<?php }?></td></tr>
<tr valign="top">
		<td scope="row" colspan="1">Publish wordpress `pages` to social media	<span class="mandatory">*</span></td>
		<td>
		<select name="xyz_smap_premium_default_includePage" id="xyz_smap_premium_default_includePage" onchange="xyz_smap_premium_show_includePage(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_includePage0=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_includePage0=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
		</td>
	</tr>
	<tr id="selIncludePage_premium"><td></td>
		<td style="border-top:0px;"><select name="xyz_smap_premium_include_pages" >
		
		<option value ="1" <?php if($xyz_smap_premium_include_pages0=='1') echo 'selected'; ?> >Yes, publish pages </option>
		
		<option value ="0" <?php if($xyz_smap_premium_include_pages0=='0') echo 'selected'; ?> >No, dont publish pages </option>
		</select>
		</td>
	</tr>
	
	<tr valign="top">

<td scope="row" colspan="1">Publish wordpress `posts` to social media  <span class="mandatory">*</span> 	 </td>
<td>
<select name="xyz_smap_premium_default_cat_sel" id="xyz_smap_premium_default_cat_sel" onchange="xyz_smap_premium_show_postCategory(this.value);">

<option value ="1" id="xyz_smap_premium_pi_default_cat_sel_def_set"  <?php if($xyz_smap_premium_default_cat_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0"  id="xyz_smap_premium_pi_default_cat_sel_ovrd_set"  <?php if($xyz_smap_premium_default_cat_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>
</td></tr>

<tr id="selPostCat_premium"><td></td>
	<td>
	<select name="xyz_smap_premium_include_posts" id="xyz_smap_premium_include_posts" onchange="dropdown_def_cat_sel(this.value);">

			<option value="1"
			<?php if($xyz_smap_premium_include_posts0=='1') echo 'selected'; ?>>Yes, publish posts</option>

			<option value="0"
			<?php if($xyz_smap_premium_include_posts0=='0') echo 'selected'; ?>>No, dont publish posts</option>
	</select>
	</td>
</tr>

<tr id="cat_sel_rad_tr"><td></td><td>

<input type="hidden" value="<?php echo $spec_cat0;?>" name="xyz_smap_sel_cat_pi" id="xyz_smap_sel_cat_pi">

<input type="radio" name="xyz_smap_cat_all_pi" id="xyz_smap_cat_all" value="All" onchange="rd_cat_chn(-1)" <?php if($smap_category_ids0!="Specific") echo "checked"?> >All categories<font style="padding-left: 10px;"></font>
<input type="radio" name="xyz_smap_cat_all_pi" id="xyz_smap_cat_spec" value="Specific" onchange="rd_cat_chn(1)" <?php if($smap_category_ids0=="Specific") echo "checked"?>>Specific categories

<span id="cat_dropdown_span"><br /><br />
 
<?php 


$args = array(
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'show_last_update'   => 0,
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => '1 3',
		'hierarchical'       => 1,
		'id'                 => 'xyz_smap_catlist_pi',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'category',
		'hide_if_empty'      => false );

if(count(get_categories($args))>0)
{
	$args['name']='xyz_smap_catlist_pi';
	echo str_replace( "<select", "<select multiple onClick=setcat_pi(this) style='width:200px;height:auto !important;border:1px solid #cccccc;'", wp_dropdown_categories($args));
}
else
echo "NA";

?><br /><br />
</span>
</td></tr>
	
	
<tr valign="top">

<td scope="row" colspan="1">Select wordpress custom post types for auto publish</td>
<td>
<select name="xyz_smap_premium_default_custtype_sel" id="xyz_smap_premium_default_custtype_sel" onchange="dropdown_def_custtype_sel(this.value)">

<option value ="1" id="xyz_smap_premium_default_custtype_sel_def_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0" id="xyz_smap_premium_default_custtype_sel_ovrd_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>

</td>

</tr>

<tr id="custtype_dropdown_span">
<td>&nbsp;</td>
<td>
<?php 
	
	$args=array(
			'public'   => true,
			'_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	$post_types=get_post_types($args,$output,$operator);
	
	$ar1=explode(",",$smap_customtype_ids0);
	$cnt=count($post_types);
  foreach ($post_types  as $post_type ) {

echo '<input type="checkbox" name="post_types[]" value="'.$post_type.'" ';
if(in_array($post_type, $ar1))
{
	echo 'checked="checked"/>';
}
else
	echo '/>';

echo '<label>'.$post_type.'</label><br/>';

  }
  if($cnt==0)
  	echo 'No custom posttypes';
?>
</td></tr>
	
	
	<tr valign="top">
					<td>Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_pi')" onmouseout="dethide('xyz_pi')">
						<div id="xyz_pi" class="informationdiv"
							style="display: none; font-weight: normal;"> 
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
					<td>
					<select name="xyz_smap_premium_pi_info" id="xyz_smap_premium_pi_info" onchange="xyz_smap_premium_pi_info_insert(this)">
		<option value ="0" selected="selected">--Select--</option>
		<option value ="1" >{POST_TITLE}  </option>
		<option value ="2" >{PERMALINK} </option>
		<option value ="3" >{POST_EXCERPT}  </option>
		<option value ="4" >{POST_CONTENT}   </option>
		<option value ="5" >{BLOG_TITLE}   </option>
		<option value ="6" >{USER_NICENAME}   </option>
		<option value ="7" >{POST_ID}    </option>
		<option value ="8" >{POST_TAGS}    </option>
		<option value ="9" >{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select></td> </tr><tr><td>&nbsp;</td><td>
<textarea id="xyz_smap_pimessage" name="xyz_smap_pimessage"	><?php echo $xyz_smap_pimessageO;?></textarea>
					</td>
				</tr>
	
	<tr valign="top" >

<td scope="row" colspan="1">Min. time delay for auto publishing  in case of scheduled publishing		</td>
<td><select name="xyz_smap_premium_default_timedelay" id="xyz_smap_premium_default_timedelay" onchange="xyz_smap_premium_show_timedelay(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_timedelay=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_timedelay=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
</td></tr><tr valign="top" id="sel_timedelay_premium">

<td scope="row" colspan="1"></td>
<td>
<input id="xyz_smap_min_timedelay_post_publish_value"  name="xyz_smap_min_timedelay_post_publish_value" type="text" value="<?php echo $xyz_smap_min_timedelay_post_publish_value;?>"/>

<select name="xyz_smap_min_timedealy_post_publish_period" id="xyz_smap_min_timedealy_post_publish_period" >

<option value ="1" <?php if($xyz_smap_min_timedealy_post_publish_period=='1') echo 'selected'; ?> >Minutes </option>

<option value ="2" <?php if($xyz_smap_min_timedealy_post_publish_period=='2') echo 'selected'; ?> >Hours </option>

<option value ="3" <?php if($xyz_smap_min_timedealy_post_publish_period=='3') echo 'selected'; ?> >Days </option>
</select> 
</td></tr>				
		<tr>
			<td   id="bottomBorderNone"></td>
					<td   id="bottomBorderNone" style="height: 50px">
							<input type="submit" class="submit_smap_new"
								style=" margin-top: 10px; "
								name="pinit" value="Save" />
					</td>
				</tr>

</table>
</div>

</form>
<?php }else if($xyz_smap_account_type==5){
?>

	<form method="post" >
	<div> 
	<span><strong>You have to fill in the following:</strong></span>
	
	<table class="widefat xyz_smap_premium_table" style="width:98%;padding-top: 10px;">	
	
	<tr valign="top"><td width="50%" style="border-top:0px;">
		Application name  <span class="mandatory">*</span><br><span style="color: green;">[This is just for tracking purpose]</span>
	</td>
	<td style="border-top:0px;">
		<input id="xyz_smap_gpapplication_name"  name="xyz_smap_gpapplication_name" type="text" value="<?php if($gms1==""){echo $xyz_smap_gpapplication_nameO;}?>"/>
	</td></tr>
	
	<tr valign="top">
	<td width="50%">Email (Google account email/Google page login email) <span class="mandatory">*</span></td>					
	<td>
		<input id="xyz_smap_gp_email" name="xyz_smap_gp_email" type="text" value="<?php if($gms2==""){echo $xyz_smap_gp_emailO;}?>"/>
	</td></tr>
	

	<tr valign="top"><td>Password  <span class="mandatory">*</span></td>
	<td>
		<input id="xyz_smap_gp_password" name="xyz_smap_gp_password" type="password" value="<?php if($gms3==""){echo $xyz_smap_gp_password_decr;}?>" />
	</td></tr>
	
	
	
	
	<?php 
	$pg_prof_array=explode(",",$xyz_smap_gp_page_or_prof_val0);
	?>
	
	<tr class="typesel_gp" valign="top" style="display: none;"><td></td>
		<td>
			<input id="gp_prof" name="gp_pg_prof[]" type="checkbox" <?php if(in_array(0, $pg_prof_array))
			{
				echo 'checked="checked"';
			}?> 
			value="0" />Profile
			<br>
			<input id="gp_pg" name="gp_pg_prof[]" type="checkbox" onclick="gp_checked();" <?php if(in_array(1, $pg_prof_array))
			{
				echo 'checked="checked"';
			}?>  
			value="1" />Page
		</td>
	</tr>	
	<tr class="typesel_gp" style="display: none;" valign="top" id="xyz_smap_gp_pageid" style="display: none;"><td>Google Pageid</td>
		<td>	
			<input  name="xyz_smap_gp_pageid" placeholder="Page ID" type="text"  value="<?php echo $xyz_smap_gp_pageidO;?>" />
		</td>
	</tr>
	
	
	<tr valign="top">
		<td scope="row" colspan="1">Publish wordpress `pages` to social media	<span class="mandatory">*</span></td>
		<td>
		<select name="xyz_smap_premium_default_includePage" id="xyz_smap_premium_default_includePage" onchange="xyz_smap_premium_show_includePage(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_includePage0=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_includePage0=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
		</td>
	</tr>
	<tr id="selIncludePage_premium"><td></td>
		<td style="border-top:0px;"><select name="xyz_smap_premium_include_pages" >
		
		<option value ="1" <?php if($xyz_smap_premium_include_pages0=='1') echo 'selected'; ?> >Yes, publish pages </option>
		
		<option value ="0" <?php if($xyz_smap_premium_include_pages0=='0') echo 'selected'; ?> >No, dont publish pages </option>
		</select>
		</td>
	</tr>
	<tr valign="top">

<td scope="row" colspan="1">Publish wordpress `posts` to social media	</td>
<td>
<select name="xyz_smap_premium_default_cat_sel" id="xyz_smap_premium_default_cat_sel" onchange="xyz_smap_premium_show_postCategory(this.value);">

<option value ="1" id="xyz_smap_premium_gp_default_cat_sel_def_set"  <?php if($xyz_smap_premium_default_cat_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0"  id="xyz_smap_premium_gp_default_cat_sel_ovrd_set"  <?php if($xyz_smap_premium_default_cat_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>
</td></tr>

<tr id="selPostCat_premium"><td></td>
	<td>
	<select name="xyz_smap_premium_include_posts" id="xyz_smap_premium_include_posts" onchange="dropdown_def_cat_sel(this.value);">

			<option value="1"
			<?php if($xyz_smap_premium_include_posts0=='1') echo 'selected'; ?>>Yes, publish posts</option>

			<option value="0"
			<?php if($xyz_smap_premium_include_posts0=='0') echo 'selected'; ?>>No, dont publish posts</option>
	</select>
	</td>
</tr>

<tr id="cat_sel_rad_tr"><td></td><td>

<input type="hidden" value="<?php echo $spec_cat0;?>" name="xyz_smap_sel_cat_gp" id="xyz_smap_sel_cat_gp">

<input type="radio" name="xyz_smap_cat_all_gp" id="xyz_smap_cat_all" value="All" onchange="rd_cat_chn(-1)" <?php if($smap_category_ids0!="Specific") echo "checked"?> >All categories<font style="padding-left: 10px;"></font>
<input type="radio" name="xyz_smap_cat_all_gp" id="xyz_smap_cat_spec" value="Specific" onchange="rd_cat_chn(1)" <?php if($smap_category_ids0=="Specific") echo "checked"?>>Specific categories

<span id="cat_dropdown_span"><br /><br />
 
<?php 


$args = array(
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'show_last_update'   => 0,
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => '1 3',
		'hierarchical'       => 1,
		'id'                 => 'xyz_smap_catlist_gp',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'category',
		'hide_if_empty'      => false );

if(count(get_categories($args))>0)
{
	$args['name']='xyz_smap_catlist_gp';
	echo str_replace( "<select", "<select multiple onClick=setcat_gp(this) style='width:200px;height:auto !important;border:1px solid #cccccc;'", wp_dropdown_categories($args));
}
else
echo "NA";

?><br /><br />
</span>
</td></tr>

<tr valign="top">

<td scope="row" colspan="1">Select wordpress custom post types for auto publish</td>
<td>
<select name="xyz_smap_premium_default_custtype_sel" id="xyz_smap_premium_default_custtype_sel" onchange="dropdown_def_custtype_sel(this.value)">

<option value ="1" id="xyz_smap_premium_default_custtype_sel_def_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='1') echo 'selected'; ?> >Use default settings </option>

<option value ="0" id="xyz_smap_premium_default_custtype_sel_ovrd_set"  <?php if($xyz_smap_premium_default_custtype_sel0=='0') echo 'selected'; ?> >Override default settings </option>
</select>

</td>

</tr>

<tr id="custtype_dropdown_span">
<td>&nbsp;</td>
<td>
<?php 
	
	$args=array(
			'public'   => true,
			'_builtin' => false
	);
	$output = 'names';
	$operator = 'and';
	$post_types=get_post_types($args,$output,$operator);
	
	$ar1=explode(",",$smap_customtype_ids0);
	$cnt=count($post_types);
	foreach ($post_types  as $post_type ) {

echo '<input type="checkbox" name="post_types[]" value="'.$post_type.'" ';
if(in_array($post_type, $ar1))
{
	echo 'checked="checked"/>';
}
else
	echo '/>';

echo '<label>'.$post_type.'</label><br/>';

  }
  if($cnt==0)
  	echo 'No custom posttypes';
?>
</td></tr>
	
	<tr valign="top">
					<td>Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_gp')" onmouseout="dethide('xyz_gp')">
						<div id="xyz_gp" class="informationdiv"
							style="display: none; font-weight: normal;"> 
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
					<td>
					<select name="xyz_smap_premium_gp_info" id="xyz_smap_premium_gp_info" onchange="xyz_smap_premium_gp_info_insert(this)">
		<option value ="0" selected="selected">--Select--</option>
		<option value ="1" >{POST_TITLE}  </option>
		<option value ="2" >{PERMALINK} </option>
		<option value ="3" >{POST_EXCERPT}  </option>
		<option value ="4" >{POST_CONTENT}   </option>
		<option value ="5" >{BLOG_TITLE}   </option>
		<option value ="6" >{USER_NICENAME}   </option>
		<option value ="7" >{POST_ID}    </option>
		<option value ="8" >{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select></td> </tr><tr><td>&nbsp;</td><td>
<textarea id="xyz_smap_gpmessage" name="xyz_smap_gpmessage"	><?php echo $xyz_smap_gpmessageO;?></textarea>
					</td>
				</tr>
	
	<tr valign="top"><td>
		Posting method  <span class="mandatory">*</span>
	</td>
	<td>
	
	<select id="xyz_smap_gppost_method" name="xyz_smap_gppost_method">
		<option value="1" <?php if($xyz_smap_gppost_methodO==1){?>selected="selected"<?php }?>>Simple text message</option>
		<option value="2" <?php if($xyz_smap_gppost_methodO==2){?>selected="selected"<?php }?>>Text message with image</option>
		<option value="3" <?php if($xyz_smap_gppost_methodO==3){?>selected="selected"<?php }?>>Attach your blog post</option>
	</select>

	</td></tr>
	<tr valign="top" >

<td scope="row" colspan="1">Min. time delay for auto publishing  in case of scheduled publishing		</td>
<td><select name="xyz_smap_premium_default_timedelay" id="xyz_smap_premium_default_timedelay" onchange="xyz_smap_premium_show_timedelay(this.value)">
		
		<option value ="1" <?php if($xyz_smap_premium_default_timedelay=='1') echo 'selected'; ?> >Use default settings </option>
		
		<option value ="0" <?php if($xyz_smap_premium_default_timedelay=='0') echo 'selected'; ?> >Override default settings </option>
		</select>
</td></tr><tr valign="top" id="sel_timedelay_premium">

<td scope="row" colspan="1"></td>
<td>
<input id="xyz_smap_min_timedelay_post_publish_value"  name="xyz_smap_min_timedelay_post_publish_value" type="text" value="<?php echo $xyz_smap_min_timedelay_post_publish_value;?>"/>

<select name="xyz_smap_min_timedealy_post_publish_period" id="xyz_smap_min_timedealy_post_publish_period" >

<option value ="1" <?php if($xyz_smap_min_timedealy_post_publish_period=='1') echo 'selected'; ?> >Minutes </option>

<option value ="2" <?php if($xyz_smap_min_timedealy_post_publish_period=='2') echo 'selected'; ?> >Hours </option>

<option value ="3" <?php if($xyz_smap_min_timedealy_post_publish_period=='3') echo 'selected'; ?> >Days </option>
</select> 
</td></tr>	
		<tr>
			<td   id="bottomBorderNone">&nbsp;</td>
					<td   id="bottomBorderNone" style="height: 50px">
							<input type="submit" class="submit_smap_new"
								style=" margin-top: 10px; "
								name="gp" value="Save" />
					</td>
				</tr>

</table>
</div>

</form>

<?php }?>

</fieldset>
</div>
<script type="text/javascript">

var cat_flag="<?php echo $cat_flag;?>";
var post_flag="<?php echo $post_flag;?>";
var page_flag="<?php echo $page_flag;?>";
var custtype_flag="<?php echo $custtype_flag;?>";
var categ_radio="<?php echo $categ_radio;?>";
var spec_cat='<?php echo $spec_cat0; ?>';

var ln_sh_post_profile_flag="<?php echo $ln_sh_post_profile;?>";

var fb_prefrd_link="<?php echo $posting_methodO;?>";
var timedelay_flag="<?php echo $timedelay_flag;?>";
fb_rd_for_preferred_link(fb_prefrd_link);
if(custtype_flag==1 || custtype_flag=="")
{
	dropdown_def_custtype_sel(1);
}
else 
{
	dropdown_def_custtype_sel(0);
	
}
if(cat_flag==1 || cat_flag=="")
{
	xyz_smap_premium_show_postCategory(1);
	if(post_flag==1)
		dropdown_def_cat_sel(1);
	else
		dropdown_def_cat_sel(0);
}
else 
{
	if(post_flag==1)
		dropdown_def_cat_sel(1);
	else
		dropdown_def_cat_sel(0);
}
if(page_flag==1)
	xyz_smap_premium_show_includePage(1);

share_post_profile(ln_sh_post_profile_flag);


if(categ_radio=="Specific")
{
	rd_cat_chn(1);
}
else 
	rd_cat_chn(-1);

if(timedelay_flag==1)
	xyz_smap_premium_show_timedelay(1);


<?php 

$xyz_smap_pi_board_ids1=array();
$xyz_smap_pi_board_idsO=isset($xyz_smap_pi_board_idsO)?$xyz_smap_pi_board_idsO:'';
if($xyz_smap_pi_board_idsO!=""){
	$xyz_smap_pi_board_ids1=explode(",",$xyz_smap_pi_board_idsO);
	for($k=0;$k<count($xyz_smap_pi_board_ids1);$k++){
	?>
	
	jQuery(document).ready(function() {
		
	var brdid="<?php echo $xyz_smap_pi_board_ids1[$k];?>";
	jQuery("select option[value='"+brdid+"']").attr("selected","selected");

	
	
});

	<?php }}?>
	jQuery(document).ready(function() {
		gp_checked();
		show_GP_pgAnDprof();
	});
	function fb_rd_for_preferred_link(string)
	{
			if(string==1||string==2)
				jQuery("#fb_rd_for_preferred_link_id").show();
			else
				jQuery("#fb_rd_for_preferred_link_id").hide();
	}

	function show_GP_pgAnDprof()
	{
		var string=jQuery("#xyz_smap_gp_email").val();
		if(string.indexOf('@gmail.com') !=-1)
			jQuery(".typesel_gp").show();
		else
			jQuery(".typesel_gp").hide();
		
		jQuery("#xyz_smap_gp_email").focusout(function () {
			var string=jQuery("#xyz_smap_gp_email").val();
			if(string.indexOf('@gmail.com') !=-1)
				jQuery(".typesel_gp").show();
			else
				jQuery(".typesel_gp").hide();
		});
		
	}

	function gp_checked(){
		
		if(jQuery('#gp_pg').is(':checked'))
			jQuery('#xyz_smap_gp_pageid').show();
		else
			jQuery('#xyz_smap_gp_pageid').hide();
	}
		
	
	function setcat_fb(obj)
	{
		var sel_str="";
		for(var k=0;k<obj.options.length;k++)
		{
			if(obj.options[k].selected)
			sel_str+=obj.options[k].value+",";
		}


		var l = sel_str.length; 
		var lastChar = sel_str.substring(l-1, l); 
		if (lastChar == ",")
		{ 
			sel_str = sel_str.substring(0, l-1);
		}

		document.getElementById('xyz_smap_sel_cat_fb').value=sel_str;

	}
	function setcat_tw(obj)
	{
		var sel_str="";
		for(var k=0;k<obj.options.length;k++)
		{
			if(obj.options[k].selected)
			sel_str+=obj.options[k].value+",";
		}


		var l = sel_str.length; 
		var lastChar = sel_str.substring(l-1, l); 
		if (lastChar == ",")
		{ 
			sel_str = sel_str.substring(0, l-1);
		}

		document.getElementById('xyz_smap_sel_cat_tw').value=sel_str;

	}
	function setcat_ln(obj)
	{
		var sel_str="";
		for(var k=0;k<obj.options.length;k++)
		{
			if(obj.options[k].selected)
			sel_str+=obj.options[k].value+",";
		}


		var l = sel_str.length; 
		var lastChar = sel_str.substring(l-1, l); 
		if (lastChar == ",")
		{ 
			sel_str = sel_str.substring(0, l-1);
		}

		document.getElementById('xyz_smap_sel_cat_ln').value=sel_str;

	}
	function setcat_pi(obj)
	{
		var sel_str="";
		for(var k=0;k<obj.options.length;k++)
		{
			if(obj.options[k].selected)
			sel_str+=obj.options[k].value+",";
		}


		var l = sel_str.length; 
		var lastChar = sel_str.substring(l-1, l); 
		if (lastChar == ",")
		{ 
			sel_str = sel_str.substring(0, l-1);
		}

		document.getElementById('xyz_smap_sel_cat_pi').value=sel_str;

	}
	function setcat_gp(obj)
	{
		var sel_str="";
		for(var k=0;k<obj.options.length;k++)
		{
			if(obj.options[k].selected)
			sel_str+=obj.options[k].value+",";
		}


		var l = sel_str.length; 
		var lastChar = sel_str.substring(l-1, l); 
		if (lastChar == ",")
		{ 
			sel_str = sel_str.substring(0, l-1);
		}

		document.getElementById('xyz_smap_sel_cat_gp').value=sel_str;

	}

	var d1='<?php echo $spec_cat0;?>';
	splitText = d1.split(",");
	jQuery.each(splitText, function(k,v) {
	jQuery("#xyz_smap_catlist_fb").children("option[value="+v+"]").attr("selected","selected");
	jQuery("#xyz_smap_catlist_tw").children("option[value="+v+"]").attr("selected","selected");
	jQuery("#xyz_smap_catlist_ln").children("option[value="+v+"]").attr("selected","selected");
	jQuery("#xyz_smap_catlist_pi").children("option[value="+v+"]").attr("selected","selected");
	jQuery("#xyz_smap_catlist_gp").children("option[value="+v+"]").attr("selected","selected");
	});


	function share_post_profile(act)
	{ 
			if(act!=0)
			  jQuery("#share_post_profile_type").hide();
			else
			  jQuery("#share_post_profile_type").show();
	}

	function rd_cat_chn(act)
	{ 
			if(act==-1)
			  jQuery("#cat_dropdown_span").hide();
			else
			  jQuery("#cat_dropdown_span").show();
	}


	function dropdown_def_custtype_sel(act)
	{ 
			if(act==1)
			  jQuery("#custtype_dropdown_span").hide();
			else
			{
			  jQuery("#custtype_dropdown_span").show();
			  
			}
	}
	
	
	function dropdown_def_cat_sel(act)
	{ 
		var catval='<?php echo $smap_category_ids0; ?>';
		var onchn= jQuery('#xyz_smap_premium_default_cat_sel').val();
			if(act==0)
			{
			  jQuery("#cat_sel_rad_tr").hide();
			  if(onchn==1)
			  	jQuery('#selPostCat_premium').hide();
			}
			else
			{
				jQuery("#cat_sel_rad_tr").show();
				jQuery('#selPostCat_premium').show();
				jQuery("#xyz_smap_premium_include_posts option[value='1']").attr("selected","selected");
				if(catval=="All")
					document.getElementById('xyz_smap_cat_all').checked = true;
			}
	}
	function xyz_smap_premium_show_postCategory(val)
	{
		if(val==1)
			dropdown_def_cat_sel(0);
		else
			dropdown_def_cat_sel(1);
	}
	
	function xyz_smap_premium_fb_info_insert(inf){
		
	    var e = document.getElementById("xyz_smap_premium_fb_info");
	    var ins_opt = e.options[e.selectedIndex].text;
	    if(ins_opt=="0")
	    	ins_opt="";
	    var str=jQuery("textarea#xyz_smap_message").val()+ins_opt;
	    jQuery("textarea#xyz_smap_message").val(str);
	    jQuery('#xyz_smap_premium_fb_info :eq(0)').prop('selected', true);
	    jQuery("textarea#xyz_smap_message").focus();

	}
	function xyz_smap_premium_tw_info_insert(inf){
		
	    var e = document.getElementById("xyz_smap_premium_tw_info");
	    var ins_opt = e.options[e.selectedIndex].text;
	    if(ins_opt=="0")
	    	ins_opt="";
	    var str=jQuery("textarea#xyz_smap_twmessage").val()+ins_opt;
	    jQuery("textarea#xyz_smap_twmessage").val(str);
	    jQuery('#xyz_smap_premium_tw_info :eq(0)').prop('selected', true);
	    jQuery("textarea#xyz_smap_twmessage").focus();

	}
	function xyz_smap_premium_ln_info_insert(inf){
		
	    var e = document.getElementById("xyz_smap_premium_ln_info");
	    var ins_opt = e.options[e.selectedIndex].text;
	    if(ins_opt=="0")
	    	ins_opt="";
	    var str=jQuery("textarea#xyz_smap_lnmessage").val()+ins_opt;
	    jQuery("textarea#xyz_smap_lnmessage").val(str);
	    jQuery('#xyz_smap_premium_ln_info :eq(0)').prop('selected', true);
	    jQuery("textarea#xyz_smap_lnmessage").focus();

	}
	function xyz_smap_premium_pi_info_insert(inf){
		
	    var e = document.getElementById("xyz_smap_premium_pi_info");
	    var ins_opt = e.options[e.selectedIndex].text;
	    if(ins_opt=="0")
	    	ins_opt="";
	    var str=jQuery("textarea#xyz_smap_pimessage").val()+ins_opt;
	    jQuery("textarea#xyz_smap_pimessage").val(str);
	    jQuery('#xyz_smap_premium_pi_info :eq(0)').prop('selected', true);
	    jQuery("textarea#xyz_smap_pimessage").focus();

	}
	function xyz_smap_premium_gp_info_insert(inf){
		
	    var e = document.getElementById("xyz_smap_premium_gp_info");
	    var ins_opt = e.options[e.selectedIndex].text;
	    if(ins_opt=="0")
	    	ins_opt="";
	    var str=jQuery("textarea#xyz_smap_gpmessage").val()+ins_opt;
	    jQuery("textarea#xyz_smap_gpmessage").val(str);
	    jQuery('#xyz_smap_premium_gp_info :eq(0)').prop('selected', true);
	    jQuery("textarea#xyz_smap_gpmessage").focus();

	}
	function xyz_smap_premium_show_includePage(val)
	{
		if(val==1)
			jQuery("#selIncludePage_premium").hide();
		else
			jQuery("#selIncludePage_premium").show();
		
	}
	function xyz_smap_premium_show_timedelay(val)
	{
		if(val==1)
			jQuery("#sel_timedelay_premium").hide();
		else
			jQuery("#sel_timedelay_premium").show();
		
	}
</script>
	