<?php
/*------------------------------------------------------------------------
# mod_ospropertysearch.php - OS Property search module
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2015 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');
error_reporting(E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR);
//error_reporting(E_ALL);
if (!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
$jinput				 = JFactory::getApplication()->input;
global $configClass, $bootstrapHelper;
$db = JFactory::getDbo();
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root().'modules/mod_ospropertysearch/asset/style.css');
$document->addScript(JURI::root().'media/com_osproperty/assets/js/ajax.js','text/javascript',true);

include_once(JPATH_ROOT."/components/com_osproperty/helpers/common.php");
include_once(JPATH_ROOT."/components/com_osproperty/helpers/helper.php");
include_once(JPATH_ROOT."/components/com_osproperty/helpers/route.php");
include_once(JPATH_ROOT."/components/com_osproperty/helpers/bootstrap.php");
include_once(JPATH_ROOT.DS."administrator".DS."components".DS."com_osproperty".DS."helpers".DS."extrafields.php");
require_once(JPATH_ROOT.DIRECTORY_SEPARATOR."components".DS."com_osproperty".DS."helpers".DS."helper.php");
require_once dirname(__FILE__).'/helper.php';

OSPHelper::loadBootstrap();
OSPHelper::loadMedia();
OSPHelper::chosen();
OSPHelper::loadLanguage();
OSPHelper::generateBoostrapVariables();

$configClass			= OSPHelper::loadConfig();
$lang_suffix 			= OSPHelper::getFieldSuffix();
$view                   = OSPHelper::getStringRequest('view','');
$app                    = JFactory::getApplication();
$show_keyword 			= $params->get('show_keyword',0);
$show_category 			= $params->get('show_category',0);
$show_type 				= $params->get('show_type',0);
$show_price			 	= $params->get('show_price',0);
$show_basic_slide 		= $params->get('show_basic_slide',1);
$show_details_slide 	= $params->get('show_details_slide',1);
$show_address_slide		= $params->get('show_address_slide',1);
$show_amenity_slide 	= $params->get('show_amenity_slide',1);
$show_other_slide 		= $params->get('show_other_slide',1);
$inputbox_width_site	= $params->get('inputbox_width_site',150);
$show_labels			= $params->get('show_labels',1);
$layout                 = $params->get('layout',0);
$usechosen              = $params->get('usechosen',1);
if($usechosen == 1)
{
    $chosenStyle = " chosen";
}
else
{
    $chosenStyle = "";
}

if($layout == 0){
    $layout = 'default';
    $widthStyle = 'width:'.$inputbox_width_site.'px !important';
}else{
    $layout = 'horizontal';
    $show_labels = 0;
    $widthStyle = 'width:100%;';
}
$labelinoneline			= $params->get('labelinoneline',0);
if($labelinoneline == 1){
	$separator = "</tr><tr>";
}else{
	$separator = "";
}
$amenities_post			= $jinput->get('amenities',array(),'ARRAY');
$isFeatured				= $jinput->getInt('isFeatured',0);
$isSold					= $jinput->getInt('isSold',0);
$city					= $jinput->getInt('city',0);
$state_id				= $jinput->getInt('state_id',0);
//$category_ids			= $jinput->get('catIds',array(),'ARRAY');
//$category_ids			= \Joomla\Utilities\ArrayHelper::toInteger($category_ids);
$category_id 			= $jinput->getInt('category_id',0);
$category_ids			=  $jinput->get('category_ids',array(),'ARRAY');
$category_ids			= \Joomla\Utilities\ArrayHelper::toInteger($category_ids);
if(!in_array($category_id,$category_ids)){
	$category_ids[count($category_ids)] = $category_id;
}

$rowFluidClass          = $bootstrapHelper->getClassMapping('row-fluid');
$span12Class            = $bootstrapHelper->getClassMapping('span12');
$span6Class             = $bootstrapHelper->getClassMapping('span6');
$span4Class             = $bootstrapHelper->getClassMapping('span4');
$span3Class             = $bootstrapHelper->getClassMapping('span3');


if($city == 0){
    switch($view) {
        case "lcity":
            $city = $jinput->getInt('id',0);
            $db->setQuery("Select state_id from #__osrs_cities where id = '$city'");
            $state_id = $db->loadResult();
        break;
    }
}
if($state_id == 0){
    switch($view){
        case "ltype":
            $menus = JFactory::getApplication()->getMenu();
            $menu = $menus->getActive();
            if (is_object($menu)) {
                $params1 = new JRegistry() ;
                $params1->loadString($menu->params) ;
                if($state_id == 0){
                    $state_id = $params1->get('state_id',0);
                }
                if($isFeatured == 0){
                    $isFeatured = $params1->get('isFeatured',0);
                }
                if($isSold == 0){
                    $isSold = $params1->get('isSold',0);
                }
            }
        break;
    }
}
OSPHelper::generateBoostrapVariables();
$country_id				= $jinput->getInt('country_id',HelperOspropertyCommon::getDefaultCountry());
$show_customfields		= $params->get('show_customfields',1);
$show_advancesearchform = $params->get('show_advancesearchform',1);
$moduleclass_sfx		= $params->get('moduleclass_sfx','');
$samepage				= $params->get('samepage',1);
$opengroups 			= $params->get('opengroups',0);
$property_type			= $params->get('property_type',0);
if($property_type == 0){
	$type_id = 0;
	$property_type = $jinput->getInt('property_type',0);
	if($property_type == 0){
		$property_type = $jinput->getInt('adv_type',0);
	}
}else{
	$type_id = 1;
}

if(($show_type == 1) and ($type_id == 0)){
    $property_type = $jinput->getInt('property_type',$property_type);
    if($property_type == 0) {
        switch ($view) {
            case "ltype":
                $property_type = $jinput->getInt('type_id', 0);
                break;
            case "lcity":
                $menus = JFactory::getApplication()->getMenu();
                $menu = $menus->getActive();
                if (is_object($menu)) {
                    $params = new JRegistry();
                    $params->loadString($menu->params);
                    $property_type = $params->get('type_id', 0);
                }
            break;
        }
    }
	if($show_labels == 0){
		$typeArr[] = JHTML::_('select.option','',JText::_('OS_PROPERTY_TYPE'));
	}else{
		$typeArr[] = JHTML::_('select.option','',JText::_('OS_ANY'));
	}
	$db->setQuery("Select id as value,type_name$lang_suffix as text from #__osrs_types where published = '1' order by type_name");
	$protypes = $db->loadObjectList();
	$typeArr   = array_merge($typeArr,$protypes);

	$lists['type'] = JHTML::_('select.genericlist',$typeArr,'property_type','style="'.$widthStyle.'" class="input-medium'. $chosenStyle.'"' ,'value','text',$property_type,'property_type'.$module->id);

	$lists['marketstatus'] = OSPHelper::buildDropdownMarketStatus($isSold);
}

$show_agenttype			= $params->get('show_agenttype',0);
$show_ordering_slide	= $params->get('show_ordering_slide',0);
$random_id				= $module->id;

$sortby					= OSPHelper::getStringRequest('sortby','');
$orderby				= OSPHelper::getStringRequest('orderby','');
$option					= OSPHelper::getStringRequest('option','com_osproperty');

if($opengroups == 1){
	$class = "blockdiv";
    $iclass = "osicon-chevron-up icon-chevron-up";
}else{
    $class = "hiddendiv";
    $iclass = "osicon-chevron-down icon-chevron-down";
}
//list the custom fields for searching
if($show_customfields == 1){
	//checked do search through extra field
	//get the list of the field groups
	$user = JFactory::getUser();
	$access_sql = ' and `access` IN (' . implode(',', JFactory::getUser()->getAuthorisedViewLevels()) . ')';
	$db->setQuery("Select * from #__osrs_fieldgroups where published = '1' $access_sql order by ordering");
	$groups = $db->loadObjectList();
	//$property_type = $jinput->getInt('property_type',$property_type);
	if(count($groups) > 0){
		$extrafieldSql = array();
		for($i=0;$i<count($groups);$i++){
			$group = $groups[$i];
			$extraSql = "";
			if($property_type > 0){
				$extraSql = " and id in (Select fid from #__osrs_extra_field_types where type_id = '$property_type') ";
			}
			$db->setQuery("Select * from #__osrs_extra_fields where group_id = '$group->id' $extraSql and published = '1' and searchable = '1' $access_sql order by ordering");
			$fields = $db->loadObjectList();
			$group->fields = $fields;
		}
	}
}
$db->setQuery("Select id from #__osrs_types where published = '1' order by ordering");
$types = $db->loadObjectList();
if(count($types) > 0){
   	foreach ($types as $type){
   		$db->setQuery("Select fid from #__osrs_extra_field_types where type_id = '$type->id'");
   		$type->fields = $db->loadColumn(0);
   	}
}


if($show_category == 1){
	/**
	 * Build the select list for parent menu item
	 */
}

