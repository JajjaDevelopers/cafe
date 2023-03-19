<?php 
session_start();
$username = $_SESSION["fullName"];
?>
<?php include("../private/database.php");?>
<?php

$batch_report_no = documentNumber("batch_reports_summary", "batch_report_no");

$sql = $conn->prepare("INSERT INTO batch_reports_summary (batch_report_no, batch_order_no, batch_report_date, 
                    customer_id, offtaker, net_input, mc_out, color_sorted, valuation_status, comment, prepared_by) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$batch_order_no = ($_POST['batchOrderNumber']);
$batch_report_date = $_POST['batchReportDate'];
$customer_id = ($_POST['customerId']);
$gradeId = ($_POST['inputCode']);
$offtaker = ($_POST['batchReportOfftaker']);
$net_input = ($_POST['netInputQty']);
$mc_out = ($_POST['batchReportMcOut']);
$colorSorted = $_POST['colorSortedInput'];
$valuation_status = 0;
$comment = ($_POST['remarks']);
$inventory_reference = "Batch Report";

$sql->bind_param("iisssdddiss", $batch_report_no, $batch_order_no, $batch_report_date, $customer_id, $offtaker,
                $net_input, $mc_out, $colorSorted, $valuation_status, $comment, $username);
$sql->execute();
$sql->close();

//Update processing status in batch orders
$updateOrderSql = $conn->prepare("UPDATE batch_processing_order SET status = 'Processed'
                                 WHERE (batch_order_no = ?)");
$updateOrderSql->bind_param("i", $batch_order_no);
$updateOrderSql->execute();
$updateOrderSql->close();


//inserting individual grade
$highNumber = $_POST["highNumber"];
$lowNumber = $_POST["lowNumber"];
$blacksNumber = $_POST["blacksNumber"];
$wastesNumber = $_POST["wastesNumber"];
$lossesNumber = $_POST["lossesNumber"];
$numbersList = array($highNumber, $lowNumber, $blacksNumber, $wastesNumber, $lossesNumber);

$highGradeList = array();
$lowGradeList = array();
$blacksGradeList = array();
$wastesGradeList = array();
$lossesGradeList = array();
$allLists = array($highGradeList, $lowGradeList, $blacksGradeList, $wastesGradeList, $lossesGradeList);
$listsIdentifier = array("high", "low", "blacks", "wastes", "losses");

//capturing batch report input
$itmNo = 1;
$inputSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                            grade_id, qty_out, trans_date) VALUE (?, ?, ?, ?, ?, ?, ?)");
$inputSql->bind_param("sisisds", $inventory_reference, $batch_report_no, $customer_id, $itmNo, $gradeId,
                        $net_input, $batch_report_date);
$inputSql->execute();
$inputSql->close();

//Capturing batch report output
$returnSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                            grade_id, qty_in, trans_date) VALUE (?, ?, ?, ?, ?, ?, ?)");
$itmNo += 1;


for ($x=0; $x<count($allLists); $x++){
    for ($i=1; $i <= $numbersList[$x]; $i++){
        $grdId = $_POST[($listsIdentifier[$x].'Grade'.$i.'Id')];
        $grdQty = $_POST[($listsIdentifier[$x].'Grade'.$i.'Qty')];
        if ($grdQty != 0){
            $returnSql->bind_param("sisisds", $inventory_reference, $batch_report_no, $customer_id, $itmNo, $grdId,
                                $grdQty, $batch_report_date);
            $returnSql->execute();
            $conn->rollback();
            $itmNo += 1;
        }
    }
}


// Capturing grade input


header("location:../processing/selectBatchOrder?act=Grading&formmsg=success");
exit();


?>