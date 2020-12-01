<?php

	defined('_JEXEC') or die;
?>

<?php	foreach ($product as $itemProduct)	{  ?>
	<div class="swiper-slide">
		<div class="item"><span class="object-type"><?= $itemProduct->cat_title ?></span>
			<div class="item-wrapper">
				<div class="img-box"><img class="item-image" src="<?= (json_decode($itemProduct->images)->image_intro) ? json_decode($itemProduct->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>" alt="<?= $itemProduct->title ?>" />
					<span class="object-price color-orange">$ <?= $itemProduct->tsena_field_value ?></span>
					<a  data-id-product="<?= $itemProduct->id ?>" class="icon-balance icon-balance-add"></a>
				</div>
				<div class="info">
					<p class="icon-pin mb15"><b><?= $itemProduct->adres_field_value ?></b></p>
					<p class="mb15"><?= mb_substr(strip_tags($itemProduct->introtext), 0, 200, 'UTF-8') ?></p>
					<div class="flex between">
						<span class="caption">Площадь: <?= $itemProduct->pls_obshchaya_m_field_value ?> м²</span>
						<span class="caption">Этажей: <?= $itemProduct->etaz_field_value ?><?= ($itemProduct->etazhnost_zdn_field_value) ? '/'. $itemProduct->etazhnost_zdn_field_value : null ?></span>
					</div>
				</div>
				<div class="btn-box flex between align-center">
					<a class="btn" href="<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>">Смотреть</a>
					<?php if($itemProduct->iframe_map_value) {?>
					<a class="show-map color-orange">На карте</a>
					<?php	}	?>
				</div>
				<div class="map-box"><?= $itemProduct->iframe_map_value ?></div>
			</div>
		</div>
	</div>
<?php	}	?>

