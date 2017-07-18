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
						order: sortList.sortable('toArray').toString()
					},
					success: function(response) {
						loading.hide();
						pageTitle.after('<div class="updated"><p>Jobs sort order has been saved!</p></div>');
					},
					error: function(error) {
						pageTitle.after('<div class="error"><p>There was an error saving the sort order</p></div>');
					}
				});
			}
		});
	});
})();