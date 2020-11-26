<?php 
/*------------------------------------------------------------------------
# layout_of_site.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2016 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die;
$db = JFactory::getDbo();
?>
<fieldset>
	<legend><?php echo JText::_('General Setting')?></legend>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('load_bootstrap', JText::_( 'Load Bootstrap' ), JText::_('If your template does not have Twitter Bootstrap, please make sure you set this configure option to Yes')); ?>
		</div>
		<div class="controls">
			<?php
			OspropertyConfiguration::showCheckboxfield('load_bootstrap',$configs['load_bootstrap']);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('twitter_bootstrap_version', JText::_( 'Twitter Bootstrap version' ), JText::_('Please only set this config option to version 3 if your site template is built based on twitter bootstrap version 3. Otherwise, leave it to 2')); ?>
		</div>
		<div class="controls">
			<?php
			//OspropertyConfiguration::showCheckboxfield('twitter_bootstrap_version',(int)$configs['twitter_bootstrap_version'],'Bootstrap version 3','Bootstrap version 2');
			$options   = array();
			$options[] = JHtml::_('select.option', 2, JText::_('OS_VERSION_2'));
			$options[] = JHtml::_('select.option', 3, JText::_('OS_VERSION_3'));
			$options[] = JHtml::_('select.option', 4, JText::_('OS_VERSION_4'));

			echo JHtml::_('select.genericlist', $options, 'configuration[twitter_bootstrap_version]', 'class="chosen"', 'value', 'text', $configs['twitter_bootstrap_version'] ? (int)$configs['twitter_bootstrap_version'] : 2);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('load_chosen', JText::_( 'Load Chosen library' ), JText::_('Chosen is Joomla core library, it makes the dropdown select list become nicer')); ?>
		</div>
		<div class="controls">
			<?php
			OspropertyConfiguration::showCheckboxfield('load_chosen',$configs['load_chosen']);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('load_lazy', JText::_( 'Load Lazy library' ), JText::_('Lazy Load is delays loading of images in long web pages. Images outside of viewport are not loaded until user scrolls to them. This is opposite of image preloading. Using Lazy Load on long web pages will make the page load faster. In some cases it can also help to reduce server load.')); ?>
		</div>
		<div class="controls">
			<?php
			OspropertyConfiguration::showCheckboxfield('load_lazy',$configs['load_lazy']);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_date_format', JTextOs::_( 'Date format' ), JTextOs::_('Select the date format for page display.')); ?>
		</div>
		<div class="controls">
			<?php
			$option_format_date = array();
			$option_format_date[] =  JHtml::_('select.option','d-m-Y H:i:s','d-m-Y H:i:s');
			$option_format_date[] =  JHtml::_('select.option','m-d-Y H:i:s','m-d-Y H:i:s');
			$option_format_date[] =  JHtml::_('select.option','Y-m-d H:i:s','Y-m-d H:i:s');
			echo JHtml::_('select.genericlist',$option_format_date,'configuration[general_date_format]','class="inputbox chosen"','value','text',isset($configs['general_date_format'])? $configs['general_date_format']:'');
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('general_date_format', JText::_( 'Default countries' ), JTextOs::_('SELECT_COUNTRY_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php
			$db->setQuery("Select id as value, country_name as text from #__osrs_countries order by country_name");
			$countries = $db->loadObjectList();
			$checkbox_show_country_id = array();
			if (isset($configs['show_country_id'])){
				$checkbox_show_country_id = explode(',',$configs['show_country_id']);
			}
			if($configs['show_country_id'] == ""){
				$checkbox_show_country_id[] = 194;
			}
			echo JHTML::_('select.genericlist',$countries,'configuration[show_country_id][]','multiple class="inputbox chosen"','value','text',$checkbox_show_country_id);
			?>
		</div>
	</div>

	<?php
	$query = $db->getQuery(true);
	$query->clear();
	$rows = array();
	$query->select('a.id AS value, a.title AS text, a.level');
	$query->from('#__menu AS a');
	$query->join('LEFT', $db->quoteName('#__menu').' AS b ON a.lft > b.lft AND a.rgt < b.rgt');

	$query->where('a.menutype != '.$db->quote(''));
	$query->where('a.component_id IN (SELECT extension_id FROM #__extensions WHERE element="com_osproperty")');
	$query->where('a.client_id = 0');
	$query->where('a.published = 1');

	$query->group('a.id, a.title, a.level, a.lft, a.rgt, a.menutype, a.parent_id, a.published');
	$query->order('a.lft ASC');

	// Get the options.
	$db->setQuery($query);
	$rows = $db->loadObjectList();

	// Pad the option text with spaces using depth level as a multiplier.
	for ($i = 0, $n = count($rows); $i < $n; $i++)
	{
		$rows[$i]->text = str_repeat('- ', $rows[$i]->level).$rows[$i]->text;
	}
	$options = array();
	$options[] = JHtml::_('select.option', 0, JText::_('-- None --'), 'value', 'text');
	$rows = array_merge($options, $rows);

	$lists['default_menu_item'] = JHtml::_('select.genericlist', $rows, 'configuration[default_itemid]',
		array(
			'option.text.toHtml'	=> false,
			'option.text'			=> 'text',
			'option.value'			=> 'value',
			'list.attr'				=> ' class="input-large chosen" ',
			'list.select'			=> $configs['default_itemid']));
	?>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('load_lazy', JText::_( 'OS_DEFAULT_ITEMID' ), JText::_('OS_DEFAULT_ITEMID_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php echo $lists['default_menu_item']; ?>
		</div>
	</div>
</fieldset>