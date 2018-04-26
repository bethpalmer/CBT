<?php
/**
 * Plugin Name: WP Boilerplate Shortcode
 * Description: Provides a boilerplate post type and a shortcode for insertion into posts, pages and custom post types Requires WP >= v3.0.
 * Plugin URI: http://mikeschinkel.com/wordpress-plugins/wp-boilerplate-shortcode/
 * Version: 1.0.1
 * Author: Mike Schinkel
 * Author URI: http://mikeschinkel.com/wordpress-plugins/
 */

/*
Copyright 2010 Mike Schinkel
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/
WPBoilerplateShortcode::onload();

function the_boilerplate($key,$by='path',$args=array()) {
	if (in_array($by,array('path','title','id')))
		$args["by$by"] = $key;
	echo WPBoilerplateShortcode::boilerplate_shortcode($args);
}

class WPBoilerplateShortcode {
	static function onload() {
		add_action('init', array(__CLASS__,'init_boilerplates'));
		add_shortcode('boilerplate', array(__CLASS__,'boilerplate_shortcode'));
	}
	function init_boilerplates() {
		if (function_exists('register_post_type')) {
			register_post_type('boilerplate',
				array(
					'singular_label'      => __('Boilerplate'),
					'label'               => __('Boilerplates'),
					'exclude_from_search' => true,
					'publicly_queryable'  => true,
					'public'              => true,
					'show_ui'             => true,
					'query_var'           => 'boilerplates',
					'rewrite'             => array('slug' => 'boilerplates'),
					'supports'            => array(
						'title',
						'editor',
						'revisions',
					),
				)
			);
		}
	}
	static function boilerplate_shortcode($args=array()) {
		$default = array(
			'bypath' => '',
			'bytitle' => '',
			'byid' => '',
			'id' => '',
			'class' => 'boilerplate',
			'title' => '',
			'showtitle' => false,
			'titletag' => 'h3',
		);
		$args = (object)array_merge($default,$args);
		if (!empty($args->byid)) {
			$page = get_page($args->byid);
		} else if (!empty($args->bypath)) {
			$page = get_page_by_path($args->bypath,OBJECT,'boilerplate');
		} else if (!empty($args->bytitle)) { // "bytitle" will only work if this patch is accepted: http://core.trac.wordpress.org/ticket/12743
			$page = get_page_by_title($args->bytitle,OBJECT,'boilerplate');
		} else {
			$page = null;
		}
		if (is_null($page))
			$value = '[ERROR: No "bytitle", "bypath" or "byid" arguments where provided with the boilerplate shortcode' .
					' or the values provided did not match an existing boilerplate entry.]';
		else {
			if (!empty($args->title)){
				$title = $args->title;
				$showtitle = true;
			} else {
				$title = $page->post_title;
				$showtitle = $args->showtitle;
			}
			$value = (!$showtitle ? '' : "\n<{$args->titletag}>$title</{$args->titletag}>\n");
			$id = (empty($args->id) ? '' : ' id="' . $args->id . '"');
			$value =<<<HTML
<div$id class="$class">$value
{$page->post_content}
</div>
HTML;
		}
		return $value;
	}
}