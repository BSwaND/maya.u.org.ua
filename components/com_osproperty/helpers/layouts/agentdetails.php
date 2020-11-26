<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?> agentdetails">
	<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
		<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
			<div class="<?php echo $bootstrapHelper->getClassMapping('span4'); ?>">
                <div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
                    <div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
                        <?php
                        if(($agent->photo != "") && ($configClass['show_agent_image'] == 1)){
                            ?>
                            <img src='<?php echo JURI::root()?>images/osproperty/agent/<?php echo $agent->photo?>' border="0" />
                            <?php
                        }else{
                            ?>
                            <img src='<?php echo JURI::root()?>media/com_osproperty/assets/images/noimage.jpg' border="0" />
                            <?php
                        }
                        if($agent->featured == 1){
                        ?>
                            <img alt="<?php echo JText::_('OS_FEATURED');?>" class="spotlight_watermark" src="<?php echo JURI::root()?>media/com_osproperty/assets/images/featured_medium.png">
                         <?php
                        }
                        ?>
                    </div>
                </div>
			</div>
			<div class="<?php echo $bootstrapHelper->getClassMapping('span4'); ?>">
                <h1 class="componentheading agent_title">
                    <?php echo $agent->name?>
                    <?php
                    if($configClass['enable_report'] == 1)
                    {
                        JHTML::_('behavior.modal','a.osmodal');
                        ?>
                        &nbsp;
                        <a href="<?php echo JURI::root()?>index.php?option=com_osproperty&tmpl=component&task=property_reportForm&item_type=1&id=<?php echo $agent->id?>" class="osmodal reportlink" rel="{handler: 'iframe', size: {x: 350, y: 600}}" title="<?php echo JText::_('OS_REPORT_AGENT');?>">
							<i class="edicon edicon-flag"></i>
                        </a>
                        <?php
                    }
                    if(JFactory::getUser()->id == $agent->user_id && JFactory::getUser()->id > 0)
                    {
                        ?>
                        &nbsp;
                        <a href="<?php echo JRoute::_('index.php?option=com_osproperty&task=agent_editprofile');?>" title="<?php echo JText::_('OS_EDIT_PROFILE');?>" class="editprofilelink">
                             <i class="edicon edicon-pencil"></i>
                        </a>
                        <?php
                    }
                    ?>
                </h1>
				<?php
				if($configClass['show_agent_address'] == 1){
					$address = OSPHelper::generateAddress($agent);
					if($address != ""){
						?>
						<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
							<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> address">
							<?php
							echo "<i class='edicon edicon-location'></i>&nbsp;";
							echo $address;
							?>
							</div>
						</div>
						<?php
					}
				}
				?>
				<?php
				if(($configClass['show_agent_email'] == 1) and ($agent->email != ""))
				{
				?>
					<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
						<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>"> <i class="edicon edicon-mail2"></i>&nbsp;<a href="mailto:<?php echo $agent->email;?>" target="_blank"><?php echo $agent->email;?></a></div>
					</div>
				<?php
				}
				?>
				<?php
				if(($configClass['show_license'] == 1) and ($agent->license != ""))
				{
					
					?>
					<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
						<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
							<i class="edicon edicon-bookmark"></i>&nbsp;
							<?php
							echo $agent->license;
							?>
						</div>
					</div>
					<?php
				}
				?>
				<?php
				if(($configClass['show_company_details'] == 1) and ($agent->company_id > 0))
				{
				?>
					<div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
						<div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
							<i class="edicon edicon-office"></i>&nbsp;
							<?php
							$link = JRoute::_('index.php?option=com_osproperty&task=company_info&id='.$agent->company_id.'&Itemid='.OSPRoute::getCompanyItemid());
							?>
							<span class="hasTip" title="&lt;img src=&quot;<?php echo $agent->company_photo;?>&quot; alt=&quot;<?php echo str_replace("'","",$agent->company_name);?>&quot; width=&quot;100&quot; /&gt;">
								<i class="osicon-camera"></i>
							</span>
							&nbsp;|&nbsp;
							<?php
							echo "<a href='".$link."' title='".$agent->company_name."'>".$agent->company_name."</a>";
							?>
						</div>
					</div>
				<?php
				}
				?>
                <?php
                if(($configClass['show_agent_fax'] == 1) and ($agent->fax != ""))
                {
                    ?>
                    <div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
                        <div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>"> <i class="edicon edicon-printer"></i>&nbsp;<?php echo $agent->fax;?></div>
                    </div>
                    <?php
                }
                ?>
                <?php
                if(($configClass['show_agent_msn'] == 1) and ($agent->msn != ""))
                {
                    ?>
                    <div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
                        <div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>"> <i class="edicon edicon-bubble2"></i>&nbsp;<?php echo $agent->msn;?></div>
                    </div>
                    <?php
                }
                ?>
                <div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
                    <div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
                        <ul class="social marT15 marL0">
                            <?php
                            if(($configClass['show_agent_mobile'] == 1) and ($agent->mobile != ""))
                            {
                                ?>
                                <li class="mobile">
                                    <a href="tel:<?php echo $agent->mobile; ?>" target="_blank">
                                        <i class="edicon edicon-mobile"></i>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <?php
                            if(($configClass['show_agent_phone'] == 1) and ($agent->phone != ""))
                            {
                                ?>
                                <li class="phone">
                                    <a href="tel:<?php echo $agent->phone; ?>" target="_blank">
                                        <i class="edicon edicon-phone"></i>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <?php
                            if(($configClass['show_agent_skype'] == 1) and ($agent->skype != ""))
                            {
                                ?>
                                <li class="skype">
                                    <a href="skype:<?php echo $agent->skype; ?>" target="_blank">
                                        <i class="edicon edicon-skype"></i>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <?php
                            if(($agent->facebook != "") and ($configClass['show_agent_facebook'] == 1)){
                                ?>
                                <li class="facebook">
                                    <a href="<?php echo $row->facebook; ?>" target="_blank">
                                        <i class="edicon edicon-facebook"></i>
                                    </a>
                                </li>
                            <?php }
                            if(($agent->aim != "") and ($configClass['show_agent_twitter'] == 1)){
                                ?>
                                <li class="twitter">
                                    <a href="<?php echo $row->aim; ?>" target="_blank">
                                        <i class="edicon edicon-twitter"></i>
                                    </a>
                                </li>
                            <?php }
                            if(($agent->yahoo != "") and ($configClass['show_agent_linkin'] == 1)){
                                ?>
                                <li class="linkin">
                                    <a href="<?php echo $row->yahoo; ?>" target="_blank">
                                        <i class="edicon edicon-linkedin2"></i>
                                    </a>
                                </li>
                            <?php }
                            if(($agent->gtalk != "") and ($configClass['show_agent_gplus'] == 1)){
                                ?>
                                <li class="gplus">
                                    <a href="<?php echo $row->gtalk; ?>" target="_blank">
                                        <i class="edicon edicon-google-plus"></i>
                                    </a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                </div>
			</div>
            <?php
            if ($configClass['show_agent_contact'] == 1)
            {
            ?>
			<div class="<?php echo $bootstrapHelper->getClassMapping('span4'); ?>">
                <form method="POST" action="<?php echo JRoute::_('index.php?option=com_osproperty&task=agent_submitcontact')?>" name="contactForm" id="contactForm">
                    <?php
                    HelperOspropertyCommon::contactForm('contactForm', $configClass['general_bussiness_name'], $agent->name);
                    ?>
                    <input type="hidden" name="option" value="com_osproperty" />
                    <input type="hidden" name="task" value="agent_submitcontact" />
                    <input type="hidden" name="id" value="<?php echo $agent->id?>" />
                    <input type="hidden" name="Itemid" value="<?php echo $jinput->getInt('Itemid',0)?>" />
                </form>
			</div>
            <?php } ?>
		</div>
        <?php
        $bio = OSPHelper::getLanguageFieldValue($agent,'bio');
        if($bio != "")
        {
            ?>
            <div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>">
                <div class="<?php echo $bootstrapHelper->getClassMapping('span12'); ?> agentbio">
                    <span class="agentbioheading">
                        <?php echo JText::_('OS_BIO');?>
                    </span>
                    <?php
                    echo stripslashes($bio);
                    ?>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php } ?>
	</div>
</div>