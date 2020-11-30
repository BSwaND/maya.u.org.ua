document.addEventListener("DOMContentLoaded", function () {

	function changeFilters() {
		if(location.pathname != '/poisk')
		{
			jQuery('#quantity-select input').change(function () {
				jQuery('#order-sort-form input[name=set_limit]').val(jQuery(this).val());
				jQuery('#order-sort-form').submit();
			});
			jQuery('#order-sort-select input').change(function () {
				jQuery('#order-sort-form input[name=order_sort]').val(jQuery(this).val());
				jQuery('#order-sort-form').submit();
			});
		} else {
			jQuery('#quantity-select input').change(function () {
				jQuery('.filter-form input[name=set_limit]').val(jQuery(this).val());
				jQuery('.filter-form').submit()
			});
			jQuery('#order-sort-select input').change(function () {
				jQuery('.filter-form input[name=order_sort]').val(jQuery(this).val());
				jQuery('.filter-form').submit()
			});
		}
	} changeFilters();




});
