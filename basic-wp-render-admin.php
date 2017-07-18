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
	?>
		<div id="job-sort" class="wrap">
			<div id="icon-job-admin" class="icon32"><br /></div>
			<h2>Sort Job Positions <img src="<?php echo esc_url(admin_url() . '/images/loading.gif') ?>" alt="loading"></h2>
			<?php if($job_listing->have_posts()) : ?>
				<p></p>
				<ul id="custom-type-list">
					<p><strong>Note:</strong> this only affects the Jobs listed using the shortcode functions</p>
					<?php while($job_listing->have_posts()) : $job_listing->the_post(); ?>
						<li data-id="<?php the_id(); ?>"><?php the_title(); ?></li>
					<?php endwhile; ?>
				</ul>
			<?php else: ?>
				<p>You have no Jobs to sort.</p>
			<?php endif; ?>
		</div>
	<?php
}