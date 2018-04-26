<?php

global $wpdb;

$xyz_smap_accountId = $_GET['smap_id'];
$xyz_smap_account_type= $_GET['smap_accounttype'];

if($xyz_smap_accountId=="" || !is_numeric($xyz_smap_accountId)){
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type='.$xyz_smap_account_type));
	exit();

}

$table=xyz_smap_get_table($xyz_smap_account_type);

$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT %d,%d',array($xyz_smap_accountId,0,1) )) ;

if($accountCount==0){
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type='.$xyz_smap_account_type));
	exit();
}else{

	$entries = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT %d,%d',array($xyz_smap_accountId,0,1) ));
	
	foreach( $entries as $entry ) {
		if($xyz_smap_account_type==1)
		{
			$app_id = $entry->xyz_smap_application_id;
			$app_secret = $entry->xyz_smap_application_secret;
			$xyz_smap_authorization_flag = $entry->xyz_smap_authorization_flag;
			$page_idsO = $entry->xyz_smap_page_ids;
		}
		else if($xyz_smap_account_type==3)
		{
			$lnappikey=$entry->xyz_smap_lnapikey;
			$lnapisecret=$entry->xyz_smap_lnapisecret;
			$xyz_smap_authorization_flag = $entry->xyz_smap_authorization_flag;
			
			$xyz_smap_ln_share_post = $entry->xyz_smap_ln_share_post;
			$xyz_smap_ln_company_name = $entry->xyz_smap_ln_company_name;
			$xyz_smap_ln_group_id = $entry->xyz_smap_ln_group_id;
			$xyz_smap_ln_company_id0=$entry->xyz_smap_ln_company_id;
			$xyz_smap_ln_company_fetch=$entry->xyz_smap_ln_company_fetch;
			
		}
	
	}
}

