<?php
include "../utility/HelperFunctions.php";
include "connlogin.php";
include "functions.php";
if(isset($_SESSION["valNo"])){
$valNo = intval($_SESSION["valNo"]);
$valuationNumber = Helper::formatDocNo($valNo,"VAL-");
}elseif(isset($_GET["valNo"])){
    $valNo = intval($_GET["valNo"]);
    $valuationNumber = Helper::formatDocNo($valNo,"VAL-");
}

//summary
$summSql = $conn->prepare("SELECT valuation_date, batch_report_no, customer_id, input_qty, exchange_rate, costs, prepared_by, prep_date,
                        verified_by, ver_date, approved_by, appr_date, customer_name, contact_person, telephone
                        FROM valuation_report_summary JOIN customer USING (customer_id)
                        WHERE valuation_no=?");
$summSql->bind_param("i", $valNo);
$summSql->execute();
$summSql->bind_result($valDate, $batcNo, $cltId, $inputQty, $fxRate, $valCosts, $prepared_by, $prep_time, $verified_by, $ver_time, 
                    $approved_by, $appr_time, $cltName, $cltContact, $cltTel);
$summSql->fetch();
$summSql->close();
$valCostsUsd=num($valCosts/$fxRate);



function valuationDetails(){
    include "../private/connlogin.php";
    global $valNo, $fxRate, $inputQty, $ttQty, $ttYield, $ttUsdAmt, $ttUgxAmt;
    //details
    $valDetSql = $conn->prepare("SELECT grade_name, qty_in, price_ugx FROM inventory JOIN grades USING (grade_id) 
    WHERE inventory_reference='Valuation Report' AND document_number=? AND qty_in>0 ORDER BY item_no");
    $valDetSql->bind_param("i", $valNo);
    $valDetSql->execute();
    $valDetSql->bind_result($grdName, $grdQty, $ugxPx);
    $ttQty=$ttYield=$ttUsdAmt=$ttUgxAmt=0;
    $i=1;
    while ($valDetSql->fetch()){
        $ttQty+=$grdQty; $ttYield+=$grdQty*100/$inputQty; $ttUsdAmt+=$ugxPx*$grdQty/$fxRate; $ttUgxAmt+=$ugxPx*$grdQty;
        ?>
        <tr>
            <td><input type="text" value="<?=$grdName?>"  readonly  class="itmNameInput"></td>
            <td><input type="text" value="<?=num($grdQty*100/$inputQty)?>" readonly  class="tblNum"></td>
            <td><input type="text" value="<?=num($grdQty)?>" readonly class="tblNum" ></td>
            <td><input type="text" value="<?=num($ugxPx/$fxRate)?>" class="tblNum" readonly></td>
            <td><input type="text" value="<?=num(($ugxPx/$fxRate)*2.20462262185)?>" class="tblNum" readonly></td>
            <td><input type="text" value="<?=num($ugxPx)?>" readonly class="tblNum" ></td>
            <td><input type="text" value="<?=num($ugxPx*$grdQty/$fxRate)?>" readonly  class="tblNum"></td>
            <td><input type="text" value="<?=num($ugxPx*$grdQty)?>" readonly  class="tblNum"></td>
        </tr>
        <?php
    }
    
}

//valuation details for editing
function valEditDetails(){
    include "../private/connlogin.php";
    global $valNo, $fxRate, $inputQty, $ttQty, $ttYield, $ttUsdAmt, $ttUgxAmt;
    //details
    $valDetSql = $conn->prepare("SELECT grade_id, grade_name, qty_in, price_ugx FROM inventory JOIN grades USING (grade_id) 
    WHERE inventory_reference='Valuation Report' AND document_number=? AND qty_in>0 ORDER BY item_no");
    $valDetSql->bind_param("i", $valNo);
    $valDetSql->execute();
    $valDetSql->bind_result($grdId, $grdName, $grdQty, $ugxPx);
    $ttQty=$ttYield=$ttUsdAmt=$ttUgxAmt=0;
    $itemNo=1;
    while ($valDetSql->fetch()){
        $ttQty+=$grdQty; $ttYield+=$grdQty*100/$inputQty; $ttUsdAmt+=$ugxPx*$grdQty/$fxRate; $ttUgxAmt+=$ugxPx*$grdQty;
        ?>
        <tr>
            <td>
                <div id="<?='item'.$itemNo.'Field'?>" style="display: grid;" class="itemName">
                    <input type="text" value="<?=$grdId?>" id="<?='highGrade'.$itemNo.'Code'?>" readonly name="<?='highGrade'.$itemNo.'Code'?>" class="itmNameInput" style="grid-column: 1; display:none;">
                    <input type="text" value="<?=$grdName?>" id="<?='highGrade'.$itemNo.'Name'?>" readonly name="highGrade'.$itemNo.'Name" class="itmNameInput" style="grid-column: 2; width: 250px">
                    <select id="<?='highGrade'.$itemNo.'Select'?>" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="valuationItemCodeAndName(this.id)">
                        <?php CoffeeGrades();?>
                    </select>
                </div>
                
            </td>
            <td><input type="number" value="<?=$grdQty*100/$inputQty?>" id="<?='highGrade'.$itemNo.'Yield'?>" readonly name="<?='highGrade'.$itemNo.'Yield'?>" class="tblNum" min="0.00" step="0.01"></td>
            <td><input type="number" value="<?=$grdQty?>" id="<?='highGrade'.$itemNo.'Qty'?>" name="<?='highGrade'.$itemNo.'Qty'?>" class="tblNum" min="0" step="0.01"></td>
            <td><input type="number" value="<?=$ugxPx/$fxRate?>" id="<?='highGrade'.$itemNo.'PriceUs'?>" name="<?='highGrade'.$itemNo.'PriceUs'?>" class="tblNum" readonly min="0.00" step="0.0001"></td>
            <td><input type="number" value="<?=($ugxPx/$fxRate)*2.20462262185?>" id="<?='highGrade'.$itemNo.'PriceCts'?>" name="<?='highGrade'.$itemNo.'PriceCts'?>" class="tblNum" readonly min="0.00" step="0.0001"></td>
            <td><input type="number" value="<?=$ugxPx?>" id="<?='highGrade'.$itemNo.'PriceUgx'?>" name="<?='highGrade'.$itemNo.'PriceUgx'?>" class="tblNum" min="0.01" step="0.0001"></td>
            <td><input type="number" value="<?=$ugxPx*$grdQty/$fxRate?>" id="<?='highGrade'.$itemNo.'AmountUs'?>" readonly name="<?='highGrade'.$itemNo.'AmountUs'?>" class="tblNum" min="0.00" step="0.0001"></td>
            <td><input type="number" value="<?=$ugxPx*$grdQty?>" id="<?='highGrade'.$itemNo.'AmountUgx'?>" readonly name="<?='highGrade'.$itemNo.'AmountUgx'?>" class="tblNum" min="0.00" step="0.0001"></td>
        </tr>
        <?php
        $itemNo+=1;
    }
    while ($itemNo<=10){
        ?>
        <tr>
            <td>
                <div id="<?='item'.$itemNo.'Field'?>" style="display: grid;" class="itemName">
                    <input type="text" value="" id="<?='highGrade'.$itemNo.'Code'?>" readonly name="<?='highGrade'.$itemNo.'Code'?>" class="itmNameInput" style="grid-column: 1; display:none;">
                    <input type="text" value="" id="<?='highGrade'.$itemNo.'Name'?>" readonly name="highGrade'.$itemNo.'Name" class="itmNameInput" style="grid-column: 2; width: 250px">
                    <select id="<?='highGrade'.$itemNo.'Select'?>" style="margin-left: 0px; width: 20px; grid-column: 3;" class="itemSelect" onchange="valuationItemCodeAndName(this.id)">
                        <?php CoffeeGrades();?>
                    </select>
                </div>
                
            </td>
            <td><input type="number" value="" id="<?='highGrade'.$itemNo.'Yield'?>" readonly name="<?='highGrade'.$itemNo.'Yield'?>" class="tblNum" min="0.00" step="0.01"></td>
            <td><input type="number" value="" id="<?='highGrade'.$itemNo.'Qty'?>" name="<?='highGrade'.$itemNo.'Qty'?>" class="tblNum" min="0" step="0.01"></td>
            <td><input type="number" value="" id="<?='highGrade'.$itemNo.'PriceUs'?>" name="<?='highGrade'.$itemNo.'PriceUs'?>" class="tblNum" readonly min="0.00" step="0.0001"></td>
            <td><input type="number" value="" id="<?='highGrade'.$itemNo.'PriceCts'?>" name="<?='highGrade'.$itemNo.'PriceCts'?>" class="tblNum" readonly min="0.00" step="0.0001"></td>
            <td><input type="number" value="" id="<?='highGrade'.$itemNo.'PriceUgx'?>" name="<?='highGrade'.$itemNo.'PriceUgx'?>" class="tblNum" min="0.01" step="0.0001"></td>
            <td><input type="number" value="" id="<?='highGrade'.$itemNo.'AmountUs'?>" readonly name="<?='highGrade'.$itemNo.'AmountUs'?>" class="tblNum" min="0.00" step="0.0001"></td>
            <td><input type="number" value="" id="<?='highGrade'.$itemNo.'AmountUgx'?>" readonly name="<?='highGrade'.$itemNo.'AmountUgx'?>" class="tblNum" min="0.00" step="0.0001"></td>
        </tr>
        <?php
        $itemNo+=1;
    }
    
}
?>
