<?php

function basicwp_add_custom_metabox() {
	add_meta_box(
		'basciwp_meta',
		'Job Listing',
		'basicwp_meta_callback',
		'job'
	);
}
add_action('add_meta_boxes', 'basicwp_add_custom_metabox');

function basicwp_meta_callback($post) {
	wp_nonce_field(basename(__FILE__), 'basicwp_jobs_nonce');
	$basicwp_stored_meta = get_post_meta($post->ID);
?>
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="job_id" class="basicwp-row-title">Job ID</label>
				<div class="meta-td">
					<input type="text" name="job_id" id="job-id" value="<?php if ( ! empty ( $basicwp_stored_meta['job_id'] ) ) {
					echo esc_attr( $basicwp_stored_meta['job_id'][0] );
				} ?>">
				</div>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="date_listed" class="basicwp-row-title">Date Listed</label>
				<div class="meta-td">
					<input type="text" name="date_listed" id="date-listed" value="<?php if ( ! empty ( $basicwp_stored_meta['date_listed'] ) ) {
					echo esc_attr( $basicwp_stored_meta['date_listed'][0] );
				} ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="meta-row">
		<div class="meta-th">
			<span>Principle Duties</span>
		</div>
	</div>
	<div class="meta-editor">
		<?php
			$content = get_post_meta($post->ID, 'principle_duties', true);
			$editor = 'principle_duties';
			$settings = [
				'textarea_rows' => 8,
				'media_buttons' => false
			];
			wp_editor($content, $editor, $settings);
		?>
	</div>
<?php
}

function basicwp_meta_save($post_id) {
	$is_autosave = wp_is_post_autosave($post_id);
	$is_revision = wp_is_post_revision($post_id);
	$is_valid_nonce = ( isset( $_POST[ 'basicwp_jobs_nonce' ] ) && wp_verify_nonce( $_POST[ 'basicwp_jobs_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST[ 'job_id' ] ) ) {
    	update_post_meta( $post_id, 'job_id', sanitize_text_field( $_POST[ 'job_id' ] ) );
    }
    if ( isset( $_POST[ 'date_listed' ] ) ) {
    	update_post_meta( $post_id, 'date_listed', sanitize_text_field( $_POST[ 'date_listed' ] ) );
    }
    if ( isset( $_POST[ 'principle_duties' ] ) ) {
    	update_post_meta( $post_id, 'principle_duties', sanitize_text_field( $_POST[ 'principle_duties' ] ) );
    }
}
add_action('save_post', 'basicwp_meta_save');