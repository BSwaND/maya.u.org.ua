<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="search <?php echo $this->pageclass_sfx; ?>">
	<div class="main object-page">
		<div class="intro">
			<div class="container">
				<h1 class="title large white bottom-line centered mb25">
					Результаты поиска
				</h1>
			</div>
		</div>
	</div>
	<div class="filter-box mb110">
		<div class="container">
			<?php
				$module = JModuleHelper::getModules('filter');
				echo JModuleHelper::renderModule($module[0], $attribs);
			?>
		</div>
	</div>
	<div class="mb110">
		<div class="container">
			<?php if ($this->error == null && count($this->results) > 0) : ?>
				<?php echo $this->loadTemplate('results'); ?>
			<?php else : ?>
				<?php echo $this->loadTemplate('error'); ?>
			<?php endif; ?>		
		</div>
	</div>
	
</div>
