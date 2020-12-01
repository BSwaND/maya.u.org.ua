<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  mod_custom
	 *
	 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */

	defined('_JEXEC') or die;

	$set_limit = 12;
	$notIdCategory = 15;

	include(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');
	$query->where($db->quoteName('c.state') . ' = 1' );
	$query->andWhere($db->quoteName('c.state') . ' = 1' );

	$query->andWhere('cat.parent_id = ' . 8);
	$query->orWhere('cat.parent_id = ' . 9);
	$query->order('c.publish_up DESC ');

	$query->group('id');
	$query->setLimit($set_limit);
	$db->setQuery($query);
	$product =  $db->loadObjectList();
?>

<div class="week-offer mb110">
	<div class="container">
		<p class="title medium centered bottom-line mb45"><b>Предложение недели</b></p>
		<div class="week-slider-block mb60">
			<div class="week-offer-slider swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ($product as $itemProduct){	?>
						<div class="swiper-slide">
							<div class="item">
								<div class="img-box"><img src="<?= (json_decode($itemProduct->images)->image_intro) ? json_decode($itemProduct->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>" alt="Предложение недели" />
									<p class="title medium white"><?= $itemProduct->cat_title ?></p>
									<?php // 	<p class="text white mb30">Доступна продажа и долгосрочная аренда!</p> ?>
								</div>
								<div class="content-wrapper">
									<p class="mb20"><b>Описание обьекта: </b></p>
									<div class="description mb15">
										<?= $itemProduct->introtext ?>
									</div>
									<p class="mb15"><b>Расположение:</b></p>
									<p class="address mb40"><?= $itemProduct->adres_field_value ?></p>
									<ul class="properties-list mb45">
										<?php if($itemProduct->pls_obshchaya_m_field_value) { ?>
											<li class="icon-home">Площадь: <?= $itemProduct->pls_obshchaya_m_field_value ?> м²</li>
										<?php } ?>
										<?php if($itemProduct->kol_sotok_field_value) { ?>
											<li class="icon-territory">Територия: <?= $itemProduct->kol_sotok_field_value  ?> соток</li>
										<?php } ?>
										<?php if($itemProduct->kol_komnat_field_value) { ?>
											<li class="icon-bed">Комнат: <?= $itemProduct->kol_komnat_field_value ?></li>
										<?php } ?>
										<?php if($itemProduct->kol_sanuzlov_field_value) { ?>
											<li class="icon-shower">Санузел: <?= $itemProduct->kol_sanuzlov_field_value ?></li>
										<?php } ?>
										<?php if($itemProduct->etaz_field_value) { ?>
											<li class="icon-floor">Этажей: <?= $itemProduct->etaz_field_value ?><?= ($itemProduct->etazhnost_zdn_field_value) ? '/'. $itemProduct->etazhnost_zdn_field_value : null ?></li>
										<?php } ?>
									</ul>
									<a class="btn" href="<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>">Познакомиться подробнее</a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="week-slider-prev swiper-button-prev">&nbsp;</div>
			<div class="week-slider-next swiper-button-next">&nbsp;</div>
		</div>
	</div>
</div>