<?php

function basicwp_job_taxonomy_list($atts, $content = null) {
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
add_shortcode('job_location_list', 'basicwp_job_taxonomy_list');

function basicwp_list_job_by_location($atts, $content = null) {
	$atts = shortcode_atts(array(
		'title' => 'Current Job Openings in',
		'count' => 5,
		'location' => '',
		'pagination' => false
	), $atts);

	$paged = get_query_var('paged') ? get_query_var('paged') : 1;

	$args = array(
        'post_type' 		=> 'job',
        'post_status'       => 'publish',
        'no_found_rows'     => $pagination,
        'posts_per_page'    => $atts[ 'count' ],
        'paged'			    => $paged,
        'tax_query' 		=> array(
            array(
                'taxonomy' => 'location',
                'field'    => 'slug',
                'terms'    => $atts[ 'location' ],
            ),
        )
    );

    $jobs_by_location = new WP_Query( $args );
    var_dump($jobs_by_location->get_posts());
}
add_shortcode('jobs_by_location', 'basicwp_list_job_by_location');