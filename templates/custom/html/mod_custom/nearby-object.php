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

	$mikrorajon = (int)$document->parent_id;
	$type_nedviz =  (int)$document->type_nedviz;
	$this_id_article =  (int)$document->this_id;
	$cat_parent_id =  (int)$document->cat_parent_id;

	$set_limit = 12;
	$notIdCategory = 15;

	include(JPATH_BASE . '/templates/custom/html/com_content/article/model/_select_product.php');
	$query->where($db->quoteName('c.state') . ' = 1' );

	if($mikrorajon)
	{
		$query->andWhere([
			'mik_kievskij.value = ' . $mikrorajon,
			'mik_malinovskij.value = ' . $mikrorajon,
			'mik_ovidiopolskij.value = ' . $mikrorajon,
			'mik_primorskij.value = ' . $mikrorajon,
			'mik_suvorovskij.value = ' . $mikrorajon,
		]);
	}
//	$query->andWhere('type.value = ' . $type_nedviz);

	$query->andWhere('c.id != ' . $this_id_article);
	$query->andWhere('cat.parent_id = ' . $cat_parent_id);



	$query->group('id');
	$query->setLimit($set_limit);
	$db->setQuery($query);
	$product =  $db->loadObjectList();
?>

<div class="hot-offers mb110">
	<div class="container">
		<div class="flex between align-center bottom-line mb40">
			<p class="title medium"><b>Объекты рядом</b></p>
		</div>
		<div class="objects-slider nearby-objects-slider swiper-container mb60">
			<div class="swiper-wrapper">
				<?php 	include(JPATH_BASE . '/templates/custom/html/mod_custom/_item-slider.php'); ?>
			</div>
		</div>
		<div class="hot-objects-pagination objects-slider-pagination">&nbsp;</div>
	</div>
</div>