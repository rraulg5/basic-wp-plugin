<?php

function basicwp_sample_shortcode($atts, $content = null) {
	$atts = shortcode_atts(
		array(
			'title' => 'Default title',
			'src' => 'http://www.google.com'
		),
		$atts
	);

	$locations = get_terms('location');
	$displayList = '';

	if (! empty($locations) && ! is_wp_error($locations)) {
		$displayList.= '<div id="job-location-list">';
		$displayList.= '<h4>' . esc_html__($atts['title']) . '</h4>';
		$displayList.= '<ul>';

		foreach ($locations as $location) {
			$displayList.= '<li class="job-location"><a href="' . esc_url(get_term_link($location)) . '">' . esc_html__($location->name) . '</a></li>';
		}

		$displayList.= '</ul>';
		$displayList.= '</div>';
	}

	return $displayList;
}
add_shortcode('job_listing', 'basicwp_sample_shortcode');