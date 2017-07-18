<?php

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

function basicwp_reorder_admin_jobs_callback() {

	$args = array(
		'post_type'					=>	'job',
		'orderby'					=>	'menu_order',
		'order'						=>	'ASC',
		'no_found_rows'				=>	true,
		'update_post_term_cache'	=>	false,
		'post_per_page'				=>	50
	);

	$job_listing = new WP_Query($args);
	echo '<pre>';
	var_dump($job_listing);
	echo '</pre>';
}