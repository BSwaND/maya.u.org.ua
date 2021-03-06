<?php
/*------------------------------------------------------------------------
# configuration.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2019 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die('Restricted access');

class HTML_OspropertyConfiguration
{
	function configurationHTML($option,$configs,$used_currencies)
    {
		global $mainframe,$_jversion,$configClass;
	    JHtml::_('behavior.multiselect');
		JToolBarHelper::title(JText::_('OS_CONFIGURATION'),"cog");
		JToolBarHelper::save('configuration_save');
		JToolBarHelper::apply('configuration_apply');
		JToolBarHelper::cancel('configuration_cancel');
		JToolbarHelper::custom('cpanel_list','featured.png', 'featured_f2.png',JText::_('OS_DASHBOARD'),false);
		JHTML::_('behavior.tooltip');
		?>
		<style>
			div.current fieldset {
				border: 1px solid #CCCCCC;
			}
			fieldset label, fieldset span.faux-label {
			    clear: right;
			}
			div.current label, div.current span.faux-label {
			    clear: none;
			    display: block;
			    float: left;
			    margin-top: 1px;
			    min-width: 30px;
			}
		</style>
		<?php
		if (!isset($configs['goole_map_resolution']) || !is_numeric($configs['goole_map_resolution']))
		{
		    $themapres 	    = "10";
		}
		else
		{
		    $themapres 	    = $configs['goole_map_resolution'];
		}
		$thedeclat 		    = $configClass['goole_default_lat'];
		$thedeclong 	    = $configClass['goole_default_long'];
		if (isset($configs['goole_map_latitude']) && is_float($configs['goole_map_latitude']))
		{
			    $thedeclat  = $configs['goole_map_latitude'];
		}
		if (isset($configs['goole_map_longitude']) && is_float($configs['goole_map_longitude']))
		{
			$thedeclong     = $configs['goole_map_longitude'];
		}
		$editorPlugin       = null;
		if (JPluginHelper::isEnabled('editors', 'codemirror'))
		{
			$editorPlugin   = 'codemirror';
		}
		elseif(JPluginHelper::isEnabled('editor', 'none'))
		{
			$editorPlugin   = 'none';
		}
		if ($editorPlugin)
		{
			$showCustomCss  = 1;
		}
		else
		{
			$showCustomCss  = 0;
		}
		?>
		<form method="POST" action="index.php?option=com_osproperty&task=configuration_list" name="adminForm" id="adminForm" enctype="multipart/form-data" class="form-horizontal">
		<div class="row-fluid">
			<ul class="joomla-tabs nav nav-tabs">
				<li class="nav-item active"><a class="nav-link" href="#general-page" data-toggle="tab"><?php echo JTextOs::_('GENERAL_SETTING');?></a></li>
				<li class="nav-item"><a class="nav-link" href="#properties" data-toggle="tab"><?php echo JTextOs::_('PROPERTIES');?></a></li>
				<li class="nav-item"><a class="nav-link" href="#payment" data-toggle="tab"><?php echo JTextOs::_('PAYMENT');?> & <?php echo JTextOs::_('Expiration');?></a></li>
                <li class="nav-item"><a class="nav-link" href="#homepage" data-toggle="tab"><?php echo JText::_('OS_LAYOUTS');?></a></li>
				<li class="nav-item"><a class="nav-link" href="#company" data-toggle="tab"><?php echo JTextOs::_('COMPANY');?></a></li>
				<li class="nav-item"><a class="nav-link" href="#agent" data-toggle="tab"><?php echo JTextOs::_('USERTYPE');?></a></li>
				<li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab"><?php echo JTextOs::_('IMAGES');?></a></li>
				<li class="nav-item"><a class="nav-link" href="#locator" data-toggle="tab"><?php echo JTextOs::_('SEARCH');?></a></li>
				<li class="nav-item"><a class="nav-link" href="#othersetting" data-toggle="tab"><?php echo JTextOs::_('CURRENCIES');?></a></li>
				<?php
				if($showCustomCss == 1)
				{
				?>
				    <li><a href="#customcss" data-toggle="tab"><?php echo JText::_('Custom CSS');?></a></li>
				<?php
				}
				jimport('joomla.filesystem.folder');
	        	if(JFolder::exists(JPATH_ROOT.DS."components".DS."com_osmembership"))
	        	{
	        		?>
	        		<li><a href="#membership" data-toggle="tab"><?php echo JText::_('MEMBERSHIP');?></a></li>
	        		<?php
	        	}
	        	if(JFolder::exists(JPATH_ROOT.DS."components".DS."com_oscalendar"))
	        	{
	        		?>
	        		<li><a href="#oscalendar" data-toggle="tab"><?php echo JText::_('OSCALENDAR');?></a></li>
	        		<?php
	        	}
				?>
				<li><a href="#downloadid" data-toggle="tab"><?php echo JText::_('Download ID');?></a></li>
			</ul>
			<div class="tab-content">	
				<div class="tab-pane active" id="general-page">
					<table  width="100%">
						<tr>
							<td width="50%" valign="top">
								<!--  Business setting -->
								<?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/business.php');?>
								<?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/currency.php');?>
                                <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/spam.php');?>
                                <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/privacy.php');?>
							</td>
							<td valign="top">
                                <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/layout_of_site.php');?>
								<!--  Top menu -->
                                <?php
                                if(file_exists(JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/google_maps/google_map.php'))
                                {
                                    require_once(JPATH_COMPONENT_ADMINISTRATOR .'/classes/configuration/google_maps/google_map.php');
                                }
                                ?>
							</td>
						</tr>
					</table>
				</div>
		       	<div class="tab-pane" id="properties">
                    <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/properties/property.php');?>
	       		</div>
				<div class="tab-pane" id="payment">
                    <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/payment.php');?>
					<?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/cron_task.php'); ?>
	       		</div>
                <div class="tab-pane" id="homepage">
                    <?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/general/homepage.php');?>
                </div>
	       		<div class="tab-pane" id="company">
					<!-- 	Fieldset Agent Settings  -->
					<?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/company/company.php');?>
					<!-- end Fieldset Agent Settings  -->
		       	</div>
		       	<div class="tab-pane" id="agent">
					<!-- 	Fieldset Agent Settings  -->
					<?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/agents/agent.php');?>
					<!-- end Fieldset Agent Settings  -->
		       	</div>
		       	<div class="tab-pane" id="images">
					<!-- 	Fieldset Properties Settings  -->
					<?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/images/image.php');?>
					<!-- end Fieldset Agent Settings  -->
		       	</div>
	       		<div class="tab-pane" id="locator">
	       		<?php
	        	if(file_exists(JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/locator/locator.php'))
	        	{
                    require_once(JPATH_COMPONENT_ADMINISTRATOR .'/classes/configuration/locator/locator.php');
                }
	        	?>
	        	</div>
				<div class="tab-pane" id="othersetting">
					<fieldset>
						<legend><?php echo JText::_('OS_USED_CURRENCIES')?></legend>
					</fieldset>
					<table class="adminlist table table-striped">
						<thead>
							<tr>
								<th >
									<?php
										echo JText::_('OS_CURRENCY_NAME');
									?>
								</th>
								<th class="center">
									<?php
										echo JText::_('OS_CURRENCY_CODE');
									?>
								</th>
								<th class="center">
									<?php
										echo JText::_('OS_CURRENCY_SYMBOL');
									?>
								</th>
								<th class="center">
									<?php
										echo JText::_('OS_PUBLISHED');
									?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$k = 0;
							for ($i = 0, $n = count($used_currencies); $i < $n; $i++)
							{
								$row = $used_currencies[$i];
								?>
								<tr class="<?php echo "row$k"; ?>">
									<td>
										<?php
											echo $row->currency_name;
										?>
									</td>
									<td class="center">
										<?php
											echo $row->currency_code;
										?>
									</td>
									<td class="center">
										<?php
											echo $row->currency_symbol;
										?>
									</td>
									<td class="center">
										<div id="div_<?php echo $row->id;?>">
										<?php
											if($row->published == 1)
											{
												?>
												<a href="javascript:changePublishedStatus(0,<?php echo $row->id?>,'<?php echo JUri::base();?>')" title="<?php echo JText::_('OS_CLICK_HERE_TO_UNPUBLISH_CURRENCY');?>">
													<i class="icon-star colorgreen"></i>
												</a>
												<?php
											}
											else
											{
												?>
												<a href="javascript:changePublishedStatus(1,<?php echo $row->id?>,'<?php echo JUri::base();?>')" title="<?php echo JText::_('OS_CLICK_HERE_TO_PUBLISH_CURRENCY');?>">
													<i class="icon-star colorred" ></i>
												</a>
												<?php
											}
										?>
										</div>
									</td>
								</tr>
								<?php
							}	
							?>
						</tbody>
					</table>
				</div>
				<?php
				if($showCustomCss == 1)
				{
				?>
				<div class="tab-pane" id="customcss">
					<table  width="100%">
						<tr>
							<td>
								<?php
								$customCss = '';
								if (file_exists(JPATH_ROOT.'/media/com_osproperty/assets/css/custom.css'))
								{
									$customCss = file_get_contents(JPATH_ROOT.'/media/com_osproperty/assets/css/custom.css');
								}
								echo JEditor::getInstance($editorPlugin)->display('configuration[custom_css]', $customCss, '100%', '550', '75', '8', false, null, null, null, array('syntax' => 'css'));
								?>
							</td>
						</tr>
					</table>
				</div>
				<?php
				}
		        jimport('joomla.filesystem.folder');
		        if(JFolder::exists(JPATH_ROOT.DS."components".DS."com_osmembership"))
		        {
			       	?>
			       	<div class="tab-pane" id="membership">
			       		<table  width="100%">
			       			<tr>
			       				<td>
			       					<!-- 	Fieldset Properties Settings  -->
			       					<?php 
			       					require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/membership/membership.php');?>
			       					<!-- end Fieldset Agent Settings  -->
			       				</td>
			       			</tr>
			       		</table>
			       	</div>
			       	<?php
		        }
		        else
		        {
					$db = Jfactory::getDBO();
					$db->setQuery("Update #__osrs_configuration set fieldvalue = '0' where fieldname like 'integrate_membership'");
					$db->execute();
				}
		        if(JFolder::exists(JPATH_ROOT.DS."components".DS."com_oscalendar"))
		        {
			       	?>
			       	<div class="tab-pane" id="oscalendar">
			       		<table  width="100%">
			       			<tr>
			       				<td>
			       					<!-- 	Fieldset Properties Settings  -->
			       					<?php require_once (JPATH_COMPONENT_ADMINISTRATOR.'/classes/configuration/calendar/calendar.php');?>
			       					<!-- end Fieldset Agent Settings  -->
			       				</td>
			       			</tr>
			       		</table>
			       	</div>
			       	<?php
		        }
				?>
				<div class="tab-pane" id="downloadid">
					<table  width="100%">
						<tr>
							<td>
								<strong>Download ID: </strong><input type="text" class="input-xlarge" id="download_id" name="configuration[download_id]" value="<?php echo isset($configClass['download_id'])? $configClass['download_id']:''; ?>"/>
								<BR />
								<span class="colorred">
								Enter your Download ID into this config option to be able to use Joomla Update to update your site to latest version of OS Property whenever there is new version available. To register Download ID, please go to: <a href="http://joomdonation.com" target="_blank">www.joomdonation.com</a> and click on menu <strong><a href="http://joomdonation.com/download-ids.html" target="_blank">Download ID</a></strong>. <strong>Notice:</strong> You should login before you access to this page. 
								</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
        </div>
        <input type="hidden" name="option" value="com_osproperty" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="MAX_UPLOAD_SIZE" value="9000000" />
		<input type="hidden" name="currency_id_pos" id="currency_id_pos" value="" />
        </form>
		<script type="text/javascript">
		function changePublishedStatus(status,id,live_site){
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null){
				alert ("Browser does not support HTTP Request")
				return
			}
			var currency_id_pos = document.getElementById('currency_id_pos');
			currency_id_pos.value = id;
			url = live_site + "index.php?option=com_osproperty&no_html=1&tmpl=component&task=configuration_changecurrencystatus&id=" + id + "&status=" + status;
			xmlHttp.onreadystatechange=updateCurrency;
			xmlHttp.open("GET",url,true)
			xmlHttp.send(null)
		}
		function updateCurrency() { 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
				var currency_id_pos = document.getElementById('currency_id_pos');
				currency_id_pos = currency_id_pos.value;
				document.getElementById("div_" + currency_id_pos).innerHTML = xmlHttp.responseText ;
				
			} 
		}
		</script>
        <?php 
	}
}
?>