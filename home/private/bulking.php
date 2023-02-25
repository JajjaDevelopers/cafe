<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
<?php 
include ("connlogin.php");
include ("functions.php");
?>
<?php
$bulkingNo = documentNumber("bulking", "bulk_no");
$bulkingDate = $_POST["bulkingDate"];
$customerId = $_POST["customerId"];
$bulkOutGrd = $_POST["bulkOutGrd"];
$totalQty = $_POST["totalQty"];
$comment = $_POST["comment"];
$ref = "Bulking";

//creating items
$grdList = array();
$qtyList = array();
for ($x=1; $x<=5; $x++){
    array_push($grdList, "item".$x."Id");
    array_push($qtyList, "item".$x."Qty");
}

$summSql = $conn->prepare("INSERT INTO bulking (bulk_no, bulk_date, customer_id, grade_id, qty, 
                        prepared_by, prep_time, comment) VALUES (?,?,?,?,?,?,NOW(),?)");
$summSql->bind_param("isssdss", $bulkingNo, $bulkingDate, $customerId, $bulkOutGrd, $totalQty, 
                        $prepared_by, $comment);
$summSql->execute();
$summSql->close();

//updating inventory
$itmNo = 1;
$inputSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, trans_date, 
                            customer_id, item_no, grade_id, qty_out) VALUES (?,?,?,?,?,?,?)");
for ($x=0; $x<count($grdList); $x++){
    $grd = $_POST[$grdList[$x]];
    $qty = $_POST[$qtyList[$x]];
    if ($qty > 0){
        $inputSql->bind_param("sissisd", $ref, $bulkingNo, $bulkingDate, $customerId, $itmNo, $grd, $qty);
        $inputSql->execute();
        $itmNo += 1;
    }
}

$outputSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, trans_date, 
                            customer_id, item_no, grade_id, qty_in) VALUES (?,?,?,?,?,?,?)");
$outputSql->bind_param("sissisd", $ref, $bulkingNo, $bulkingDate, $customerId, $itmNo, $bulkOutGrd, $totalQty);
$outputSql->execute();



header("location: ../inventory/bulking");
?>