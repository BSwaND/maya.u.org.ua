<?php
/*------------------------------------------------------------------------
# theme.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2016 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
global $mainframe;
$mainframe = JFactory::getApplication();
jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
class JFormFieldMarketstatus extends JFormField
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'marketstatus';
	
	function getInput()
	{    
		include_once JPATH_ROOT.'/components/com_osproperty/helpers/helper.php';
		$configClass = OSPHelper::loadConfig();
		if ($this->element['value'] > 0) {
    	    $selectedValue = (int) $this->element['value'] ;
    	} else {
    	    $selectedValue = (int) $this->value ;
    	}
		$marketArr[] = JHTML::_('select.option','0','Select Market status');
       	$market_status 		= $configClass['market_status'];
		if($market_status != ""){
			$market_status_array = explode(",",$market_status);
			if(in_array('1',$market_status_array)){
				$marketArr[] = JHtml::_('select.option',1,JText::_('OS_SOLD'));
			}
			if(in_array('2',$market_status_array)){
				$marketArr[] = JHtml::_('select.option',2,JText::_('OS_CURRENT'));
			}
			if(in_array('3',$market_status_array)){
				$marketArr[] = JHtml::_('select.option',3,JText::_('OS_RENTED'));
			}
		}
		return JHtml::_('select.genericlist',$marketArr, $this->name, array(
		    'option.text.toHtml' => false ,
		    'option.value' => 'value', 
		    'option.text' => 'text', 
		    'list.attr' => ' class="inputbox" ',
		    'list.select' => $selectedValue  		        		
		));	
	}
}