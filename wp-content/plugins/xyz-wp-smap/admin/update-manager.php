<?php
add_filter( 'http_request_args', 'xyz_smap_exclude_updates', 5, 2 );
function xyz_smap_exclude_updates( $r, $url )
{
	if ( strpos( $url, '://api.wordpress.org/plugins/update-check' ) > 0) // supports http and https
	{
		$plugins = json_decode( $r['body']['plugins'], true );
		unset( $plugins['plugins'][plugin_basename( XYZ_SMAP_PLUGIN_FILE_PREMIUM)] );
		$r['body']['plugins'] = json_encode( $plugins );
	}
	return $r;
}

add_filter('site_transient_update_plugins', 'xyz_smap_remove_update_nag');//WP 3.0+
add_filter('transient_update_plugins', 'xyz_smap_remove_update_nag');//WP 2.8+

if(!function_exists('xyz_smap_remove_update_nag'))
{
	function xyz_smap_remove_update_nag($value) 
	{
		if (isset($value->response[ plugin_basename(XYZ_SMAP_PLUGIN_FILE_PREMIUM) ])) 
		 	unset($value->response[ plugin_basename(XYZ_SMAP_PLUGIN_FILE_PREMIUM) ]);
		return $value;
	}
}


 if( (time() - get_option('xyz_smap_premium_last_check_time')) > (86400) )
{

	$xyz_plugin_ver=xyz_smap_premium_plugin_get_version();
	// echo $xyz_plugin_ver;
	$url = "http://xyzscripts.com/product/changelog/XYZWPSMPPRE";

	$update_data=wp_remote_get($url);
	if(is_array($update_data))
	{
		$update_data=$update_data['body'];
	
		preg_match_all('/<version no="(.+?)">(.+?)<\/version>/is', $update_data,$matches);
	
	// 	 print_r($matches);die;
	
		$latest_ver=$matches[1][0];
	
		$update_str='';
		foreach ($matches[0] as $k => $v)
		{
			if($matches[1][$k]==$xyz_plugin_ver)
				break;
			$update_str.=$v;
		}
	
	
	
		update_option('xyz_smap_premium_last_check_time', time());
		if(trim($latest_ver)!='')
			update_option('xyz_smap_premium_latest_version', $latest_ver);
		update_option('xyz_smap_premium_change_log', $update_str);
	
		// echo $update_str;die;
	}
}




add_action('wp_ajax_xyz_wp_smap_premium_update_info', 'xyz_smap_premium_update_info');
function xyz_smap_premium_update_info()
{
	?><br>
	Latest version out there is : <b>	<?php	echo get_option('xyz_smap_premium_latest_version'); ?></b>.
	 You are using version <b><?php echo xyz_smap_premium_plugin_get_version(); ?></b> of this plugin.
	  <input class="submit_smap_new" id="UpdateButton"
				style="color:#FFFFFF;border-radius:4px;border:1px solid #1A87B9;margin-left:6px; margin-bottom:10px;" type="button"
				name="UpdateButton" value="Get latest version"
				 onClick='document.location.href="<?php echo admin_url('admin.php?page=xyz-wp-smap-key&action=get-latest');?>"'>
				 <br><br>
	 Please find the changelog below.   
	
	 
	
	<?php
	
	$items=get_option('xyz_smap_premium_change_log');
	
	$items=preg_replace("/<version(.+?)>/is", "<b>Version $1</b><br><br>", $items);
	$items=str_replace("</version>", "<br>", $items);
	$items=str_replace("<item>", "<b> * </b>", $items);
	$items=str_replace("</item>", "<br>", $items);
	
	echo $items;
	die;
}

function wp_smap_premium_admin_notice()
{
	global $wpdb;
	$version=get_option('xyz_smap_premium_version');

	$current_version=xyz_smap_premium_plugin_get_version();
	if($version!=$current_version)
	{
		echo '<div class="error">
		<p>It seems you have upgraded the XYZ WP Social Media Auto Publish Plugin. Please deactivate and then reactivate the plugin to upgrade the database.</p>
		</div>';
	}
	else
	{
		$license_key=get_option('xyz_wp_smap_license_key');
		if($license_key=='')
		{
			echo '<div class="error">
			<p><strong>XYZ WP Social Media Auto Publish</strong> requires you to <a href="'.admin_url('admin.php?page=xyz-wp-smap-key').'">configure</a> the license key obtained from your xyzscripts <a href="http://xyzscripts.com/members/">member area</a>.</p>
			</div>';
		}
	}
}

add_action('admin_notices', 'wp_smap_premium_admin_notice');

?>