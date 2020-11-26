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
$db = JFactory::getDbo();
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root()."components/com_osproperty/templates/".$themename."/style/font.css");
//JHTML::_('behavior.modal','osmodal');
OSPHelperJquery::colorbox('osmodal');
$extrafieldncolumns = $params->get('extrafieldncolumns',3);
?>
<link rel="stylesheet" href="<?php echo JURI::root()?>components/com_osproperty/templates/<?php echo $themename;?>/font/css/font-awesome.min.css">
<script src="<?php echo JURI::root()?>components/com_osproperty/templates/<?php echo $themename;?>/js/modernizr.custom.js"></script>
<script src="<?php echo JURI::root()?>components/com_osproperty/templates/<?php echo $themename;?>/js/jquery.mosaicflow.js"></script>
<style>
#main ul{
	margin:0px;
}
</style>
<div id="notice" style="display:none;"></div>
<?php
if(count($topPlugin) > 0){
	for($i=0;$i<count($topPlugin);$i++){
		echo $topPlugin[$i];
	}
}

if($configClass['comment_active_comment'] == 1){
	$spanHeaderTitle = "9";
}else{
	$spanHeaderTitle = "12";
}
?>
<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>" id="propertydetails">
	<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span'.$spanHeaderTitle); ?> property-header-info-name">
				<h1 class="property-header-info-name-text" data-selenium="property-header-name">
				<?php
				if(($row->ref != "")  and ($configClass['show_ref'] == 1)){
					?>
					<span color="orange">
						<?php echo $row->ref?>
					</span>
					-
					<?php
				}
				?>
				<?php echo $row->pro_name?>
				</h1>
				<?php
				if($configClass['comment_active_comment'] == 1){
					?>
					<span class="property-header-info-name-stars">
						<?php
						if($row->number_votes > 0){
							$points = round($row->total_points/$row->number_votes);
							?>
							<img src="<?php echo JURI::root()?>media/com_osproperty/assets/images/stars-<?php echo $points;?>.png" />	
							<?php
						}else{
							?>
							<img src="<?php echo JURI::root()?>media/com_osproperty/assets/images/stars-0.png" />	
							<?php
						}
						?>
					</span>
					<?php
				}
				?>
				<div class="property-header-info-address">
					<?php
					echo $row->subtitle;
					if($row->isFeatured == 1){
						?>
						<span class="featuredpropertydetails"><?php echo JText::_('OS_FEATURED');?></span>
						<?php
					}
					if(($configClass['active_market_status'] == 1)&&($row->isSold > 0)){
						?>
						<span class="marketstatuspropertydetails"><?php echo OSPHelper::returnMarketStatus($row->isSold);?></span>
						<?php
					}
					$created_on = $row->created;
					$modified_on = $row->modified;
					$created_on = strtotime($created_on);
					$modified_on = strtotime($modified_on);
					if($created_on > time() - 3*24*3600){ //new
						if($configClass['show_just_add_icon'] == 1){
							?>
							<i class="edicon edicon-bullhorn noattension" title="<?php echo JText::_('OS_NEW');?>"></i>
							<?php
						}
					}elseif($modified_on > time() - 2*24*3600){
						if($configClass['show_just_update_icon'] == 1){
							?>
							<i class="edicon edicon-spinner9 noattension" title="<?php echo JText::_('OS_JUST_UPDATED');?>"></i>
							<?php
						}
					}
					if($configClass['enable_report'] == 1){
					?>
						<a href="<?php echo JURI::root()?>index.php?option=com_osproperty&tmpl=component&item_type=0&task=property_reportForm&id=<?php echo $row->id?>" class="osmodal reportlink" title="<?php echo JText::_('OS_REPORT_LISTING');?>">
							<span class="reportitem">
								<?php echo JText::_('OS_REPORT');?>
							</span>
						</a>
					<?php } ?>
				</div>
			</div>
			<?php 
			if($configClass['listing_show_rating'] == 1){
				if($row->number_votes > 0){
					$rating = round($row->total_points/$row->number_votes,1);
				}else{
					$rating = 0;
				}
				?>
				<div class="<?php echo $bootstrapHelper->getClassMapping('span3'); ?> property-header-rating" data-selenium="property-header-review-rating">
					<div class="property-header-rating-score">
						<span class="property-header-rating-score-text"><?php echo JText::_('OS_RATING');?></span>
						<span class="property-header-rating-score-value" data-selenium="property-header-review-score"><?php echo $rating;?></span>
					</div>
					<div class="property-header-rating-reviews">
						<span><?php echo JText::_('OS_BASED_ON');?> </span>
						<span class="fontbold"><?php echo $row->number_votes;?> </span>
						<span class="fontbold"><?php echo JText::_('OS_REVIEWS');?></span>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>" id="propertydetails">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> propertygallerytheme3">
					<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
						<?php
						if(count($photos) > 0){
							//new modification on gallery style
							?>
							<script type="text/javascript" src="<?php echo JUri::root(true)?>/media/com_osproperty/assets/js/colorbox/jquery.colorbox.js"></script>
							<script type="text/javascript">
								jQuery(document).ready(function(){
									jQuery(".iframecolorbox").colorbox({rel:'colorbox',maxWidth:'95%', maxHeight:'95%'});
								});
							</script>
							<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
								<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> mosaicflow" id="mosaicflow_theme3" data-item-height-calculation="attribute">
									<?php
									//maximum 5 pictures
									$max_photos = count($photos);
									if($max_photos > 4)
									{
										$max_photos = 4;
									}
									for($i=0;$i<$max_photos;$i++)
									{
										$photo = $photos[$i];
										$title = $photo->image_desc;
										$title = str_replace("\n","",$title);
										$title = str_replace("\r","",$title);
										$title = str_replace("'","\'",$title);
										if(file_exists(JPATH_ROOT."/images/osproperty/properties/".$row->id."/".$photos[$i]->image)){
											if($i == 0){
												$extra_class = "";
											}else{
												$extra_class = "hidden-phone";
											}
										?>
											<div class="mosaicflow__item <?php echo $extra_class;?>">
												<?php
												if($i==0)
												{
													?>
													<img src="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/<?php echo $photos[$i]->image?>" alt="<?php echo $photos[$i]->image_desc;?>" title="<?php echo $photos[$i]->image_desc;?>" class="gallery_photo1"/>
													<a class="iframecolorbox" href="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/<?php echo $photos[$i]->image?>">
														<div class="dark-overlay" id="gallery_photo1_overlay">
															<div class="dark-overlay-information">
																<div class="dark-overlay-information-title">
																	<?php
																	if(($row->ref != "")  and ($configClass['show_ref'] == 1)){
																		?>

																			<?php echo $row->ref?> -
																		<?php
																	}
																	?>
																	<?php echo $row->pro_name?>
																</div>
																<div class="dark-overlay-information-caption"><?php echo JText::_('OS_SEE_MORE_PHOTOS');?></div>
															</div>
														</div>
													</a>
													<?php
												}
												else
												{
													?>
													<img src="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/<?php echo $photos[$i]->image?>" alt="<?php echo $photos[$i]->image_desc;?>" title="<?php echo $photos[$i]->image_desc;?>"/>
													<a class="iframecolorbox" href="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/<?php echo $photos[$i]->image?>">
														<div class="dark-overlay">
															<div class="dark-overlay-information">
																<div class="dark-overlay-information-caption"><?php echo JText::_('OS_SEE_MORE_PHOTOS');?></div>
															</div>
														</div>
													</a>
													<?php
												}
												if($i == 2)
												{
												?>
													<div class="review-snippet">
														<div class="review-snippet-container">
															<?php
															if(($configClass['comment_active_comment'] == 1) && (count($row->comment_raw) > 0)){
															
															$comment = $row->comment_raw;
															$comment = $comment[0];
															$content = $comment->content;
															$content = explode(" ",$content);
															if(count($content) > 10){
																$new_content = "";
																for($j=0;$j<10;$j++){
																	$new_content .= $content[$j]." ";
																}
																$new_content = substr($new_content,0,strlen($new_content) - 1)."..";
															}else{
																$new_content = implode(" ",$content);
															}
															?>
																<div class="review-MIN-10017">
																	<span>
																		<i class="osicon-comment"></i>
																	</span>
																	<div class="clearfix"></div>
																	<span class="review-text-MIN-10017">"<?php echo $new_content;?>"</span>
																</div>
																<div class="author-MIN-10017">
																	<span class="author-text"><?php echo $comment->name?></span>
																</div>
															<?php } 
															else{
																//show bath, bed, room, square
																?>
																<div class="review-MIN-10017">
																	<span class="review-text-MIN-10017">
																		<?php
																		if(($configClass['use_bedrooms'] == 1) and ($row->bed_room > 0)){
																			echo $row->bed_room." ".JText::_('OS_BD').".";
																		}
					
																		if(($configClass['use_bathrooms'] == 1) and ($row->bath_room > 0)){
																			echo " ".OSPHelper::showBath($row->bath_room)." ".JText::_('OS_BT').".";
																		}
					
																		if(($configClass['use_rooms'] == 1) and ($row->rooms > 0)){
																				echo " ".$row->rooms." ".JText::_('OS_RM').".";
																		}
					
																		if(($configClass['use_squarefeet'] == 1) and ($row->square_feet > 0)){
																				echo " ".OSPHelper::showSquare($row->square_feet)." ".OSPHelper::showSquareSymbol().".";
																		}
																		?>
																	</span>
																</div>
																<?php
															}
															?>
														</div>
													</div>
												<?php } ?>
											</div>
										<?php
										}
									}
									if(($configClass['goole_use_map'] == 1) && ($row->lat_add != "") and ($row->long_add != "") && count($photos) > 0){
										if(($max_photos > 1) and ($max_photos != 3))
										{
                                            ?>
                                            <div class="mosaicflow__item hidden-phone">
                                                <a href="#shelllocation" title="<?php echo JText::_('OS_CLICK_HERE_TO_SEE_PROPERTY_ON_MAP');?>">
                                                    <img src="<?php echo JUri::base(true)?>/media/com_osproperty/assets/images/img-map-mosaic_v1.png" />
                                                </a>
                                            </div>
                                            <?php
										}
										else
										{
											?>
											<div class="mosaicflow__item hidden-phone">
											<?php
                                            if($configClass['map_type'] == 1)
                                            {
                                                HelperOspropertyOpenStreetMap::loadOpenStreetMapDetails($row, $configClass, 'position:relative;width: 100%; min-height: 150px', 2);
                                            }
                                            else
                                            {
                                                HelperOspropertyGoogleMap::loadGoogleMapDetails($row, $configClass, 'position:relative;width: 100%; min-height: 150px', 2);
                                            }
											?>
											</div>
											<?php
										}
									}
									?>
								</div>
								<div class="nodisplay">
									<?php 
									if($max_photos < count($photos)){
										for($i = $max_photos; $i< count($photos); $i++){
											?>
											<a class="iframecolorbox nodisplay" href="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/<?php echo $photos[$i]->image?>" >
												<img src="<?php echo JURI::root()?>images/osproperty/properties/<?php echo $row->id;?>/medium/<?php echo $photos[$i]->image?>">
											</a>
											<?php
										}
									}
									?>
								</div>
								<div class="badge-price">
									<div class="type-ribbon">
										<span class="type-ribbon-text"><?php echo $row->type_name;?></span>
									</div>
									<div class="price-ribbon ">
										<span class="price-ribbon-price"><?php echo $row->price_raw;?></span>
									</div>
								</div>
							</div>
							<script language="text/javascript">
							jQuery('#mosaicflow_theme3').Mosaic({
								maxRowHeight: 300,
								maxRowHeightPolicy: 'oversize'
							});
							</script>
							<?php
						}
						?> 
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="detailsBar clearfix">
				<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
					<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
						<ul class="listingActions-list">
							<?php
							$user = JFactory::getUser();
							
							if(HelperOspropertyCommon::isAgent()){
								$my_agent_id = HelperOspropertyCommon::getAgentID();
								if($my_agent_id == $row->agent_id){
									$link = JURI::root()."index.php?option=com_osproperty&task=property_edit&id=".$row->id;
									?>
									 <li class="propertyinfoli">
										<i class='edicon edicon-pencil'></i>
										<a href="<?php echo $link?>" title="<?php echo JText::_('OS_EDIT_PROPERTY')?>" class="reportlisting">
											<?php echo JText::_('OS_EDIT_PROPERTY')?>
										</a>
									</li>
									<?php
								}
							}
							if(($configClass['show_getdirection'] == 1) and ($row->show_address == 1)){
							?>
							<li class="propertyinfoli">
								<i class="edicon edicon-compass"></i>
								<a href="<?php echo JRoute::_("index.php?option=com_osproperty&task=direction_map&id=".$row->id)?>" title="<?php echo JText::_('OS_GET_DIRECTIONS')?>" class="reportlisting">
								<?php echo JText::_('OS_GET_DIRECTIONS')?>
								</a>
							</li>
							<?php
							}
							if($configClass['show_compare_task'] == 1){
							?>
							<li class="propertyinfoli">
								<span id="compare<?php echo $row->id;?>">
								<?php
								if(! OSPHelper::isInCompareList($row->id)) {
									$msg = JText::_('OS_DO_YOU_WANT_TO_ADD_PROPERTY_TO_YOUR_COMPARE_LIST');
									$msg = str_replace("'","\'",$msg);
									?>
									<i class='edicon edicon-copy'></i>
									<a onclick="javascript:osConfirmExtend('<?php echo $msg; ?>','ajax_addCompare','<?php echo $row->id ?>','<?php echo JURI::root() ?>','compare<?php echo $row->id;?>','theme3','details')" href="javascript:void(0)" class="reportlisting" title="<?php echo JText::_('OS_ADD_TO_COMPARE_LIST')?>">
										<?php echo JText::_('OS_ADD_TO_COMPARE_LIST')?>
									</a>
								<?php
								}else{
									$msg = JText::_('OS_DO_YOU_WANT_TO_REMOVE_PROPERTY_OUT_OF_COMPARE_LIST');
									$msg = str_replace("'","\'",$msg);
									?>
									<i class='edicon edicon-copy'></i>
									<a onclick="javascript:osConfirmExtend('<?php echo $msg; ?>','ajax_removeCompare','<?php echo $row->id ?>','<?php echo JURI::root() ?>','compare<?php echo $row->id;?>','theme3','details')" href="javascript:void(0)" class="reportlisting" title="<?php echo JText::_('OS_REMOVE_FROM_COMPARE_LIST')?>">
										<?php echo JText::_('OS_REMOVE_FROM_COMPARE_LIST')?>
									</a>
								<?php
								}
								?>
								</span>
							</li>
							<?php
							}
							if(($configClass['property_save_to_favories'] == 1) and ($user->id > 0)){	
								if($inFav == 0){
									?>
									<li class="propertyinfoli">
										<span id="fav<?php echo $row->id;?>">
											<i class='edicon edicon-floppy-disk'></i>
											<?php
											$msg = JText::_('OS_DO_YOU_WANT_TO_ADD_PROPERTY_TO_YOUR_FAVORITE_LISTS');
											$msg = str_replace("'","\'",$msg);
											?>
											<a onclick="javascript:osConfirmExtend('<?php echo $msg;?>','ajax_addFavorites','<?php echo $row->id?>','<?php echo JURI::root()?>','fav<?php echo $row->id; ?>','theme3','details');" class="reportlisting" title="<?php echo JText::_('OS_ADD_TO_FAVORITES');?>">
												<?php echo JText::_('OS_ADD_TO_FAVORITES');?>
											</a>
										</span>
									</li>
									<?php
								}else{
									?>
									<li class="propertyinfoli">
										<span id="fav<?php echo $row->id;?>">
											<?php
											$msg = JText::_('OS_DO_YOU_WANT_TO_REMOVE_PROPERTY_OUT_OF_YOUR_FAVORITE_LISTS');
											$msg = str_replace("'","\'",$msg);
											?>
											<i class='edicon edicon-floppy-disk'></i>
											<a onclick="javascript:osConfirmExtend('<?php echo $msg;?>','ajax_removeFavorites','<?php echo $row->id?>','<?php echo JURI::root()?>','fav<?php echo $row->id; ?>','theme3','details')" href="javascript:void(0)" class="reportlisting" title="<?php echo JText::_('OS_REMOVE_FAVORITES');?>">
												<?php echo JText::_('OS_REMOVE_FAVORITES');?>
											</a>
										</span>
									</li>
									<?php 
								}
							}
							if($configClass['property_pdf_layout'] == 1){
							?>
							<li class="propertyinfoli">
								<i class='edicon edicon-file-pdf'></i>
								<a href="<?php echo JURI::root()?>index.php?option=com_osproperty&no_html=1&task=property_pdf&id=<?php echo $row->id?>" title="<?php echo JText::_('OS_EXPORT_PDF')?>"  rel="nofollow" target="_blank" class="reportlisting">
								PDF
								</a>
							</li>
							<?php
							}
							if($configClass['property_show_print'] == 1){
							?>
							<li class="propertyinfoli">
								<i class='edicon edicon-printer'></i>
								<a target="_blank" href="<?php echo JURI::root()?>index.php?option=com_osproperty&tmpl=component&no_html=1&task=property_print&id=<?php echo $row->id?>" class="reportlisting" title="<?php echo JText::_('OS_PRINT_THIS_PAGE')?>">
									<?php echo JText::_('OS_PRINT_THIS_PAGE')?>
								</a>
							</li>
							<?php
							}
							if($row->panorama != "") {
								?>
								<li class="propertyinfoli">
									<i class='edicon edicon-camera'></i>
									<a rel="nofollow" href="<?php echo JUri::root(); ?>index.php?option=com_osproperty&task=property_showpano&id=<?php echo $row->id ?>&tmpl=component"
									   class="osmodal reportlisting" rel="{handler: 'iframe', size: {x: 650, y: 420}}">
										<?php echo JText::_('OS_PANORAMA') ?>
									</a>
								</li>
								<?php
							}
							?>
						</ul> 
					</div>
				</div>
			</div>
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
				if(($row->pro_pdf != "") || ($row->pro_pdf_file != "")){
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
						<?php } ?>
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
									<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
										<h4>
											<i class="edicon edicon-list"></i>&nbsp;<?php echo $group_name;?>
										</h4>
									</div>
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
														echo $field->field_label;
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
					if($show_location == 1)
					{
						OSPHelper::showLocationAboveGoogle($address);
					}
                    if($configClass['map_type'] == 0)
                    {
                        HelperOspropertyGoogleMap::loadGoogleMapDetailsClone($row,$configClass);
                    }
                    else
                    {
                        HelperOspropertyOpenStreetMap::loadOpenStreetMapDetailsClone($row,$configClass);
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
		if((OSPHelper::allowShowingProfile($row->agentdetails->optin)) || ($configClass['show_request_more_details'] == 1)){
			?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
				<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
					<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> agentsharingform" id="agentsharing">
						<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> agentsharingformsub">
							<?php
							if($configClass['show_agent_details'] == 1){
								$link = JRoute::_("index.php?option=com_osproperty&task=agent_info&id=".$row->agent_id."&Itemid=".OSPRoute::getAgentItemid($row->agent_id));
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
							if((OSPHelper::allowShowingProfile($row->agentdetails->optin)) and ($configClass['show_request_more_details'] == 1)){
								$span1 = $bootstrapHelper->getClassMapping('span4');//"span4";
								$span2 = "";
								$span3 = $bootstrapHelper->getClassMapping('span8');//"span8";
							}elseif((OSPHelper::allowShowingProfile($row->agentdetails->optin)) and ($configClass['show_request_more_details'] == 0)){
								$span1 = $bootstrapHelper->getClassMapping('span4');
								$span2 = $bootstrapHelper->getClassMapping('span8');
								$span3 = "";
							}elseif((!OSPHelper::allowShowingProfile($row->agentdetails->optin)) and ($configClass['show_request_more_details'] == 1)){
								$span1 = "";
								$span2 = "";
								$span3 = $bootstrapHelper->getClassMapping('span12');
							}
							?>
							<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
								<?php
								if(OSPHelper::allowShowingProfile($row->agentdetails->optin)){
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
<input type="hidden" name="process_element" id="process_element" value="" />