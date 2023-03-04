<?php session_start(); ?>
<?php $username = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php
$grnList = array();
for ($row=1; $row<=5; $row++){
    array_push($grnList, "grn".$row."Id");
}

$batch_order_no = documentNumber("batch_processing_order", "batch_order_no");
$batch_order_date = $_POST['orderDate'];
$batch_order_input_qty = $_POST['batchTotalQty'];
$batch_order_mc = $_POST['avgMc'];
//Batch order summary
if ($batch_order_input_qty>0){
    $batchSummarySql = $conn->prepare("INSERT INTO batch_processing_order (batch_order_no, batch_order_date, batch_order_input_qty, 
    batch_order_mc, prepared_by) VALUES (?, ?, ?, ?, ?)");
    $batchSummarySql->bind_param("isids", $batch_order_no, $batch_order_date, $batch_order_input_qty, $batch_order_mc, $username);
    $batchSummarySql->execute();

    //update GRNs
    $updateGrnSql = $conn->prepare("UPDATE grn SET batch_order_no = ? WHERE (grn_no = ?)");
    for ($i=0; $i<count($grnList); $i++){
        $grnNo = $_POST[$grnList[$i]];
        if ($grnNo != ""){
            $updateGrnSql->bind_param("ii", $batch_order_no, $grnNo);
            $updateGrnSql->execute();
        }
    }
    if(isset($_POST["btnsubmit"]))
    {
        header("location:../processing/batchProcessingOrder?formmsg=success");
    }
} else{
    if(isset($_POST["btnsubmit"]))
        {
            header("location:../processing/batchProcessingOrder?formmsg=fail");
        }
}

?>