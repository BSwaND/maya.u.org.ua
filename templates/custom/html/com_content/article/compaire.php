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
	include_once(JPATH_BASE . '/templates/custom/html/com_content/article/model/_result_compaire.php');
	    //var_dump( $session->get('dataIdProduct'));
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

</div>
<div class="compaire-results bg-lightblue padding-section mb110">
	<div class="container">
		<?php if($product): ?>
		<div class="flex results-box">			
			<div class="item properties">
				<div class="btn-box"><a href="#" class="btn">Очистить список</a></div>
				<span class="cell">Наименование объекта</span>
				<span class="cell">Стоимость</span>
				<span class="cell">Район города</span>
				<span class="cell">Улица</span>
				<span class="cell">Этаж</span>
				<span class="cell">Площадь участка, сот</span>
				<span class="cell">Общая площадь, м²</span>
				<span class="cell">Жилая, м²</span>
				<span class="cell">Кухня, м²</span>
				<span class="cell">Комнат, шт</span>
				<span class="cell">Санузлов, шт</span>


				<span class="cell">Состояние</span>
				<span class="cell">Особые характеристики</span>
			</div>
			<?php
			foreach ($product as $itemProduct){     ?>
				<div class="item">
					<div class="img-wrap">
						<a class="compaire-del" data-id-product="<?= $itemProduct->id ?>"></a>
						<img src="<?= (json_decode($itemProduct->images)->image_intro) ? json_decode($itemProduct->images)->image_intro : '/templates/custom/icon/joomla-logo.png' ?>" alt="<?= $itemProduct->title ?>" class="item-image">
					</div>
					<span class="cell"><?= mb_strimwidth(strip_tags($itemProduct->title), 0, 32, '...') ?></span>
					<span class="cell"><?= $itemProduct->tsena_field_value ?></span>
					<span class="cell">Район</span>
					<span class="cell"><?= $itemProduct->adres_field_value ?></span>
					<span class="cell"><?= ($itemProduct->etazhnost_zdn_field_value) ? '/'. $itemProduct->etazhnost_zdn_field_value : null ?></span>
					<span class="cell">Площадь участка</span>
					<span class="cell"><?= $itemProduct->pls_obshchaya_m_field_value ?></span>
					<span class="cell">Жилая, м²</span>
					<span class="cell">Кухня, м²</span>
					<span class="cell">Комнат, шт</span>
					<span class="cell">Санузлов, шт</span>


					<span class="cell">Состояние</span>
					<span class="cell">Особые характеристики</span>
					<div class="btn-box">
						<a href="<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>" class="btn" >Смотреть</a>
					</div>
					
				</div>
			<?php } ?>
		</div>			
		<?php endif; ?>
	</div>		
</div>
<div class="container">
	<?php
		$module = JModuleHelper::getModules('subscribe-block');
		echo JModuleHelper::renderModule($module[0], $attribs);
	?>
</div>
		
</div>
</div>