// price
$price			= $jinput->getInt('price',0);
//$lists['price'] = HelperOspropertyCommon::generatePriceList($property_type,$price,'input-medium');

// number bath room
$nbath = $jinput->getInt('nbath',0);
if($show_labels == 0){
	$bathArr[] = JHTML::_('select.option','',JText::_('OS_BATH'));
}else{
	$bathArr[] = JHTML::_('select.option','',JText::_('OS_ANY'));
}
for($i=1;$i<=5;$i++){
	$bathArr[] = JHTML::_('select.option',$i,$i.'+');
}
$lists['nbath'] = JHTML::_('select.genericlist',$bathArr,'nbath',' class="input-mini '. $chosenStyle.'"  style="'.$widthStyle.'"','value','text',$nbath);


//number bed room
$nbed = $jinput->getInt('nbed',0);
$lists['nbed'] = $nbed;
if($show_labels == 0){
	$bedArr[] = JHTML::_('select.option','',JText::_('OS_BED'));
}else{
	$bedArr[] = JHTML::_('select.option','',JText::_('OS_ANY'));
}
for($i=1;$i<=5;$i++){
	$bedArr[] = JHTML::_('select.option',$i,$i.'+');
}
$lists['nbed'] = JHTML::_('select.genericlist',$bedArr,'nbed','class="input-mini '. $chosenStyle.'" style="'.$widthStyle.'"','value','text',$nbed);

