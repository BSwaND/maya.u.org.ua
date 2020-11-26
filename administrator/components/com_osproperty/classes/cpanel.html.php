<?php
/*------------------------------------------------------------------------
# cpanel.html.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2016 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die('Restricted access');

class HTML_OspropertyCpanel{
	function cpanelHTML($option,$lists,$countries){
		global $mainframe,$configClass,$langArr,$languages;
		$db = JFactory::getDbo();
		$user = Jfactory::getUser();
		
		$document = JFactory::getDocument();
		$document->addScript(JURI::root().'media/com_osproperty/assets/js/ajax.js');
		$document->setTitle($configClass['general_bussiness_name']);
		//toolbar
		JToolBarHelper::title(JText::_('OS_CPANEL'),"home");
		//JToolBarHelper::cancel();
		JToolBarHelper::preferences('com_osproperty');
		$options = array(
				    'onActive' => 'function(title, description){
				        description.setStyle("display", "block");
				        title.addClass("open").removeClass("closed");
				    }',
				    'onBackground' => 'function(title, description){
				        description.setStyle("display", "none");
				        title.addClass("closed").removeClass("open");
				    }',
				    'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
				    'useCookie' => true, // this must not be a string. Don't use quotes.
				);
		//html
		if (version_compare(JVERSION, '3.0', 'lt')) {
			$width1 = 50;
			$width2 = 50; 
		}else{
			$width1 = 40;
			$width2 = 60; 
		}
		?>
		<form method="POST" action="index.php" name="adminForm">
		<table  width="100%" class="table table-striped">
			<tr>
				<th>
					<?php echo JText::_('OS_SYSTEM_INFORMATION')?>
				</th>
				<th>
					<?php echo JText::_('OS_CONTROLPANEL')?>
				</th>
			</tr>
			<tr>
				<td width="<?php echo $width1?>%" style="vertical-align:top !important;">
					<div class="row-fluid">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general-page" data-toggle="tab"><?php echo JText::_('OS_SETUP');?></a></li>
						<li><a href="#statistic" data-toggle="tab"><?php echo JText::_('OS_STATISTIC');?></a></li>
						<?php
						if(file_exists(JPATH_ROOT.DS."components".DS."com_osproperty".DS."changelog.txt")){
						?>
						<li><a href="#log" data-toggle="tab"><?php echo JText::_('OS_CHANGELOG');?></a></li>
						<?php
						}
						?>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="general-page">
						<div class="width-100 fltlft">
							<fieldset class="adminform">
								<table  width="100%">
									<tr>
										<td width="100%" class="fontbold backgroundlightgray padding10" style="font-size:14px;border-bottom:1px solid #CCC;">
											<?php echo JText::_('OS_SETUP')?>
										</td>
									</tr>
									<tr>
										<td width="100%">
											<?php
											$yesimg = "<img src='".JURI::root()."media/com_osproperty/assets/images/tick.png'>";
											$noimg  = "<img src='".JURI::root()."media/com_osproperty/assets/images/publish_x.png'>";
											
											?>
											<div class="accordion" id="accordion1">
												<div class="accordion-group">
													<div class="accordion-heading">
														<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
															<i class="icon-play"></i><?php echo JText::_('OS_SETUP');?>
														</a>
													</div>
												<div id="collapseOne" class="accordion-body collapse in">
												<div class="accordion-inner">
											
											<table  width="100%" class="table table-striped">
												<thead>
													<tr>
														<th width="30%">
															<?php echo JText::_('OS_ITEM_INSTALL')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_STATUS')?>
														</th>
														<th width="60%">
															<?php echo JText::_('OS_DESCRIPTION')?>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if(file_exists(JPATH_ROOT.DS."components".DS."com_osproperty".DS."version.txt")){
														
													$fh = fopen(JPATH_ROOT.DS."components".DS."com_osproperty".DS."version.txt","r");
													$version = fread($fh,filesize(JPATH_ROOT.DS."components".DS."com_osproperty".DS."version.txt"));
													@fclose($fh);
													?>
													<tr>
														<td align="left" class="padding5" style="vertical-align:middle;">
															<b><?php echo JText::_('Current version')?></b>
														</td>
														<td class="padding5 fontbold center" style="vertical-align:middle;">
															<?php
															  echo $version;
															?>
														</td>
														<td align="left" class="padding5">
															<div class="row-fluid">
																<div class="span12 ospversion_div" id="ospversion">
																	<img src="<?php echo JUri::root()?>media/com_osproperty/assets/images/updated_failure.png" />
																	<div class="clearfix"></div>
																	<span class="version-checking">Checking..</span>
																</div>
															</div>
														</TD>
													</tr>
													<?php
													}
													?>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_OSPROPERTY_CRONJOB_PLUGIN')?></b>
														</td>
														<td class="padding5 center">
															<?php
															if($lists['plugin'] == 1){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5 fontsmall">
															<?php
															echo JText::_('OS_SYSTEM_CRONJOB_MUST_BE_INSTALLED');
															?>
														</TD>
													</tr>
													
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_GD_LIB')?></b>
															<font color='red'>(<?php echo JText::_('OS_REQUIRED')?>)</font>
														</td>
														<td class="padding5 center">
															<?php
															if($lists['gd'] == 1){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_GD_LIB_EXPLAIN');
															?>
														</TD>
													</tr>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_GD_LIB_JPEG')?></b>
															<font color='red'>(<?php echo JText::_('OS_REQUIRED')?>)</font>
														</td>
														<td class="padding5 center">
															<?php
															if($lists['gd_jpg'] == 1){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_GD_LIB_JPEG_EXPLAIN');
															?>
														</TD>
													</tr>
												</tbody>
											</table>
											<?php
											
											?>
											</div>
											</div>
											</div>
											<div class="accordion-group">
												<div class="accordion-heading">
													<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
														<i class="icon-play"></i><?php echo JText::_('OS_ITEM_DATA');?>
													</a>
												</div>
											<div id="collapseTwo" class="accordion-body collapse">
											<div class="accordion-inner">
											
											<table  width="100%" class="table table-striped">
												<thead>
													<tr>
														<th width="30%">
															<?php echo JText::_('OS_ITEM_DATA')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_STATUS')?>
														</th>
														<th width="60%">
															<?php echo JText::_('OS_DESCRIPTION')?>
														</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_PROPERTY')?></b><font color='red'>(<?php echo JText::_('OS_REQUIRED')?>)</font>
														</td>
														<td align="center" class="padding5">
															<?php
															if($lists['properties'] > 0){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_AT_LEAST_ONE_PROPERTY_MUST_BE_CREATED');
															?>
														</TD>
													</tr>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_CATEGORY')?></b><font color='red'>(<?php echo JText::_('OS_REQUIRED')?>)</font>
														</td>
														<td align="center" class="padding5">
															<?php
															if($lists['categories'] > 0){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_AT_LEAST_ONE_CATEGORY_MUST_BE_CREATED');
															?>
														</TD>
													</tr>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_PROPERTY_TYPE')?></b>
														</td>
														<td align="center" class="padding5">
															<?php
															if($lists['type'] > 0){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_YOU_HAVE_NOT_CREATED_ANY_PROPERTY_TYPE');
															?>
														</TD>
													</tr>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_AGENT')?></b><font color='red'>(<?php echo JText::_('OS_REQUIRED')?>)</font>
														</td>
														<td align="center" class="padding5">
															<?php
															if($lists['agent'] > 0){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_AT_LEAST_ONE_AGENT_MUST_BE_CREATED');
															?>
														</TD>
													</tr>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_AMENITIES')?></b>
														</td>
														<td align="center" class="padding5">
															<?php
															if($lists['amenities'] > 0){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_YOU_HAVE_NOT_CREATED_ANY_AMENITTY');
															?>
														</TD>
													</tr>
													<tr>
														<td align="left" class="padding5">
															<b><?php echo JText::_('OS_PRICEGROUP')?></b>
														</td>
														<td align="center" class="padding5">
															<?php
															if($lists['pricegroups'] > 0){
																echo $yesimg;
															}else{
																echo $noimg;
															}
															?>
														</td>
														<td align="left" class="padding5">
															<?php
															echo JText::_('OS_YOU_HAVE_NOT_CREATED_ANY_PRICE_GROUP');
															?>
														</TD>
													</tr>
												</tbody>
											</table>
											<?php
											if (JFactory::getUser()->authorise('location', 'com_osproperty')) {
												?>
												</div>
												</div>
												</div>
												<div class="accordion-group">
													<div class="accordion-heading">
														<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree">
															<i class="icon-play"></i><?php echo JText::_('OS_LOCATION');?>
														</a>
													</div>
												<div id="collapseThree" class="accordion-body collapse">
												<div class="accordion-inner">
												
												<div id="location_div">
												
												</div>
												<?php
												
												?>
												</div>
												</div>
												</div>
												</div>
											<?php 
											}
											?>
											<script language="javascript">
												window.onload = function() {
												   initLocation();
												};
											</script>
										</td>
									</tr>
								</table>
							</fieldset>
							</div>
						</div>
						<div class="tab-pane" id="statistic">	
							<div class="width-100 fltlft">
								<fieldset class="adminform">
								<table  width="100%">
									<tr>
										<td width="100%" class="padding10 fontbold backgroundlightgray" style="font-size:14px;border-bottom:1px solid #CCC;">
											<?php echo JText::_('OS_STATISTIC')?>
										</td>
									</tr>
									<tr>
										<td width="100%">
										<?php
										if (version_compare(JVERSION, '4.0.0-dev', 'ge'))
										{
											echo JHtml::_('bootstrap.startAccordion', 'slide_pane1', array('active' => 'contentstatistic'));
											echo JHtml::_('bootstrap.addSlide', 'slide_pane1', '<i class="icon-file"></i>&nbsp;'.JText::_('OS_CONTENT_STATISTIC'), 'contentstatistic');	
										}
										else
										{
											echo JHtml::_('sliders.start', 'slide_pane1');
											echo JHtml::_('sliders.panel', JText::_('OS_CONTENT_STATISTIC'), 'contentstatistic');
										}
										?>
										<table  width="100%" class="table table-striped">
											<thead>
												<tr>
													<th colspan="2">
														<?php echo JText::_('OS_AGENT_ACCOUNT');?>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_TOTAL_ACCOUNT')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['agent_active'] + $lists['agent_unactive'];?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_ACTIVE_ACCOUNT')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['agent_active']?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_UNACTIVE_ACCOUNT')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['agent_unactive']?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_REQUEST_APPROVAL')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['agent_request']?>
													</td>
												</tr>
											</tbody>
											<thead>
												<tr>
													<th colspan="2">
														<?php echo JText::_('OS_LISTING');?>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_TOTAL_PROPERTIES')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['property_approved'] + $lists['property_unapproved']?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_ACTIVE_PROPERTY')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['property_approved']?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_UNACTIVE_PROPERTY')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['property_unapproved']?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_REQUEST_APPROVAL')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['property_request']?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_FEATURED')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['property_featured']?>
													</td>
												</tr>
												<tr>
													<td width="80%" align="left" class="padding5">
														<?php echo JText::_('OS_REQUEST_TO_FEATURED')?>
													</td>
													<td width="20%" align="center" class="padding5">
														<?php echo $lists['property_request_featured']?>
													</td>
												</tr>
											</tbody>
										</table>
										<?php
										if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
											echo JHtml::_('bootstrap.endSlide');
										}
										$row_mostview = $lists['mostviewed'];
										if(count($row_mostview) > 0){
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.addSlide', 'slide_pane1', '<i class="icon-clock"></i>&nbsp;'.JText::_('OS_MOST_VIEWED_PROPERTY'), 'propertystatistic');
											}
											else
											{
												echo JHtml::_('sliders.panel', JText::_('OS_MOST_VIEWED_PROPERTY'), 'propertystatistic');	
											}
											?>
											<table  width="100%" class="table table-striped">
												<thead>
													<tr>
														<th width="5%">
															ID
														</th>
														<th width="5%">
															<?php echo JText::_('OS_EDIT')?>
														</th>
														<th width="60%">
															<?php echo JText::_('OS_PROPERTY')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_HITS')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_FAVORITES')?>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php
													for($i=0;$i<count($row_mostview);$i++){
														$row = $row_mostview[$i];
														$link = "index.php?option=com_osproperty&task=properties_edit&id=$row->id";
														?>
														<tr>
															<td align="center">
																<?php echo $row->id?>
															</td>
															<td align="center">
																<a href="<?php echo $link?>" target="_blank">
																	<?php echo JText::_('OS_EDIT')?>
																</a>
															</td>
															<td align="left">
																<?php echo $row->pro_name?>
															</td>
															<td align="left">
																<?php echo $row->hits?>
															</td>
															<td align="center">
																<?php
																$db->setQuery("Select count(id) from #__osrs_favorites where pro_id = '$row->id'");
																$count = $db->loadResult();
																echo intval($count);
																?>
															</td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
											<?php
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.endSlide');
											}
										}
										$row_favorites = $lists['mostfavorites'];
										if(count($row_mostview) > 0){
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.addSlide', 'slide_pane1', '<i class="icon-clock"></i>&nbsp;'.JText::_('OS_MOST_FAVORITES_PROPERTY'), 'propertyfav');
											}
											else
											{
												echo JHtml::_('sliders.panel', JText::_('OS_MOST_FAVORITES_PROPERTY'), 'propertyfav');		
											}
											?>
											<table  width="100%" class="table table-striped">
												<thead>
													<tr>
														<th width="5%">
															ID
														</th>
														<th width="5%">
															<?php echo JText::_('OS_EDIT')?>
														</th>
														<th width="60%">
															<?php echo JText::_('OS_PROPERTY')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_HITS')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_FAVORITES')?>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php
													for($i=0;$i<count($row_favorites);$i++){
														$row = $row_favorites[$i];
														$link = "index.php?option=com_osproperty&task=properties_edit&id=$row->pro_id";
														?>
														<tr>
															<td align="center">
																<?php echo $row->pro_id?>
															</td>
															<td align="center">
																<a href="<?php echo $link?>" target="_blank">
																	<?php echo JText::_('OS_EDIT')?>
																</a>
															</td>
															<td align="left">
																<?php echo $row->pro_name?>
															</td>
															<td align="left">
																<?php echo $row->hits?>
															</td>
															<td align="center">
																<?php
																$db->setQuery("Select count(id) from #__osrs_favorites where pro_id = '$row->pro_id'");
																$count = $db->loadResult();
																echo intval($count);
																?>
															</td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
											<?php
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.endSlide');
											}
										}
										$row_rate= $lists['mostrate'];
										if(count($row_rate) > 0){
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.addSlide', 'slide_pane1', '<i class="icon-clock"></i>&nbsp;'.JText::_('OS_MOST_RATED_PROPERTY'), 'propertyrate');
											}
											else
											{
												echo JHtml::_('sliders.panel', JText::_('OS_MOST_RATED_PROPERTY'), 'propertyrate');			
											}
											?>
											<table  width="100%" class="table table-striped">
												<thead>
													<tr>
														<th width="5%">
															ID
														</th>
														<th width="5%">
															<?php echo JText::_('OS_EDIT')?>
														</th>
														<th width="60%">
															<?php echo JText::_('OS_PROPERTY')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_HITS')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_FAVORITES')?>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php
													for($i=0;$i<count($row_rate);$i++){
														$row = $row_rate[$i];
														$link = "index.php?option=com_osproperty&task=properties_edit&id=$row->id";
														?>
														<tr>
															<td align="center">
																<?php echo $row->id?>
															</td>
															<td align="center">
																<a href="<?php echo $link?>" target="_blank">
																	<?php echo JText::_('OS_EDIT')?>
																</a>
															</td>
															<td align="left">
																<?php echo $row->pro_name?>
															</td>
															<td align="left">
																<?php echo $row->hits?>
															</td>
															<td align="center">
																<?php
																$db->setQuery("Select count(id) from #__osrs_favorites where pro_id = '$row->id'");
																$count = $db->loadResult();
																echo intval($count);
																?>
															</td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
											<?php
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.endSlide');
											}
										}
										$row_comment= $lists['mostcomments'];
										if(count($row_comment) > 0){
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.addSlide', 'slide_pane1', '<i class="icon-clock"></i>&nbsp;'.JText::_('OS_MOST_COMMENTED_PROPERTY'), 'propertycomment');
											}
											else
											{
												echo JHtml::_('sliders.panel', JText::_('OS_MOST_COMMENTED_PROPERTY'), 'propertycomment');	
											}
											?>
											<table  width="100%" class="table table-striped">
												<thead>
													<tr>
														<th width="5%">
															ID
														</th>
														<th width="5%">
															<?php echo JText::_('OS_EDIT')?>
														</th>
														<th width="60%">
															<?php echo JText::_('OS_PROPERTY')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_HITS')?>
														</th>
														<th width="10%">
															<?php echo JText::_('OS_FAVORITES')?>
														</th>
													</tr>
												</thead>
												<tbody>
													<?php
													for($i=0;$i<count($row_comment);$i++){
														$row = $row_comment[$i];
														$link = "index.php?option=com_osproperty&task=properties_edit&id=$row->pro_id";
														?>
														<tr>
															<td align="center">
																<?php echo $row->pro_id?>
															</td>
															<td align="center">
																<a href="<?php echo $link?>" target="_blank">
																	<?php echo JText::_('OS_EDIT')?>
																</a>
															</td>
															<td align="left">
																<?php echo $row->pro_name?>
															</td>
															<td align="left">
																<?php echo $row->hits?>
															</td>
															<td align="center">
																<?php
																$db->setQuery("Select count(id) from #__osrs_favorites where pro_id = '$row->pro_id'");
																$count = $db->loadResult();
																echo intval($count);
																?>
															</td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
											<?php
											if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
												echo JHtml::_('bootstrap.endSlide');
											}
										}

										if (version_compare(JVERSION, '4.0.0-dev', 'ge')){
											echo JHtml::_('bootstrap.endAccordion');
										}else{
											echo JHtml::_('sliders.end');	
										}
										?>
										</td>
									</tr>
								</table>
							</fieldset>
							</div>
						</div>
						<?php
						if(file_exists(JPATH_ROOT.DS."components".DS."com_osproperty".DS."changelog.txt")){
						?>
						<div class="tab-pane" id="log">	
							<div class="width-100 fltlft">
								<fieldset class="adminform">
								<table  width="100%">
									<tr>
										<td width="100%" class="padding10 fontbold backgroundlightgray" style="font-size:14px;border-bottom:1px solid #CCC;">
											<?php echo JText::_('OS_CHANGELOG')?>
										</td>
									</tr>
									<tr>
										<td width="100%" class="fontsmall padding5 backgroundlightgray" style="border-bottom:1px solid #CCC;">
											<div style="width:100%;height:400px;overflow-y:scroll;">
												<?php
												 $file = fopen(JPATH_ROOT.DS."components".DS."com_osproperty".DS."changelog.txt",'r');
										         while(!feof($file)) { 
										             $name = fgets($file);
										             echo $name; 
										             echo "<BR />";
										         }
												?>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<?php
						}
						?>
						</div>
					</div>
				</td>
				<td width="<?php echo $width2?>%" style="vertical-align:top !important;">
					<table  width="100%">
						<tr>
							<td>
								<div id="cpanel">
									<?php
									OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=configuration_list', 'setting.png', JText::_('OS_CONFIGURATION'));
									if (JFactory::getUser()->authorise('categories', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=categories_list', 'categories.png', JText::_('OS_MANAGE_CATEGORIES'));
									}
									if (JFactory::getUser()->authorise('type', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=type_list', 'type.png', JText::_('OS_MANAGE_PROPERTY_TYPES'));
									}
									if (JFactory::getUser()->authorise('convenience', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=amenities_list', 'convenience.png', JText::_('OS_MANAGE_CONVENIENCE'));
									}
									if (JFactory::getUser()->authorise('properties', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=properties_list', 'property.png', JText::_('OS_MANAGE_PROPERTIES'));
									}
									if (JFactory::getUser()->authorise('pricelists', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=pricegroup_list', 'price.png', JText::_('OS_MANAGE_PRICELIST'));
									}
									if (JFactory::getUser()->authorise('agents', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=agent_list', 'users.png', JText::_('OS_MANAGE_AGENTS'));
									}
									if (JFactory::getUser()->authorise('companies', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=companies_list', 'company.png', JText::_('OS_MANAGE_COMPANIES'));
									}
									if (JFactory::getUser()->authorise('extrafieldgroups', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=fieldgroup_list', 'group.png', JText::_('OS_MANAGE_FIELD_GROUPS'));
									}
									if (JFactory::getUser()->authorise('extrafields', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=extrafield_list', 'fields.png', JText::_('OS_MANAGE_EXTRA_FIELDS'));
									}
									if (JFactory::getUser()->authorise('location', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=state_list', 'state.png', JText::_('OS_MANAGE_STATES'));
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=city_list', 'city.png', JText::_('OS_MANAGE_CITY'));
									}
									if (JFactory::getUser()->authorise('email', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=email_list', 'email.png', JText::_('OS_MANAGE_EMAIL_FORMS'));
									}
									if (JFactory::getUser()->authorise('comments', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=comment_list', 'comment.png', JText::_('OS_MANAGE_COMMENTS'));
									}
									if (JFactory::getUser()->authorise('tags', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&amp;task=tag_list', 'tag.png', JText::_('OS_MANAGE_TAGS'));
									}
									if (JFactory::getUser()->authorise('themes', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=theme_list', 'theme.png', JText::_('OS_MANAGE_THEMES'));
									}
									if (JFactory::getUser()->authorise('transaction', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=transaction_list', 'order.png', JText::_('OS_MANAGE_TRANSACTION'));
									}
									if (JFactory::getUser()->authorise('plugin_list', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=plugin_list', 'payment_plugin.png', JText::_('OS_PAYMENT_PLUGINS'));
									}
									if (JFactory::getUser()->authorise('csv', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=form_default', 'csv.png', JText::_('OS_CSV_FORM'));
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=csvexport_default', 'csvexport.png', JText::_('OS_EXPORT_CSV'));
									}
									if (JFactory::getUser()->authorise('xml', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=xml_default', 'xmlexport.png', JText::_('OS_EXPORT_XML'));
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=xml_defaultimport', 'xmlimport.png', JText::_('OS_IMPORT_XML'));
									}
									OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=properties_backup', 'export.png', JText::_('OS_BACKUP'));
									OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=properties_restore', 'restore.png', JText::_('OS_RESTORE'));
									if (JFactory::getUser()->authorise('translation', 'com_osproperty')) {
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=translation_list', 'translate.png', JText::_('OS_TRANSLATION_LIST'));
									}
									OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&task=properties_prepareinstallsample', 'install.png', JText::_('OS_INSTALLSAMPLEDATA'));
									OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&amp;task=properties_sefoptimize', 'icon-48-sef.png', JText::_('OS_OPTIMIZE_SEF_URLS'));
									$translatable = JLanguageMultilang::isEnabled() && count($languages);
									if($translatable){
										OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&amp;task=properties_syncdatabase', 'sync.png', JText::_('OS_SYNC_MULTILINGUAL_DATABASE'));
									}
									if($configClass['enable_report'] == 1){
										$db->setQuery("Select count(id) from #__osrs_report where is_checked = '0'");
										$count_report = $db->loadResult();
										if($count_report > 0){
											OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&amp;task=report_listing', 'notice_new.png', JText::_('OS_USER_REPORT'));
										}else{
											OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&amp;task=report_listing', 'notice.png', JText::_('OS_USER_REPORT'));
										}
									}
									OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&amp;task=properties_reGeneratePictures', 'image.png', JText::_('OS_REGENERATE_PICTURES'));
                                    OspropertyCpanel::quickiconButton('index.php?option=com_osproperty&amp;task=configuration_help', 'help.png', JText::_('JTOOLBAR_HELP'));
									?>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<input type="hidden" name="option" value="" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="live_site" id="live_site" value="<?php echo JUri::root();?>" />
		</form>
		<?php
	}
}
?>