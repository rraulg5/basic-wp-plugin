<?php

/**
 * Plugin Name: Basic WP Plugin
 * Description: A plugin for creating and displaying job opportunities. Plugin based on Develop With WP Youtube course (https://www.youtube.com/playlist?list=PLIjMj0-5C8TI7Jwell1rTvv5XXyrbKDcy)
 * Author: rraulg5
 * Author URI: http://raulgarcia.mx
 * Version: 0.1
 * License: GPLv2
 */

/*Exit if accessed directly*/
if (! defined('ABSPATH')) {
	exit;
}

/*Register Custom Post Type*/
require ( plugin_dir_path(__FILE__) . 'basic-wp-cpt.php');
require ( plugin_dir_path(__FILE__) . 'basic-wp-render-admin.php');
require ( plugin_dir_path(__FILE__) . 'basic-wp-fields.php');

function basicwp_admin_enqueue_scripts() {
	global $pagenow, $typenow;

	if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'job') {
		wp_enqueue_style('basicwp-admin-css', plugins_url('css/admin-jobs.css', __FILE__));
		wp_enqueue_script('basicwp-admin-js', plugins_url('js/admin-jobs.js', __FILE__), array('jquery', 'jquery-ui-datepicker'), '20170717', true);

		wp_enqueue_script( 'basicwp-custom-quicktags', plugins_url( 'js/basicwp-quicktags.js', __FILE__ ), array( 'quicktags' ), '20150206', true );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
	}
}
add_action('admin_enqueue_scripts', 'basicwp_admin_enqueue_scripts');

function basicwp_add_submenu_page() {
	add_submenu_page(
		'edit.php?post_type=job',
		'Reorder Jobs',
		'Reorder Jobs',
		'manage_options',
		'reorder_jobs',
		'basicwp_reorder_admin_jobs_callback'
	);
}
add_action('admin_menu', 'basicwp_add_submenu_page');