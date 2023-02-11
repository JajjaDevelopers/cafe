<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
<?php 
include ("connlogin.php"); 
include "functions.php";
?>
<?php
// Generating grades
$gradeList = array();
$qtyOutList = array();
$mcList = array();
$bagsList = array();

for ($x=1; $x<=10; $x++){
    array_push($gradeList, 'item'.$x.'Id');
    array_push($qtyOutList, 'item'.$x.'Qty');
    array_push($mcList, 'item'.$x.'Mc');
    array_push($bagsList, 'item'.$x.'Bags');
}

$dispatch_no = documentNumber("dispatch", "dispatch_no");
$dispatch_date = $_POST["relDate"];
$dispatch_time = $_POST["timeOut"];
$customer_id = $_POST["customerId"];
$dispatch_qty = $_POST["totalQty"];
$truck_no = $_POST["truckNo"];
$driver = $_POST["driver"];
$releaseNo = $_POST["releaseNo"];
//Summary 
$summarySql = $conn->prepare("INSERT INTO dispatch (dispatch_no, truck_no, driver, prepared_by, release_no) VALUES (?,?,?,?,?)");
$summarySql -> bind_param("issss", $dispatch_no, $truck_no, $driver, $prepared_by, $releaseNo);
$summarySql->execute(); 
$summarySql->close(); 

//inventory details
$detailsSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, trans_date, customer_id, item_no, 
                            grade_id, qty_out) VALUES (?,?,?,?,?,?,?)");
$inventory_reference = "Dispatch";
$itemNo = 0;
for ($i=0; $i<count($gradeList); $i++){
    $gradeQty = $_POST[$qtyOutList[$i]];
    $gradeId = $_POST[$gradeList[$i]];
    
    
    if ($gradeQty > 0){
        $itemNo += 1;
        $detailsSql->bind_param("sissisd", $inventory_reference, $dispatch_no, $dispatch_date, $customer_id, $itemNo, $gradeId, $gradeQty);
        $detailsSql->execute();
    }
}
$detailsSql->close();

//update release request
$updateSql = $conn->prepare("UPDATE release_request SET status=2, dispatch_no=?, dispatch_time=? WHERE release_no=?");
$updateSql->bind_param("isi", $dispatch_no, $dispatch_date, $releaseNo);
$updateSql->execute();
$updateSql->close();






header("location: ../inventory/pendingDispatch")
?>