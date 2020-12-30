<?php

	defined('_JEXEC') or die;
?>

<?php	foreach ($product as $itemProduct)	{  ?>

	<div class="swiper-slide">
		<div class="item"><span class="object-type"><?= $itemProduct->cat_title ?></span>
			<div class="item-wrapper">
				<a class="img-box" href="<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>">
					<img class="item-image" src="<?= (json_decode($itemProduct->images)->image_fulltext) ? json_decode($itemProduct->images)->image_fulltext : '/templates/custom/icon/joomla-logo.png' ?>" alt="<?= $itemProduct->title ?>" />
					<span class="object-price color-orange"><?=  number_format($itemProduct->tsena_field_value, 0, ',', ' ')  ?> <?= $itemProduct->valuta_value ?></span>
					
				</a>
				<div class="info">
					<div class="flex between align-center mb15">
						<p class="icon-pin"><b><?= $itemProduct->adres_field_value ?></b></p>
						<a data-id-product="<?= $itemProduct->id ?>" class="icon-balance icon-balance-add"></a>
					</div>					
					<p class="introtext mb15"><?= mb_strimwidth(strip_tags($itemProduct->introtext), 0, 150, '...') ?></p>
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

