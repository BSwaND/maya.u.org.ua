<?php 
/*------------------------------------------------------------------------
# property.php - Ossolution Property
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
<table width="100%">
    <tr>
        <td width="50%" valign="top">
            <fieldset>
                <legend><?php echo JText::_('OS_FEATURED_FIELDS')?></legend>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('general_approval', JTextOs::_( 'Auto approval' ), JTextOs::_('Do new and updated listings require admin approval before publishing?')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('general_approval',$configs['general_approval']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('default_access_level', JText::_( 'OS_DEFAULT_ACCESS_LEVEL' ), JText::_('OS_DEFAULT_ACCESS_LEVEL_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        if($configs['default_access_level'] == ""){
                            $configs['default_access_level'] = 1;
                        }
                        echo OSPHelper::accessDropdown('configuration[default_access_level]',$configs['default_access_level']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('property_not_avaiable', JText::_( 'Unavailable link' ), JTextOs::_('Not available link explain.')); ?>
                    </div>
                    <div class="controls">
                        <input type="text" class = "input-xlarge" name="configuration[property_not_avaiable]" value="<?php echo isset($configs['property_not_avaiable'])? $configs['property_not_avaiable']:''; ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('address_format', JTextOs::_( 'Address format' ), JTextOs::_('Address format explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $addressArr = array();
                        $addressArr[0] =  JText::_('OS_ADDRESS');
                        $addressArr[1] =  JText::_('OS_CITY');
                        $addressArr[2] =  JText::_('OS_STATE');
                        $addressArr[3] =  JText::_('OS_REGION');
                        $addressArr[4] =  JText::_('OS_POSTCODE');

                        $optionArr = array();
                        $optionArr[0] = "0,1,2,3,4";
                        $optionArr[1] = "0,1,4,2,3";
                        $optionArr[2] = "0,1,4,3,2";
                        $optionArr[3] = "0,1,3,4,2";
                        $optionArr[4] = "0,1,3,2,4";
                        $optionArr[5] = "0,1,2,4,3";

                        $nColArr = array();
                        for($i=0;$i<count($optionArr);$i++){
                            $item = $optionArr[$i];
                            $itemArr = explode(",",$item);
                            $value = "";
                            if(count($itemArr) > 0){
                                for($j=0;$j<count($itemArr);$j++){
                                    $value .= $addressArr[$itemArr[$j]].", ";
                                }
                                $value = substr($value,0,strlen($value)-2);
                            }
                            $nColArr[$i] = JHTML::_('select.option',$item,$value);
                        }
                        if (!isset($configs['address_format'])) $configs['address_format'] = '1';
                        echo JHtml::_('select.genericlist',$nColArr,'configuration[address_format]','class="chosen input-xxlarge"','value','text',$configs['address_format']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('limit_upload_photos', JTextOs::_( 'Max photos can uploaded' ), JTextOs::_('Max photos can uploaded explain')); ?>
                    </div>
                    <div class="controls">
                        <input type="text" class="input-mini" size="5" name="configuration[limit_upload_photos]" value="<?php echo isset($configs['limit_upload_photos'])? $configs['limit_upload_photos']:''; ?>"> <?php echo JText::_("OS_PHOTOS")?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('limit_upload_photos', JText::_( 'OS_REF_FIELD' ), JTextOs::_('')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $option_ref_field = array();
                        $option_ref_field[] = JHtml::_('select.option',0,JText::_('OS_MANUAL_ENTER'));
                        $option_ref_field[] = JHtml::_('select.option',1,JText::_('OS_AUTO_GENERATE'));
                        echo JHtml::_('select.genericlist',$option_ref_field,'configuration[ref_field]','class="chosen input-large"','value','text',isset($configs['ref_field'])? $configs['ref_field']:0);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('ref_prefix', JText::_( 'OS_REF_PREFIX' ), JText::_('OS_REF_PREFIX_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <input type="text" class="input-small" name="configuration[ref_prefix]" value="<?php echo isset($configs['ref_prefix'])? $configs['ref_prefix']:'PREFIX'; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_ref', JText::_( 'Show Ref' ), JText::_('Do you want to show Ref value at front-end')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('show_ref',$configs['show_ref']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_metatag', JText::_( 'Show meta tag' ), JTextOs::_('Show meta tag explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('show_metatag',$configs['show_metatag']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_just_add_icon', JTextOs::_( 'Show just added icon' ), JTextOs::_('Show just added icon explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('show_just_add_icon',$configs['show_just_add_icon']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_just_update_icon', JTextOs::_( 'Show just updated icon' ), JTextOs::_('Show just updated icon explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('show_just_update_icon',$configs['show_just_update_icon']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_just_update_icon', JTextOs::_( 'Use energy and elimate' ), JTextOs::_('Use energy and elimate explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('energy',$configs['energy']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('energy_value', JTextOs::_( 'Energy Measurement steps' ), JTextOs::_('Energy Measurement steps explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        if($configs['energy_class'] == ""){
                            $configs['energy_class'] = "A,B,C,D,E,F,G";
                        }
                        if($configs['energy_value'] == ""){
                            $configs['energy_value'] = "50,90,150,230,330,450";
                        }
                        ?>
                        <strong>Class:</strong>
                        <small>Please enter class name of Energy graph, separated by comma</small>
                        <input type="text" class="input-xlarge" name="configuration[energy_class]" value="<?php echo $configs['energy_class'];?>" />
                        <BR />
                        <strong>Value:</strong>
                        <small>Please enter value of Energy graph, separated by comma</small>
                        <input type="text" class="input-xlarge" name="configuration[energy_value]" value="<?php echo $configs['energy_value'];?>" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('climate_value', JTextOs::_( 'Climate Measurement steps' ), JTextOs::_('Climate Measurement steps explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        if($configs['climate_class'] == ""){
                            $configs['climate_class'] = "A,B,C,D,E,F,G";
                        }
                        if($configs['climate_value'] == ""){
                            $configs['climate_value'] = "5,10,20,35,55,80";
                        }
                        ?>
                        <strong>Class:</strong>
                        <small>Please enter class name of Co2 graph, separated by comma</small>
                        <input type="text" class="input-xlarge" name="configuration[climate_class]" value="<?php echo $configs['climate_class'];?>" />
                        <BR />
                        <strong>Value:</strong>
                        <small>Please enter value of Co2 graph, separated by comma</small>
                        <input type="text" class="input-xlarge" name="configuration[climate_value]" value="<?php echo $configs['climate_value'];?>" />
                    </div>
                </div>
                <strong>
                    <?php echo JText::_( 'OS_USE_BASE_PROPERTY_FIELDS' ); ?>
                </strong>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_rooms', JTextOs::_( 'Use number rooms field' ), JTextOs::_('Use number rooms field explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_rooms',$configs['use_rooms']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_bedrooms', JTextOs::_( 'Use number bedrooms field' ), JTextOs::_('Use number bedrooms field explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_bedrooms',$configs['use_bedrooms']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_bathrooms', JTextOs::_( 'Use number bathrooms field' ), JTextOs::_('Use number bathrooms field explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_bathrooms',$configs['use_bathrooms']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('fractional_bath', JText::_( 'OS_FRACTIONAL_BATHS' ), JText::_('OS_FRACTIONAL_BATHS_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('fractional_bath',$configs['fractional_bath']);
                        ?>
                    </div>
                </div>
                <strong>
                    <?php echo JText::_( 'OS_BUILDING_INFORMATION' ); ?>
                </strong>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_nfloors', JText::_( 'OS_BUILDING_INFORMATION' ), JText::_('OS_BUILDING_INFORMATION_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_nfloors',$configs['use_nfloors']);
                        ?>
                    </div>
                </div>
                <strong>
                    <?php echo JTextOs::_( 'Use parking field' ); ?>
                </strong>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_parking', JTextOs::_( 'Use parking field' ), JTextOs::_('Use parking field explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_parking',$configs['use_parking']);
                        ?>
                    </div>
                </div>
                <strong>
                    <?php echo JText::_( 'OS_BASEMENT_FOUNDATION' ); ?>
                </strong>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('basement_foundation', JText::_( 'OS_BASEMENT_FOUNDATION' ), JText::_('OS_BASEMENT_FOUNDATION_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('basement_foundation',$configs['basement_foundation']);
                        ?>
                    </div>
                </div>
                <strong>
                    <?php echo JText::_( 'OS_LAND_INFORMATION' ); ?>
                </strong>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_squarefeet', JText::_( 'OS_LAND_INFORMATION' ), JText::_('OS_LAND_INFORMATION_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_squarefeet',$configs['use_squarefeet']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_square', JText::_( 'OS_LAND_AREA_UNIT_OF_MEASUREMENT' ), JText::_('OS_LAND_AREA_UNIT_OF_MEASUREMENT_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_square',$configs['use_square'],JText::_('OS_METER'),JText::_('OS_FEET'));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('acreage', JText::_( 'OS_ACREAGE_UNIT_OF_MEASUREMENT' ), JText::_('OS_ACREAGE_UNIT_OF_MEASUREMENT_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('acreage',$configs['acreage'],JText::_('OS_ACRES'),JText::_('OS_HECTARES'));
                        ?>
                    </div>
                </div>
                <strong>
                    <?php echo JText::_( 'Show Property History & Tax' ); ?>
                </strong>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_property_history', JText::_( 'Show Property History & Tax' ), JText::_('Do you want to show Property Sold History & Tax')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_property_history',$configs['use_property_history']);
                        ?>
                    </div>
                </div>
                <strong>
                    <?php echo JText::_( 'OS_BUSINESS_INFORMATION' ); ?>
                </strong>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_business',JText::_( 'OS_BUSINESS_INFORMATION' ), JText::_('OS_BUSINESS_INFORMATION_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_business',$configs['use_business']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_rural',JText::_( 'OS_RURAL_INFORMATION' ), JText::_('OS_RURAL_INFORMATION_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_rural',$configs['use_rural']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('use_open_house',JText::_( 'Show Open House' ), JText::_('Do you want to show Open House information')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('use_open_house',$configs['use_open_house']);
                        ?>
                    </div>
                </div>
                <div class="headerlabel">
                    <?php echo HelperOspropertyCommon::showLabel('',JText::_( 'Fields required' ), JText::_('Select Required status of fields in Add property form')); ?>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('adddress_required',JText::_( 'Address' ), JText::_('Do you want to make Required with Address field')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('adddress_required',$configs['adddress_required']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('short_desc_required',JText::_( 'Short description' ), JText::_('Do you want to make Required with Short description field')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('short_desc_required',$configs['short_desc_required']);
                        ?>
                    </div>
                </div>
                <div class="headerlabel">
                    <?php echo HelperOspropertyCommon::showLabel('',JText::_( 'Grab Images' ), JText::_('Grab Images allows you to collect photo(s) of properties from website urls')); ?>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('grabimages_backend',JText::_( 'Using at Back-end' ), JText::_('Do you want to use Grab Images function at Back-end side')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('grabimages_backend',$configs['grabimages_backend']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('grabimages_frontend',JText::_( 'Using at Front-end' ), JText::_('Do you want to use Grab Images function at Front-end side')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('grabimages_frontend',$configs['grabimages_frontend']);
                        ?>
                    </div>
                </div>

            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('OS_SOCIAL_SHARING')?></legend>
                <table  width="100%" class="admintable">
                    <tr>
                        <td class="key" nowrap="nowrap">
                            <span class="editlinktip hasTip" title="<?php echo JText::_( 'OS_ALLOW_SOCIAL_SHARING' );?>::<?php echo JTextOs::_('ALLOW_SOCIAL_SHARING_EXPLAIN'); ?>">
                                <label for="checkbox_property_save_to_favories">
                                    <?php echo JText::_( 'OS_ALLOW_SOCIAL_SHARING' ).':'; ?>
                                </label>
                            </span>
                        </td>
                        <td>
                            <?php
                            OspropertyConfiguration::showCheckboxfield('social_sharing',$configs['social_sharing']);
                            ?>
                        </td>
                    </tr>
					<tr>
                        <td class="key" nowrap="nowrap">
                            <span class="editlinktip hasTip" title="<?php echo JText::_( 'Sharing type' );?>::<?php echo JText::_('For Native Sharing, there is no need to enter publisher id'); ?>">
                                <label for="checkbox_property_save_to_favories">
                                    <?php echo JText::_( 'Sharing type' ).':'; ?>
                                </label>
                            </span>
                        </td>
                        <td>
                            <?php
                            OspropertyConfiguration::showCheckboxfield('social_sharing_type',$configs['social_sharing_type'],'Addthis sharing','Native sharing');
                            ?>
                        </td>
                    </tr>
					<tr>
                        <td class="key" nowrap="nowrap">
                            <span class="editlinktip hasTip" title="<?php echo JText::_( 'Published ID' );?>::<?php echo JText::_('In case you select Addthis sharing, please enter Published ID'); ?>">
                                <label for="checkbox_property_save_to_favories">
                                    <?php echo JText::_( 'Published ID' ).':'; ?>
                                </label>
                            </span>
                        </td>
                        <td>
                            <input type="text" size="40" name="configuration[publisher_id]" value="<?php echo isset($configs['publisher_id'])? $configs['publisher_id']:''; ?>">
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('OS_SEF')?></legend>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('sef_configure', JText::_( 'OS_SEF_LINK_CONTAIN' ), JText::_('OS_SEF_LINK_CONTAIN_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $sefArr[] = JHTML::_('select.option','0',JText::_('OS_ALIAS_ONLY'));
                        $sefArr[] = JHTML::_('select.option','1',JText::_('OS_REF_ALIAS'));
                        $sefArr[] = JHTML::_('select.option','2',JText::_('OS_REF_ALIAS_ID'));
                        echo JHtml::_('select.genericlist',$sefArr,'configuration[sef_configure]','class="chosen input-medium"','value','text',$configs['sef_configure']);
                        ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('OS_BREADCRUMBS')?></legend>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('include_categories', JText::_( 'OS_INCLUDE_CATEGORIES' ), JText::_('')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('include_categories',$configs['include_categories']);
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('include_type', JText::_( 'OS_INCLUDE_PROPERTY_TYPE' ), JText::_('')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('include_type',$configs['include_type']);
                        ?>
                    </div>
                </div>
            </fieldset>
        </td>
        <td width="50%" valign="top">
            <fieldset>
                <legend><?php echo JText::_('OS_ALERT_EMAIL_SETTING')?></legend>
                <table width="100%" class="admintable">
                    <tr>
                        <td class="key" nowrap="nowrap">
                            <span class="editlinktip hasTip" title="<?php echo JText::_( 'OS_ACTIVATE_ALERT_EMAIL_FEATURE' );?>::<?php echo JText::_('OS_ACTIVATE_ALERT_EMAIL_FEATURE_EXPLAIN'); ?>">
                                <label for="checkbox_categories_show_sub_categories">
                                    <?php echo JText::_( 'OS_ACTIVATE_ALERT_EMAIL_FEATURE' ).':'; ?>
                                </label>
                            </span>
                        </td>
                        <td>
                            <?php
                            OspropertyConfiguration::showCheckboxfield('active_alertemail',$configs['active_alertemail']);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="key" nowrap="nowrap">
                            <span class="editlinktip hasTip" title="<?php echo JText::_( 'OS_CRONJOB_FILE' );?>">
                                <label for="checkbox_categories_show_sub_categories">
                                    <?php echo JText::_( 'OS_CRONJOB_FILE' ).':'; ?>
                                </label>
                            </span>
                        </td>
                        <td>
                            Live URL: <strong class="colorgreen"><?php echo JUri::root(); ?>components/com_osproperty/cron.php</strong>
                            <BR />
                            Real Path: <strong class="colorred"><?php echo JPATH_ROOT; ?>/components/com_osproperty/cron.php</strong>
                            <BR />
                            <i>You need to set up a cron job using your hosting account control panel which should execute every hours. Depending on your web server you should use either the live url or real path.</i>
                        </td>
                    </tr>
                    <tr>
                        <td class="key" nowrap="nowrap" valign="top">
                            <span class="editlinktip hasTip" title="<?php echo JTextOs::_( 'NUMBER_LISTING_TO_CHECK_PER_CRONTASK_RUNNING' );?>
                                <label for="checkbox_number_email_by_hour">
                                    <?php echo JTextOs::_( 'NUMBER_LISTING_TO_CHECK_PER_CRONTASK_RUNNING' ).':'; ?>
                                </label>
                            </span>
                        </td>
                        <td>
                            <input type="text" class="text-area-order input-mini" size="5" name="configuration[max_properties_per_time]" value="<?php echo isset($configs['max_properties_per_time'])?$configs['max_properties_per_time']:'100' ?>" />
                            <BR />
                            <i><?php echo JTextOs::_( 'NUMBER_LISTING_TO_CHECK_PER_CRONTASK_RUNNING_EXPLAIN' ); ?></i>
                        </td>
                    </tr>
                    <tr>
                        <td class="key" nowrap="nowrap" valign="top">
                            <span class="editlinktip hasTip" title="<?php echo JTextOs::_( 'NUMBER_SAVED_LIST_TO_CHECK_PER_CRONTASK_RUNNING' );?>
                                <label for="checkbox_number_email_by_hour">
                            <?php echo JTextOs::_( 'NUMBER_SAVED_LIST_TO_CHECK_PER_CRONTASK_RUNNING' ).':'; ?>
                            </label>
                            </span>
                        </td>
                        <td>
                            <input type="text" class="text-area-order input-mini" size="5" name="configuration[max_lists_per_time]" value="<?php echo isset($configs['max_lists_per_time'])?$configs['max_lists_per_time']:'50' ?>" />
                            <BR />
                            <i><?php echo JTextOs::_( 'NUMBER_SAVED_LIST_TO_CHECK_PER_CRONTASK_RUNNING_EXPLAIN' ); ?></i>
                        </td>
                    </tr>
                    <tr>
                        <td class="key" nowrap="nowrap" valign="top">
                            <span class="editlinktip hasTip" title="<?php echo JTextOs::_( 'NUMBER_EMAIL_CRONTASK_RUNNING' );?>
                                <label for="checkbox_number_email_by_hour">
                            <?php echo JTextOs::_( 'NUMBER_EMAIL_CRONTASK_RUNNING' ).':'; ?>
                            </label>
                            </span>
                        </td>
                        <td>
                            <input type="text" class="text-area-order input-mini" size="5" name="configuration[max_email_per_time]" value="<?php echo isset($configs['max_email_per_time'])?$configs['max_email_per_time']:'50' ?>" />
                            <BR />
                            <i><?php echo JTextOs::_( 'NUMBER_EMAIL_CRONTASK_RUNNING_EXPLAIN' ); ?></i>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend><?php echo JTextOs::_('Comment Settings')?></legend>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('comment_active_comment', JText::_( 'Active Comment & Rating' ), JText::_('')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('comment_active_comment',$configs['comment_active_comment']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[comment_active_comment]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('comment_auto_approved',JTextOs::_( 'Auto approved Comment' ), JText::_('')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('comment_auto_approved',$configs['comment_auto_approved']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[comment_active_comment]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_rating',JTextOs::_( 'Show rating icon' ), JText::_('Show rating icon explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('show_rating',$configs['show_rating']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[comment_active_comment]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_rating',JText::_( 'Only logged user can submit review' ), JText::_('OS_ONLY_REGISTERED_USER_CAN_SUBMIT_REVIEW_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('registered_user_write_comment',$configs['registered_user_write_comment']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[comment_active_comment]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('only_one_review',JText::_( 'OS_ONE_USER_CAN_WRITE_ONE_REVIEW' ), JText::_('OS_ONE_USER_CAN_WRITE_ONE_REVIEW_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('only_one_review',$configs['only_one_review']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[comment_active_comment]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('only_one_review',JText::_( 'Allow user to edit comment' ), JText::_('')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('allow_edit_comment',$configs['allow_edit_comment']);
                        ?>
                    </div>
                </div>
            </fieldset>
            <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'configuration'.DS.'general'.DS.'csv.php');?>
            <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'configuration'.DS.'properties'.DS.'sold.php');?>
            <fieldset>
                <legend><?php echo JTextOs::_('Walking score setting')?></legend>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_walkscore', JTextOs::_( 'Show walked score tab' ), JTextOs::_('Show walked score tab explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('show_walkscore',$configs['show_walkscore']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[show_walkscore]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('ws_id',JTextOs::_( 'Walked score ID' ), JTextOs::_('Walked score ID explain.')); ?>
                    </div>
                    <div class="controls">
                        <input type="text" size="50" name="configuration[ws_id]" value="<?php echo isset($configs['ws_id'])? $configs['ws_id']:''; ?>">
                        <div class="clr"></div>
                        <?php echo JText::_('Click here to request new API Walked Score key');?>
                        <a href="http://www.walkscore.com/professional/api-sign-up.php" target="_blank">http://www.walkscore.com/professional/api-sign-up.php</a>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[show_walkscore]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('ws_width',JText::_( 'Width size of Walked score' ), JTextOs::_('Width size of Walked score div explain.')); ?>
                    </div>
                    <div class="controls">
                        <input type="text" class="input-mini" size="5" name="configuration[ws_width]" value="<?php echo isset($configs['ws_width'])? $configs['ws_width']:''; ?>"> px
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[show_walkscore]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('ws_height',JText::_( 'Height size of Walked score' ), JTextOs::_('Height size of Walked score div explain.')); ?>
                    </div>
                    <div class="controls">
                        <input type="text" class="input-mini" size="5" name="configuration[ws_height]" value="<?php echo isset($configs['ws_height'])? $configs['ws_height']:''; ?>"> px
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[show_walkscore]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('ws_height',JTextOs::_( 'Unit' ), JText::_('')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $nColArr = array();
                        $nColArr[] = JHTML::_('select.option','mi','Miles');
                        $nColArr[] = JHTML::_('select.option','km','Kilometers');
                        echo JHtml::_('select.genericlist',$nColArr,'configuration[ws_unit]','class="chosen input-small"','value','text',$configs['ws_unit']);
                        ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('OS_PDF_EXPORT')?></legend>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('property_pdf_layout', JText::_( 'OS_PDF_EXPORT_FEATURE' ), JText::_('PDF_LAYOUT_EXPLAIN')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('property_pdf_layout',$configs['property_pdf_layout']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[property_pdf_layout]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('ws_id',JText::_( 'Select font name in PDF file' ), ''); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $optionArr = array();
                        $optionArr[] = JHtml::_('select.option','','Select font');
                        $fontArr = array('courier','helvetica','times','freeserif');
                        foreach($fontArr as $font){
                            if(file_exists(JPATH_ROOT.'/components/com_osproperty/helpers/tcpdf/fonts/'.$font.'.php')){
                                $optionArr[] = JHtml::_('select.option',$font,$font);
                            }
                        }
                        echo JHtml::_('select.genericlist',$optionArr,'configuration[pdf_font]','class="chosen inputbox"','value','text',isset($configs['pdf_font'])? $configs['pdf_font']:'times');
                        ?>
                    </div>
                </div>
				<div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[property_pdf_layout]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('show_googlemap_pdf',JText::_( 'Show Map image in PDF' ), ''); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('show_googlemap_pdf',$configs['show_googlemap_pdf']);
                        ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('OS_RELATED_PROPERTIES')?></legend>

                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('relate_properties', JText::_( 'OS_SHOW_RELATED_PROPERTIES' ), JText::_('OS_SHOW_RELATED_PROPERTIES')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('relate_properties',$configs['relate_properties']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('max_relate',JTextOs::_( 'Max relate properties' ), JTextOs::_('Max relate properties explain')); ?>
                    </div>
                    <div class="controls">
                        <input type="text" class="input-mini" size="5" name="configuration[max_relate]" value="<?php echo isset($configs['max_relate'])? $configs['max_relate']:''; ?>"> <?php echo JText::_('OS_PROPERTIES');?>
                    </div>
                </div>

                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('relate_columns',JText::_( 'Number columns' ), JText::_('OS_RELATED_PROPERTIES_IN_COLUMNS')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $columns = array();
                        $columns[] = JHTML::_('select.option','2','2');
                        $columns[] = JHTML::_('select.option','3','3');
                        $columns[] = JHTML::_('select.option','4','4');
                        if (!isset($configs['relate_columns'])) $configs['relate_columns'] = '2';
                        echo JHtml::_('select.genericlist',$columns,'configuration[relate_columns]','class="chosen input-small"','value','text',$configs['relate_columns']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                    <strong>
                        How do you want to show related properties
                    </strong>
                    <BR />
                    <span style="font-style:italic;">OS Property has 2 related properties parts. 1 - By distances, 2 - By property type</span>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('relate_city',JText::_( 'Show related properties by distances' ), JText::_('Do you want to show related properties by distances')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('relate_city',$configs['relate_city']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('relate_distance',JText::_( 'Distance' ), JTextOs::_('Relate properties distance explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $distanceArr[] = JHTML::_('select.option','5','5 Miles');
                        $distanceArr[] = JHTML::_('select.option','10','10 Miles');
                        $distanceArr[] = JHTML::_('select.option','20','20 Miles');
                        $distanceArr[] = JHTML::_('select.option','50','50 Miles');
                        $distanceArr[] = JHTML::_('select.option','100','100 Miles');
                        if (!isset($configs['relate_distance'])) $configs['relate_distance'] = '0';
                        echo JHtml::_('select.genericlist',$distanceArr,'configuration[relate_distance]','class="chosen input-small"','value','text',$configs['relate_distance']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('relate_property_type',JText::_( 'Show related properties same type' ), JTextOs::_('Select relate properties in the same property type explain')); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('relate_property_type',$configs['relate_property_type']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                    <strong>
                        Filter related properties by price and categories
                    </strong>
                    </br>
                    <span style="font-style:italic;">Leave price empty if you don't want to filter related property by category and price</span>
                </div>
                <?php
                $db = JFactory::getDbo();
                $db->setQuery("Select id, category_name from #__osrs_categories where published = '1' order by ordering");
                $categories = $db->loadObjectList();
                if(count($categories)> 0){
                    foreach ($categories as $category){
                        ?>
                        <div class="control-group related_properties_category_price" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[relate_properties]' => '1')); ?>'>
                            <div class="control-label">
                                <?php echo $category->category_name; ?>
                            </div>
                            <div class="controls">
                                <input type="text" class="input-small" name="configuration[price_from_<?php echo $category->id; ?>]" value="<?php echo $configs['price_from_'.$category->id];?>" placeholder="From"/>
                                -
                                <input type="text" class="input-small" name="configuration[price_to_<?php echo $category->id; ?>]" value="<?php echo $configs['price_to_'.$category->id];?>" placeholder="To"/>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </fieldset>
			<?php
			if (version_compare(phpversion(), '5.4.0', 'ge')) {
			?>
            <fieldset>
                <legend><?php echo JText::_('OS_FACEBOOK_AUTO_POSTING')?></legend>
				This feature is used to post property details into Facebook. 
				<BR />
				<strong>Note: </strong>
				<BR />
				1. You need to enter App ID and App Secret and get Access Token
				<BR />
				2. This feature will update Published and Approved properties
				<BR /><BR />
                <script src="<?php echo JUri::root()?>media/com_osproperty/assets/js/all.js" type="text/javascript"></script>
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('facebook_autoposting', JText::_( 'OS_ENABLE_FACEBOOK_AUTO_POSTING' ), JText::_( 'OS_ENABLE_FACEBOOK_AUTO_POSTING' )); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('facebook_autoposting',$configs['facebook_autoposting']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[facebook_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('posting_properties',JText::_( 'OS_POSTING_PROPERTIES' ), JText::_( 'OS_POSTING_PROPERTIES' )); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $optionArr = array();
                        $optionArr[] = JHTML::_('select.option',0,JText::_('OS_BOTH_NEW_AND_UPDATED_PROPERTIES'));
                        $optionArr[] = JHTML::_('select.option',1,JText::_('OS_ONLY_NEW_PROPERTIES'));
                        $optionArr[] = JHTML::_('select.option',2,JText::_('OS_ONLY_UPDATED_PROPERTIES'));
                        echo JHTML::_('select.genericlist',$optionArr,'configuration[posting_properties]','class="chosen input-large"','value','text',$configs['posting_properties']);
                        ?>
                    </div>
                </div>
				<div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[facebook_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('facebook_version',JText::_( 'OS_FB_VERSION' ), JText::_( 'OS_FB_VERSION_EXPLAIN' )); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $optionArr = array();
                        $optionArr[] = JHTML::_('select.option',0,JText::_('Version 2.11 or higher'));
                        $optionArr[] = JHTML::_('select.option',1,JText::_('Version 2.10 or older'));
                        echo JHTML::_('select.genericlist',$optionArr,'configuration[facebook_version]','class="chosen input-large"','value','text',$configs['facebook_version']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[facebook_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('fb_app_id',JText::_( 'OS_FACEBOOK_APP_ID' ), JText::_( 'OS_FACEBOOK_APP_ID' )); ?>
                    </div>
                    <div class="controls">
                        <input type="text" id="fb_app_id" data-bind="value: app_id" class="input-medium" name="configuration[fb_app_id]" value="<?php echo isset($configs['fb_app_id'])? $configs['fb_app_id']:''; ?>">
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[facebook_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('fb_app_id',JText::_( 'OS_FACEBOOK_APP_SECRET' ), JText::_( 'OS_FACEBOOK_APP_SECRET' )); ?>
                    </div>
                    <div class="controls">
                        <input type="text" id="fb_app_secret" data-bind="value: app_secret" class="input-large" name="configuration[fb_app_secret]" value="<?php echo isset($configs['fb_app_secret'])? $configs['fb_app_secret']:''; ?>" />
                    </div>
                    <button class="btn btn-primary" type="button" onClick="javascript:getFbToken()"><?php echo JText::_('Get Access Token')?></button>
                    <div id="location_div"></div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[facebook_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('fb_app_id',JText::_( 'OS_FACEBOOK_ACCESS_TOKEN' ), JText::_( 'OS_FACEBOOK_ACCESS_TOKEN' )); ?>
                    </div>
                    <div class="controls">
                        <input data-bind="value: app_secret" class="input-large" id="access_token" type="text" name="configuration[access_token]" readonly="true" aria-invalid="true" value="<?php echo isset($configs['access_token'])? $configs['access_token']:''; ?>" />
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[facebook_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('fb_app_id',JText::_( 'OS_TARGET' ), JText::_( 'OS_TARGET' )); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $fb_params = $configs['fb_params'];
                        $fb_params = explode("||",$fb_params);

                        $fb_target = $configs['fb_target'];
                        ?>
                        <select name="configuration[fb_target]" id="fb_target" class="input-large">
                            <?php
                            if(count($fb_params) > 0){
                                foreach($fb_params as $param){
                                    $param = explode("@@",$param);
                                    $label = $param[0];
                                    if($label != ""){
                                        ?>
                                        <optgroup label="<?php echo $label;?>">
                                        <?php
                                    }
                                    $content = $param[1];
                                    $content = explode("{+}",$content);
                                    if(count($content) > 0){
                                        foreach($content as $optionValue){
                                            $optionValue = explode(":",$optionValue);

                                            if($fb_target == $optionValue[0]){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?php echo $optionValue[0]?>" <?php echo $selected; ?>><?php echo $optionValue[1]; ?></option>
                                            <?php
                                        }
                                    }

                                    if($label != ""){
                                        ?>
                                        </optgroup>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
				<textarea name="configuration[fb_params]" id="fb_params" style="display:none;"><?php echo $configs['fb_params'];?></textarea>
                <script language="JavaScript">
                    function getFbToken(){
                        var fb_app_id = document.getElementById('fb_app_id');
                        var fb_app_secret = document.getElementById('fb_app_secret');
                        if(fb_app_id.value == ""){
                            alert("Please enter Application ID");
                            return false;
                        }
                        if(fb_app_secret.value == ""){
                            alert("Please enter Application Secret");
                            return false;
                        }
                        xmlHttp=GetXmlHttpObject();
                        if (xmlHttp==null){
                            alert ("Browser does not support HTTP Request")
                            return
                        }

                        url = "https://graph.facebook.com/" + fb_app_id.value;
                        xmlHttp.onreadystatechange=ajaxfb;
                        xmlHttp.open("GET",url,true)
                        xmlHttp.send(null)
                    }

                    function ajaxfb(){
                        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
                            res = xmlHttp.responseText;
                            data = JSON.parse(res);

                            var fb_app_id = document.getElementById('fb_app_id');
                            var fb_app_secret = document.getElementById('fb_app_secret');
                            //if(typeof(data.icon_url) != 'undefined'){
                                var w = 550;
                                var h = 450;
                                var left = (screen.width/2)-(w/2);
                                var top = (screen.height/2)-(h/2);
                                window.open('index.php?option=com_osproperty&task=configuration_connectfb&tmpl=component&app_id='+fb_app_id.value+'&app_secret='+fb_app_secret.value, 'Get Access Token', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left).focus();
                            //}else{
                                //alert("Invalid App ID");
                            //}
                        }
                    }
                </script>
            </fieldset>
			<?php 
			}
			?>
			<fieldset>
                <legend><?php echo JText::_('OS_TWEET_AUTO_POSTING')?></legend>
                This feature is used to post property details into Twitter.com.
                <BR />
                <strong>Note: </strong>
                <BR />
                1. You need to enter Consumer Key, Consumer Secret, Access Token and Access Token Secret
                <BR />
                2. This feature will update Published and Approved properties
                <BR /><BR />
                <div class="control-group">
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('tweet_autoposting', JText::_( 'OS_ENABLE_TWEET_AUTO_POSTING' ), JText::_( 'OS_ENABLE_TWEET_AUTO_POSTING' )); ?>
                    </div>
                    <div class="controls">
                        <?php
                        OspropertyConfiguration::showCheckboxfield('tweet_autoposting',$configs['tweet_autoposting']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[tweet_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('tw_posting_properties',JText::_( 'OS_POSTING_PROPERTIES' ), JText::_( 'OS_POSTING_PROPERTIES' )); ?>
                    </div>
                    <div class="controls">
                        <?php
                        $optionArr = array();
                        $optionArr[] = JHTML::_('select.option',0,JText::_('OS_BOTH_NEW_AND_UPDATED_PROPERTIES'));
                        $optionArr[] = JHTML::_('select.option',1,JText::_('OS_ONLY_NEW_PROPERTIES'));
                        $optionArr[] = JHTML::_('select.option',2,JText::_('OS_ONLY_UPDATED_PROPERTIES'));
                        echo JHTML::_('select.genericlist',$optionArr,'configuration[tw_posting_properties]','class="chosen input-large"','value','text',$configs['tw_posting_properties']);
                        ?>
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[tweet_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('consumer_key',JText::_( 'OS_CONSUMER_KEY' ), JText::_( 'OS_CONSUMER_KEY' )); ?>
                    </div>
                    <div class="controls">
                        <input type="text" id="consumer_key"  class="input-large" name="configuration[consumer_key]" value="<?php echo isset($configs['consumer_key'])? $configs['consumer_key']:''; ?>">
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[tweet_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('consumer_key',JText::_( 'OS_CONSUMER_SECRET' ), JText::_( 'OS_CONSUMER_SECRET' )); ?>
                    </div>
                    <div class="controls">
                        <input type="text" id="consumer_secret" class="input-large" name="configuration[consumer_secret]" value="<?php echo isset($configs['consumer_secret'])? $configs['consumer_secret']:''; ?>" />
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[tweet_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('tw_access_token',JText::_( 'OS_ACCESS_TOKEN' ), JText::_( 'OS_ACCESS_TOKEN' )); ?>
                    </div>
                    <div class="controls">
                        <input type="text" id="tw_access_token" class="input-large" name="configuration[tw_access_token]" value="<?php echo isset($configs['tw_access_token'])? $configs['tw_access_token']:''; ?>" />
                    </div>
                </div>
                <div class="control-group" data-showon='<?php echo HelperOspropertyCommon::renderShowon(array('configuration[tweet_autoposting]' => '1')); ?>'>
                    <div class="control-label">
                        <?php echo HelperOspropertyCommon::showLabel('tw_access_token_secret',JText::_( 'OS_ACCESS_TOKEN_SECRET' ), JText::_( 'OS_ACCESS_TOKEN_SECRET' )); ?>
                    </div>
                    <div class="controls">
                        <input type="text" id="tw_access_token_secret" class="input-large" name="configuration[tw_access_token_secret]" value="<?php echo isset($configs['tw_access_token_secret'])? $configs['tw_access_token_secret']:''; ?>" />
                    </div>
                </div>
            </fieldset>
        </td>
    </tr>
</table>

