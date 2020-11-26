<?php 
/*------------------------------------------------------------------------
# business.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2016 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die;
global $languages;
?>
<fieldset>
	<legend><?php echo JTextOs::_('Business setting')?></legend>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_bussiness_name', JTextOs::_( 'System bussiness name' ), JTextOs::_('The name of your real estate business shown on the component header and elsewhere, eg. the print page and email pages.')); ?>
		</div>
		<div class="controls">
			<input type="text" size="40" name="configuration[general_bussiness_name]" value="<?php echo isset($configs['general_bussiness_name'])? $configs['general_bussiness_name']:''; ?>">
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_bussiness_address', JTextOs::_( 'Business Address' ), JText::_('Your business address. This appears in the header of the print page.')); ?>
		</div>
		<div class="controls">
			<input type="text" size="40" name="configuration[general_bussiness_address]" value="<?php echo isset($configs['general_bussiness_address'])? $configs['general_bussiness_address']:''; ?>">
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_bussiness_phone', JText::_( 'Business Phone number' ), JText::_('Your contact telephone number shown on the arrange viewing form and the print page.')); ?>
		</div>
		<div class="controls">
			<input type="text" size="40" name="configuration[general_bussiness_phone]" value="<?php echo isset($configs['general_bussiness_phone'])? $configs['general_bussiness_phone']:''; ?>">
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_bussiness_email', JTextOs::_( 'Business Email' ), JTextOs::_('Email address to use with the property inspection and mailing list request forms.')); ?>
		</div>
		<div class="controls">
			<input type="text" size="40" name="configuration[general_bussiness_email]" value="<?php echo isset($configs['general_bussiness_email'])? $configs['general_bussiness_email']:''; ?>">
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('notify_email', JTextOs::_( 'Notify Email' ), JTextOs::_('NOTIFY_EMAIL_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<input type="text" size="40" name="configuration[notify_email]" value="<?php echo isset($configs['notify_email'])? $configs['notify_email']:''; ?>" />
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('show_footer', JText::_( 'Show Copyright' ), JTextOs::_('SHOW_FOOTER_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php
			OspropertyConfiguration::showCheckboxfield('show_footer',$configs['show_footer']);
			?>
		</div>
	</div>
</fieldset>
<input type="hidden" name="configuration[live_site]" id="live_site" value="<?php echo JUri::root();?>" />