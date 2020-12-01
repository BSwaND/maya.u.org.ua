<?php
	/**
	 * 
	 * @package     Joomla.Site
	 * @subpackage  com_content
	 *
	 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */

	defined('_JEXEC') or die;

	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/_head-article.php');

	$coordinates = 	explode(',' ,$this->item->jcfields[21]->value);
	$gallery_foto = json_decode($this->item->jcfields[29]->rawvalue);

	$mikrorajon = null;
	$mikrorajon = [$this->item->jcfields[6]->rawvalue[0] , $this->item->jcfields[7]->rawvalue[0] , $this->item->jcfields[8]->rawvalue[0] , $this->item->jcfields[9]->rawvalue[0] , $this->item->jcfields[10]->rawvalue[0] ];
	foreach( $mikrorajon as $key){  ($key != 0) ?  $mikrorajon = $key : null; }

	$document->this_id = $this->item->id;
	$document->parent_id = $mikrorajon;
	$document->type_nedviz = $this->item->jcfields[4]->rawvalue[0];
	$document->cat_parent_id = $this->item->parent_id;

?>
<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />

	<?= $this->item->event->afterDisplayTitle ?>
	<?= $this->item->event->beforeDisplayContent ?>

	<div class="main object-page">
		<div class="intro">
			<div class="container">
				<h1 class="title large white bottom-line centered mb25"><?= $this->item->title ?></h1>
				<div class="breadcrumbs">
					<?php
						$module = JModuleHelper::getModules('breadcrumbs');
						echo JModuleHelper::renderModule($module[0], $attribs);
					?>
				</div>
			</div>
		</div>

		<div class="bg-blue">
			<div class="container">
				<?php
					$module = JModuleHelper::getModules('filter');
					echo JModuleHelper::renderModule($module[0], $attribs);
				?>
			</div>
		</div>

		<div class="object-content bg-lightblue">
			<div class="container">
				<div class="info-block">
					<div class="slider-block">
						<div class="object-slider swiper-slider">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<a href="<?= (json_decode( $this->item->images)->image_intro) ? json_decode( $this->item->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>" data-fancybox="object-gallery">
										<img src="<?= (json_decode( $this->item->images)->image_intro) ? json_decode( $this->item->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>" alt="<?= $this->item->title ?>">
									</a>
								</div>
								<?php
									if($gallery_foto) {
										foreach ($gallery_foto as $item_foto => $value)		{	?>
											<div class="swiper-slide">
												<a href="<?= $value->foto ?>" data-fancybox="object-gallery"><img src="<?= $value->foto ?>" alt="<?= $this->item->title ?>"></a>
											</div>
										<?php	}	?>
									<?php	}	?>
							</div>
						</div>
						<div class="swiper-button-prev object-slider-prev"></div>
						<div class="swiper-button-next object-slider-next"></div>
					</div>
					<div class="content-block">
						<div class="flex align-center mb20">
							<span class="object-price color-orange">$  <?= $this->item->jcfields[12]->value ?></span>
							<div class=""><a  data-id-product="<?= $itemProduct->id ?>" class="icon-balance icon-balance-add"></a></div>

							<span class="object-year">
							<?php if($this->item->jcfields[28]->value) { ?>
								<?= $this->item->jcfields[28]->value ?> года постройки
							<?php }?>
							</span>

							<span class="object-id">ID  <?= $this->item->id ?></span>
						</div>
						<p class="object-address icon-pin mb30"> <?= $this->item->jcfields[18]->value ?></p>
						<ul class="parameters-list flex mb30">
							<?php if($this->item->jcfields[11]->value) { ?>
								<li class="icon-home">Площадь: <?= $this->item->jcfields[11]->value ?> м2</li>
							<?php }?>
							<?php if($this->item->jcfields[20]->value) { ?>
								<li class="icon-territory">Територия:  <?= $this->item->jcfields[20]->value ?> соток</li>
							<?php }?>
							<?php if($this->item->jcfields[13]->value) { ?>
								<li class="icon-bed">Комнат:  <?= $this->item->jcfields[13]->value ?></li>
							<?php }?>
							<?php if($this->item->jcfields[14]->value) { ?>
								<li class="icon-shower">Санузел:  <?= $this->item->jcfields[14]->value ?></li>
							<?php }?>
							<?php if($this->item->jcfields[19]->value) { ?>
								<li class="icon-floor">Этаж:  <?= $this->item->jcfields[19]->value ?></li>
							<?php }?>
						</ul>
						<div class="object-description mb20">
							<p><b>Описание обьекта:</b></p>
							<?= $this->item->text ?>
						</div>
						<div class="object-contacts flex">
						<?php
							$idUser = $this->item->jcfields[32]->rawvalue;
							if($idUser)
							{
								include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_getUserData.php'); ?>

							<div class="contact-item">
								<p class="contact-person mb20">Ведущий риелтор: <span class="name"><?= $userFild[35]->value ?></span> </p>
								<div class="flex align-center">
									<a href="#" class="btn">Задайте вопрос риелтору</a>
									<a href="#" class="contact-tel icon-tel color-orange"><?= $userFild[36]->value ?></a>
								</div>
							</div>
							<div class="contact-item">
								<p class="contact-person mb20">Ведущий риелтор: <span class="name"><?= $userFild[33]->value ?></span> </p>
								<div class="flex align-center">
									<a href="#" class="btn">Задайте вопрос риелтору</a>
									<a href="#" class="contact-tel icon-tel color-orange"><?= $userFild[34]->value ?></a>
								</div>
							</div>
						<?php	}	?>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->item->event->afterDisplayContent ?>


<div class="map-block">
	<div class="container">
		<h2 class="title medium centered bottom-line mb60"><b>Обьект</b> на карте</h2>
	</div>
	<div class="map-box">
		<div id="map"></div>
	</div>
</div>

<?php
	$module = JModuleHelper::getModules('nearby-object');
	echo JModuleHelper::renderModule($module[0], $attribs);
?>
<?php
	$module = JModuleHelper::getModules('like-object');
	echo JModuleHelper::renderModule($module[0], $attribs);
?>

<?php
	$module = JModuleHelper::getModules('expert-block');
	echo JModuleHelper::renderModule($module[0], $attribs);
?>

<div class="container">
	<?php
		$module = JModuleHelper::getModules('subscribe-block');
		echo JModuleHelper::renderModule($module[0], $attribs);
	?>
</div>


<script>
	function initMap() {
		var element = document.getElementById('map');
		var options = {
			zoom: 15,
			center: {lat: <?= $coordinates[0]?>, lng: <?= $coordinates[1]?>},
		};

		var myMap = new google.maps.Map(element, options);

		var markers = [
			{
				coordinates: {lat: <?= $coordinates[0]?>, lng: <?= $coordinates[1]?>},
				info: '<h3><?= $this->item->title ?></h3><br><img src="<?= (json_decode( $this->item->images)->image_intro) ? json_decode( $this->item->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>"><br><p> <?= $this->item->jcfields[18]->value ?></p>'
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
