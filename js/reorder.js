(function () {
	jQuery(document).ready(function($) {
		var sortList = $('#custom-type-list');
		var loading = $('#loading-animation');
		var pageTitle = $('#page-title');

		sortList.sortable({
			update: function(event, ui) {
				loading.show();
				

				$.ajax({
					url: ajaxurl,
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'save_post',
						order: sortList.sortable('toArray'),
						security: WP_JOB_LISTING.security
					},
					success: function(response) {
						loading.hide();
						$('#message').remove();

						if (response.success) {
							pageTitle.after('<div id="message" class="updated"><p>' + WP_JOB_LISTING.success_msg + '</p></div>');
						} else {
							pageTitle.after('<div id="message" class="error"><p>' + WP_JOB_LISTING.fail_msg + '</p></div>');
						}
					},
					error: function(error) {
						loading.hide();
						$('#message').remove();
						pageTitle.after('<div id="message" class="error"><p>' + WP_JOB_LISTING.fail_msg + '</p></div>');
					}
				});
			}
		});
	});
})();