<?php
/*------------------------------------------------------------------------
# osproperty.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2018 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die;
error_reporting(E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR);
$offset = "600";
$expstring = gmdate("D, d M Y H:i:s",time() + $offset)." GMT";
//JResponse::allowCache(true);
JFactory::getApplication()->allowCache(true);
//JResponse::setHeader('Expires',$expstring,true);
JFactory::getApplication()->setHeader('Expires',$expstring,true);

//error_reporting(E_ALL);
define('DS', DIRECTORY_SEPARATOR);
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
include(JPATH_COMPONENT_ADMINISTRATOR.DS."classes".DS."property.php");
include(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers".DS."extrafields.php");
include(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers".DS."image.php");
include(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers".DS."classimage.php");
include(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers".DS."images.php");
include(JPATH_COMPONENT.DS."plugins".DS."os_payments.php");
include(JPATH_COMPONENT.DS."plugins".DS."os_payment.php");

jimport('joomla.filesystem.folder');
//Include files from classes folder
$dir = JFolder::files(JPATH_COMPONENT.DS."classes");
if(count($dir) > 0){
	for($i=0;$i<count($dir);$i++){
		require_once(JPATH_COMPONENT.DS."classes".DS.$dir[$i]);
	}
}

$dir = JFolder::files(JPATH_COMPONENT.DS."helpers");
if(count($dir) > 0){
	for($i=0;$i<count($dir);$i++){
		if($dir[$i]!= "ipn_log.txt"){
			require_once(JPATH_COMPONENT.DS."helpers".DS.$dir[$i]);
		}
	}
}

include_once(JPATH_ROOT.DS."components".DS."com_osproperty".DS."helpers".DS."libraries".DS."libraries.php");
OSLibraries::checkMembership();

include(JPATH_COMPONENT.DS."helpers".DS."google".DS."googleMaps.lib.php");
include(JPATH_COMPONENT.DS."helpers".DS."google".DS."googleWDirections.lib.php");

$app = JFactory::getApplication();
$current_template = $app->getTemplate();
$document = JFactory::getDocument();

global $_jversion,$configs,$configClass,$symbol,$jinput;
$db = JFactory::getDBO();
$db->setQuery("Select * from #__osrs_configuration");
$configs = $db->loadObjectList();
$configClass = array();
foreach ($configs as $config) {
	$configClass[$config->fieldname] = $config->fieldvalue;
}

$curr = $configClass['general_currency_default'];
$arrCode=array();
$arrSymbol=array();

$db->setQuery("Select * from #__osrs_currencies where id = '$curr'");
$currency = $db->loadObject();
$symbol = $currency->currency_symbol;
$index=-1;
if($symbol == ""){
	$symbol='$';
}

$configClass['curr_symbol'] = $symbol;

$version = new JVersion();
global $mainframe,$languages,$lang_suffix;
$mainframe = JFactory::getApplication();
$languages = OSPHelper::getLanguages();

OSPHelper::loadMedia();

if (version_compare(JVERSION, '3.0', 'lt')) {
	OSPHelper::loadBootstrap(true);	
}else{
	if($configClass['load_bootstrap']  == 1){
		OSPHelper::loadBootstrap(true);
	}else{
		OSPHelper::loadBootstrap(false);	
	}
}

/**
 * Multiple languages processing
 */
if (JLanguageMultilang::isEnabled() && !OSPHelper::isSyncronized())
{
	OSPHelper::setupMultilingual();
}

$translatable = JLanguageMultilang::isEnabled() && count($languages);
if($translatable){
	//generate the suffix
	$lang_suffix = OSPHelper::getFieldSuffix();
}

global $ismobile;
$ismobile = OSPHelper::checkBrowers();
//OSPHelper::initSetup();

if($configClass['integrate_oscalendar'] == 1){
	include(JPATH_ROOT.DS."components".DS."com_oscalendar".DS."helpers".DS."helper.php");
}

