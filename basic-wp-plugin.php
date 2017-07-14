<?php

/**
 * Plugin Name: Basic WP Plugin
 * Description: A plugin for creating and displaying job opportunities. Plugin based on Develop With WP Youtube course (https://www.youtube.com/playlist?list=PLIjMj0-5C8TI7Jwell1rTvv5XXyrbKDcy)
 * Author: rraulg5
 * Author URI: http://raulgarcia.mx
 * Version: 0.1
 * License: GPLv2
 */

function basicwp_remove_dashboard_widget() {
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
}

add_action('wp_dashboard_setup', 'basicwp_remove_dashboard_widget');

function basicwp_add_google_link() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu([
		'id' => 'google_analytics',
		'title' => 'Google Analytics',
		'href' => 'http://google.com/analytics',
	]);	
}

add_action('wp_before_admin_bar_render', 'basicwp_add_google_link');