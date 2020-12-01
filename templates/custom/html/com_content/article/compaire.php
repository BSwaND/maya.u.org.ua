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
<div class="container">

	<?php
		if($product){
			foreach ($product as $itemProduct){     ?>
				<div class="item" style="border: 1px solid #ccc">
					<span class=""> id = <?= $itemProduct->id ?></span>  <a class="compaire-del" data-id-product="<?= $itemProduct->id ?>">x</a>
					<p class="object-type"><?= $itemProduct->title ?></p>
					<a href="<?= JRoute::_(ContentHelperRoute::getCategoryRoute($itemProduct->catid)) .'/'. $itemProduct->alias  ?>" class="btn" >Смотреть</a>
				</div>
			<?php } ?>
		<?php } ?>


	<?php
		//	print_r($arrIdProduct);
		//
		//	echo '<pre>';
		//	print_r($product);
		//	echo '</pre>';
		//	?>


	<?php
		$module = JModuleHelper::getModules('subscribe-block');
		echo JModuleHelper::renderModule($module[0], $attribs);
	?>
</div>