//number bed room
$nroom = $jinput->getInt('nroom',0);
$lists['room'] = $nroom;
if($show_labels == 0){
	$roomArr[] = JHTML::_('select.option','',JText::_('OS_ROOMS'));
}else{
	$roomArr[] = JHTML::_('select.option','',JText::_('OS_ANY'));
}
for($i=1;$i<=5;$i++){
	$roomArr[] = JHTML::_('select.option',$i,$i.'+');
}
$lists['nroom'] = JHTML::_('select.genericlist',$roomArr,'nroom','class="input-mini '. $chosenStyle.'" style="'.$widthStyle.'"','value','text',$nroom);


//number bed floors
$nfloors = $jinput->getInt('nfloors',0);
$lists['nfloors'] = $nfloors;
if($show_labels == 0){
	$floorArr[] = JHTML::_('select.option','',JText::_('OS_FLOORS'));
}else{
	$floorArr[] = JHTML::_('select.option','',JText::_('OS_ANY'));
}
for($i=1;$i<=5;$i++){
	$floorArr[] = JHTML::_('select.option',$i,$i.'+');
}
$lists['nfloor'] = JHTML::_('select.genericlist',$floorArr,'nfloors','class="input-mini '. $chosenStyle.'" style="'.$widthStyle.'"','value','text',$nfloors);

if($show_labels == 0){
	$first_option = JText::_('OS_COUNTRY');
}else{
	$first_option = JText::_('OS_ANY');
}

$lists['country'] = HelperOspropertyCommon::makeCountryList($country_id,'mcountry_id'.$random_id,'onchange="change_country_companyModule'.$random_id.'(this.value,0,0,'.$random_id.')"',$first_option,'style="width:'.$inputbox_width_site.'px;"');