if($xyz_smap_account_type==1)
{
	session_start();	
	$code="";
	if(isset($_REQUEST['code']))
	$code = $_REQUEST["code"];
	if(isset($_GET['auth-link-click']) && $_GET['auth-link-click']==1)
		$redirecturl=admin_url('admin.php?page=social-media-auto-publish-manageaccounts&action=account-authentication&auth-link-click=1&smap_id='.$xyz_smap_accountId.'&smap_accounttype='.$xyz_smap_account_type.'&auth=1');
	else
		$redirecturl=admin_url('admin.php?page=social-media-auto-publish-manageaccounts&action=account-authentication&smap_id='.$xyz_smap_accountId.'&smap_accounttype='.$xyz_smap_account_type.'&auth=1');

	$my_url =  $redirecturl;
	$my_url=urlencode($my_url);
	$code = $_REQUEST["code"];
	
	if($accountCount>0 && !isset($_GET['auth']))
	{
	
		$xyz_smap_premium_session_state = md5(uniqid(rand(), TRUE));
		setcookie("xyz_smap_premium_session_state",$xyz_smap_premium_session_state,"0","/");
		
		
		   $dialog_url = "https://www.facebook.com/".XYZ_SMAP_FB_API_VERSION."/dialog/oauth?client_id=" 
	       . $app_id . "&redirect_uri=" . $my_url . "&state="
		   . $xyz_smap_premium_session_state . "&scope=email,public_profile,publish_pages,user_posts,publish_actions,manage_pages";
		   
		   
		
	     header("Location: " . $dialog_url);
	} 


	if(isset($_GET['auth']) && $_GET['auth']==1)
	{
		
	if(isset($_COOKIE['xyz_smap_premium_session_state']) && isset($_REQUEST['state']) && ($_COOKIE['xyz_smap_premium_session_state'] === $_REQUEST['state'])) {
		
		
		      			$token_url = "https://graph.facebook.com/".XYZ_SMAP_FB_API_VERSION."/oauth/access_token?"
	   			. "client_id=" . $app_id . "&redirect_uri=" . $my_url
	   			. "&client_secret=" . $app_secret . "&code=" . $code;
	   
	   	$response = wp_remote_get($token_url);
	   	
	   	$params = null;$access_token="";
	   	if(is_array($response))
	   	{
		   	if(isset($response['body']))
		   	{
			   	$params= json_decode($response['body']);
				if(isset($params->access_token))
			   	//if(isset($params['access_token']))
			   	$access_token = $params->access_token;
		   	}
	   	}
	
	   	if($access_token!="")
	   	{   		
		   	$xyz_smap_authorization_flag=0;
		   	$xyz_smap_account_status=1;
		   	
		   	if($page_idsO!="" && $page_idsO!="-1")
		   	{
		   		
		   		$offset=0;$limit=100;$data=array();
		   		   		
		   		//$fbid='me';
		   		do
		   		{
		   			$result1="";$pagearray1="";
		   			$pp=wp_remote_get("https://graph.facebook.com/".XYZ_SMAP_FB_API_VERSION."/me/accounts?access_token=$access_token&limit=$limit&offset=$offset");
		   		
		   		
		   			if(is_array($pp))
		   			{
		   				$result1=$pp['body'];
		   				$pagearray1 = json_decode($result1);
		   				if(is_array($pagearray1->data))
		   					$data = array_merge($data, $pagearray1->data);
		   			}
		   			else
		   				break;
		   			$offset += $limit;
	// 	   			if(!is_array($pagearray1->paging))
	// 	   				break;
		   		}while(isset($pagearray1->paging->next));
		   			   		
		   		$count=count($data);$newpgs="";
		   		if($count>0)
		   		{
		   			$smap_pages_ids1=$page_idsO;
		   			$smap_pages_ids0=array();
		   			if($smap_pages_ids1!="")
		   				$smap_pages_ids0=explode(",",$smap_pages_ids1);
		   		
		   			$smap_pages_ids=array();$profile_flg=0;
		   			for($i=0;$i<count($smap_pages_ids0);$i++)
		   			{
		   			if($smap_pages_ids0[$i]!="-1")
		   				$smap_pages_ids[$i]=trim(substr($smap_pages_ids0[$i],0,strpos($smap_pages_ids0[$i],"-")));
		   				else{
		   			$smap_pages_ids[$i]=$smap_pages_ids0[$i];$profile_flg=1;}
		   		}
		   		
		   		for($i=0;$i<$count;$i++)
		   		{
		   			if(in_array($data[$i]->id, $smap_pages_ids))
		   				$newpgs.=$data[$i]->id."-".$data[$i]->access_token.",";
		   			
		   		}
		   		$newpgs=rtrim($newpgs,",");
		   		
		   		if($profile_flg==1)
		   			$newpgs=$newpgs.",-1";
		   		
		   		if($newpgs!="")
		   			$wpdb->query( $wpdb->prepare( 'UPDATE '.$wpdb->prefix.$table.' SET `xyz_smap_page_ids`=%s  WHERE id=%d',array($newpgs,$xyz_smap_accountId) )) ;
		   		
		   		
		   		}
		   		
		   	}
	   	}
	   	else
	   	{
	   		$xyz_smap_account_status=0;
	   		
	   		header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=14&account_type='.$xyz_smap_account_type));
	   		exit();
	   	}
	   		
	   	$url = 'https://graph.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/me?access_token='.$access_token;
	   	$contentget=wp_remote_get($url);$page_id='';
	   	if(is_array($contentget))
	   	{
	   		$result1=$contentget['body'];
	   		$pagearray = json_decode($result1);
	   		$page_id=$pagearray->id;
	   	}
	   	$wpdb->query( $wpdb->prepare( 'UPDATE '.$wpdb->prefix.$table.' SET xyz_smap_fb_numericid = %s,`xyz_smap_access_token` =%s,`xyz_smap_authorization_flag` =%s,`xyz_smap_account_status` =%d  WHERE id=%d',array($page_id,$access_token,$xyz_smap_authorization_flag,$xyz_smap_account_status,$xyz_smap_accountId) )) ;
	   	
	   	if(isset($_GET['auth-link-click']) && $_GET['auth-link-click']==1)
	   		header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=4&account_type='.$xyz_smap_account_type));
	   	else 
	   	{	
	    	$authdetails = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."xyz_smap_fb_details ORDER BY id DESC LIMIT 0,1" );
	    	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&action=edit-account&id='.$authdetails->id.'&type='.$xyz_smap_account_type));
	   	}
	
	   	exit();   
	   }
	   else {
	   	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=6&account_type='.$xyz_smap_account_type));
	   	exit();
	   }
	}
}	
else if($xyz_smap_account_type==3)
		{
			$state=md5(get_home_url());
			
			if(isset($_GET['auth-link-click-ln']) && $_GET['auth-link-click-ln']==1)
				$redirecturl=urlencode(admin_url('admin.php?page=social-media-auto-publish-manageaccounts&auth-link-click-ln=1&action=account-authentication&smap_id='.$xyz_smap_accountId.'&smap_accounttype='.$xyz_smap_account_type));
			else 
				$redirecturl=urlencode(admin_url('admin.php?page=social-media-auto-publish-manageaccounts&action=account-authentication&smap_id='.$xyz_smap_accountId.'&smap_accounttype='.$xyz_smap_account_type));
				
			
			if(!isset($_GET['code']))
			{
				
				$linkedin_auth_url='https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id='.$lnappikey.'&redirect_uri='.$redirecturl.'&state='.$state.'&scope=w_share+rw_company_admin';//rw_groups not included as it requires linkedin partnership agreement

				wp_redirect($linkedin_auth_url); 
				echo '<script>document.location.href="'.$linkedin_auth_url.'"</script>';
				die;
				
			}

			if( isset($_GET['error']) && isset($_GET['error_description']) )//if any error 
			{

				header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=13&account_type='.$xyz_smap_account_type.'&error='.urlencode($_GET['error_description'])));
				exit();
			}
 
			else if(isset($_GET['code']) && isset($_GET['state']) && $_GET['state']==$state)
			{

				$fields='grant_type=authorization_code&code='.$_GET['code'].'&redirect_uri='.$redirecturl.'&client_id='.$lnappikey.'&client_secret='.$lnapisecret;
				$ln_acc_tok_json=xyzsmap_getpage('https://www.linkedin.com/uas/oauth2/accessToken', '', false, $fields);
				$ln_acc_tok_json=$ln_acc_tok_json['content'];
				$ln_acc_tok_arr=json_decode($ln_acc_tok_json);



			$xyz_smap_ln_company_id="";
			if($xyz_smap_ln_company_fetch==1)
				$xyz_smap_ln_company_id=$xyz_smap_ln_company_id0;
			
			if($xyz_smap_ln_share_post==1 || $xyz_smap_ln_share_post==2) //company or group
			{


			 $ObjLinkedin = new SMAPLinkedInOAuth2($ln_acc_tok_arr->access_token);

			if($xyz_smap_ln_share_post==1)//company
			{
				if($xyz_smap_ln_company_fetch==0)
				{
					$company_err=0;
					$company_name=$xyz_smap_ln_company_name;
					try
					{
						$ar = $ObjLinkedin->getAdminCompanies();//gets only 100 companies as of now; need to modify if requested by client
						//$ar=json_decode($response2['linkedin'],true);
						//print_r($response2);die;
						if ($ar['_total']>0)
						{
							foreach ($ar['values'] as $ark => $arv)
							{
								if(strcasecmp ($arv['name'],$company_name)==0)
									$xyz_smap_ln_company_id = $arv['id'];
							}
						}
						if($xyz_smap_ln_company_id=='')					
						{
							$company_err=1;
						}
					}
					catch(Exception $e)
					{
						$company_err=1;
					}
					if($company_err==1)
					{
						$xyz_smap_authorization_flag=1;
						$wpdb->query( 'UPDATE '.$wpdb->prefix.$table.' SET `xyz_smap_authorization_flag` ="'.$xyz_smap_authorization_flag.'",`xyz_smap_ln_auth_time`=time() WHERE id="'.$xyz_smap_accountId.'" ' ) ;
						
						header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=11&account_type='.$xyz_smap_account_type));
						exit();

					}
				}
				
			}

			/*GROUP LOGIC COMMENTED TEMPORARILY UNTIL API IS AVAILABLE FOR TESTING */

		/*	else if($xyz_smap_ln_share_post==2)//group
			{
					$groupId=$xyz_smap_ln_group_id;
					try{
						$response2 = $OBJ_linkedin->getGroup($groupId);//does not check membership status now; need to modify if requested by client
					}
					catch(Exception $e)
					{
						$xyz_smap_authorization_flag=1;
						$wpdb->query( 'UPDATE '.$wpdb->prefix.$table.' SET `xyz_smap_authorization_flag` ="'.$xyz_smap_authorization_flag.'" WHERE id="'.$xyz_smap_accountId.'" ' ) ;
						
						header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=12&account_type='.$xyz_smap_account_type));
						exit();
					}
					
					if($response2!=2)
					{
						$xyz_smap_authorization_flag=1;
						$wpdb->query( 'UPDATE '.$wpdb->prefix.$table.' SET `xyz_smap_authorization_flag` ="'.$xyz_smap_authorization_flag.'" WHERE id="'.$xyz_smap_accountId.'" ' ) ;
						
						header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=12&account_type='.$xyz_smap_account_type));
						exit();
					}
				}*/  
			
			}
			
			$xyz_smap_authorization_flag=0;
			$xyz_smap_account_status=1;
			
			
				$wpdb->query( 'UPDATE '.$wpdb->prefix.$table.' SET `xyz_smap_application_lnarray` ="'.$wpdb->_real_escape($ln_acc_tok_json).'",`xyz_smap_authorization_flag` ="'.$xyz_smap_authorization_flag.'",`xyz_smap_account_status` ="'.$xyz_smap_account_status.'",`xyz_smap_ln_company_id` ="'.$xyz_smap_ln_company_id.'",`xyz_smap_ln_auth_time` ="'.time().'"  WHERE id="'.$xyz_smap_accountId.'" ' ) ;
				if(isset($_GET['auth-link-click-ln']) && $_GET['auth-link-click-ln']==1)
					header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=4&account_type='.$xyz_smap_account_type));
				else
				{
					$authdetails_ln = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."xyz_smap_ln_details ORDER BY id DESC LIMIT 0,1" );
					header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&action=edit-account&id='.$authdetails_ln->id.'&type='.$xyz_smap_account_type));
				}
					

			exit();
		}
}
?>