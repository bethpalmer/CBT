<?php

add_action('admin_menu', 'xyz_smap_premium_menu');

function xyz_smap_premium_add_admin_scripts()
{
	wp_register_script( 'xyz_smap_premium_notice_script', plugins_url('xyz-wp-smap/js/notice.js') );
	wp_enqueue_script( 'xyz_smap_premium_notice_script' );
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	
	wp_register_style('xyz_smap_premium_style', plugins_url('xyz-wp-smap/admin/style.css'));
	wp_enqueue_style('xyz_smap_premium_style');
}

add_action("admin_enqueue_scripts","xyz_smap_premium_add_admin_scripts");

function xyz_smap_premium_menu()
{
	add_menu_page('XYZ Social Media Auto Publish', 'XYZ SMAP', 'manage_options', 'social-media-auto-publish-settings-premium', 'xyz_smap_premium_settings');

	// Add a submenu to the Dashboard:
	$page=add_submenu_page('social-media-auto-publish-settings-premium', 'XYZ Social Media Auto Publish - Manage Settings', ' Settings', 'manage_options', 'social-media-auto-publish-settings-premium' ,'xyz_smap_premium_settings');
	add_submenu_page('social-media-auto-publish-settings-premium', 'XYZ Social Media Auto Publish - Manage Accounts', 'Manage Accounts', 'manage_options', 'social-media-auto-publish-manageaccounts' ,'xyz_smap_manage_accounts');
	add_submenu_page('social-media-auto-publish-settings-premium', 'XYZ Social Media Auto Publish - Logs', 'Logs', 'manage_options', 'social-media-auto-publish-log-premium' ,'xyz_smap_premium_logs');	
	add_submenu_page('social-media-auto-publish-settings-premium', 'XYZ Social Media Auto Publish - License Key', 'License Key', 'manage_options', 'xyz-wp-smap-key' ,'xyz_wp_smap_license'); 
	add_submenu_page('social-media-auto-publish-settings-premium', 'XYZ Social Media Auto Publish - About', 'About', 'manage_options', 'social-media-auto-publish-about-premium' ,'xyz_smap_premium_about'); 
	xyz_smap_include_addon_file('menu.php');
	
	add_submenu_page('social-media-auto-publish-settings-premium', 'XYZ Social Media Auto Publish - Addons', 'Addons', 'manage_options', 'social-media-auto-publish-addons' ,'smap_premium_addons');
	
}

function xyz_smap_premium_settings()
{
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);	
	$_POST = xyz_trim_deep($_POST);
	$_GET = xyz_trim_deep($_GET);
	
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/settings.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
}

function xyz_wp_smap_license(){
	$formflag=0;
	
	if(isset($_GET['action']) && $_GET['action']=='get-latest' )
	{
		require( dirname( __FILE__ ) . '/../xyz-get-latest.php' );
		xyz_wp_smap_get_latest_plugin();
		$formflag=1;
	}
	if($formflag==0){
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/xyz-wp-smap-key.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
	}
}
function xyz_smap_premium_about()
{
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/about.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
}

function xyz_smap_premium_logs()
{
	
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);
	$_POST = xyz_trim_deep($_POST);
	$_GET = xyz_trim_deep($_GET);
	
	$formflag=0;

	if(isset($_GET['action']) && $_GET['action']=='republish' )
	{
		require( dirname( __FILE__ ) . '/republish.php' );
		$formflag=1;
	}
	
	if($formflag==0){
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/logs.php' );
	require( dirname( __FILE__ ) . '/footer.php' );}
}

function xyz_smap_manage_accounts()
{
	$formflag = 0;
	
	$_POST = stripslashes_deep($_POST);
	$_GET = stripslashes_deep($_GET);	
	$_POST = xyz_trim_deep($_POST);
	$_GET = xyz_trim_deep($_GET);
	
	if(isset($_GET['action']) && $_GET['action']=='add-account' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/add-account.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='edit-account' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/edit-account.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='account-delete' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/account-delete.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='account-status' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/update-account-status.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='account-authentication' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/authorization.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}

	if($formflag==0)
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/manage-accounts.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
	}
}
/////////////////////// addon modification///////

function smap_premium_addons(){
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/addons.php' );

	
	if(isset($_GET['action']) && $_GET['action']=='update-addons' )
	{
	
		require( dirname( __FILE__ ) . '/../xyz-get-latest.php' );
		xyz_wp_smap_get_latest_addon();

		$formflag=1;
	}
	else if(isset($_GET['action']) && $_GET['action']=='install-addons' )
	{
		require( dirname( __FILE__ ) . '/../xyz-get-latest.php' );
		xyz_wp_smap_install_addon();
	
		$formflag=1;
	}
	else
	{
		xyz_wp_smap_manage_addons();
	}
	require( dirname( __FILE__ ) . '/footer.php' );
}

?>