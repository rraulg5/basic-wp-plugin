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

	if (! isset($atts['location'])) {
		return '<p class="job-error">You must provide a location for this shortcode to work.</p>';
	}

	$atts = shortcode_atts(array(
		'title' => 'Current Job Openings in',
		'count' => 5,
		'location' => '',
		'pagination' => 'off'
	), $atts);

    $pagination = $atts['pagination'] == 'on' ? false: true;
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

    if ($jobs_by_location->have_posts()) :
    	$location = str_replace('-', ' ', $atts['location']);

    	$displayByLocation = '<div id="jobs-by-location">';
    	$displayByLocation.= '<h4>' . esc_html__($atts['title']) . '&nbsp;' . esc_html__(ucwords($location)) . '</h4>';
    	$displayByLocation.= '<ul>';

    	while ($jobs_by_location->have_posts()) : $jobs_by_location->the_post();
    		global $post;

    		$deadline = get_post_meta(get_the_ID(), 'application_deadline', true);
    		$title = get_the_title();
    		$slug = get_permalink();

    		$displayByLocation .= '<li class="job-listing">';
            $displayByLocation .= sprintf( '<a href="%s">%s</a>&nbsp&nbsp', esc_url( $slug ), esc_html__( $title ) );
            $displayByLocation .= '<span>' . esc_html( $deadline ) . '</span>';
            $displayByLocation .= '</li>';

    	endwhile;

    	$displayByLocation.= '</ul></div>';

    else:
        $displayByLocation = sprintf( __( '<p class="job-error">Sorry, no jobs listed in %s where found.</p>' ), esc_html__( ucwords( str_replace( '-', ' ', $atts[ 'location' ] ) ) ) );
    endif;

    wp_reset_postdata();

    if ($jobs_by_location->max_num_pages > 1 && is_page()) {
        $displayByLocation .= '<nav class="prev-next-posts">';
        $displayByLocation .= '<div class="nav-pervious">';
        $displayByLocation .= get_next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous' ), $jobs_by_location->max_num_pages );
        $displayByLocation .= '</div>';
        $displayByLocation .= '<div class="next-posts-link">';
        $displayByLocation .= get_previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>' ) );
        $displayByLocation .= '</div>';
        $displayByLocation .= '</nav>';
    }

    return $displayByLocation;
}
add_shortcode('jobs_by_location', 'basicwp_list_job_by_location');