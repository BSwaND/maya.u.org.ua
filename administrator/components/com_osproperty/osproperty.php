<?php
/*------------------------------------------------------------------------
# admin.osproperty.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2010 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

error_reporting(E_CORE_ERROR | E_ERROR | E_PARSE | E_USER_ERROR | E_COMPILE_ERROR);
define('DS', DIRECTORY_SEPARATOR);
JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

jimport('joomla.filesystem.folder');
//Include files from classes folder
$dir = JFolder::files(JPATH_COMPONENT_ADMINISTRATOR.DS."classes");
if(count($dir) > 0){
	for($i=0;$i<count($dir);$i++){
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."classes".DS.$dir[$i]);
	}
}

//Include files from helpers folder
$dir = JFolder::files(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers");
if(count($dir) > 0){
	for($i=0;$i<count($dir);$i++){
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers".DS.$dir[$i]);
	}
}

include_once(JPATH_ROOT.DS."components".DS."com_osproperty".DS."helpers".DS."libraries".DS."libraries.php");
include_once(JPATH_ROOT.DS."components".DS."com_osproperty".DS."helpers".DS."helper.php");
include_once(JPATH_ROOT.DS."components".DS."com_osproperty".DS."helpers".DS."osupload.php");
OSLibraries::checkMembership();


$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root()."media/com_osproperty/assets/css/backend_style.css");
$document->addScript(JURI::root()."media/com_osproperty/assets/js/ajax.js");
$document->addScript(JURI::root()."media/com_osproperty/assets/js/lib.js");
//JRequest::setVar('hidemainmenu',1);

global $_jversion,$configs,$mainframe,$languages,$jinput;
$jinput = JFactory::getApplication()->input;
$languages = OSPHelper::getLanguages();
$db = JFactory::getDBO();
$db->setQuery("select * from #__osrs_configuration");
$configs = $db->loadOBjectList();

$version = new JVersion();
$current_joomla_version = $version->getShortVersion();
$three_first_char = substr($current_joomla_version,0,3);
$mainframe = JFactory::getApplication();

$user = JFactory::getUser();

global $langArr;
$countryIDArray = array(12,28,35,169,66,193,86,92,130,147,187,152,162,175,71,9,13,18,20,15,51,65,73,90,120,136,167,87,39,47,55,114,138,144,176,181,195,91,149,151,110,41,145,3,5,77,45,82,93,25,135,146,50,206,163,170,192,125,132,198,84,54,185,97,56,191,207,208,209,116,4,30,49,133,158,178);
$countryFileArray = array('au_australia','br_brazil','ca_canada','es_spain','fr_france','gb_united','in_india','it_italy','nl_netherlands','pt_portugal','tr_turkey','ru_russia','sg_singapore','se_sweden','de_germany','ar_argentina','at_austria','bb_barbados','be_belgium','bs_bahamas','dk_denmark','fi_finland','gr_greece','ie_ireland','mx_mexico','no_norway','za_southafrica','id_indonesia','cl_chile','hr_croatia','ec_ecuador','my_malaysia','pk_pakistan','pe_peru','ch_switzerland','th_thailand','uy_uruguay','il_israel','qa_qatar','ro_romania','lu_luxembourg','co_colombia','ph_philippines','al_albania','ad_andorra','gt_guatemala','cr_costarica','hn_honduras','jm_jamaica','bo_bolivia','ng_nigeria','pl_poland','cz_czech','mv_maldives','sk_slovakia','sk_srilanka','ae_uae','mo_morocco','nz_newzealand','ve_venezuela','hu_hungary','do_dominican','tt_trinidad','ke_kenya','eg_egypt','uk_ukraine','sl_scotland','nr_northern_ireland','wa_wales','mt_malta','dz_algeria','bg_bulgaria','cy_cyprus','ni_nicaragua','sa_saudiarabia','tw_taiwan');

for($i=0;$i<count($countryIDArray);$i++){
	$langArr[$i] = new stdClass();
	$langArr[$i]->country_id = $countryIDArray[$i];
	$langArr[$i]->file_name = $countryFileArray[$i].".txt";
}

global $configs,$configClass;

$blacktaskarry = array('properties_showphotosinzipfile','properties_print','extrafield_addfieldoption','extrafield_removefieldoption','extrafield_savechangeoption','upload_ajaxupload','agent_getstate','configuration_connectfb','properties_newupload','properties_install');
$tmpl = $jinput->getString('tmpl','');


$db = JFactory::getDBO();
$db->setQuery('SELECT * FROM #__osrs_configuration ');
$configs = array();
$configClass = array();
foreach ($db->loadObjectList() as $config) {
	$configs[$config->fieldname] = $config->fieldvalue;
	$configClass[$config->fieldname] = $config->fieldvalue;
}

if((!in_array($task,$blacktaskarry)) and ($tmpl != "component")){

	if (version_compare(JVERSION, '3.0', 'lt')) {
		OSPHelper::loadBootstrap(true);	
	}else{
		$document->addStyleSheet(JUri::root().'media/jui/css/jquery.searchtools.css');
	}

	if($configClass['load_lazy']){
		?>
		<script src="<?php echo JUri::root(); ?>media/com_osproperty/assets/js/lazy.js" type="text/javascript"></script>
		<?php
	}

	OSPHelper::chosen();

}

/**
 * Multiple languages processing
 */
