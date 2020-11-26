<?php 
/*------------------------------------------------------------------------
# offering_paid.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2018 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die;

?>
<fieldset>
	<legend><?php echo JText::_('Offering Paid Listing')?></legend>

    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('active_payment',JText::_( 'OS_ACTIVATE_PAYMENT' ),JText::_('OS_ACTIVE_PAYMENT_EXPLAIN')); ?>
        </div>
        <div class="controls">
            <?php
            OspropertyConfiguration::showCheckboxfield('active_payment',$configs['active_payment']);
            ?>
        </div>
    </div>
    <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[active_payment]' => '1')); ?>'>
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('normal_cost',JText::_( 'OS_COST_PER_NORMAL_PROPERTIES' ),JText::_('OS_COST_PER_NORMAL_PROPERTIES_EXPLAIN')); ?>
        </div>
        <div class="controls">
            <input type="text" class="input-mini" size="10" name="configuration[normal_cost]" value="<?php echo isset($configs['normal_cost'])? $configs['normal_cost']:'0'; ?>" />
            <?php echo HelperOspropertyCommon::loadCurrency($configs['general_currency_default']);?>
        </div>
    </div>
    <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[active_payment]' => '1')); ?>'>
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('general_featured_upgrade_amount',JText::_( 'OS_COST_PER_FEATURED_PROPERTIES' ),JText::_('OS_COST_PER_FEATURED_PROPERTIES_EXPLAIN'));?>
        </div>
        <div class="controls">
            <input type="text" class="input-mini" size="10" name="configuration[general_featured_upgrade_amount]" value="<?php echo isset($configs['general_featured_upgrade_amount'])? $configs['general_featured_upgrade_amount']:''; ?>" />
            <?php echo HelperOspropertyCommon::loadCurrency($configs['general_currency_default']);?>
        </div>
    </div>
    <!--
    <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[active_payment]' => '1')); ?>'>
        <div class="control-label">

            <?php echo HelperOspropertyCommon::showLabel('enable_cardtypes[]',JText::_( 'OS_ENABLE_CARD' ),JText::_('OS_ENABLE_CARD_EXPLAIN'));?>
        </div>
        <div class="controls">
            <?php
            $paymentArr = array();
            $paymentArr[]  =  JHTML::_('select.option','Visa',JText::_('OS_VISA_CARD'));
            $paymentArr[]  =  JHTML::_('select.option','MasterCard',JText::_('OS_MASTER_CARD'));
            $paymentArr[]  =  JHTML::_('select.option','Discover',JText::_('OS_DISCOVER'));
            $paymentArr[]  =  JHTML::_('select.option','Amex',JText::_('OS_AMEX'));

            $enable_cardtypes = $configs['enable_cardtypes'];
            $enable_cardtypes = explode(",",$enable_cardtypes);
            echo JHTML::_('select.genericlist',$paymentArr,'enable_cardtypes[]','class="inputbox" multiple','value','text',$enable_cardtypes);
            ?>
        </div>
    </div>
    -->
</fieldset>