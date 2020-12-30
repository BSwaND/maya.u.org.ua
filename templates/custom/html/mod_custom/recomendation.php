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
	$notIdCategory = 18;

	include(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');
	$query->where($db->quoteName('c.state') . ' = 1' );
	$query->andWhere($db->quoteName('c.id') . ' != ' . $notIdCategory );
	$query->andWhere($db->quoteName('c.state') . ' = 1' );
	$query->andWhere('recommendation.value = ' . 1);
	$query->group('id');
	$query->order($db->quoteName('c.publish_up'). 'DESC');
	$query->setLimit($set_limit);
	$db->setQuery($query);
	$product =  $db->loadObjectList();
	?>


<div class="recommend-objects mb110">
	<div class="container">
		<div class="flex between align-center bottom-line mb40">
			<p class="title medium"><b>Маия рекомендует</b></p>
			<a class="btn" href="/gallery/majya-rekomenduet/">Смотреть все предложения</a>
		</div>
		<div class="objects-slider recommend-objects-slider swiper-container mb60">
			<div class="swiper-wrapper">
				   <?php 	include(JPATH_BASE . '/templates/custom/html/mod_custom/_item-slider.php') ?>
			</div>
		</div>
		<div class="recommend-objects-pagination objects-slider-pagination">&nbsp;</div>
	</div>
</div>