if (JLanguageMultilang::isEnabled() && !OSPHelper::isSyncronized())
{
	OSPHelper::setupMultilingual();
}

$option = $jinput->getString('option','com_osproperty');
$task = $jinput->getString('task','');
if($task != ""){
	$taskArr = explode("_",$task);
	$maintask = $taskArr[0];
}else{
	//cpanel
	$maintask = "";
}

//include(JPATH_COMPONENT_ADMINISTRATOR.DS."helpers".DS."osproperty");
if (version_compare(JVERSION, '3.0', 'ge')) {
}

if($maintask != "ajax"){
	$fromarray = array('oscalendar');
	$from = $jinput->getString('from','');
	if((!in_array($task,$blacktaskarry)) and (!in_array($from,$fromarray)) and ($tmpl != "component")){
		HelperOspropertyCommon::renderSubmenu($task);
		$db->setQuery("Select count(id) from #__osrs_properties");
		$count_properties = $db->loadResult();
		
		$db->setQuery("Select count(id) from #__osrs_agents");
		$count_agents = $db->loadResult();

		$db->setQuery("Select count(id) from #__osrs_categories");
		$count_categories = $db->loadResult();

		$db->setQuery("Select count(id) from #__osrs_types");
		$count_types = $db->loadResult();

		if(($count_properties == 0) && ($count_agents == 0) && ($count_categories == 0) && ($count_types == 0)){
			$msg = sprintf(JText::_('OS_YOU_DO_NOT_HAVE_ANY_DATA_CLICK_TO_INSTALL_SAMPLE_DATA'),'<a href="'.JUri::base().'index.php?option=com_osproperty&task=properties_prepareinstallsample">here</a>');
			JFactory::getApplication()->enqueueMessage($msg, 'message');
		}
	}
}



switch ($maintask){
	default:
	case "cpanel":
		OspropertyCpanel::cpanel($option);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "plugin":
		if (!JFactory::getUser()->authorise('plugin_list', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyPlugin::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "fieldgroup":
		if (!JFactory::getUser()->authorise('extrafieldgroups', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyFieldgroup::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "extrafield":
		if (!JFactory::getUser()->authorise('extrafields', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyExtrafield::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "categories":
		if (!JFactory::getUser()->authorise('categories', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyCategories::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "properties":
		if ((!JFactory::getUser()->authorise('properties', 'com_osproperty')) and ($task != "properties_reGeneratePictures") and ($task != "properties_sefoptimize")) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyProperties::display($option,$task);
		if($task != "properties_newupload"){
			HelperOspropertyCommon::loadFooter($option);
		}
	break;
	case "amenities":
		if (!JFactory::getUser()->authorise('convenience', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyAmenities::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "type":
		if (!JFactory::getUser()->authorise('propertytypes', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyType::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "pricegroup":
		if (!JFactory::getUser()->authorise('pricelists', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyPricegroup::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "companies":
		if (!JFactory::getUser()->authorise('companies', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyCompanies::display($option,$task);
	break;
	case "country":
		if (!JFactory::getUser()->authorise('location', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyCountry::display($option,$task);
	break;
	case "state":
		if (!JFactory::getUser()->authorise('location', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyState::display($option,$task);
	break;
	case "agent":
		if ((!JFactory::getUser()->authorise('agents', 'com_osproperty')) and ($tmpl != "component")){
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyAgent::display($option,$task);
	break;
	case "coupon":
		OspropertyCoupon::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case 'comment':
		if (!JFactory::getUser()->authorise('comments', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyComment::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case 'configuration':
		if (!JFactory::getUser()->authorise('configuration', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyConfiguration::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case 'email':
		if (!JFactory::getUser()->authorise('email', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyEmail::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "transaction":
		if (!JFactory::getUser()->authorise('transaction', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyTransaction::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "form":
		if (!JFactory::getUser()->authorise('csv', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyCsvform::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "city":
		if (!JFactory::getUser()->authorise('location', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyCity::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "translation":
		if (!JFactory::getUser()->authorise('translation', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyTranslation::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "theme":
		if (!JFactory::getUser()->authorise('themes', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyTheme::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "csvexport":
		if (!JFactory::getUser()->authorise('csv', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyCsvExport::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "report":
		if (!JFactory::getUser()->authorise('report', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyReport::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "tag":
		if (!JFactory::getUser()->authorise('tags', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyTag::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
	case "upload":
		OspropertyUpload::display($option,$task);
	break;
	case "xml":
		if (!JFactory::getUser()->authorise('xml', 'com_osproperty')) {
			return JError::raise(E_WARNING, 404, JText::_('JERROR_ALERTNOAUTHOR'));
		}
		OspropertyXml::display($option,$task);
		HelperOspropertyCommon::loadFooter($option);
	break;
}
if((!in_array($task,$blacktaskarry)) and ($tmpl != "component")){
	if($configClass['load_lazy']){
		?>
		<script type="text/javascript">
		jQuery(function() {
			jQuery("img.oslazy").lazyload();
		});
		</script>
		<?php
	}
}
?>