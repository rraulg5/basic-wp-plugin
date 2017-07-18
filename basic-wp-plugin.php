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

	if ($typenow == 'job') {
		wp_enqueue_style('basicwp-admin-css', plugins_url('css/admin-jobs.css', __FILE__));
	}

	if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'job') {
		wp_enqueue_script('basicwp-admin-js', plugins_url('js/admin-jobs.js', __FILE__), array('jquery', 'jquery-ui-datepicker'), '20170717', true);
		wp_enqueue_script( 'basicwp-custom-quicktags', plugins_url( 'js/basicwp-quicktags.js', __FILE__ ), array( 'quicktags' ), '20170717', true );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
	}

	if ($pagenow == 'edit.php' && $typenow == 'job') {
		wp_enqueue_script('reorder-js', plugins_url('js/reorder.js', __FILE__), array('jquery', 'jquery-ui-sortable'), '20170718', true);
	}
}
add_action('admin_enqueue_scripts', 'basicwp_admin_enqueue_scripts');
