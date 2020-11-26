document.addEventListener("DOMContentLoaded", function () {

	function changeFilters() {
		jQuery('#quantity-select input').change(function () {
			jQuery('.filter-form input[name=set_limit]').val(jQuery(this).val());
			jQuery('.filter-form').submit()
		});
		jQuery('#order-sort-select input').change(function () {
			jQuery('.filter-form input[name=order_sort]').val(jQuery(this).val());
			jQuery('.filter-form').submit()
		});
	}
	changeFilters();


});
