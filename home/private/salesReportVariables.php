<?php
include "connlogin.php";
include "functions.php";
$salNo = intval($_GET['salNo']);
$salesNo = formatDocNo($salNo, "SAL-");

$summSql = $conn->prepare("SELECT customer_id, customer_name, sales_report_date, sale_category, sales_report_value, foreign_currency,
                        exchange_rate, preparing_staff, verified_by, approved_by, sales_notes, contact_person, telephone, prep_time,
                        ver_time, appr_time
                        FROM sales_reports_summary JOIN customer USING (customer_id) WHERE sales_report_no=?");
$summSql->bind_param("i", $salNo);
$summSql->execute();
$summSql->bind_result($cltId, $cltName, $salDate, $salCat, $salVal, $currency, $salFx, $prepared_by, $verified_by, $approved_by, 
                        $salNotes, $cltContact, $cltTel, $prep_time, $ver_time, $appr_time);
$summSql->fetch();
$summSql->close();

//details


function salesItemDetails(){
    include "connlogin.php";
    // include "functions.php";
    global $salNo, $salFx;
    $detSql = $conn->prepare("SELECT grade_name, qty_out, price_ugx FROM inventory JOIN grades USING (grade_id)
                        WHERE (inventory_reference='Sales Report' AND document_number=? AND qty_out>0) GROUP BY item_no");
    $ref = "Sales Report";
    $detSql->bind_param("i", $salNo);
    $detSql->execute();
    $detSql->bind_result($grade, $qty, $ugPx);
    ?>
    <table>
        <tr>
            <th style="width: 250px;">Grade</th>
            <th style="width: 80px;">QTY (Kgs)</th>
            <th style="width: 80px;">Batch Number</th>
            <th style="width: 70px;">Price (USD/Kg)</th>
            <th style="width: 70px;">Price (UGX/Kg)</th>
            <th style="width: 80px;">Amount (USD)</th>
            <th style="width: 100px;">Amount (UGX)</th>
        </tr>
    <?php
    $ttQty=0;
    $ttUgx=0;
    $ttUsd=0;
    while ($detSql->fetch()){
        $ttQty+=$qty;
        $ttUgx+=($ugPx*$qty);
        $ttUsd+=($ugPx*$qty/$salFx);
        ?>
        <tr>
            <td><input type="text" value="<?=$grade?>" id="<?= 'item'.$i.'Name'?>" readonly class="itmNameInput"></td>
            <td><input type="text" value="<?=num($qty)?>" id="<?= 'item'.$i.'Qty'?>" readonly class="tblNum"></td>
            <td><input type="text" value="" id="<?= 'item'.$i.'Batch'?>" readonly class="tblNum"></td>
            <td><input type="text" value="<?=num($ugPx/$salFx)?>" id="<?= 'item'.$i.'UsdPx'?>" readonly class="tblNum"></td>
            <td><input type="text" value="<?=num($ugPx)?>" id="<?= 'item'.$i.'UgxPx'?>" readonly class="tblNum"></td>
            <td><input type="text" value="<?=num($ugPx*$qty/$salFx)?>" id="<?= 'item'.$i.'UsdAmount'?>" readonly class="tblNum"></td>
            <td><input type="text" value="<?=num($ugPx*$qty)?>" id="<?= 'item'.$i.'UgxAmount'?>" readonly class="tblNum"></td>
        </tr>
        <script>
            // document.getElementById("")
        </script>
        <?php
    }
    ?>
        <tr>
            <th>Total</th>
            <th><input type="text" value="<?=num($ttQty)?>" id="totalQty" readonly name="totalQty" class="tblTotal"></th>
            <th></th>
            <th></th>
            <th></th>
            <th><input type="text" value="<?=num($ttUsd)?>" id="usdGrandTotal" readonly name="usdGrandTotal" class="tblTotal"></th>
            <th><input type="text" value="<?=num($ttUgx)?>" id="ugxGrandTotal" readonly name="ugxGrandTotal" class="tblTotal"></th>
        </tr>
    </table>
    <?php

}



?>