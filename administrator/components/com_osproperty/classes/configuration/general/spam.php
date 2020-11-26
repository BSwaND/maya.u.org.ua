<?php 
/*------------------------------------------------------------------------
# spam.php - Ossolution Property
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
	<legend><?php echo JText::_('OS_SPAM_DETECT')?></legend>
    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('integrate_stopspamforum', JTextOs::_( 'Integrate with StopSpamForm' ), JTextOs::_('Integrate with StopSpamForm explain')); ?>
        </div>
        <div class="controls">
			<?php
            OspropertyConfiguration::showCheckboxfield('integrate_stopspamforum',$configs['integrate_stopspamforum']);
            ?>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo JText::_('OS_REPORT')?></legend>
    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('integrate_stopspamforum',JText::_( 'OS_REPORT' ), JText::_('OS_REPORT_EXPLAIN')); ?>
        </div>
        <div class="controls">
            <?php
            OspropertyConfiguration::showCheckboxfield('enable_report',$configs['enable_report']);
            ?>
        </div>
    </div>
</fieldset>