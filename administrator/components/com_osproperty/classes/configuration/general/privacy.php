<?php 
/*------------------------------------------------------------------------
# privacy.php - Ossolution Property
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
	<legend><?php echo JText::_('OS_PRIVACY_POLICY')?></legend>
    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('use_privacy_policy', JText::_( 'OS_SHOW_PRIVACY_POLICY' ), JText::_('OS_SHOW_PRIVACY_POLICY_EXPLAIN')); ?>
        </div>
        <div class="controls">
            <?php
            OspropertyConfiguration::showCheckboxfield('use_privacy_policy',$configs['use_privacy_policy']);
            ?>
        </div>
    </div>
    <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[use_privacy_policy]' => '1')); ?>'>
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('privacy_policy_article_id', JText::_( 'OS_PRIVACY_ARTICLE' ), JText::_('OS_PRIVACY_ARTICLE_EXPLAIN')); ?>
        </div>
        <div class="controls">
            <?php echo OSPHelper::getArticleInput($configs['privacy_policy_article_id'], 'configuration[privacy_policy_article_id]'); ?>
        </div>
    </div>
    <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[use_privacy_policy]' => '1')); ?>'>
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('allow_user_profile_optin', JText::_( 'OS_TURNON_PROFILE_OPTIN' ), JText::_('OS_TURNON_PROFILE_OPTIN_EXPLAIN')); ?>
        </div>
        <div class="controls">
            <?php
            OspropertyConfiguration::showCheckboxfield('allow_user_profile_optin',$configs['allow_user_profile_optin']);
            ?>
        </div>
    </div>
	<!--
    <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[use_privacy_policy]' => '1')); ?>'>
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('delete_account', JText::_( 'OS_DELETE_PROFILE_WHEN_USER_DELETED' ), JText::_('OS_DELETE_PROFILE_WHEN_USER_DELETED_EXPLAIN')); ?>
        </div>
        <div class="controls">
            <?php
            OspropertyConfiguration::showCheckboxfield('delete_account',$configs['delete_account']);
            ?>
        </div>
    </div>
	-->
</fieldset>