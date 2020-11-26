<?php

/*------------------------------------------------------------------------
# details.html.tpl.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2018 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// No direct access.
defined('_JEXEC') or die;
$db					= JFactory::getDbo();
$document			= JFactory::getDocument();
$document->addStyleSheet(JURI::root()."components/com_osproperty/templates/".$themename."/style/style.css");
$document->addStyleSheet(JURI::root()."components/com_osproperty/templates/".$themename."/style/font.css");
$extrafieldncolumns = $params->get('extrafieldncolumns',3);
$show_location		= $params->get('show_location',1);
$module_ids			= $params->get('module_ids','');
OSPHelperJquery::colorbox('osmodal');
?>
<style>
#main ul{
	margin:0px;
}
</style>
<div id="notice" style="display:none;">
</div>
<?php
if(count($topPlugin) > 0){
	for($i=0;$i<count($topPlugin);$i++){
		echo $topPlugin[$i];
	}
}
?>
<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>" id="propertydetails">
	<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
				<script src="<?php echo JURI::root()?>media/com_osproperty/assets/js/jquery.bxslider.js"></script>
				<div>
					<div id="slides">
						 <script type="text/javascript" src="<?php echo JUri::root()?>media/com_osproperty/assets/js/colorbox/jquery.colorbox.js"></script>
						 <link rel="stylesheet" href="<?php echo JUri::root()?>media/com_osproperty/assets/js/colorbox/colorbox.css" type="text/css" media="screen" />
						 <script type="text/javascript">
						  jQuery(document).ready(function(){
							  jQuery(".propertyphotogroup").colorbox({rel:'colorbox',maxWidth:'95%', maxHeight:'95%'});
						  });
						</script>
						<?php
						if(count($photos) > 0){
							if(count($photos) == 1){
								?>
								<li class="propertyinfoli">
									<a class="propertyphotogroup propertyinfolilink" href="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/<?php echo $photos[0]->image?>">
										<?php
										OSPHelper::showPropertyPhoto($photos[0]->image,'medium',$row->id,'','','',$photos[0]->image_desc);
										?>
									</a>
								</li>
								<?php
							}else{
							?>
								<ul class="bxslider padding0 margin0">
									<?php
									for($i=0;$i<count($photos);$i++){
										if($photos[$i]->image != ""){
											if(JPATH_ROOT.'/images/osproperty/properties/'.$row->id.'/medium/'.$photos[$i]->image){
												?>
												<li class="propertyinfoli">
													<a class="propertyphotogroup propertyinfolilink" href="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/<?php echo $photos[$i]->image?>">
														<img class="pictureslideshow" src="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/medium/<?php echo $photos[$i]->image?>" alt="<?php echo $photos[$i]->image_desc;?>" title="<?php echo $photos[$i]->image_desc;?>"/>
													</a>
												</li>
												<?php
											}else{
												?>
												<li class="propertyinfoli"><img src="<?php echo JURI::root()?>media/com_osproperty/assets/images/nopropertyphoto.png" alt="<?php echo $photos[$i]->image_desc;?>" title="<?php echo $photos[$i]->image_desc;?>"/></li>
												<?php
											}
										}else{
											?>
											<li class="propertyinfoli"><img src="<?php echo JURI::root()?>media/com_osproperty/assets/images/nopropertyphoto.png" alt="<?php echo $photos[$i]->image_desc;?>" title="<?php echo $photos[$i]->image_desc;?>"/></li>
											<?php
										}
									}
									?>
								</ul>
								<script>
									jQuery(document).ready(function(){
										jQuery('.bxslider').bxSlider({
											pagerCustom: '#bx-pager',
											mode: 'fade',
											captions: true
										});
									});
								</script>
							<?php } ?>
						<?php
						}else{
						?>
							<ul class="bxslider padding0 margin0">
								<li class="propertyinfoli"><img src="<?php echo JURI::root()?>media/com_osproperty/assets/images/nopropertyphoto.png" alt="" title=""/></li>
							</ul>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> summary singleTop">
			<?php
			if($configClass['show_agent_details'] == 1){
				$span = $bootstrapHelper->getClassMapping('span8');
			}else{
				$span = $bootstrapHelper->getClassMapping('span12');
			}
			?>
			<div class="<?php echo $span; ?>">
				<?php
				if($row->isFeatured == 1){
					?>
					<div class="single-featured">
						<span class="osicon-star"></span>
						<?php echo JText::_('OS_FEATURED');?>
					</div>
					<div class="clearfix"></div>
					<?php
				}
				?>
				<h1 class="pageTitle">
					<?php
					$user = JFactory::getUser();

					if(HelperOspropertyCommon::isAgent()){
						$my_agent_id = HelperOspropertyCommon::getAgentID();
						if($my_agent_id == $row->agent_id){
							$link = JURI::root()."index.php?option=com_osproperty&task=property_edit&id=".$row->id;
							?>
								<a href="<?php echo $link?>" title="<?php echo JText::_('OS_EDIT_PROPERTY')?>" class="editproperty">
									<i class="osicon-edit"></i>
								</a>
							<?php
						}
					}
					if(($row->ref != "") and ($configClass['show_ref'] == 1)){
						?>
						<span color="orange">
						<?php echo $row->ref?>
					</span>
						-
						<?php
					}
					?>
					<?php echo $row->pro_name?> <span class="label label-yellow"><?php echo $row->type_name?></span>
					<?php
					if(($configClass['active_market_status'] == 1)&&($row->isSold > 0)){
						?>
						<span class="label label-green"><?php echo OSPHelper::returnMarketStatus($row->isSold);?></span>
						<?php
					}
						?>
				</h1>
				<?php
				if($row->show_address == 1){
					?>
					<div class="address">
						<?php
						echo OSPHelper::generateAddress($row);
						?>
					</div>
					<?php
				}
				?>
				<div class="singlePrice">
					<div class="listPrice">
						<?php echo $row->price1;?>
					</div>
					<div class="listCategory"> <?php echo $row->category_name?> </div>
				</div>
				<ul class="stats">
					<?php
					if($configClass['listing_show_view'] == 1){
					?>
					<li>
						<span class="osicon-eye"></span>
						<?php echo $row->hits;?>
					</li>
					<?php } ?>
					<?php
					if($configClass['comment_active_comment'] == 1){
					?>
					<li>
						<span class="edicon edicon-bubble2"></span>
						<?php echo $row->ncomments; ?>
					</li>
					<?php } ?>
				</ul>
				<?php
				if($configClass['enable_report'] == 1){
				?>
					<div class="reportLink">
						<a href="<?php echo JURI::root()?>index.php?option=com_osproperty&tmpl=component&item_type=0&task=property_reportForm&id=<?php echo $row->id?>" class="osmodal" rel="{handler: 'iframe', size: {x: 350, y: 600}}" title="<?php echo JText::_('OS_REPORT_LISTING');?>">
							<span class="icon-flag"></span>
						</a>
					</div>
				<?php }
				if($configClass['property_show_print'] == 1){
					?>
					<div class="printLink">
						<a target="_blank" href="<?php echo JURI::root()?>index.php?option=com_osproperty&tmpl=component&no_html=1&task=property_print&id=<?php echo $row->id?>">
							<span class="osicon-printer"></span>
						</a>
					</div>
					<?php
				}
				if($configClass['property_pdf_layout'] == 1){
					?>
					<div class="pdfLink">
						<a href="<?php echo JURI::root()?>index.php?option=com_osproperty&no_html=1&task=property_pdf&id=<?php echo $row->id?>" title="<?php echo JText::_('OS_EXPORT_PDF')?>"  rel="nofollow" target="_blank">
							<span class="edicon edicon-file-pdf"></span>
						</a>
					</div>
					<?php
				}
				if(($configClass['show_getdirection'] == 1) and ($row->show_address == 1)){
					?>
					<div class="getdirectionLink">
						<a href="<?php echo JRoute::_("index.php?option=com_osproperty&task=direction_map&id=".$row->id)?>" title="<?php echo JText::_('OS_GET_DIRECTIONS')?>">
							<span class="edicon edicon-compass"></span>
						</a>
					</div>
					<?php
				}
				if($configClass['show_compare_task'] == 1){
					?>
					<div class="comparePropertyLink">
						<span id="compare<?php echo $row->id;?>">
						<?php
						if(! OSPHelper::isInCompareList($row->id)) {
							$msg = JText::_('OS_DO_YOU_WANT_TO_ADD_PROPERTY_TO_YOUR_COMPARE_LIST');
							$msg = str_replace("'","\'",$msg);
							?>
							<a title="<?php echo JText::_('OS_ADD_TO_COMPARE_LIST');?>" onclick="javascript:osConfirmExtend('<?php echo $msg; ?>','ajax_addCompare','<?php echo $row->id ?>','<?php echo JURI::root() ?>','compare<?php echo $row->id;?>','theme2','details')" href="javascript:void(0)" class="compareLink">
								<span class="edicon edicon-calculator"></span>
							</a>
							<?php
						}else{
							$msg = JText::_('OS_DO_YOU_WANT_TO_REMOVE_PROPERTY_OUT_OF_COMPARE_LIST');
							$msg = str_replace("'","\'",$msg);
							?>
							<a title="<?php echo JText::_('OS_REMOVE_FROM_COMPARE_LIST');?>" onclick="javascript:osConfirmExtend('<?php echo $msg; ?>','ajax_removeCompare','<?php echo $row->id ?>','<?php echo JURI::root() ?>','compare<?php echo $row->id;?>','theme2','details')" href="javascript:void(0)" class="compareLinkActive">
								<span class="edicon edicon-calculator"></span>
							</a>
							<?php
						}
						?>
						</span>
					</div>
					<?php
				}
				if(($configClass['property_save_to_favories'] == 1) and ($user->id > 0)){
					if($inFav == 0){
						?>
						<div class="addFavLink">
							<span id="fav<?php echo $row->id;?>">
								<?php
								$msg = JText::_('OS_DO_YOU_WANT_TO_ADD_PROPERTY_TO_YOUR_FAVORITE_LISTS');
								$msg = str_replace("'","\'",$msg);
								?>
								<a title="<?php echo JText::_('OS_ADD_TO_FAVORITES');?>" onclick="javascript:osConfirmExtend('<?php echo $msg;?>','ajax_addFavorites','<?php echo $row->id?>','<?php echo JURI::root()?>','fav<?php echo $row->id; ?>','theme2','details')" class="favLink">
									<span class="edicon edicon-heart"></span>
								</a>
							</span>
						</div>
						<?php
					}else{
						?>
						<div class="addFavLink">
							<span id="fav<?php echo $row->id;?>">
								<?php
								$msg = JText::_('OS_DO_YOU_WANT_TO_REMOVE_PROPERTY_OUT_OF_YOUR_FAVORITE_LISTS');
								$msg = str_replace("'","\'",$msg);
								?>
								<a title="<?php echo JText::_('OS_REMOVE_FAVORITES');?>" onclick="javascript:osConfirmExtend('<?php echo $msg;?>','ajax_removeFavorites','<?php echo $row->id?>','<?php echo JURI::root()?>','fav<?php echo $row->id; ?>','theme2','details')" href="javascript:void(0)" class="favLinkActive">
									<span class="edicon edicon-heart"></span>
								</a>
							</span>
						</div>
						<?php
					}
				}
				?>
				<div class="clearfix"></div>
				<?php
				if($configClass['show_feature_group'] == 1){
				?>
					<ul class="features">
						<?php
						if(($row->bed_room > 0) and ($configClass['use_bedrooms'] == 1)){
						?>
							<li>
								<span class="edicon edicon-codepen"></span>
								<div><?php echo $row->bed_room?> <?php echo JText::_('OS_BEDS')?></div>
							</li>
						<?php
						}
						if(($row->bath_room > 0) and ($configClass['use_bathrooms'] == 1)){
						?>
							<li>
								<span class="edicon edicon-droplet"></span>
								<div><?php echo OSPHelper::showBath($row->bath_room);?> <?php echo JText::_('OS_BATHS')?></div>
							</li>
							<?php
						}
						if(($row->square_feet > 0) and ($configClass['use_squarefeet'] == 1)){
							?>
							<li>
								<div>
									<span class="edicon edicon-map2"></span>
									<?php echo OSPHelper::showSquare($row->square_feet);?> <?php echo OSPHelper::showSquareLabels();?>
								</div>
							</li>
							<?php
						}
						if(($configClass['use_rooms'] == 1) and ($row->rooms > 0)){
							?>
							<li>
								<div>
									<span class="edicon edicon-home3"></span>
									<?php echo $row->rooms;?> <?php echo JText::_('OS_ROOMS')?>
								</div>
							</li>
							<?php
						}
						?>
					</ul>
					<div class="clearfix"></div>
				<?php } ?>
			</div>
			<?php
			if($configClass['show_agent_details'] == 1){
			?>
                <div class="<?php echo $bootstrapHelper->getClassMapping('span4'); ?> summaryItem center">
                    <?php
                    if(($configClass['show_agent_image'] == 1) and ($row->agentdetails->photo != "") and file_exists(JPATH_ROOT.'/images/osproperty/agent/thumbnail/'.$row->agentdetails->photo)){
                        $link = JRoute::_("index.php?option=com_osproperty&task=agent_info&id=".$row->agent_id."&Itemid=".OSPRoute::getAgentItemid($row->agent_id));
                        ?>
                        <a href="<?php echo $link; ?>">
                            <img class="avatar agentAvatarImg" src="<?php echo JUri::root()."images/osproperty/agent/thumbnail/".$row->agentdetails->photo ?>" alt="<?php echo $row->agentdetails->name;?>" />
                        </a>
                        <?php
                    }
                    ?>
                    <div class="agentName"><?php echo $row->agentdetails->name;?></div>
                        <?php
                        $link = JRoute::_("index.php?option=com_osproperty&task=agent_info&id=".$row->agent_id."&Itemid=".OSPRoute::getAgentItemid());
                        ?>
                        <a class="btn btn-green contactBtn" href="<?php echo $link;?>"><?php echo JText::_('OS_CONTACT_OWNER');?></a>
                    </div>
			<?php } ?>
		</div>

		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> descriptionTop">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> description">
				<h3><i class="edicon edicon-newspaper"></i>&nbsp;<?php echo JText::_('OS_DESCRIPTION')?></h3>
				<div class="entry-content">
					<?php
					$row->pro_small_desc = OSPHelper::getLanguageFieldValue($row,'pro_small_desc');
					echo $row->pro_small_desc;
					if($configClass['use_open_house'] == 1){
						?>
						<div class="floatright">
							<?php echo $row->open_hours;?>
						</div>
						<?php
					}
					$pro_full_desc = OSPHelper::getLanguageFieldValue($row,'pro_full_desc');
					$row->pro_full_desc =  JHtml::_('content.prepare', $pro_full_desc);
					echo stripslashes($row->pro_full_desc);
				?>
				</div>
				<?php
				if(($configClass['energy'] == 1) and (($row->energy > 0) || ($row->climate > 0) || ($row->e_class != "") || ($row->c_class != ""))){
				?>
					<h3><i class="edicon edicon-stats-dots"></i>&nbsp;<?php echo JText::_('OS_EPC')?></h3>
					<div class="entry-content">
						<?php
						echo HelperOspropertyCommon::drawGraph($row->energy, $row->climate,$row->e_class,$row->c_class);
						?>
					</div>
				<?php } ?>
				<?php
				if(($row->pro_pdf != "") and ($row->pro_pdf_file != "")){
				?>
					<h3><i class="edicon folder-open"></i>&nbsp;<?php echo JText::_('OS_DOCUMENT')?></h3>
					<div class="entry-content">
					<?php
						if($row->pro_pdf != ""){
							?>
							<a href="<?php echo $row->pro_pdf?>" title="<?php echo JText::_('OS_PROPERTY_DOCUMENT')?>" alt="<?php echo JText::_('OS_PROPERTY_DOCUMENT')?>" target="_blank" class="btn btn-sm btn-o btn-linkdocument">
								<i class="edicon edicon-link"></i>
							</a>
							<?php
						}
						if($row->pro_pdf_file != "")
						{
							if(file_exists(JPATH_ROOT.'/media/com_osproperty/document/'.$row->pro_pdf_file))
							{
								$fileUrl = JUri::root().'media/com_osproperty/document/'.$row->pro_pdf_file;
							}
							else
							{
								$fileUrl = JUri::root().'components/com_osproperty/document/'.$row->pro_pdf_file;
							}
							?>
							<a href="<?php echo $fileUrl; ?>" title="<?php echo JText::_('OS_PROPERTY_DOCUMENT')?>" alt="<?php echo JText::_('OS_PROPERTY_DOCUMENT')?>" target="_blank" class="btn btn-sm btn-o btn-document">
								<i class="edicon edicon-download"></i>
							</a>
							<?php
						}
						?>
					</div>
				<?php } ?>
				<?php if(count($tagArr) > 0){ ?>
				<h3><i class="edicon edicon-tags"></i>&nbsp;<?php echo JText::_('OS_TAGS')?></h3>
				<div class="entry-content">
					<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> noleftmargin">
						<?php echo implode(" ",$tagArr);?>
					</div>
					<div class="clearfix"></div>
				</DIV>
				<?php } ?>

				<?php if($configClass['social_sharing']== 1){ ?>
					<h3><i class="edicon edicon-share2"></i>&nbsp;<?php echo JText::_('OS_SHARE')?></h3>
					<div class="entry-content">
						<?php
						$url = JRoute::_("index.php?option=com_osproperty&task=property_details&id=$row->id");
						$url = JUri::getInstance()->toString(array('scheme', 'user', 'pass', 'host')).$url;
						?>
							<a href="http://www.facebook.com/share.php?u=<?php echo $url;?>" target="_blank" class="btn btn-sm btn-o btn-facebook" title="<?php echo JText::_('OS_ASK_YOUR_FACEBOOK_FRIENDS');?>" id="link2Listing" rel="canonical">
								<i class="edicon edicon-facebook"></i>
								<?php echo JText::_('OS_FACEBOOK')?>
							</a>
							&nbsp;
							<a href="https://twitter.com/intent/tweet?original_referer=<?php echo $url;?>&tw_p=tweetbutton&url=<?php echo $url;?>" target="_blank" class="btn btn-sm btn-o btn-twitter" title="<?php echo JText::_('OS_ASK_YOUR_TWITTER_FRIENDS');?>" id="link2Listing" rel="canonical">
								<i class="edicon edicon-twitter"></i>
								<?php echo JText::_('OS_TWEET')?>
							</a>

						<div class="clearfix"></div>
					</DIV>
				<?php } ?>
			</div>
		</div>

		<?php
		if(count($middlePlugin) > 0){
			for($i=0;$i<count($middlePlugin);$i++){
				echo $middlePlugin[$i];
			}
		}
		?>
		<!-- description list -->
		<?php
		$fieldok = 0;
		if(count($row->extra_field_groups) > 0){
			$extra_field_groups = $row->extra_field_groups;
			for($i=0;$i<count($extra_field_groups);$i++){
				$group = $extra_field_groups[$i];
				$group_name = $group->group_name;
				$fields = $group->fields;
				if(count($fields)> 0){
					$fieldok = 1;
				}
			}
		}
		?>
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
				<nav id="listing-sections">
					<ul>
						<li class="listing-nav-icon">
							<i class="edicon edicon-paragraph-justify"></i>
						</li>
						<?php
						if(($configClass['show_amenity_group'] == 1) or ($fieldok == 1) or ($configClass['show_neighborhood_group'] == 1)){
							?>
							<li>
								<a href="#shellfeatures"><?php echo JText::_('OS_FEATURES');?></a>
							</li>
						<?php } ?>
						<?php
						if(($configClass['goole_use_map'] == 1) and ($row->lat_add != "") and ($row->long_add != "")){
							?>
							<li>
								<a href="#shelllocation"><?php echo JText::_('OS_LOCATION')?></a>
							</li>
						<?php } ?>
						<?php
						if(($configClass['show_walkscore'] == 1) and ($configClass['ws_id'] != "")){
							?>
							<li>
								<a href="#shellwalkscore"><?php echo JText::_('OS_NEARBY')?></a>
							</li>
						<?php } ?>
						<?php
						if($row->pro_video != "") {
							?>
							<li>
								<a href="#shellvideo"><?php echo JText::_('OS_VIDEO') ?></a>
							</li>
							<?php
						}
						if($configClass['comment_active_comment'] == 1){
							?>
							<li>
								<a href="#shellcomments"><?php echo JText::_('OS_COMMENTS');?></a>
							</li>
						<?php } ?>
						<?php
						if($configClass['property_mail_to_friends'] == 1){
						?>
						<li>
							<a href="#shellsharing"><?php echo JText::_('OS_SHARING');?></a>
						</li>
						<?php }
						if($row->panorama != "") {
							?>
							<li>
								<a rel="nofollow" href="<?php echo JUri::root(); ?>index.php?option=com_osproperty&task=property_showpano&id=<?php echo $row->id ?>&tmpl=component"
								   class="osmodal" rel="{handler: 'iframe', size: {x: 650, y: 420}}">
									<?php echo JText::_('OS_PANORAMA'); ?>
								</a>
							</li>
							<?php
						}
						?>
					</ul>
				</nav>
			</div>
		</div>

		<?php
		//load module at right hand side
		if($module_ids != "")
		{
			?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('span8'); ?>">
			<?php
		}
		?>

		<?php
		if(($configClass['show_amenity_group'] == 1) or ($fieldok == 1) or ($configClass['show_neighborhood_group'] == 1)){
		?>
		<div id="shellfeatures">
			<h2>
				<i class="edicon edicon-clipboard"></i>&nbsp;<?php echo JText::_('OS_FEATURES')?>
			</h2>
			<div class="listing-features">
				<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
					<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
						<?php
						echo $row->core_fields1;
						if(($configClass['show_amenity_group'] == 1) and ($row->amens_str1 != "")){
						?>
						<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
							<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
								<h4>
									<i class="edicon edicon-star-full"></i>&nbsp;<?php echo JText::_('OS_AMENITIES')?>
								</h4>
							</div>
						</div>
						<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
							<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
								<?php echo $row->amens_str1;?>
							</div>
						</div>
						<?php
						}
						?>
						<?php
						if(($configClass['show_neighborhood_group'] == 1) and ($row->neighborhood != "")){
						?>
						<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
							<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
								<h4>
									<i class="edicon edicon-star-full"></i>&nbsp;<?php echo JText::_('OS_NEIGHBORHOOD')?>
								</h4>
							</div>
						</div>
						<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
							<?php 
							echo $row->neighborhood;
							?>
						</div>
						<div class="clearfix"></div>
						<?php  } 
						?>
						<?php
						if(count($row->extra_field_groups) > 0){
							if($extrafieldncolumns == 2){
								$span = $bootstrapHelper->getClassMapping('span6');
								$jump = 2;
							}else{
								$span = $bootstrapHelper->getClassMapping('span4');
								$jump = 3;
							}
							$extra_field_groups = $row->extra_field_groups;
							for($i=0;$i<count($extra_field_groups);$i++){
								$group = $extra_field_groups[$i];
								$group_name = $group->group_name;
								$fields = $group->fields;
								if(count($fields)> 0){
								?>
								<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
									<h4>
										<i class="edicon edicon-list"></i>&nbsp;<?php echo $group_name;?>
									</h4>
								</div>
								<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
									<?php
									$k = 0;
									for($j=0;$j<count($fields);$j++){
										$field = $fields[$j];
										if($field->field_type != "textarea"){
											$k++;
											?>
											<div class="<?php echo $span; ?>">
												<?php
												if(($field->displaytitle == 1) or ($field->displaytitle == 2)){
													?>
													<?php
													if($field->field_description != ""){
														?>
														<span class="editlinktip hasTip" title="<?php echo $field->field_label;?>::<?php echo $field->field_description?>">
															<?php echo $field->field_label;?>
														</span>
													<?php
													}else{
														?>
														<?php echo $field->field_label;?>
													<?php
													}
												}
												?>
												<?php
												if($field->displaytitle == 1){
													?>
													:&nbsp;
												<?php } ?>
												<?php if(($field->displaytitle == 1) or ($field->displaytitle == 3)){?>
													<?php echo $field->value;?> <?php } ?>
											</div>
											<?php
											if($k == $jump){
												?>
												</div><div class='<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> minheight0'>
												<?php
												$k = 0;
											}
										}
									}
									?>
								</div>
								<?php
									for($j=0;$j<count($fields);$j++) {
										$field = $fields[$j];
										if ($field->field_type == "textarea") {
											?>
											<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
												<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
													<?php
													if (($field->displaytitle == 1) or ($field->displaytitle == 2)) {
														?>
														<?php
														if ($field->field_description != "") {
															?>
															<span class="editlinktip hasTip"
																  title="<?php echo $field->field_label;?>::<?php echo $field->field_description?>">
																<strong><?php echo $field->field_label;?></strong>
															</span>
															<BR/>
														<?php
														} else {
															?>
															<strong><?php echo $field->field_label;?></strong>
														<?php
														}
													}
													?>
													<?php if (($field->displaytitle == 1) or ($field->displaytitle == 3)) { ?>
														<?php echo $field->value; ?>
													<?php } ?>
												</div>
											</div>
										<?php
										}
									}
								}
							?>
							<div class='amenitygroup <?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>'></div>
							<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php 
		}
		?>
		<?php
		if($module_ids != "")
		{
			?>
				</div>
				<div class="<?php echo $bootstrapHelper->getClassMapping('span4');?>">
                    <?php
                    $document = JFactory::getDocument();
                    $renderer = $document->loadRenderer('module');
					$moduleArr = explode(",", $module_ids);

					foreach($moduleArr as $module)
					{
						$db->setQuery("Select title from #__modules where id = '$module' and showtitle = '1'");
						$module_title = $db->loadResult();
                    ?>
						<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid');?>">
							<div class="<?php echo $bootstrapHelper->getClassMapping('span12');?>">
								<h3 class="module_title"><?php echo $module_title;?></h3>
								<?php
								$moduleContent->text = "{loadmoduleid ".$module."}";
								$moduleContent->text = JHtml::_('content.prepare', $moduleContent->text);
								echo $moduleContent->text;
								?>
							</div>
						</div>
						<?php
					}
                    ?>
                </div>
			</div>
			<?php
		}
		?>
		<!-- end des -->
		<?php
		if(($configClass['goole_use_map'] == 1) and ($row->lat_add != "") and ($row->long_add != "")){

		$address = OSPHelper::generateAddress($row);
		?>
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
				<div id="shelllocation">
					<h2>
						<i class="edicon edicon-location2"></i>&nbsp;<?php echo JText::_('OS_LOCATION')?>
					</h2>
					<?php
                    if($configClass['map_type'] == 1)
                    {
                        HelperOspropertyOpenStreetMap::loadOpenStreetMapDetails($row, $configClass, '', 1);
                    }
                    else
                    {
                        HelperOspropertyGoogleMap::loadGoogleMapDetails($row, $configClass, '', 1);
                    }
					?>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		<?php
		if(($configClass['show_walkscore'] == 1) and ($configClass['ws_id'] != "")){
			?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
					<div id="shellwalkscore">
						<h2>
							<i class="edicon edicon-map"></i>&nbsp;<?php echo JText::_('OS_WALK_SCORE')?>
						</h2>
						<?php
						echo $row->ws;
						?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<?php
		if($row->pro_video != ""){
			?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
					<div id="shellvideo">
						<h2>
							<i class="edicon edicon-play"></i>&nbsp;<?php echo JText::_('OS_VIDEO')?>
						</h2>
						<?php
						echo stripslashes($row->pro_video);
						?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<?php
		if($configClass['comment_active_comment'] == 1){
			?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> noleftmargin">
					<div id="shellcomments">
						<h2>
							<i class="edicon edicon-bubbles3"></i>&nbsp;<?php echo JText::_('OS_COMMENTS')?>
						</h2>
						<?php
						echo $row->comments;
						if(($owner == 0) and ($can_add_cmt == 1)){
							HelperOspropertyCommon::reviewForm($row,$itemid,$configClass);
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<?php
		if(($configClass['use_property_history'] == 1) and (($row->price_history != "") or ($row->tax != ""))){
			?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
					<div id="shellhistorytax">
						<h2>
							<i class="edicon edicon-history"></i>&nbsp;<?php echo JText::_('OS_HISTORY_TAX')?>
						</h2>
						<?php
						if($row->price_history != ""){
							echo $row->price_history;
							echo "<BR />";
						}
						if($row->tax != ""){
							echo $row->tax;
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<?php
		if($configClass['property_mail_to_friends'] == 1){
		?>
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> tellfrendform" id="shellsharing">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> tellfrendformsub">
				<h2>
					<i class="edicon edicon-share"></i>&nbsp;<?php echo JText::_('OS_TELL_A_FRIEND')?>
				</h2>
				<?php HelperOspropertyCommon::sharingForm($row,$itemid); ?>
			</div>
		</div>
		<?php } ?>
		<?php
			if(file_exists(JPATH_ROOT.DS."components".DS."com_oscalendar".DS."oscalendar.php")){
				if(($configClass['integrate_oscalendar'] == 1) and (in_array($row->pro_type,explode("|",$configClass['show_date_search_in'])))){
					?>
					<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
						<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
							<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> tellfrendform" id="shellsharing">
								<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> tellfrendformsub">
									<h2>
										<i class="edicon edicon-calendar"></i>&nbsp;<?php echo JText::_('OS_AVAILABILITY')?>
									</h2>
									<?php
									require_once(JPATH_ROOT.DS."components".DS."com_oscalendar".DS."classes".DS."default.php");
									require_once(JPATH_ROOT.DS."components".DS."com_oscalendar".DS."classes".DS."default.html.php");
									$otherlanguage =& JFactory::getLanguage();
									$otherlanguage->load( 'com_oscalendar', JPATH_SITE );
									OsCalendarDefault::calendarForm($row->id);
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
		?>
		<?php
		if(($configClass['show_agent_details'] == 1) or ($configClass['show_request_more_details'] == 1)){
			?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
					<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> agentsharingform" id="agentsharing">
						<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> agentsharingformsub">
							<?php
							if($configClass['show_agent_details'] == 1){
								$link = JRoute::_("index.php?option=com_osproperty&task=agent_info&id=".$row->agent_id."&Itemid=".OSPRoute::getAgentItemid());
								if($row->agentdetails->agent_type == 0){
									$title = JText::_('OS_AGENT_INFO');
								}else{
									$title = JText::_('OS_OWNER_INFO');
								}
							?>
							<h2>
								<i class="edicon edicon-user-tie"></i>&nbsp;
								<a href="<?php echo $link;?>" title="<?php echo $title;?>">
									<?php echo $row->agent_name;?>
								</a>
							</h2>
							<?php 
							}
							if(($configClass['show_agent_details'] == 1) and ($configClass['show_request_more_details'] == 1)){
								$span1 = $bootstrapHelper->getClassMapping('span4');//"span4";
								$span2 = "";
								$span3 = $bootstrapHelper->getClassMapping('span8');//"span8";
							}elseif(($configClass['show_agent_details'] == 1) and ($configClass['show_request_more_details'] == 0)){
								$span1 = $bootstrapHelper->getClassMapping('span4');
								$span2 = $bootstrapHelper->getClassMapping('span8');
								$span3 = "";
							}elseif(($configClass['show_agent_details'] == 0) and ($configClass['show_request_more_details'] == 1)){
								$span1 = "";
								$span2 = "";
								$span3 = $bootstrapHelper->getClassMapping('span12');
							}
							?>
							<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
								<?php
								if($configClass['show_agent_details'] == 1){
								?>
								<div class="<?php echo $span1;?>">
									<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
										<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
											<?php
											if($configClass['show_agent_image'] == 1){
												$agent_photo = $row->agentdetails->photo;
												if(($agent_photo != "") and (file_exists(JPATH_ROOT.'/images/osproperty/agent/'.$agent_photo))){
													?>
													<img src="<?php echo JURI::root(true)?>/images/osproperty/agent/<?php echo $agent_photo; ?>" class="agentphoto"/>
													<?php
												}else{
													?>
													<img src="<?php echo JURI::root(true)?>/media/com_osproperty/assets/images/user.jpg" class="agentphoto"/>
													<?php
												}
											}
											?>
										</div>
									</div>
									<?php
									if($configClass['show_request_more_details'] == 1){
									?>
										<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
											<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
												<ul class="marB0 agentbasicinformation divbottom">
													<?php if(($row->agentdetails->phone != "") and ($configClass['show_agent_phone'] == 1)){?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-phone-hang-up"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->phone;?></span>
													</li>
													<?php } 
													if(($row->agentdetails->mobile != "") and ($configClass['show_agent_mobile'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-mobile"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->mobile;?></span>
													</li>
													<?php } 
													if(($row->agentdetails->fax != "") and ($configClass['show_agent_fax'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-printer"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->fax;?></span>
													</li>
													<?php }
													if(($row->agentdetails->email != "") and ($configClass['show_agent_email'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="osicon-mail"></i>
														</span>
														<span class="right"><a href="mailto:<?php echo $row->agentdetails->email;?>" target="_blank"><?php echo $row->agentdetails->email;?></a></span>
													</li>
													<?php }
													if(($row->agentdetails->skype != "") and ($configClass['show_agent_skype'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-skype"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->skype;?></span>
													</li>
													<?php }
													if(($row->agentdetails->msn != "") and ($configClass['show_agent_msn'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-bubble2"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->msn;?></span>
													</li>
													<?php }
													?>
												</ul>
											</div>
										</div>		
										<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> divbottom">
											<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
												<ul class="social marT15 marL0">
													<?php
													if(($row->agentdetails->facebook != "") and ($configClass['show_agent_facebook'] == 1)){
													?>
													<li class="facebook">
														<a href="<?php echo $row->agentdetails->facebook; ?>" target="_blank">
															<i class="edicon edicon-facebook"></i>
														</a>
													</li>
													<?php }
													if(($row->agentdetails->aim != "") and ($configClass['show_agent_twitter'] == 1)){
													?>
													<li class="twitter">
														<a href="<?php echo $row->agentdetails->aim; ?>" target="_blank">
															<i class="edicon edicon-twitter"></i>
														</a>
													</li>
													<?php }
													if(($row->agentdetails->yahoo != "") and ($configClass['show_agent_linkin'] == 1)){
													?>
													<li class="linkin">
														<a href="<?php echo $row->agentdetails->yahoo; ?>" target="_blank">
															<i class="edicon edicon-linkedin2"></i>
														</a>
													</li>
													<?php }
													if(($row->agentdetails->gtalk != "") and ($configClass['show_agent_gplus'] == 1)){
													?>
													<li class="gplus">
														<a href="<?php echo $row->agentdetails->gtalk; ?>" target="_blank">
															<i class="edicon edicon-google-plus"></i>
														</a>
													</li>
													<?php }
													?>
												</ul>
											</div>
										</div>
									<?php } ?>
								</div>
								<?php
								}
								if($configClass['show_request_more_details'] == 0){
								?>
								<div class="<?php echo $span2;?>">
										<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
											<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
												<ul class="marB0 agentbasicinformation">
													<?php if(($row->agentdetails->phone != "") and ($configClass['show_agent_phone'] == 1)){?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-phone-hang-up"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->phone;?></span>
													</li>
													<?php } 
													if(($row->agentdetails->mobile != "") and ($configClass['show_agent_mobile'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-mobile"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->mobile;?></span>
													</li>
													<?php } 
													if(($row->agentdetails->fax != "") and ($configClass['show_agent_fax'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-printer"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->fax;?></span>
													</li>
													<?php }
													if(($row->agentdetails->email != "") and ($configClass['show_agent_email'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="osicon-mail"></i>
														</span>
														<span class="right"><a href="mailto:<?php echo $row->agentdetails->email;?>" target="_blank"><?php echo $row->agentdetails->email;?></a></span>
													</li>
													<?php }
													if(($row->agentdetails->skype != "") and ($configClass['show_agent_skype'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-skype"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->skype;?></span>
													</li>
													<?php }
													if(($row->agentdetails->msn != "") and ($configClass['show_agent_msn'] == 1)){
													?>
													<li class="marT3 marB0">
														<span class="left">
															<i class="edicon edicon-bubble2"></i>
														</span>
														<span class="right"><?php echo $row->agentdetails->msn;?></span>
													</li>
													<?php }
													?>
												</ul>
											</div>
										</div>		
										<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> divbottom">
											<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
												<ul class="social marT15 marL0">
													<?php
													if(($row->agentdetails->facebook != "") and ($configClass['show_agent_facebook'] == 1)){
													?>
													<li class="facebook">
														<a href="<?php echo $row->agentdetails->facebook; ?>" target="_blank">
															<i class="edicon edicon-facebook"></i>
														</a>
													</li>
													<?php }
													if(($row->agentdetails->aim != "") and ($configClass['show_agent_twitter'] == 1)){
													?>
													<li class="twitter">
														<a href="<?php echo $row->agentdetails->aim; ?>" target="_blank">
															<i class="edicon edicon-twitter"></i>
														</a>
													</li>
													<?php }
													if(($row->agentdetails->yahoo != "") and ($configClass['show_agent_linkin'] == 1)){
													?>
													<li class="linkin">
														<a href="<?php echo $row->agentdetails->yahoo; ?>" target="_blank">
															<i class="edicon edicon-linkedin2"></i>
														</a>
													</li>
													<?php }
													if(($row->agentdetails->gtalk != "") and ($configClass['show_agent_gplus'] == 1)){
													?>
													<li class="gplus">
														<a href="<?php echo $row->agentdetails->gtalk; ?>" target="_blank">
															<i class="edicon edicon-google-plus"></i>
														</a>
													</li>
													<?php }
													?>
												</ul>
											</div>
										</div>
									</div>
								<?php } ?>
								<?php
								if($configClass['show_request_more_details'] == 1){
								?>
								<div class="<?php echo $span3;?> requestmoredetails">
									<h4>
										<i class="edicon edicon-question"></i>&nbsp;
										<?php echo JText::_('OS_REQUEST_MORE_INFOR');?>
									</h4>
									<?php echo HelperOspropertyCommon::requestMoreDetails($row,$itemid); ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
		<?php
		if(($configClass['relate_properties'] == 1) and ($row->relate != "")){
		?>
			<div class="detailsBar clearfix">
				<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
					<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
						<div class="shellrelatedproperties">
							<h2><i class="edicon edicon-location2"></i>&nbsp;<?php echo JText::_('OS_RELATE_PROPERTY')?></h2>
							<?php
							echo $row->relate;
							?>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
		<?php
		if($integrateJComments == 1){
		?>
			<div class="detailsBar clearfix">
				<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
					<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
						<div class="shell">
							<fieldset><legend><span><?php echo JText::_('OS_JCOMMENTS')?></span></legend></fieldset>
							<?php
							$comments = JPATH_SITE . DS .'components' . DS . 'com_jcomments' . DS . 'jcomments.php';
							if (file_exists($comments)) {
								require_once($comments);
								echo JComments::showComments($row->id, 'com_osproperty', $row->pro_name);
							}
							?>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
		<?php
		if(count($bottomPlugin) > 0){
			for($i=0;$i<count($bottomPlugin);$i++){
				echo $bottomPlugin[$i];
			}
		}
		if($configClass['social_sharing'] == 1){
		?>
		<div class="clearfix"></div>
		<?php
		echo $row->social_sharing;
		}
		?>
		<!----------------- end social --------------->
		<!-- end tabs bottom -->
	</div>
</div>
<!-- end wrap content -->
<input type="hidden" name="process_element" id="process_element" value="" />
<script type="text/javascript">
var width = jQuery(".propertyinfoli").width();
jQuery(".pictureslideshow").attr("width",width);
</script>