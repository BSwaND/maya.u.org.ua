document.addEventListener("DOMContentLoaded", function () {

	function changeFilters()
	{
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
	}
	changeFilters();

	function addCompareProduct()
	{
		jQuery('.icon-balance-add').click(function (e){
			 e.preventDefault();
			let atrProduct = jQuery(this).attr('data-id-product');
			jQuery.ajax({
				type: 'POST',
				url: '/templates/custom/html/setSessionnCompare.php',
				data: {'dataIdProduct':atrProduct},
				success: function (q) {
					jQuery('.compare-box .counter').html(q)
					console.log(q)
				}
			})
		})


		
		jQuery('.compaire-del').click(function (){
			let arrId = 0;
			let thisId = jQuery(this).attr('data-id-product');
			let arrProduct = document.querySelectorAll('.compaire-del');

			arrProduct.forEach((el)=>{
				if(thisId != el.getAttribute('data-id-product')){
					if(arrId == 0){
						arrId = el.getAttribute('data-id-product');
					} else {
						arrId += ','+ el.getAttribute('data-id-product');
					}
				}
			})

			jQuery.ajax({
				type: 'POST',
				url: '/templates/custom/html/setSessionnCompare.php',
				data: {'dataIdProductDell': 1, 'dataIdProduct': arrId },
				success: function (q) {
					jQuery('.compare-box .counter').html(q)
					console.log(q)
					window.location.reload();
				}
			})
		})
	}
	addCompareProduct()

});
