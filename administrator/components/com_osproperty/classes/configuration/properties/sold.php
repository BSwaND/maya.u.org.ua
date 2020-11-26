<?php 
/*------------------------------------------------------------------------
# sold.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2016 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die;

?>

<fieldset>
	<legend><?php echo JText::_('OS_MARKET_STATUS')?></legend>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('active_market_status', JText::_( 'OS_ACTIVATE_OS_MARKET_STATUS' ), JText::_('OS_ACTIVATE_OS_MARKET_STATUS_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php
			OspropertyConfiguration::showCheckboxfield('active_market_status',$configs['active_market_status']);
			?>
		</div>
	</div>
	<div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[active_market_status]' => '1')); ?>'>
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('market_statuses', JText::_( 'OS_SELECT_MARKET_STATUS' ), JText::_('OS_SELECT_MARKET_STATUS_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php
			$market_status = array();
			$market_status[0]->value = 1;
			$market_status[0]->text = JText::_('OS_SOLD');

			$market_status[1]->value = 2;
			$market_status[1]->text = JText::_('OS_CURRENT');

			$market_status[2]->value = 3;
			$market_status[2]->text = JText::_('OS_RENTED');

			$checkbox_market_status = array();
			if (isset($configs['market_status'])){
				$checkbox_market_status = explode(',',$configs['market_status']);
			}
			if($configs['use_sold'] == "1"){
				$checkbox_market_status[] = 1;
			}
			echo JHTML::_('select.genericlist',$market_status,'configuration[market_status][]','multiple class="chosen"','value','text',$checkbox_market_status);
			?>
		</div>
	</div>
</fieldset>

