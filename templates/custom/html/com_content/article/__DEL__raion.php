<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  com_content
	 *
	 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */

	defined('_JEXEC') or die;

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/_head-article.php');
	?>

<?= $this->item->event->afterDisplayTitle ?>
<?= $this->item->event->beforeDisplayContent ?>
<?= $this->item->text ?>
<?= $this->item->event->afterDisplayContent ?>

сохранение

<style>
	#map {width:100%; height:600px;}
</style>

<div id="map"></div>

<script>
	function initMap() {
		var element = document.getElementById('map');
		var options = {
			zoom: 5,
			center: {lat: 55.7558, lng: 37.6173},
		};

		var myMap = new google.maps.Map(element, options);

		var markers = [
			{
				coordinates: {lat: 55.751956, lng: 37.622634},
				info: '<h3>Москва</h3><br><img src="https://placehold.it/200x150"><br><p>Описание</p>'
			},
			{
				coordinates: {lat: 59.940208, lng: 30.328092},
				info: '<h3>Санкт-Петербург</h3><br> <img src="https://placehold.it/200x150"><br><p>Описание</p>'
			},
			{
				coordinates: {lat: 50.449973, lng: 30.524911},
				info: '<h3>Киев</h3><br><img src="https://placehold.it/200x150"><br><p>Описание</p>'
			} ,
			{
				coordinates: {lat: 50.449974, lng: 30.524912},
				info: '<h3>Киев</h3><br><img src="https://placehold.it/200x150"><br><p>Описание</p>'
			}
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
