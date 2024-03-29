<?php
include "../utility/HelperFunctions.php";
include "../private/connlogin.php";
include "../private/functions.php";
$valNo = intval($_SESSION["valNo"]);
$valuationNumber = Helper::formatDocNo($valNo,"VAL-");

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
    include "connlogin.php";
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

?>