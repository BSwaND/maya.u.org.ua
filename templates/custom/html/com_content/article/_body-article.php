<?php
	defined('_JEXEC') or die;
	?>

<div class="item-page <?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />

	<?= $this->item->event->afterDisplayTitle ?>
	<?= $this->item->event->beforeDisplayContent ?>

	<div class="main object-page">
		<div class="intro">
			<div class="container">
				<h1 class="title large white bottom-line centered mb25">
					<?= $this->item->title ?>
					<?= $this->get('category')->title ?>
				</h1>
				<div class="breadcrumbs">
					<?php
						$module = JModuleHelper::getModules('breadcrumbs');
						echo JModuleHelper::renderModule($module[0], $attribs);
					?>
				</div>
			</div>
		</div>
	</div>

	<?= $this->item->text ?>

	<div class="bg-blue">
		<div class="container">
			<?php
				$module = JModuleHelper::getModules('filter');
				echo JModuleHelper::renderModule($module[0], $attribs);
			?>
		</div>
	</div>
	
	<div class="region-objects-block mb110">
		<div class="container">
			<div class="flex between align-center bottom-line mb30">
				<p class="title medium mb15">
					<?php
						if($this->item->id == 4)
						{
							echo 'Поиск';
						} else {
							echo 'Купить недвижимость - ' . $this->item->title . $this->get('category')->title ;
						}
					?>
				</p>
				<div class="filters flex align-center mb15">
					<span class="counter">Найдено - <?= count($product) ?> объектов</span>
					<div class="select quantity-select" id="quantity-select">
						<div class="select-title"><?= $_POST['set_limit'] ? $_POST['set_limit'] : 8 ?></div>
						<div class="select-content">
							<label class="select-label">8 <input class="select-input" type="radio"  value="8"  <?= $_POST['set_limit'] == 8 ? 'checked' : null ?> /></label>
							<label class="select-label">12<input class="select-input" type="radio"  value="12" <?= $_POST['set_limit'] == 12 ? 'checked' : null ?>/></label>
							<label class="select-label">16<input class="select-input" type="radio"  value="16" <?= $_POST['set_limit'] == 16 ? 'checked' : null ?>/></label>
						</div>
					</div>
					<div class="select sort-select" id="order-sort-select">
						<div class="select-title">
							<?php
								switch ($_POST['order_sort']){
									case 1:
										echo  'Последние добавленные';
										break;
									case 2:
										echo  'Цена по возрастанию';
										break;
									case 3:
										echo  'Цена по убыванию';
										break;
									default:
										echo 'Последние добавленные';
								}
							?>
						</div>
						<div class="select-content">
							<label class="select-label">Последние добавленные<input class="select-input" type="radio" name="Сортировка"  value="1" <?= $_POST['order_sort'] == 1 ? 'checked' : null ?> /></label>
							<label class="select-label">Цена по возрастанию<input class="select-input" type="radio" name="Сортировка" value="2"  <?= $_POST['order_sort'] == 2 ? 'checked' : null ?> /></label>
							<label class="select-label">Цена по убыванию<input class="select-input" type="radio" name="Сортировка" value="3"  <?= $_POST['order_sort'] == 6 ? 'checked' : null ?> /></label>
						</div>
					</div>
				</div>

			</div>
			<div class="region-objects objects-slider flex mb60">
				<?php	foreach ($product as $itemProduct ) {	?>
					<div class="item">
						<span class="object-type"><?= $itemProduct->cat_title ?></span>
						<div class="item-wrapper">

							<div class="img-box">
								<img src="<?= (json_decode($itemProduct->images)->image_intro) ? json_decode($itemProduct->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>" alt="<?= $itemProduct->title ?>" class="item-image">
								<span class="object-price color-orange">$  <?= $itemProduct->tsena_field_value ?></span>
							</div>
							<div class="info">
								<p class="icon-pin mb15"><b><?= $itemProduct->adres_field_value ?></b></p>
								<p class="mb15"><?= mb_substr(strip_tags($itemProduct->introtext), 0, 200, 'UTF-8') ?></p>
								<div class="flex between"><span class="caption">Площадь: <?= $itemProduct->pls_obshchaya_m_field_value ?> м²</span><span class="caption">Этажей: <?= $itemProduct->etaz_field_value ?><?= ($itemProduct->etazhnost_zdn_field_value) ? '/'. $itemProduct->etazhnost_zdn_field_value : null ?></span></div>
							</div>
							<div class="btn-box flex between align-center">
								<a href="<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>" class="btn" >Смотреть</a>
								<a href="#" class="show-map color-orange">На карте</a>
								<div class="" style="background: #eee; font-size: 10px; padding: 10px;">
									<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>	
								</div>
							</div>
							<!--							<div class="map-box"><img src="/images/map-card.jpg" alt=""></div> AIzaSyDBk7HP0J_IedREXBBmWhqlQ8tD90LfQLI -->
							<div class="map-box" id="map-box_<?= $itemProduct->id ?>">	</div>
							<script>
								function initMap<?= $itemProduct->id ?>() {
									let element = document.getElementById('map-box_<?= $itemProduct->id ?>');
									let options = {
										zoom: 5,
										center: {lat: 55.7558, lng: 37.6173},
									};

									let myMap = new google.maps.Map(element, options);

									let markers = [
										{
											coordinates: {lat: 55.751956, lng: 37.622634},
											info: '<h3>Москва</h3><br><img src="https://placehold.it/200x150"><br><p>Описание</p>'
										}
									];

									for(let i = 0; i < markers.length; i++) {
										addMarker(markers[i]);
									}

									function addMarker(properties) {
										let marker = new google.maps.Marker({
											position: properties.coordinates,
											map: myMap
										});

										if(properties.image) {
											marker.setIcon(properties.image);
										}

										if(properties.info) {
											let InfoWindow = new google.maps.InfoWindow({
												content: properties.info
											});

											marker.addListener('click', function(){
												InfoWindow.open(myMap, marker);
											});
										}
									}
								}
							</script>
							<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD05yH55GKkhSphg8Fz8OIueKEp-kq_hkg&callback=initMap<?= $itemProduct->id ?>"></script>
						</div>
					</div>
				<?php }	?>
			</div>
		</div>
	</div>
	<?= $this->item->event->afterDisplayContent ?>
</div>
