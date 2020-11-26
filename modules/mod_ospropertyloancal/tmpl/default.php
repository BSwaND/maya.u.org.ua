<?php
/*------------------------------------------------------------------------
# default.php - mod_oscategoryloancal
# ------------------------------------------------------------------------
# author    Dang Thuc Dam
# copyright Copyright (C) 2010 joomdonation.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomdonation.com
# Technical Support:  Forum - http://www.joomdonation.com/forum.html
*/
// no direct access
defined('_JEXEC') or die('Restricted access');
$rowFluidClass          = $bootstrapHelper->getClassMapping('row-fluid');
$span12Class            = $bootstrapHelper->getClassMapping('span12');
$controlGroupClass      = $bootstrapHelper->getClassMapping('control-group');
$controlLabelClass      = $bootstrapHelper->getClassMapping('control-label');
$controlsClass          = $bootstrapHelper->getClassMapping('controls');
?>

<script type="text/javascript">

<!--

    function calculateit()
    {
    f = document.repayment
    amt = f.amt.value
    annual_int = f.interest.value/100
    term = f.term.value
    monthly = annual_int/12
    monthly_pay = Math.floor((amt*monthly)/(1-Math.pow((1+monthly),(-1*term*12)))*100)/100
    f.monthly.value = currency(monthly_pay)
    }

    function currency(num)
    {
    var dollars = Math.floor(num);
    for (var i = 0; i < num.length; i++)
    {
      if (num.charAt(i) == ".")
    break;
    }
    var cents = "" + Math.round(num * 100);
    cents = cents.substring(cents.length-2, cents.length);
    return (dollars + "." + cents)
    }

//-->

</script>
<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?> loancal">
    <div class="<?php echo $rowFluidClass?>">
        <div class="<?php echo $span12Class?>">
            <form method="post" action="" name="repayment">
                <div class="<?php echo $controlsClass; ?>">
                    <div class="<?php echo $controlsClass?>">
                        <div class="<?php echo $bootstrapHelper->getClassMapping('input-prepend');?>">
                            <span class="add-on"><?php echo JText::_( 'OS_LOANCAL_CURRENCY' ); ?></span>
                            <input type="text" name="amt" id="amt" size="15" maxlength="15" placeholder="<?php echo JText::_( 'OS_LOANCAL_AMOUNT' ); ?>"/>
                        </div>
                    </div>
                </div>
                <div class="<?php echo $controlsClass; ?>">
                    <div class="<?php echo $controlsClass?>">
                        <div class="<?php echo $bootstrapHelper->getClassMapping('input-prepend');?>">
                            <span class="add-on"><?php echo JText::_( 'OS_LOANCAL_PERCENT' ); ?></span>
                            <input type="text" name="interest" id="interest" size="15" maxlength="15" placeholder="<?php echo JText::_( 'OS_LOANCAL_RATE' ); ?>" />
                        </div>
                    </div>
                </div>
                <div class="<?php echo $controlsClass; ?>">
                    <div class="<?php echo $controlsClass?>">
                        <div class="<?php echo $bootstrapHelper->getClassMapping('input-prepend');?>">
                            <span class="add-on"><?php echo JText::_( 'OS_LOANCAL_YRS' ); ?></span>
                            <input type="text" name="term" id="term" size="15" maxlength="15" placeholder="<?php echo JText::_( 'OS_LOANCAL_TERM' ); ?>" />
                        </div>
                    </div>
                </div>
                <div class="<?php echo $controlsClass; ?>">
                    <div class="<?php echo $controlsClass?>">
                        <input type="button" onclick="calculateit()" name="<?php echo JText::_( 'OS_LOANCAL_CALC' ); ?>" value="<?php echo JText::_( 'OS_LOANCAL_CALC' ); ?>" class="btn btn-info" />
                    </div>
                </div>
                <div class="<?php echo $controlsClass; ?>" style="margin-top:10px;">
                    <div class="<?php echo $controlsClass?>">
                        <div class="<?php echo $bootstrapHelper->getClassMapping('input-prepend');?>">
                            <span class="add-on"><?php echo JText::_( 'OS_LOANCAL_CURRENCY' ); ?></span>
                            <input type="text" name="monthly" id="monthly" size="15" maxlength="15" placeholder="<?php echo JText::_( 'OS_LOANCAL_REPAY' ); ?>" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>