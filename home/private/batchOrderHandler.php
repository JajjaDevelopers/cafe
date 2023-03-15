<?php session_start(); ?>
<?php $username = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php
$grnList = array();
for ($row=1; $row<=5; $row++){
    array_push($grnList, "grn".$row."Id");
}

$batch_order_no = documentNumber("batch_processing_order", "batch_order_no");
$batch_combn = $_POST['combination'];
$batch_order_date = $_POST['orderDate'];
$client = $_POST['customerId'];
$grade = $_POST['gradeLimit'];
$batch_order_input_qty = $_POST['batchTotalQty'];
$batch_order_mc = $_POST['avgMc'];
$activity=$_POST['activity'];
$startDate=$_POST['startDate'];
$startTime=$_POST['startTime'];
$endDate=$_POST['endDate'];
$endTime=$_POST['endTime'];
if ($activity=="Grading"){
    $status="Pending Grading";
}elseif($activity=="Hulling"){
    $status="Pending Hulling";
}elseif($activity=="Drying"){
    $status="Pending Drying";
}
//Batch order summary
if ($batch_order_input_qty>0){
    $batchSummarySql = $conn->prepare("INSERT INTO batch_processing_order (batch_order_no, batch_order_date, activity, 
    batch_order_input_qty, batch_order_mc, start_date, start_time, end_date, end_time, status, prepared_by, prep_time, 
    customer_id, grade_id) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?, NOW(),?,?)");
    $batchSummarySql->bind_param("issddssssssss", $batch_order_no, $batch_order_date, $activity, $batch_order_input_qty, 
    $batch_order_mc, $startDate, $startTime, $endDate, $endTime, $status, $username, $client, $grade);
    $batchSummarySql->execute();

    //update GRNs
    $updateGrnSql = $conn->prepare("UPDATE grn SET batch_order_no = ? WHERE (grn_no = ?)");
    if ($batch_combn=='multiGrn'){
        for ($i=0; $i<count($grnList); $i++){
            $grnNo = $_POST[$grnList[$i]];
            if ($grnNo != ""){
                $updateGrnSql->bind_param("ii", $batch_order_no, $grnNo);
                $updateGrnSql->execute();
            }
        }
    }elseif($batch_combn=='multiClient'){
        for ($i=1; $i<=5; $i++){
            
            $grnQty = $_POST['client'.$i.'Qty'];
            if ($grnQty>0){
                $grnNo = $_POST['client'.$i.'Grn'];
                $updateGrnSql->bind_param("ii", $batch_order_no, $grnNo);
                $updateGrnSql->execute();
            }
        }
    }
    
    if(isset($_POST["btnsubmit"]))
    {
        header("location:../processing/batchOrder?formmsg=success");
    }
} else{
    if(isset($_POST["btnsubmit"]))
        {
            header("location:../processing/batchProcessingOrder?formmsg=fail");
        }
}

?>