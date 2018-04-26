<?php

global $wpdb;

$xyz_smap_accountId = $_GET['id'];
$xyz_smap_account_type= $_GET['type'];
$xyz_smap_account_status=$_GET['status'];

if($xyz_smap_accountId=="" || !is_numeric($xyz_smap_accountId)){
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type='.$xyz_smap_account_type));
	exit();

}

if($xyz_smap_account_type==1)
{
	$table="xyz_smap_fb_details";
}
else if($xyz_smap_account_type==2)
{
	$table="xyz_smap_tw_details";
}
else if($xyz_smap_account_type==3)
{
	$table="xyz_smap_ln_details";
}
else if($xyz_smap_account_type==4)
{
	$table="xyz_smap_pi_details";
}

else if($xyz_smap_account_type==5)
{
	$table="xyz_smap_gp_details";
}

$accountCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT 0,1',array($xyz_smap_accountId) )) ;

if($accountCount==0){
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type='.$xyz_smap_account_type));
	exit();
}else{
	
if($xyz_smap_account_type==1 && $xyz_smap_account_status==1)
	{
		$accountCount1 = $wpdb->get_results( $wpdb->prepare( 'SELECT xyz_smap_authorization_flag FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT 0,1',array($xyz_smap_accountId) )) ;
	
		foreach( $accountCount1 as $entry ) {
			$xyz_smap_authorization_flag=$entry->xyz_smap_authorization_flag;
		}
	
		if($xyz_smap_authorization_flag==1)
		{
			header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=8&account_type='.$xyz_smap_account_type));
			exit();
		}
	
	}
	
	if($xyz_smap_account_type==2 && $xyz_smap_account_status==1)
	{
		$accountCount1 = $wpdb->get_results( $wpdb->prepare( 'SELECT xyz_smap_consumer_id,xyz_smap_consumer_secret,xyz_smap_tw_id,xyz_smap_access_token,xyz_smap_access_token_secret FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT 0,1',array($xyz_smap_accountId) )) ;
	
		foreach( $accountCount1 as $entry ) {
			$xyz_smap_consumer_id=$entry->xyz_smap_consumer_id;
			$xyz_smap_consumer_secret=$entry->xyz_smap_consumer_secret;
			$xyz_smap_tw_id=$entry->xyz_smap_tw_id;
			$xyz_smap_access_token=$entry->xyz_smap_access_token;
			$xyz_smap_access_token_secret=$entry->xyz_smap_access_token_secret;
		}
		$err=0;
		if($xyz_smap_consumer_id=="" || $xyz_smap_consumer_secret=="" || $xyz_smap_tw_id=="" || $xyz_smap_access_token="" || $xyz_smap_access_token_secret=="")
			$err=1;
		
		if($err==1)
		{
			header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=10&account_type='.$xyz_smap_account_type));
			exit();
		}
	
	}
	
	if($xyz_smap_account_type==3 && $xyz_smap_account_status==1)
	{
		$accountCount1 = $wpdb->get_results( $wpdb->prepare( 'SELECT xyz_smap_authorization_flag FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT 0,1',array($xyz_smap_accountId) )) ;
	
		foreach( $accountCount1 as $entry ) {
			$xyz_smap_authorization_flag=$entry->xyz_smap_authorization_flag;
		}
	
		if($xyz_smap_authorization_flag==1)
		{
			header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=8&account_type='.$xyz_smap_account_type));
			exit();
		}
	
	}
	
	
	
if($xyz_smap_account_type==4 && $xyz_smap_account_status==1)
	{
		$accountCount1 = $wpdb->get_results( $wpdb->prepare( 'SELECT xyz_smap_pi_board_ids,xyz_smap_authorization_flag FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT 0,1',array($xyz_smap_accountId) )) ;
		
		foreach( $accountCount1 as $entry ) {
			$xyz_smap_pi_board_ids=$entry->xyz_smap_pi_board_ids;
			$xyz_smap_authorization_flag=$entry->xyz_smap_authorization_flag;
		}
		
		if($xyz_smap_authorization_flag==1 || $xyz_smap_pi_board_ids=="")
		{
			header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=9&account_type='.$xyz_smap_account_type));
			exit();
		}
		
	}
	
	if($xyz_smap_account_type==5 && $xyz_smap_account_status==1)
	{
		$accountCount1 = $wpdb->get_results( $wpdb->prepare( 'SELECT xyz_smap_authorization_flag FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT 0,1',array($xyz_smap_accountId) )) ;
		
		foreach( $accountCount1 as $entry ) {
			$xyz_smap_authorization_flag=$entry->xyz_smap_authorization_flag;
		}
		
		if($xyz_smap_authorization_flag==1)
		{
			header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=7&account_type='.$xyz_smap_account_type));
			exit();
		}
		
	}
	
	
	$wpdb->query( $wpdb->prepare( 'UPDATE '.$wpdb->prefix.$table.' SET `xyz_smap_account_status` =%d  WHERE id=%d',array($xyz_smap_account_status,$xyz_smap_accountId) )) ;

	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=2&account_type='.$xyz_smap_account_type));
	exit();

}
?>