global $configs;
$db = JFactory::getDBO();
$db->setQuery('SELECT * FROM #__osrs_configuration ');
$configs = array();
foreach ($db->loadObjectList() as $config) {
	$configs[$config->fieldname] = $config->fieldvalue;
}

$jinput = JFactory::getApplication()->input;
$option = $jinput->getString('option','com_osproperty');

$task = $jinput->getString('task','');
if($task == ""){
	$view = $jinput->getString('view','');
	switch ($view){
		case "lmanageproperties":
			$task = "property_manageallproperties";
		break;
		case "lcategory":
			$task = "category_listing";
		break;
		case "lagents":
			$task = "agent_layout";
		break;
		case "lcompanies":
			$task = "company_listing";
		break;
		case "ldefault":
			$task = "default_page";
		break;
		case "lsearch":
			$task = "locator_search";
		break;
		case "aaddproperty":
			$task = "property_new";
		break;
		case "aeditdetails":
			$task = "agent_editprofile";
		break;
		case "rfavoriteproperties":
			$task = "property_favorites";
		break;
		case "ltype":
			$task = "property_type";
		break;
		case "lcity":
			$task = "property_city";
		break;
		case "ccompanydetails":
			$task = "company_edit";
		break;
		case "ladvsearch":
			$task = "property_advsearch";
		break;
		case "rsearchlist":
			$task = "property_searchlist";
		break;
		case "aagentregistration":
			$task = "agent_register";
		break;
		case "rcompare":
			$task = "compare_properties";
		break;
		case "ccompanyregistration":
			$task = "company_register";
		break;
        case "lmlssearchiframe":
            $task = "default_mlssearch";
        break;
		case "ldetails":
			$task = "property_details";
		break;
        case "lmembership":
            $task = "membership_listsubscriptions";
            break;
	}
}
if($task != ""){
	$taskArr = explode("_",$task);
	$maintask = $taskArr[0];
}else{
	//cpanel
	$maintask = "";
}

OSPHelper::loadThemeStyle($task);
OSPHelper::generateBoostrapVariables();

//make the list that is used to load Chosen library
$chosenTasks = array("property_new","property_edit","property_advsearch","locator_default","locator_search");
if(in_array($task,$chosenTasks)) {
    if ($configClass['load_chosen'] == 1) {
        OSPHelper::chosen();
    }
}

$notloadLazy = array("property_gallery");

if(($configClass['load_lazy']) && ($maintask != "ajax") && (! in_array($task,$notloadLazy))){
	?>
	<script src="<?php echo JUri::root(); ?>media/com_osproperty/assets/js/lazy.js" type="text/javascript"></script>
	<?php
}

$loadLazy = 1;
switch ($maintask){
	case "ajax":
		$loadLazy = 0;
		OspropertyAjax::display($option,$task);
	break;
	case "category":
		OspropertyCategories::display($option,$task);
	break;
	case "property":
		OspropertyListing::display($option,$task);
	break;
	case "payment":
		OspropertyPayment::display($option,$task);
	break;
	case "compare":
		OspropertyCompare::display($option,$task);
	break;
	case "agent":
		OspropertyAgent::display($option,$task);
	break;
	case "company":
		OspropertyCompany::display($option,$task);
	break;
	default:
	case "default":
		OspropertyDefault::display($option,$task);
	break;
	case "locator":
		OspropertyLocator::display($option,$task);
	break;
	case "cron":
		OspropertyCron::display($option,$task);
	break;
	case "direction":
		OspropertyDirection::display($option,$task);
	break;
	case "filter":
		OspropertyFilter::display($option,$task);
	break;
    case "membership":
        OspropertyMembership::display($option,$task);
        break;
    case "upload":
        OsPropertyUpload::display($option,$task);
        break;
}


if(($configClass['load_lazy']) && ($maintask != "ajax") && (! in_array($task,$notloadLazy))){
	?>
	<script type="text/javascript">
	jQuery(function() {
		jQuery("img.oslazy").lazyload();
	});
	</script>
	<?php
}

?>