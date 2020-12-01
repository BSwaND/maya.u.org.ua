<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  mod_custom
	 *
	 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */

	defined('_JEXEC') or die;

	$app  = JFactory::getApplication();
	$document = JFactory::getDocument();

	include(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');
	$query->where($db->quoteName('c.state') . ' = 1' );

	$query->andWhere('cat.parent_id = ' . 8);
	$query->orWhere('cat.parent_id = ' . 9);

	$query->group('id');
	$query->setLimit(1000);
	$db->setQuery($query);
	$product =  $db->loadObjectList();

	?>

<div class="map-block">
	<div class="container">
		<p class="title medium centered bottom-line mb45">Недвижимость Одессы на карте города</p>
	</div>
	<div class="map-box">
		<div id="map-main-page"></div>
	</div>
</div>

<script>
	function initMap() {
		var element = document.getElementById('map-main-page');
		var options = {
			zoom: 12,
			center: {lat: 46.468982, lng: 30.740729 	},
			styles:		[
				{
					"featureType": "administrative",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#444444"
						}
					]
				},
				{
					"featureType": "landscape",
					"elementType": "all",
					"stylers": [
						{
							"color": "#f2f2f2"
						}
					]
				},
				{
					"featureType": "poi",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "road",
					"elementType": "all",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"lightness": 45
						}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "simplified"
						}
					]
				},
				{
					"featureType": "road.arterial",
					"elementType": "labels.icon",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "transit",
					"elementType": "all",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "water",
					"elementType": "all",
					"stylers": [
						{
							"color": "#aaaacb"
						},
						{
							"visibility": "on"
						}
					]
				}
			]
		};

		var myMap = new google.maps.Map(element, options);

		var markers = [
				<?php  foreach ($product as $itemProduct)	  {
					  $coordinates = 	explode(',' , $itemProduct->koordinaty_field_value); ?>
			{
				coordinates: {lat: <?= $coordinates[0] ?>, lng: <?= $coordinates[1] ?>},
				info: '<h3><?=  $itemProduct->title ?></h3><br><img src="<?= (json_decode($itemProduct->images)->image_intro) ? json_decode($itemProduct->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>"><br><p> <?=  $itemProduct->adres_field_value?></p>'
			},
				<?php  }?>
		];

		for(var i = 0; i < markers.length; i++) {
			addMarker(markers[i]);
		}

		function addMarker(properties) {
			var marker = new google.maps.Marker({
				position: properties.coordinates,
				map: myMap
			});

			if(properties.image) {
				marker.setIcon(properties.image);
			}

			if(properties.info) {
				var InfoWindow = new google.maps.InfoWindow({
					content: properties.info
				});

				marker.addListener('click', function(){
					InfoWindow.open(myMap, marker);
				});
			}
		}
	}
</script>



