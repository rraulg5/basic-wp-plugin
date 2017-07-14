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