if(OSPHelper::userOneState()){
	$lists['state'] = "<input type='hidden' name='mstate_id".$random_id."' id='mstate_id".$random_id."' value='".OSPHelper::returnDefaultState()."'/>";
	//list city
	if(intval($state_id) == 0){
		$state_id = OSPHelper::returnDefaultState();
	}
	$lists['city'] = modOspropertySearchHelper::loadCity($option,$state_id, $city,$random_id,$show_labels);
}else{
	if($show_labels == 0){
		$first_option = JText::_('OS_STATE');
	}else{
		$first_option = JText::_('OS_ANY');
	}
	$lists['state'] = HelperOspropertyCommon::makeStateList($country_id,$state_id,'mstate_id'.$random_id,'onchange="change_stateModule'.$random_id.'(this.value,'.$city.','.$random_id.')"',$first_option,'class="input-medium" style="width:'.$inputbox_width_site.'px;"');
	//list city
	$lists['city'] = modOspropertySearchHelper::loadCity($option,$state_id, $city,$random_id,$show_labels);
}


$db->setQuery("Select * from #__osrs_amenities where published = '1' order by ordering");
$amenities = $db->loadObjectList();

$user_types = $configClass['user_types'];
$user_types = explode(",",$user_types);
$optionArr = array();
$agent_type = $jinput->getInt('agent_type',-1);
if($show_labels == 0){
	$optionArr[] = JHTML::_('select.option',-1,JText::_('OS_PROPERTIES_POSTED_BY'));
}else{
	$optionArr[] = JHTML::_('select.option',-1,JText::_('OS_ANY'));
}
if(in_array(0,$user_types)){
	$optionArr[] = JHTML::_('select.option', '0', JText::_('OS_AGENT'));
}
if(in_array(1,$user_types)){
	$optionArr[] = JHTML::_('select.option', '1', JText::_('OS_OWNER'));
}
if(in_array(2,$user_types)){
	$optionArr[] = JHTML::_('select.option', '2', JText::_('OS_REALTOR'));
}
if(in_array(3,$user_types)){
	$optionArr[] = JHTML::_('select.option', '3', JText::_('OS_BROKER'));
}
if(in_array(4,$user_types)){
	$optionArr[] = JHTML::_('select.option', '4', JText::_('OS_BUILDER'));
}
if(in_array(5,$user_types)){
	$optionArr[] = JHTML::_('select.option', '5', JText::_('OS_LANDLORD'));
}
if(in_array(6,$user_types)){
	$optionArr[] = JHTML::_('select.option', '6', JText::_('OS_SELLER'));
}

$lists['agenttype'] = JHTML::_('select.genericlist',$optionArr,'agent_type','style="width:'.$inputbox_width_site.'px !important;" class="input-medium chosen"','value','text',$agent_type);

$optionArr = array();
$optionArr[] = JHTML::_('select.option','a.isFeatured',JText::_('OS_FEATURED'));
$optionArr[] = JHTML::_('select.option','a.ref',JText::_('Ref'));
$optionArr[] = JHTML::_('select.option','a.pro_name',JText::_('OS_PROPERTY_TITLE'));
$optionArr[] = JHTML::_('select.option','a.id',JText::_('OS_LISTDATE'));
$optionArr[] = JHTML::_('select.option','a.price',JText::_('OS_PRICE'));
$lists['sortby'] = JHtml::_('select.genericlist',$optionArr,'sortby','class="input-medium"','value','text',$sortby);

$optionArr = array();
$optionArr[] = JHTML::_('select.option','desc',JText::_('OS_DESC'));
$optionArr[] = JHTML::_('select.option','asc',JText::_('OS_ASC'));
$lists['orderby'] =  JHtml::_('select.genericlist',$optionArr,'orderby','class="input-medium"','value','text',$orderby);


$lists['sqft_min'] = $jinput->getInt('sqft_min',0);
$lists['sqft_max'] = $jinput->getInt('sqft_max',0);

$lists['lotsize_min'] = $jinput->getInt('lotsize_min',0);
$lists['lotsize_max'] = $jinput->getInt('lotsize_max',0);

$radius_arr = array(5,10,20,50,100,200);
$radiusArr = array();
$radius_type = ($configClass['locator_radius_type'] == 0) ? JText::_('OS_MILES') : JText::_('OS_KILOMETRE');
foreach ($radius_arr as $radius) {
	$radiusArr[] = JHtml::_('select.option',$radius, $radius. ' '. $radius_type);
}
$lists['radius'] = JHtml::_('select.genericlist',$radiusArr,'radius_search','class="input-medium" style=""', 'value', 'text',$radius_search);

require( JModuleHelper::getLayoutPath( 'mod_ospropertysearch' , $layout) );
?>