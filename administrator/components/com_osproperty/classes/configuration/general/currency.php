<?php 
/*------------------------------------------------------------------------
# currency.php - Ossolution Property
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
	<legend><?php echo JTextOs::_('Currency Setting')?></legend>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_currency_default', JTextOs::_( 'Default currency' ), JTextOs::_('DEFAULT_CURRENCY_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php
			$db = JFactory::getDbo();
			$db->setQuery("Select id as value, concat(currency_name,' - ',currency_code,' - ',currency_symbol) as text from #__osrs_currencies where published = '1' order by currency_name");
			$currencies = $db->loadObjectList();
			if (!isset($configs['general_currency_default'])) $configs['general_currency_default'] = '';
			echo JHtml::_('select.genericlist',$currencies,'configuration[general_currency_default]','class="inputbox chosen"','value','text',$configs['general_currency_default']);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('show_convert_currency', JTextOs::_( 'Show convert currencies' ), JTextOs::_('Show convert currencies explain')." ".JText::_( 'OS_CONVERT_CURRENCY_NOTICE' )); ?>
		</div>
		<div class="controls">
			<?php
			OspropertyConfiguration::showCheckboxfield('show_convert_currency',$configs['show_convert_currency']);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_currency_money_format', JTextOs::_( 'Money format' ), JTextOs::_('Show convert currencies explain')); ?>
		</div>
		<div class="controls">
			<?php
			$option_moneyformat = array();
			$option_moneyformat[] = JHtml::_('select.option',0,JTextOs::_('Select Money format'));
			$option_moneyformat[] = JHtml::_('select.option',1,'1.000.000,00');
			$option_moneyformat[] = JHtml::_('select.option',2,'1 000 000,00');
			$option_moneyformat[] = JHtml::_('select.option',3,'1,000,000.00');
			$option_moneyformat[] = JHtml::_('select.option',4,'1.000.000');
			$option_moneyformat[] = JHtml::_('select.option',5,'1 000 000');
			$option_moneyformat[] = JHtml::_('select.option',6,'1,000,000');
			echo JHtml::_('select.genericlist',$option_moneyformat,'configuration[general_currency_money_format]','class="chosen inputbox"','value','text',isset($configs['general_currency_money_format'])? $configs['general_currency_money_format']:0);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('currency_position', JText::_( 'OS_CURRENCY_POSITION' ), JText::_('OS_CURRENCY_POSITION_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php
			$option_order = array();
			$option_order[] = JHtml::_('select.option','0',JText::_('OS_BEFORE_PRICE'));
			$option_order[] = JHtml::_('select.option','1',JText::_('OS_AFTER_PRICE'));
			echo JHtml::_('select.genericlist',$option_order,'configuration[currency_position]','class="input-medium chosen"','value','text',$configs['currency_position']);
			?>
		</div>
	</div>
</fieldset>