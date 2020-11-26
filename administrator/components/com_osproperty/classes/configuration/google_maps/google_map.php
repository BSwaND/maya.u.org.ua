<?php 
/*------------------------------------------------------------------------
# google_map.php - Ossolution Property
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
	<legend><?php echo JText::_('Map')?></legend>
    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('map_type', JText::_( 'Select Map type' ), JTextOs::_('OS Property supports Google Map and OpenStreetMap, please select Map type you want to use')); ?>
        </div>
        <div class="controls">
            <?php
            OspropertyConfiguration::showCheckboxfield('map_type',$configs['map_type'], 'OpenStreetMap' ,'Google Map');
            ?>
        </div>
    </div>
	<div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[map_type]' => '0')); ?>'>
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('goole_aip_key', JText::_( 'Google Key' ), JTextOs::_('The name of your real estate business shown on the component header and elsewhere, eg. the print page and email pages.')); ?>
		</div>
		<div class="controls">
			<input type="text" class="input-xlarge" name="configuration[goole_aip_key]" value="<?php echo isset($configs['goole_aip_key'])?$configs['goole_aip_key']:'' ?>" />
			<BR />
			You can register new Google API key through this <strong><a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank" title="To get started using the Google Maps JavaScript API, click the button below, which takes you to the Google Developers Console.">link</a></strong>. You can read more details <strong><a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key">here</a></strong>
		</div>
	</div>
	
	<div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[map_type]' => '0')); ?>'>
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('goole_map_overlay', JTextOs::_( 'Map Overlay' ), JTextOs::_('')); ?>
		</div>
		<div class="controls">
			<?php
			if (!isset($configs['goole_map_overlay'])) $configs['goole_map_overlay'] = 'ROADMAP';
			$option_map_overlay = array();
			$option_map_overlay[] = JHtml::_('select.option','ROADMAP',JTextOs::_('Normal'));
			$option_map_overlay[] = JHtml::_('select.option','SATELLITE',JTextOs::_('Satellite'));
			$option_map_overlay[] = JHtml::_('select.option','HYBRID',JTextOs::_('Hybrid'));
			echo JHtml::_('select.genericlist',$option_map_overlay,'configuration[goole_map_overlay]','class="chosen inputbox"','value','text',$configs['goole_map_overlay']);
			?>
		</div>
	</div>
	<div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[map_type]' => '0')); ?>'>
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('goole_use_map',JText::_( 'Show street view in Details' ), JTextOs::_('Show street view map explain')); ?>
		</div>
		<div class="controls">
			<?php
			OspropertyConfiguration::showCheckboxfield('show_streetview',$configs['show_streetview']);
			?>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('', JTextOs::_( 'Default coordinates' ), JTextOs::_('DEFAULT_COORDINATES_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<?php
			global $configClass;
			if($configClass['map_type'] == 0)
			{
                include(JPATH_ROOT . "/components/com_osproperty/helpers/googlemap.lib.php");
                if (($configClass['goole_default_lat'] == "") && ($configClass['goole_default_long'] == ""))
                {
                    //find the default lat long
                    $default_address = $configClass['general_bussiness_address'];
                    $defaultGeocode = HelperOspropertyGoogleMap::getLatlongAdd($default_address);
                    $configClass['goole_default_lat'] = $defaultGeocode[0]->lat;
                    $configClass['goole_default_long'] = $defaultGeocode[0]->long;
                }

                $thedeclat = $configClass['goole_default_lat'];
                $thedeclong = $configClass['goole_default_long'];

                $geoCodeArr = array();
                $geoCodeArr[0]->lat = $thedeclat;
                $geoCodeArr[0]->long = $thedeclong;
                HelperOspropertyGoogleMap::loadGMapinEditProperty($geoCodeArr, 'map', 'er_declat', 'er_declong');
                ?>
                <br />
                <body onload="initialize()">
                <div id="map" style="width: 400px; height: 200px"></div>
                </body>
                <?php
            }
            else
            {
                include(JPATH_ROOT . "/components/com_osproperty/helpers/openstreetmap.lib.php");
                if (($configClass['goole_default_lat'] == "") && ($configClass['goole_default_long'] == ""))
                {
                    //find the default lat long
                    $default_address = $configClass['general_bussiness_address'];
                    $defaultGeocode = HelperOspropertyOpenStreetMap::getLatlongAdd($default_address);
                    $configClass['goole_default_lat'] = $defaultGeocode[0];
                    $configClass['goole_default_long'] = $defaultGeocode[1];
                }

                $thedeclat = $configClass['goole_default_lat'];
                $thedeclong = $configClass['goole_default_long'];

                $geoCodeArr = array();
                $geoCodeArr[0]->lat = $thedeclat;
                $geoCodeArr[0]->long = $thedeclong;
                ?>
                <div id="map" style="width: 400px; height: 200px"></div>
                <?php
                HelperOspropertyOpenStreetMap::loadGMapinEditProperty($geoCodeArr, 'map', 'er_declat', 'er_declong');
            }
			?>

			<br />
			<table>
				<tr>
					<td class="key" width="50%" style="border:1px solid #DDD;background-color:#efefef;">
						<?php echo JText::_( 'Latitude' ); ?>
						<input size="5" class="input-mini" type="text" name="configuration[goole_default_lat]" id="er_declat" size="25" maxlength="100" value="<?php echo $thedeclat;?>" />
					</td>
					<td class="key" style="padding-left:10px;border:1px solid #DDD;background-color:#efefef;" width="50%">
						<?php echo JText::_( 'Longitude' ); ?>
						<input size="5" class="input-mini" type="text" name="configuration[goole_default_long]" id="er_declong" size="25" maxlength="100" value="<?php echo $thedeclong;?>" />
					</td>
				</tr>
			</table>
		</div>
	</div>
    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('goole_use_map', JText::_( 'Map in Details page' ), JTextOs::_('Do you want to show Google Map in Property Details page')); ?>
        </div>
        <div class="controls">
            <?php
            OspropertyConfiguration::showCheckboxfield('goole_use_map',$configs['goole_use_map']);
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('goole_map_resolution', JText::_( 'Default Map Zoom' ), JText::_('The map resolution determines the zoom level of the maps used in Property Details page. The smaller the number - the closer the view, and the bigger the number - the further away the view. From 0 to 18.')); ?>
        </div>
        <div class="controls">
            <input type="text" class="input-mini" name="configuration[goole_map_resolution]" value="<?php echo isset($configs['goole_map_resolution'])?$configs['goole_map_resolution']:'' ?>" size="2">
        </div>
    </div>
    <div class="control-group">
        <div class="control-label">
            <?php echo HelperOspropertyCommon::showLabel('limit_zoom', JText::_( 'Limit Zoom level' ), JText::_('Enter Limit Zoom level of Google map in property details page. From 0 to 18.')); ?>
        </div>
        <div class="controls">
            <input type="text" class="input-mini" name="configuration[limit_zoom]" value="<?php echo isset($configs['limit_zoom'])?$configs['limit_zoom']:'15' ?>" size="2">
        </div>
    </div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('goole_use_map', JTextOs::_( 'Map width' ), JTextOs::_('MAP_WIDTH_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<input type="text" class="text-area-order input-mini" size="5" maxlength="5" name="configuration[property_map_width]" value="<?php echo isset($configs['property_map_width'])?$configs['property_map_width']:'' ?>">px
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<?php echo HelperOspropertyCommon::showLabel('goole_use_map', JTextOs::_( 'Map height' ), JTextOs::_('MAP_HEIGHT_EXPLAIN')); ?>
		</div>
		<div class="controls">
			<input type="text" class="text-area-order input-mini" size="5" maxlength="5" name="configuration[property_map_height]" value="<?php echo isset($configs['property_map_height'])?$configs['property_map_height']:'' ?>">px
		</div>
	</div>
</fieldset>