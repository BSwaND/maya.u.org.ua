<?php
$rowfluidClass      = $bootstrapHelper->getClassMapping('row-fluid');
$span12Class        = $bootstrapHelper->getClassMapping('span12');
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root()."components/com_osproperty/templates/theme3/style/font.css");
?>

<div class="<?php echo $rowfluidClass; ?>" id="agentslisting">
    <div class="<?php echo $span12Class; ?>">
        <?php
        for($i=0;$i<count($rows);$i++){
            $row = $rows[$i];
            ?>
            <div class="<?php echo $rowfluidClass; ?> ospitem-separator">
                <div class="<?php echo $span12Class; ?>">
                    <div class="<?php echo $rowfluidClass; ?>">
                        <div class="<?php echo $bootstrapHelper->getClassMapping('span3'); ?> agentphotobox">
                            <div class="<?php echo $rowfluidClass; ?>">
                                <div class="<?php echo $span12Class; ?> agentphotobox1">
                                    <?php
                                    if($configClass['show_agent_image'] == 1)
                                    {
                                        ?>
                                        <?php
                                        if(($row->photo != "") && (file_exists(JPATH_ROOT.DS."images".DS."osproperty".DS."agent".DS.$row->photo)))
                                        {
                                            if($configClass['load_lazy'])
                                            {
                                                ?>
                                                <img src='<?php echo JURI::root()?>media/com_osproperty/assets/images/loader.gif' border="0" data-original='<?php echo JURI::root()?>images/osproperty/agent/<?php echo $row->photo?>' title='<?php echo $row->name?>' class='oslazy'/>
                                                <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <img src='<?php echo JURI::root()?>images/osproperty/agent/<?php echo $row->photo?>' border="0" title='<?php echo $row->name?>'/>
                                            <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <img src='<?php echo JURI::root()?>media/com_osproperty/assets/images/noimage.jpg' border="0" title='<?php echo $row->name?>'/>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if($row->featured == 1)
                                        {
                                        ?>
                                            <img alt="<?php echo JText::_('OS_FEATURED');?>" class="spotlight_watermark" src="<?php echo JURI::root()?>media/com_osproperty/assets/images/featured_medium.png" />
                                         <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <img src='<?php echo JURI::root()?>media/com_osproperty/assets/images/noimage.jpg' border="0" title='<?php echo $row->name?>'/>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="<?php echo $rowfluidClass; ?>">
                                <div class="<?php echo $span12Class; ?> agentdetailslink">
                                    <a href="<?php echo JRoute::_('index.php?option=com_osproperty&task=agent_info&id='.$row->id.'&Itemid='.OSPRoute::getAgentItemid($row->id));?>" class="agentdetailsbtn" title="<?php echo JText::_('OS_VIEW_DETAILS');?>"><?php echo JText::_('OS_VIEW_DETAILS');?></a>
                                </div>
                            </div>
                        </div>
                        <div class="<?php echo $bootstrapHelper->getClassMapping('span9'); ?> ospitem-leftpad">
                            <div class="<?php echo $rowfluidClass; ?>">
                                <div class="<?php echo $span12Class; ?> agenttitle">
                                    <h3 class="agency-name">
                                        <?php echo $row->name?>
                                    </h3>
                                </div>
                            </div>
                            <?php
                            if($configClass['show_agent_address']==1)
                            {
                                ?>
                                <div class="<?php echo $rowfluidClass; ?>">
                                    <div class="<?php echo $span12Class; ?> agentaddress">
                                        <?php
                                        echo "<i class='fa fa-map-marker'></i> ";
                                        echo OSPHelper::generateAddress($row);
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        <?php
                        if($configClass['show_agent_email'] == 1 && $row->email != '')
                        {
                        ?>
                            <div class="<?php echo $rowfluidClass; ?>">
                                <div class="<?php echo $span12Class; ?>">
                                    <?php
                                    echo "<span class='agent_label'>".JText::_('OS_EMAIL')."</span>";
                                    echo ":&nbsp;";
                                    echo "&nbsp;";
                                    echo "<a href='mailto:$row->email'>$row->email</a>";
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        if($row->phone != "" && $configClass['show_agent_phone'] == 1)
                        {
                        ?>
                            <div class="<?php echo $rowfluidClass; ?>">
                                <div class="<?php echo $span12Class; ?>">
                                    <?php
                                    echo "<span class='agent_label'>".JText::_('OS_PHONE')."</span>";
                                    echo ":&nbsp;";
                                    echo "&nbsp;";
                                    echo $row->phone;
                                    ?>
                                </div>
                            </div>
                            <?php
                        }

                        if($row->mobile != "" && $configClass['show_agent_mobile'] == 1)
                        {
                        ?>
                            <div class="<?php echo $rowfluidClass; ?>">
                                <div class="<?php echo $span12Class; ?>">
                                    <?php
                                    echo "<span class='agent_label'>".JText::_('OS_MOBILE')."</span>";
                                    echo ":&nbsp;";
                                    echo "&nbsp;";
                                    echo $row->mobile;
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        $bio = OSPHelper::getLanguageFieldValue($row,'bio');
                        if($bio != ""){
                            $bio =  stripslashes(strip_tags($bio));
                            $bioArr = explode(" ",$bio);
                            if(count($bioArr) > 20){
                                $tempBio = "";
                                for($b=0;$b<=20;$b++){
                                    $tempBio.= $bioArr[$b]." ";
                                }
                                echo substr($tempBio,0,strlen($tempBio) - 1)."..";
                            }else{
                                echo $bio;
                            }
                        ?>
                        <?php
                        }
                        ?>
                        <div class="<?php echo $rowfluidClass; ?>">
                            <div class="<?php echo $span12Class; ?>">
                                <ul class="social marT15 marL0">
                                    <?php
                                    if(($row->facebook != "") and ($configClass['show_agent_facebook'] == 1)){
                                        ?>
                                        <li class="facebook">
                                            <a href="<?php echo $row->facebook; ?>" target="_blank">
                                                <i class="edicon edicon-facebook"></i>
                                            </a>
                                        </li>
                                    <?php }
                                    if(($row->aim != "") and ($configClass['show_agent_twitter'] == 1)){
                                        ?>
                                        <li class="twitter">
                                            <a href="<?php echo $row->aim; ?>" target="_blank">
                                                <i class="edicon edicon-twitter"></i>
                                            </a>
                                        </li>
                                    <?php }
                                    if(($row->yahoo != "") and ($configClass['show_agent_linkin'] == 1)){
                                        ?>
                                        <li class="linkin">
                                            <a href="<?php echo $row->yahoo; ?>" target="_blank">
                                                <i class="edicon edicon-linkedin2"></i>
                                            </a>
                                        </li>
                                    <?php }
                                    if(($row->gtalk != "") and ($configClass['show_agent_gplus'] == 1)){
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
                </div>
            </div>
        </div>
        <?php
        }

        if($pageNav->total > $pageNav->limit){
        ?>
            <div class="clearfix"></div>
            <DIV class="pageNavdiv">
                <?php echo $pageNav->getListFooter();?>
            </DIV>
        <?php } ?>
    </div>
</div>