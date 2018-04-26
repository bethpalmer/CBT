<?php
/*
 Plugin Name: XYZ WP Social Media Auto Publish
Plugin URI: http://xyzscripts.com/wordpress-plugins/xyz-wp-smap/
Description:   This plugin automatically publishes posts from your blog to   Facebook, Twitter, LinkedIn, Pinterest and Google Plus pages.
Version: 2.6
Author: xyzscripts.com
Author URI: http://xyzscripts.com/
License: GPLv2 or later
*/

/*
 This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( !function_exists( 'add_action' ) ) 
{
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}


ob_start();
//error_reporting(E_ALL);
define('XYZ_WP_SMAP_VALIDATOR_SERVER_COUNT',1);
define('XYZ_WP_SMAP_PRODUCT_CODE','XYZWPSMPPRE');
define('XYZ_SMAP_PLUGIN_FILE_PREMIUM',__FILE__);
define('XYZ_SMAP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

if (!defined('XYZ_SMAP_FB_API_VERSION'))
	define('XYZ_SMAP_FB_API_VERSION','v2.6');
//if (!defined('XYZ_SMAP_FB_api'))
//	define('XYZ_SMAP_FB_api','https://api.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/');
//if (!defined('XYZ_SMAP_FB_api_video'))
//	define('XYZ_SMAP_FB_api_video','https://api-video.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/');
//if (!defined('XYZ_SMAP_FB_api_read'))
//	define('XYZ_SMAP_FB_api_read','https://api-read.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/');
//if (!defined('XYZ_SMAP_FB_graph'))
//	define('XYZ_SMAP_FB_graph','https://graph.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/');
//if (!defined('XYZ_SMAP_FB_graph_video'))
//	define('XYZ_SMAP_FB_graph_video','https://graph-video.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/');
//if (!defined('XYZ_SMAP_FB_www'))
//	define('XYZ_SMAP_FB_www','https://www.facebook.com/'.XYZ_SMAP_FB_API_VERSION.'/');

$xyz_wp_smap_page_datas='';
global $wpdb;
$wpdb->query('SET SQL_MODE=""');

require_once( dirname( __FILE__ ) . '/xyz-functions.php' );
require_once( dirname( __FILE__ ) . '/xyz-addon-functions.php' );
require_once( dirname( __FILE__ ) . '/admin/install.php' );
require_once( dirname( __FILE__ ) . '/admin/update-manager.php' );
require_once( dirname( __FILE__ ) . '/admin/menu.php' );
require_once( dirname( __FILE__ ) . '/admin/destruction.php' );

if(!class_exists('SMAPFacebook'))
//require_once( dirname( __FILE__ ) . '/api/facebook.php' );
require_once( dirname( __FILE__ ) . '/api/Facebook/autoload.php');
if(!class_exists('SMAPTwitterOAuth'))
require_once( dirname( __FILE__ ) . '/api/twitteroauth.php' );
require_once( dirname( __FILE__ ) . '/api/pinterest.php' );

if(!class_exists('SMAPOAuth2'))
require_once( dirname( __FILE__ ) . '/api/linkedin.php' );


require_once( dirname( __FILE__ ) . '/admin/metabox.php' );
require_once( dirname( __FILE__ ) . '/admin/publish.php' );

require( dirname( __FILE__ ) . '/ajax-handler.php' );

require( dirname( __FILE__ ) . '/direct_call.php' );

xyz_smap_include_addon_file('addon.php');

if(get_option('xyz_credit_link')=="smap"){

	add_action('wp_footer', 'xyz_smap_premium_credit');

}
function xyz_smap_premium_credit() {
	$content = '<div style="clear:both;width:100%;text-align:center; font-size:11px; "><a target="_blank" title="Social Media Auto Publish" href="http://xyzscripts.com/wordpress-plugins/xyz-wp-smap/details" >Social Media Auto Publish</a> Powered By : <a target="_blank" title="PHP Scripts & Programs" href="http://www.xyzscripts.com" >XYZScripts.com</a></div>';
	echo $content;
}
if(!function_exists('get_post_thumbnail_id'))
	add_theme_support( 'post-thumbnails' );

?>
