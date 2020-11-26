<?php
/*------------------------------------------------------------------------
# activelistingform.php - Ossolution Property
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2018 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
?>
<script src="<?php echo JURI::root()?>media/com_osproperty/assets/js/paymentmethods.js" type="text/javascript"></script>
<h1 class="componentheading">

	<?php
    switch ($type){
        case "1":
            echo JText::_('OS_ACTIVE_LISTING');
            break;
        case "2":
            echo JText::_('OS_UPGRADE_PROPERTIES_TO_FEATURE');
            break;
        case "3":
            echo JText::_('OS_EXTEND_LISTING_SUBSCRIPTION');
            break;
    }
    echo " [".OSPHelper::getLanguageFieldValue($row,'pro_name')."]";
    ?>
</h1>
<form method="POST" action="<?php echo JRoute::_('index.php?option=com_osproperty&task=property_paymentprocess&Itemid='.$itemid); ?>" name="ftForm1" id="ftForm1">
    <div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>" id="addpropertypanel6">
        <div class="col width-100 nomargin nopadding <?php echo $bootstrapHelper->getClassMapping('span12'); ?>">
            <?php
            if($configClass['general_use_expiration_management'] == 1 && $row->expiration->id > 0){
                $expiration = $row->expiration;
                ?>
                <table class="addproperty-membership-table" width="100%">
                    <tr>
                        <th width="50%" class="paddingleft15">
                            <?php echo Jtext::_('OS_EXPIRATION_INFORMATION');?>
                        </th>
                        <th width="50%" class="paddingleft15">
                            <?php echo Jtext::_('OS_PROPERTY_TYPE');?>
                        </th>
                    </tr>
                    <?php
                    if($row->isFeatured == 1){
                        ?>
                        <tr>
                            <td>
                                <?php echo JText::_('OS_FEATURED_UNTIL');?>
                            </td>
                            <td>
                                <?php
                                $expiration_featured = strtotime($expiration->expired_feature_time);
                                if($expiration_featured < time()){
                                    $style = "extend_alert";
                                }else{
                                    $style = "";
                                }
                                echo "<span class='$style'>".date($configClass['general_date_format'],$expiration_featured)."</a>";
                                ?>
                            </td>
                        </tr>
                    <?php }
                    if($expiration->expired_time != "0000-00-00 00:00:00"){
                        ?>
                        <tr>
                            <td>
                                <?php echo JText::_('OS_UNPUBLISHED_ON');?>
                            </td>
                            <td>
                                <?php
                                $expiration_time = strtotime($expiration->expired_time);
                                if($expiration_time < time()){
                                    $style = "extend_alert";
                                }else{
                                    $style = "";
                                }
                                echo "<span class='$style'>".date($configClass['general_date_format'],$expiration_time)."</a>";
                                ?>
                            </td>
                        </tr>
                    <?php }
                    if($expiration->remove_from_database != "0000-00-00 00:00:00"){
                        ?>
                        <tr>
                            <td>
                                <?php echo JText::_('OS_REMOVED_ON');?>
                            </td>
                            <td>
                                <?php
                                $expiration_remove = strtotime($expiration->remove_from_database);
                                echo "<span>".date($configClass['general_date_format'],$expiration_remove)."</a>";
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
            <BR />
            <table class="addproperty-membership-table" width="100%">
                <tr>
                    <th width="15%">
                        #
                    </th>
                    <th width="85%">
                        <?php echo Jtext::_('OS_PROPERTY_TYPE');?>
                    </th>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="isFeatured" id="isFeatured1" value="0" onClick="javascript:showPaymentForm(0);" checked /> &nbsp;<label for="isFeatured1"><?php echo JText::_('OS_STANDARD');?></label>
                    </td>
                    <td>
                        <span><?php echo JText::_('OS_STANDARD_EXPLANATION'); ?></span>
                        <div class="clearfix"></div>
                        <table class="addproperty-membership-subtable">
                            <tr>
                                <?php
                                if($configClass['general_use_expiration_management'] == 1){ ?>
                                    <th width="50%">
                                        <?php echo Jtext::_('OS_LIFE_TIME');?>
                                    </th>
                                <?php } ?>
                                <th width="50%">
                                    <?php echo Jtext::_('OS_PRICE');?>
                                </th>
                            </tr>
                            <tr>
                                <?php
                                if($configClass['general_use_expiration_management'] == 1){ ?>
                                    <td>
                                        <?php
                                        echo $configClass['general_time_in_days'];
                                        echo " ".JText::_('OS_DAYS');
                                        ?>
                                    </td>
                                <?php } ?>
                                <td width="50%">
                                    <?php
                                    if($configClass['normal_cost'] == "0"){
                                        echo Jtext::_('OS_FREE');
                                    }else{
                                        echo OSPHelper::generatePrice(HelperOspropertyCommon::loadCurrency($configClass['general_currency_default']),$configClass['normal_cost']);
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="isFeatured" id="isFeatured2" onClick="javascript:showPaymentForm(1);" value="1" /> &nbsp;<label for="isFeatured2"><?php echo JText::_('OS_FEATURED');?></label>
                    </td>
                    <td>
                        <span><?php echo JText::_('OS_FEATURED_EXPLANATION'); ?></span>
                        <div class="clearfix"></div>
                        <table class="addproperty-membership-subtable">
                            <tr>
                                <?php
                                if($configClass['general_use_expiration_management'] == 1){ ?>
                                    <th width="50%">
                                        <?php echo Jtext::_('OS_LIFE_TIME');?>
                                    </th>
                                <?php } ?>
                                <th width="50%">
                                    <?php echo Jtext::_('OS_PRICE');?>
                                </th>
                            </tr>
                            <tr>
                                <?php
                                if($configClass['general_use_expiration_management'] == 1){ ?>
                                    <td>
                                        <?php
                                        echo $configClass['general_time_in_days_featured'];
                                        echo " ".JText::_('OS_DAYS');
                                        ?>
                                    </td>
                                <?php } ?>
                                <td width="50%">
                                    <?php
                                    if($configClass['general_featured_upgrade_amount'] == "0"){
                                        echo Jtext::_('OS_FREE');
                                    }else{
                                        echo OSPHelper::generatePrice(HelperOspropertyCommon::loadCurrency($configClass['general_currency_default']),$configClass['general_featured_upgrade_amount']);
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
            if(floatVal($configClass['normal_cost']) > 0){
                $display = "block";
            }else{
                $display = "none";
            }
            ?>
            <div id="payment_list" style="display:<?php echo $display;?>;">
                <?php
                $methods = $lists['methods'];
                if(count($methods) > 0){
                    ?>
                    <input type="hidden" name="nmethods" id="nmethods" value="<?php echo count($methods)?>" />
                    <table class="addproperty-membership-payments-table" width="100%">
                        <tr>
                            <th width="5%">
                                #
                            </th>
                            <th width="20%">
                                <?php echo Jtext::_('OS_PAYMENT_NAME');?>
                            </th>
                            <th width="55%">
                                <?php echo Jtext::_('OS_PAYMENT_DESC');?>
                            </th>
                            <th width="20%">
                            </th>
                        </tr>
                        <?php
                        $method = null ;
                        for ($i = 0 , $n = count($methods); $i < $n; $i++) {
                            $paymentMethod = $methods[$i];
                            if ($paymentMethod->getName() == $lists['paymentMethod']) {
                                $checked = ' checked="checked" ';
                                $method = $paymentMethod ;
                            }
                            else
                                $checked = '';
                            ?>
                            <tr>
                                <td class="center">
                                    <input onclick="javascript:changePaymentMethod();" type="radio" name="payment_method" id="pmt<?php echo $i?>" value="<?php echo $paymentMethod->getName(); ?>" <?php echo $checked; ?> />
                                </td>
                                <td>
                                    <label for="pmt<?php echo $i?>"><?php echo JText::_($paymentMethod->getTitle()) ; ?></label>
                                </td>
                                <td>
                                    <?php echo $paymentMethod->getDescription() ; ?>
                                </td>
                                <td class=" center">
                                    <?php
                                    if(file_exists(JPATH_ROOT.'/images/osproperty/plugins/'.$paymentMethod->getName().'.png')){
                                        ?>
                                        <img src="<?php echo JUri::root().'images/osproperty/plugins/'.$paymentMethod->getName().'.png'?>"  width="110" />
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                    </table>
                    <?php
                } else {
                    $method = $methods[0] ;
                }

                if ($method->getCreditCard()) {
                    $style = '' ;
                } else {
                    $style = 'style = "display:none"';
                }
                ?>
                <table class="addproperty-membership-credit-table">
                    <tr id="tr_card_head">
                        <th colspan=2>
                            <?php echo JText::_('OS_CREDIT_CARD_INFORMATION'); ?>
                        </th>
                    </tr>
                    <tr id="tr_card_number" <?php echo $style; ?>>
                        <td class="infor_left_col"><?php echo  JText::_('OS_AUTH_CARD_NUMBER'); ?><span class="required">*</span></td>
                        <td class="infor_right_col">
                            <input type="text" name="x_card_num" id="x_card_num" class="input-medium" onkeyup="checkNumber(this,'<?php echo JText::_('OS_ONLY_NUMBER'); ?>')" value="<?php echo $x_card_num; ?>" size="20" />
                        </td>
                    </tr>
                    <tr id="tr_exp_date" <?php echo $style; ?>>
                        <td class="infor_left_col">
                            <?php echo JText::_('OS_AUTH_CARD_EXPIRY_DATE'); ?><span class="required">*</span>
                        </td>
                        <td class="infor_right_col">
                            <?php echo $lists['exp_month'] .'  /  '.$lists['exp_year'] ; ?>
                        </td>
                    </tr>
                    <tr id="tr_cvv_code" <?php echo $style; ?>>
                        <td class="infor_left_col">
                            <?php echo JText::_('OS_AUTH_CVV_CODE'); ?><span class="required">*</span>
                        </td>
                        <td class="infor_right_col">
                            <input type="text" name="x_card_code" id="x_card_code" class="input-medium" onKeyUp="checkNumber(this,'<?php echo JText::_('OS_ONLY_NUMBER'); ?>')" value="<?php echo $x_card_code; ?>" size="20" />
                        </td>
                    </tr>
                    <?php
                    if ($method->getCardType()) {
                        $style = '' ;
                    } else {
                        $style = ' style = "display:none;" ' ;
                    }
                    ?>
                    <tr id="tr_card_type" <?php echo $style; ?>>
                        <td class="infor_left_col">
                            <?php echo JText::_('OS_CARD_TYPE'); ?><span class="required">*</span>
                        </td>
                        <td class="infor_right_col">
                            <?php echo $lists['card_type'] ; ?>
                        </td>
                    </tr>
                    <?php
                    if ($method->getCardHolderName()) {
                        $style = '' ;
                    } else {
                        $style = ' style = "display:none;" ' ;
                    }
                    ?>
                    <tr id="tr_card_holder_name" <?php echo $style; ?>>
                        <td class="infor_left_col">
                            <?php echo JText::_('OS_CARD_HOLDER_NAME'); ?><span class="required">*</span>
                        </td>
                        <td class="infor_right_col">
                            <input type="text" name="card_holder_name" id="card_holder_name" class="input-medium"  value="<?php echo $cardHolderName; ?>" size="40" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="<?php echo $bootstrapHelper->getClassMapping('row-fluid'); ?>" id="addpropertypanel6">
        <div class="col width-100 nomargin nopadding <?php echo $bootstrapHelper->getClassMapping('span12'); ?> center padding10">
            <a href="javascript:confirmUpgradeForm()" id="btn-submit" class="btn btn-primary" title="<?php echo JText::_('OS_PROCESS_PAYMENT');?>"><?php echo JText::_('OS_PROCESS_PAYMENT');?></a>
            <a href="javascript:history.go(-1)" class="btn btn-warning" title="<?php echo JText::_('OS_CANCEL');?>"><?php echo JText::_('OS_CANCEL');?></a>
        </div>
    </div>
	<input type="hidden" name="option" value="com_osproperty" />
	<input type="hidden" name="task" value="property_paymentprocess" />
	<input type="hidden" name="Itemid" value="<?php echo $itemid;?>" />
	<input type="hidden" name="remove_value" id="remove_value" value="" />
	<input type="hidden" name="live_site" value="<?php echo JURI::root()?>" />
    <input type="hidden" name="cid[]" value="<?php echo $row->id?>" />
    <input type="hidden" name="type" id="type" value="<?php echo $type;?>" />
</form>
<script type="text/javascript">
<?php
	os_payments::writeJavascriptObjects();
?>

function confirmUpgradeForm(){
	<?php
	if(($configClass['active_payment'] == 1) and (floatVal($configClass['general_featured_upgrade_amount'] > 0))){
		?>
		var methodpass = 1;
		var paymentMethod 	= "";
		var x_card_num = "";
		var x_card_code = "";
		var card_holder_name = "";
		var exp_month = "";
		var exp_year = "";
		cansubmit = checkPaymentMethod();
		<?php
	}else{
		?>
		cansubmit  = 1;
		<?php
	}
	?>
	if(cansubmit == 1){
		document.ftForm1.submit();
	}
}

function checkPaymentMethod(){
	var methodpass = 1;
	var paymentMethod 	= "";
	var x_card_num = "";
	var x_card_code = "";
	var card_holder_name = "";
	var exp_month = "";
	var exp_year = "";
	var check = 1;
	<?php
	$methods = $lists['methods'];
	if (count($methods) > 0) {
		if (count($methods) > 1) {
		?>
			var paymentValid = false;
			var nmethods = document.getElementById('nmethods');
			var methodtemp;
			for (var i = 0 ; i < nmethods.value; i++) {
				methodtemp = document.getElementById('pmt' + i);
				if(methodtemp.checked == true){
					paymentValid = true;
					paymentMethod = methodtemp.value;
					break;
				}
			}
			
			if (!paymentValid) {
				alert("<?php echo JText::_('OS_REQUIRE_PAYMENT_OPTION'); ?>");
				methodpass = 0;
			}		
		<?php	
		} else {
		?>
			paymentMethod = "<?php echo $methods[0]->getName(); ?>";
		<?php	
		}				
		?>
		method = methods.Find(paymentMethod);	
		if ((method.getCreditCard()) && (check == 1)) {
			var x_card_nume = document.getElementById('x_card_num');
			if (x_card_nume.value == "") {
				alert("<?php echo  JText::_('OS_ENTER_CARD_NUMBER'); ?>");
				x_card_nume.focus();
				methodpass = 0;
				return 0;
			}else{
				x_card_num = x_card_nume.value;
			}
			
			var x_card_codee = document.getElementById('x_card_code');
			if (x_card_codee.value == "") {
				alert("<?php echo JText::_('OS_ENTER_CARD_CODE'); ?>");
				x_card_codee.focus();
				methodpass = 0;
				return 0;
			}else{
				x_card_code = x_card_codee.value;
			}
		}
		
		if (method.getCardHolderName()) {
			card_holder_namee = document.getElementById('card_holder_name');
			if (card_holder_namee.value == '') {
				alert("<?php echo JText::_('OS_ENTER_CARD_HOLDER_NAME') ; ?>");
				card_holder_namee.focus();
				methodpass = 0;
				return 0;
			}else{
				card_holder_name = card_holder_namee.value;
			}
		}

		var exp_yeare = document.getElementById('exp_year');
		exp_year = exp_yeare.value;
		var exp_monthe = document.getElementById('exp_month');
		exp_month = exp_monthe.value;

        if (typeof stripePublicKey !== 'undefined')
        {

            if (paymentMethod.indexOf('os_stripe') == 0)
            {
                Stripe.card.createToken({
                    number: jQuery('#x_card_num').val(),
                    cvc: jQuery('#x_card_code').val(),
                    exp_month: jQuery('select[name^=exp_month]').val(),
                    exp_year: jQuery('select[name^=exp_year]').val(),
                    name: jQuery('#card_holder_name').val()
                }, stripeResponseHandler);
                return false;
            }
        }
		return 1;
		<?php
	}
	?>
}
</script>