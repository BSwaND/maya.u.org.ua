<?php
	defined('_JEXEC') or die;
	$session = JFactory::getSession();
	?>

<form method="get" id="order-sort-form" action="<?= JFactory::getURI()->toString()  ?>">
	<input type="hidden" name="set_limit" value="<?= $set_limit ?>">
	<input type="hidden" name="order_sort" value="<?= ($_GET['order_sort']) ? $_GET['order_sort'] : 8 ?>">
</form>

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
					<span class="counter">Найдено - <?= (int)$allRows ?> объектов</span>
					<div class="select quantity-select" id="quantity-select">
						<div class="select-title"><?= $_GET['set_limit'] ? $_GET['set_limit'] : 8 ?></div>
						<div class="select-content">
							<label class="select-label">8 <input class="select-input" type="radio"  value="8"  <?= $_GET['set_limit'] == 1 ? 'checked' : null ?> /></label>
							<label class="select-label">12<input class="select-input" type="radio"  value="12" <?= $_GET['set_limit'] == 12 ? 'checked' : null ?>/></label>
							<label class="select-label">16<input class="select-input" type="radio"  value="16" <?= $_GET['set_limit'] == 16 ? 'checked' : null ?>/></label>
						</div>
					</div>
					<div class="select sort-select" id="order-sort-select">
						<div class="select-title">
							<?php
								switch ($_GET['order_sort']){
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
							<label class="select-label">Последние добавленные<input class="select-input" type="radio" name="Сортировка"  value="1" <?= $_GET['order_sort'] == 1 ? 'checked' : null ?> /></label>
							<label class="select-label">Цена по возрастанию<input class="select-input" type="radio" name="Сортировка" value="2"  <?= $_GET['order_sort'] == 2 ? 'checked' : null ?> /></label>
							<label class="select-label">Цена по убыванию<input class="select-input" type="radio" name="Сортировка" value="3"  <?= $_GET['order_sort'] == 6 ? 'checked' : null ?> /></label>
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
								<div class=""><a  data-id-product="<?= $itemProduct->id ?>" class="icon-balance icon-balance-add"></a></div>
							</div>
							<div class="info">
								<p class="icon-pin mb15"><b><?= $itemProduct->adres_field_value ?></b></p>
								<p class="mb15"><?= mb_substr(strip_tags($itemProduct->introtext), 0, 200, 'UTF-8') ?></p>
								<div class="flex between"><span class="caption">Площадь: <?= $itemProduct->pls_obshchaya_m_field_value ?> м²</span>
									<span class="caption">Этажей: <?= $itemProduct->etaz_field_value ?><?= ($itemProduct->etazhnost_zdn_field_value) ? '/'. $itemProduct->etazhnost_zdn_field_value : null ?></span>
								</div>
							</div>
							<div class="btn-box flex between align-center">
								<a href="<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>" class="btn" >Смотреть</a>
							<?php if($itemProduct->iframe_map_value) {?>
								<a class="show-map color-orange">На карте</a>
							<?php } ?>
							</div>
							<div class="map-box" ><?= $itemProduct->iframe_map_value ?></div>
						</div>
					</div>
				<?php }	?>
			</div>
		</div>
	</div>
	<?= $this->item->event->afterDisplayContent ?>
</div>

<?php
	echo $pageNav->getPagesLinks();
?>

	<div class="container">
		<?php
			$module = JModuleHelper::getModules('subscribe-block');
			echo JModuleHelper::renderModule($module[0], $attribs);
		?>
	</div>

<?php
	$module = JModuleHelper::getModules('expert-block');
	echo JModuleHelper::renderModule($module[0], $attribs);
?>

	
 <?php

/*
<script>
	function initMapMainPage() {

		var myOptions =
			{
				zoom: 5,
				center: {lat: 55.751956, lng: 37.622634},
			};

		var myOptions2 =
			{
				zoom: 5,
				center: {lat: 55.751956, lng: 37.622634},
			};


		var map = new google.maps.Map(document.getElementById("map-box"), myOptions);

		var map2 = new google.maps.Map(document.getElementById("map_canvas_2"), myOptions2);


		var myMarker = new google.maps.Marker(
			{
				position: {lat: 55.751956, lng: 37.622634},
				map: map,
			});
		var myMarker2 = new google.maps.Marker(
			{
				position: {lat: 55.751956, lng: 37.622634},
				map: map2,
			});


	}
</script>
<!--							<script async defer  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD05yH55GKkhSphg8Fz8OIueKEp-kq_hkg&callback=initMap--><?//= $itemProduct->id ?><!--"></script>-->

		 */

