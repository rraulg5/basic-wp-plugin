<?php

function basicwp_add_custom_metabox() {
	add_meta_box(
		'basciwp_meta',
		'Job Listing',
		'basicwp_meta_callback',
		'job',
		'side'
	);
}
add_action('add_meta_boxes', 'basicwp_add_custom_metabox');