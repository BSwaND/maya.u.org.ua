<?php
/*------------------------------------------------------------------------
# upgrade_step1.php - Ossolution Property
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
	<?php echo JText::_('OS_UPGRADE_PROPERTIES_TO_FEATURE'); ?>
</h1>
<form method="POST" action="<?php echo JRoute::_('index.php?option=com_osproperty&task=property_paymentprocess&Itemid='.$itemid); ?>" name="ftForm1" id="ftForm1">
	<table class="upgradeproperty-table">
		<tr>
			<th width="70%" class="header_td paddingleft20">
				<?php
					echo JText::_('OS_PROPERTY');
				?>
			</th>
			<th width="15%" class="header_td">
				<?php
					echo JText::_('OS_REMOVE');
				?>
			</th>
			<?php
			if(($configClass['general_featured_upgrade_amount'] > 0) and ($configClass['active_payment'] == 1)){
			?>
			<th width="15%" class="header_td">
				<?php
					echo JText::_('OS_TOTAL');
				?>
				(<?php echo HelperOspropertyCommon::loadDefaultCurrency(1)?>)
			</th>
			<?php
			}	
			?>
		</tr>
		<?php
		$total = 0;
		for($i=0;$i<count($rows);$i++){
			$row = $rows[$i];
			$total = $total + $configClass['general_featured_upgrade_amount'];
			$link = JURI::root()."index.php?option=com_osproperty&task=property_details&id=".$row->id;
			?>
			<input type="hidden" name="cid[]" value="<?php echo $row->id?>" />
			<tr>
				<td class="data_td" width="70%">
					<table  width="100%" class="border0">
						<tr>
							<td width="70">
								<?php
								if($row->image != ""){
									?>
									<a href="<?php echo $link?>" class="osmodal" rel="{handler: 'iframe', size: {x: 980, y: 500}, onClose: function() {}}">
										<?php
										OSPHelper::showPropertyPhoto($row->image,'thumb',$row->id,'width:70px;',$bootstrapHelper->getClassMapping('img-polaroid'),'');
										?>
									</a>
									<?php
								}else{
									OSPHelper::showPropertyPhoto($row->image,'thumb',$row->id,'width:70px;',$bootstrapHelper->getClassMapping('img-polaroid'),'');
								}
								?>
							</td>
							<td align="left" class="paddingleft20">
								<a href="<?php echo $link?>" class="osmodal" rel="{handler: 'iframe', size: {x: 980, y: 500}, onClose: function() {}}">
								<strong>
								<?php
									if(($row->ref != "") and ($configClass['show_ref'] == 1)){
										echo $row->ref.", ";
									}
									echo $row->pro_name;
								?>
								</strong>
								</a>
							</td>
						</tr>
					</table>
				</td>
				<td class="data_td center">
					<a href="javascript:removeItem('<?php echo $row->id?>')">
						<i class='osicon-remove'></i>
					</a>
				</td>
				<?php
				if(($configClass['general_featured_upgrade_amount'] > 0) and ($configClass['active_payment'] == 1)){
				?>
				<td class="data_td ">
					<?php  echo OSPHelper::generatePrice(HelperOspropertyCommon::loadCurrency(),$configClass['general_featured_upgrade_amount']); ?>
				</td>
				<?php } ?>
			</tr>
			<?php	
		}
		?>
		<?php
		if(($configClass['general_featured_upgrade_amount'] > 0) and ($configClass['active_payment'] == 1)){
		?>
		<tr>
			<td class="data_td fontbold backgroundlightgray">
				
			</td>
			<td class="data_td fontbold backgroundlightgray">
				<?php echo JText::_('OS_TOTAL')?>
			</td>
			<td class="data_td backgroundlightgray">
				<?php echo OSPHelper::generatePrice(HelperOspropertyCommon::loadCurrency(),$total); //HelperOspropertyCommon::showPrice($total)?>
			</td>
		</tr>
		<?php } ?>
	</table>
	<BR />
	<?php
	if($configClass['active_payment'] == 1){
		 if(floatVal($configClass['general_featured_upgrade_amount']) > 0){
		 ?>
		 <div class="clearfix"></div>
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
	<?php
		}
	} ?>
	<div class="clearfix"></div>

	<table  width="100%" class="border0">
		<tr>
			<td width="100%" class="alignright border0">
				<input type="button" value="<?php echo JText::_('OS_BACK')?>" class="btn btn-warning" onclick="javascript:history.go(-1);"/>
				<input type="button" value="<?php echo JText::_('OS_CONFIRM')?>" class="btn btn-info" onclick="javascript:confirmUpgradeForm();" />
			</td>
		</tr>
	</table>

	<input type="hidden" name="option" value="com_osproperty" />
	<input type="hidden" name="task" value="property_paymentprocess" />
	<input type="hidden" name="Itemid" value="<?php echo $itemid;?>" />
	<input type="hidden" name="remove_value" id="remove_value" value="" />
	<input type="hidden" name="live_site" value="<?php echo JURI::root()?>" />
    <input type="hidden" name="type" value="2" />
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
		var card_type = "";
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
	var card_type = "";
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
		//var discount_100 = document.getElementById('discount_100');
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