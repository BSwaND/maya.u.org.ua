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
	$query->andWhere($db->quoteName('c.id') . ' != ' . $notIdCategory );
	$query->andWhere($db->quoteName('c.state') . ' = 1' );
	$query->andWhere('goryachij_obekt.value = ' . 1);
	$query->group('id');
	$query->order($db->quoteName('c.publish_up'). 'DESC');
	$query->setLimit($set_limit);
	$db->setQuery($query);
	$product =  $db->loadObjectList();
	?>

<div class="hot-offers mb110">
	<div class="container">
		<div class="flex between align-center bottom-line mb40">
			<p class="title medium"><b>Горячие предложения</b></p>
			<a class="btn" href="/gallery/goryachie/">Смотреть все предложения</a>
		</div>
		<div class="objects-slider hot-objects-slider swiper-container mb60">
			<div class="swiper-wrapper">
				<?php 	include(JPATH_BASE . '/templates/custom/html/mod_custom/_item-slider.php'); ?>
			</div>
		</div>
		<div class="hot-objects-pagination objects-slider-pagination">&nbsp;</div>
	</div>
</div>