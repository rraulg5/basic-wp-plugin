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

function basicwp_meta_callback() {
?>
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="job-id" class="dwwp-row-title">Job ID</label>
				<div class="meta-td">
					<input type="text" name="job-id" id="job-id" value="">
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