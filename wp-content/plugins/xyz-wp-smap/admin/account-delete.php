<?php
global $wpdb;

if(isset($_GET['id']))
$xyz_smap_accountId = $_GET['id'];
if(isset($_GET['type']))
$xyz_smap_account_type= $_GET['type'];



if($xyz_smap_accountId=="" || !is_numeric($xyz_smap_accountId)){
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type='.$xyz_smap_account_type));
	exit();

}
$table = xyz_smap_get_table($xyz_smap_account_type);

$formCount = $wpdb->query( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id=%d LIMIT %d,%d',array($xyz_smap_accountId,0,1) )) ;

if($formCount==0){
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&account_type='.$xyz_smap_account_type));
	exit();
}else{
	
	$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.$table.'  WHERE id=%d',array($xyz_smap_accountId) )) ;
	
	$wpdb->query( $wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE acc_id=%d and acc_type=%d',array($xyz_smap_accountId,$xyz_smap_account_type) )) ;
	
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-manageaccounts&msg=5&account_type='.$xyz_smap_account_type));
	exit();

}
?>