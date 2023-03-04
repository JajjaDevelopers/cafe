<?php
include "../private/connlogin.php";
include "../utility/HelperFunctions.php";
if(isset($_SESSION['batchNo'])){
$batchNo=intval($_SESSION['batchNo']);
$batchRepNo = Helper::formatDocNo(Intval($batchNo), "BRN-") ;
}else{
$batchNo=intval($_GET['batchNo']);
$batchRepNo =Helper::formatDocNo(Intval($batchNo), "BRN-") ;
}



$categorySql = $conn->prepare("SELECT type_category FROM grades WHERE grade_id='NRSC18'");
// $categorySql->bind_param("s", $inputGradeId);
$categorySql->execute();
$categorySql->bind_result($typeCategory);
$categorySql->fetch();
$categorySql->close();

//batch summary
$summSql = $conn->prepare("SELECT batch_order_no, batch_report_date, batch_reports_summary.customer_id, offtaker, net_input, mc_out, 
            color_sorted, comment, batch_reports_summary.prepared_by, batch_reports_summary.prep_time, batch_reports_summary.verified_by,
            batch_reports_summary.ver_time, batch_reports_summary.approved_by, batch_reports_summary.appr_time, customer_name,
            contact_person, telephone, batch_order_mc, grade_name FROM batch_reports_summary JOIN customer USING (customer_id) 
            JOIN batch_processing_order USING (batch_order_no) JOIN grn USING (batch_order_no) JOIN grades USING (grade_id) WHERE 
            batch_report_no=? ");
$summSql->bind_param("i", $batchNo);
$summSql->execute();
$summSql->bind_result($ordNo, $batchDate, $cltId, $offTaker, $netInputQty, $outputMc, $colSorted, $notes, $prepared_by, $prep_time, 
            $verified_by, $ver_time, $approved_by, $appr_time, $cltName, $cltContact, $cltTel, $inputMc, $inputGradeName);
$summSql->fetch();
$summSql->close();
$fmDate=$batchDate;
$batchOrderNumber=Helper::formatDocNo(intval($ordNo),"");

//returns
$overallTotal = 0.00;
function getGrades($typeCategory, $gradeType, $gradeNamePrefix, $gradeIdPrefix, $tableHeader){
    global $batchNo, $netInputQty, $overallTotal;
    include "../private/connlogin.php";
    $gradeSql = $conn->prepare("SELECT grade_id, grade_name, qty_in FROM grades JOIN inventory USING (grade_id)
                WHERE (type_category=? AND grade_type=? AND inventory_reference='Batch Report' AND document_number=? AND qty_in>0)
                ORDER BY grade_rank");
  
    $highGradeList = array();
    $lowGradeList = array();
    $blacksGradeList = array();
    $wastesGradeList = array();
    $lossesGradeList = array();
    $allLists = array($highGradeList, $lowGradeList, $blacksGradeList, $wastesGradeList, $lossesGradeList);
    $listsIdentifier = array("high", "low", "blacks", "wastes", "losses");
    //global $conn, $gradeSql, $listsIdentifier, $allLists, $highGradeList, $lowGradeList, $blacksGradeList, $wastesGradeList, $lossesGradeList;
    $gradeSql->bind_param("ssi", $typeCategory, $gradeType, $batchNo);
    $gradeSql->execute();
    $allGrades = $gradeSql -> get_result();
    $rows = $conn -> affected_rows;
  
    $index = array_search($gradeIdPrefix, $listsIdentifier);
  
    ?>
    <h6 style="margin-top: 5px;"><?= $tableHeader?></h6>
    <input id="<?= $gradeIdPrefix.'Number' ?>" name="<?= $gradeIdPrefix.'Number' ?>" value="<?= $rows ?> " readonly style="display: none;">
    <table id="highGradeReturnsTable">
        <tr>
            <th class="batchItemLabel">GRADE</th>
            <th class="batchItemBags">BAGS</th>
            <th class="batchItemKgs">KGs</th>
            <th class="batchItemPercent">%</th>
        </tr>
    <?php
    $grdCatTotal = 0.00;
    for ($gradeNo=1; $gradeNo <= $rows; $gradeNo++){
        $gradeRow = $allGrades -> fetch_assoc();
        if ($gradeIdPrefix == "blacks"){
            $grade_id = "BLACKS";
        }else{
            $grade_id = $gradeRow ['grade_id'];
        }
        $grade_name = $gradeNamePrefix.' '.$gradeRow ['grade_name'];
        $prefix = $gradeIdPrefix.'Grade'.$gradeNo;
        $qty = $gradeRow['qty_in'];
        $bags = $qty/60;
        $grdCatTotal += $qty;
  
        array_push($allLists[$index], $prefix.'Id');
        ?>
        <tr>
            <input type="text" id="<?= $prefix.'Id'?>" readonly name="<?= $prefix.'Id'?>" value="<?= $grade_id?>" class="tableInput" style="display:none">
            <td><input name="<?= $gradeIdPrefix?>" style="display:none"><?= $grade_name?></td>
            <td><input type="number" id="<?= $prefix.'Bags'?>" readonly name="<?= $prefix.'Bags'?>" value="<?=round($bags,0)?>" class="tblNum"></td>
            <td><input type="number" id="<?= $prefix.'Qty'?>" readonly name="<?= $prefix.'Qty'?>" value="<?=$qty?>" class="tblNum"></td>
            <td><input type="number" id="<?= $prefix.'Per'?>" readonly name="<?= $prefix.'Per'?>" value="<?=round($qty*100/$netInputQty,2)?>" class="tblNum"></td>
        </tr>
        <?php
    }
    $overallTotal += $grdCatTotal;
        ?>
        <tr>
            <th>SUB TOTAL</th>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalBags' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalBags'?>"  value="<?=round($grdCatTotal/60)?>" class="tblNum"></td>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalQty' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalQty'?>" value="<?=round($grdCatTotal,2)?>" class="tblNum"></td>
            <td><input type="number" id="<?= $gradeIdPrefix.'GradeSubtotalPer' ?>" readonly name="<?= $gradeIdPrefix.'GradeSubtotalPer'?>" value="<?=round($grdCatTotal*100/$netInputQty,2)?>" class="tblNum"></td>
        </tr>
    </table>
  <?php
  }