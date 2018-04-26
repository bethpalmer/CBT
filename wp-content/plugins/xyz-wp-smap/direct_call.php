<?php
function xyz_smap_plugin_query_vars($vars) {
	$vars[] = 'wp_smap';
	return $vars;
}
add_filter('query_vars', 'xyz_smap_plugin_query_vars');

function xyz_wp_smap_plugin_parse_request($wp) {
	
	if (array_key_exists('wp_smap', $wp->query_vars) && $wp->query_vars['wp_smap'] == 'cron') {
		require( dirname( __FILE__ ) . '/cron.php' );
		die;
	}
	
}
add_action('parse_request', 'xyz_wp_smap_plugin_parse_request');
?>