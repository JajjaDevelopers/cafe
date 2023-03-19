<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php
$dryingNo = documentNumber("drying", "drying_no");
$orderNo = intval($_POST['orderNo']);
$drying_date = $_POST["dryingDate"];
$customer = $_POST["customerId"];
$gradeId = $_POST["itemCode"];
$inputQty = $_POST["inputQty"];
$inputMc = $_POST["inputMc"];
$outputQty = $_POST["outputQty"];
$outputMc = $_POST["outputMc"];
$dryLoss = $_POST["dryLoss"];
$comment = $_POST["notes"];

if ($inputQty>0 && $outputQty>0 && $customer != ""){
    //Capturing summary
    $summarySql = $conn->prepare("INSERT INTO drying (drying_no, batch_order_no, drying_date, customer_id, grade_id, input_qty, 
                                input_mc, output_qty, output_mc, drying_loss, prepared_by, prep_time, comment) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, Now(), ?)");
    $summarySql->bind_param("iisssdddddss", $dryingNo, $orderNo, $drying_date, $customer, $gradeId, $inputQty, $inputMc, $outputQty, 
                                        $outputMc, $dryLoss, $prepared_by, $comment);
    $summarySql->execute();

    //Capturing details
    $reference = "Drying";
    $itmNo = 1;

    $detialsSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                                grade_id, qty_out, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $detialsSql->bind_param("sisisds", $reference, $dryingNo, $customer, $itmNo, $gradeId, $inputQty, $drying_date);
    $detialsSql->execute();
    $detialsSql->close();

    $itmNo += 1;
    $detialsSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                                grade_id, qty_in, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $detialsSql->bind_param("sisisds", $reference, $dryingNo, $customer, $itmNo, $gradeId, $outputQty, $drying_date);
    $detialsSql->execute();
    $conn->rollback();

    $itmNo += 1;
    $gradeId = "DRYLSS";
    $detialsSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                                grade_id, qty_in, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $detialsSql->bind_param("sisisds", $reference, $dryingNo, $customer, $itmNo, $gradeId, $dryLoss, $drying_date);
    $detialsSql->execute();
    $conn->rollback();

    //update order
    $orderSql=$conn->prepare("UPDATE batch_processing_order SET status='Completed Drying' WHERE batch_order_no=?");
    $orderSql->bind_param("i", $orderNo);
    $orderSql->execute();

    if(isset($_POST["btnsubmit"]))
    {
        header("location:../processing/selectBatchOrder?act=Drying&formmsg=success");
    }
} else{
    if(isset($_POST["btnsubmit"]))
        {
            header("location:../processing/selectBatchOrder?act=Drying&formmsg=success");
        }
}


// header("location: ../processing/drying");
?>