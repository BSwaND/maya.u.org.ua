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
<dl class="search-results row <?php echo $this->pageclass_sfx; ?>">
<?php foreach ($this->results as $result) : ?>
	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	<div class="item">
		<div style="display: none;"></div>
		<dt class="result-title">
			<?php //echo $this->pagination->limitstart + $result->count . '. '; ?>
			<?php if ($result->href) : ?>
				<a class="title small" href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) : ?> target="_blank"<?php endif; ?>>
					<?php // $result->title should not be escaped in this case, as it may ?>
					<?php // contain span HTML tags wrapping the searched terms, if present ?>
					<?php // in the title. ?>
					<?php echo $result->title;?>					
				</a>
				<a class="img-wrap" href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) : ?> target="_blank"<?php endif; ?>>
					<?php
					if( isset($result->images) && json_decode($result->images)->image_intro != '' ){
    				echo '<img src="'.json_decode($result->images)->image_intro.'" alt="image">';} else {echo '<img src="/images/logo_white.png" alt="logo">';}
					?>
				</a>
			<?php else : ?>
				<?php // see above comment: do not escape $result->title ?>
				<?php echo $result->title; ?>
			<?php endif; ?>
		</dt>
		<dd class="result-text">
			<?php echo $result->text; ?>
		</dd>
	</div>
	</div>
<?php endforeach; ?>
</dl>
<div class="pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
