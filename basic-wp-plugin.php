<?php

/**
 * Plugin Name: Basic WP Plugin
 * Description: A plugin for creating and displaying job opportunities. Plugin based on Develop With WP Youtube course (https://www.youtube.com/playlist?list=PLIjMj0-5C8TI7Jwell1rTvv5XXyrbKDcy)
 * Author: rraulg5
 * Author URI: http://raulgarcia.mx
 * Version: 0.1
 * License: GPLv2
 */

//Exit if accessed directly
if (! defined('ABSPATH')) {
	exit;
}

function basicwp_register_post_type() {

	$singular = 'Job';
	$plural = 'Jobs';

	$labels = [
		'name' 					=>	$plural,
		'singular_name' 		=>	$singular,
		'add_name' 				=>	'Add New',
		'add_new_item' 			=>	'Add New ' . $singular,
		'edit' 					=>	'Edit',
		'edit_item' 			=>	'Edit ' . $singular,
		'new_item' 				=>	'New ' . $singular,
		'view' 					=>	'View ' . $singular,
		'view_item' 			=>	'View ' . $singular,
		'search_term' 			=>	'Search ' . $plural,
		'parent' 				=>	'Parent ' . $singular,
		'not_found' 			=>	'No ' . $plural . ' found',
		'not_found_in_trash' 	=>	'No ' . $plural . ' in Trash'
	];

	$args = [
		'labels'				=>	$labels,
		'public'				=>	true,
		'publicly_queryable'	=>	true,
		'exclude_from_search'	=>	false,
		'show_in_nav_menus'		=>	true,
		'show_ui'				=>	true,
		'show_in_menu'			=>	true,
		'show_in_admin_bar'		=>	true,
		'menu_position'			=>	10,
		'menu_icon'				=>	'dashicons-businessman',
		'can_export'			=>	true,
		'delete_with_user'		=>	false,
		'hierarchical'			=>	false,
		'has_archive'			=>	true,
		'query_var'				=>	true,
		'capability_type'		=>	'post',
		'map_meta_cap'			=>	true,
		'rewrite' 				=>	[
			'slug' => 'jobs',
			'with_font' => true,
			'pages' => true,
			'feeds' => false
		],
		'supports'				=>	[
			'title',
			'editor',
			'author',
			'custom-fields'
		],
	];
	register_post_type('job', $args);
}
add_action('init', 'basicwp_register_post_type');