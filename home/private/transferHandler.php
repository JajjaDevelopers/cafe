<?php session_start(); ?>
<?php $prepared_by = $_SESSION["userName"]; ?>
<?php include ("database.php"); ?>
<?php
$itemIdList = [];
$itemQtyList = [];
for ($i=1; $i<=5; $i++){
    array_push($itemIdList, 'item'.$i.'Id');
    array_push($itemQtyList, 'item'.$i.'Qty');
}


$transfer_no = documentNumber("transfers", "transfer_no");
$transfer_date = $_POST["transferDate"];
$transfer_from = $_POST["fromClientId"];
$transfer_to = $_POST["toClientId"];
$from_witness = $_POST["fromWitnessName"];
$to_witness = $_POST["toWitnessName"];

$summarySql = $conn->prepare("INSERT INTO transfers (transfer_no, transfer_date, transfer_from, transfer_to, 
                            from_witness, to_witness, prepared_by)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
$summarySql->bind_param("sssssss", $transfer_no, $transfer_date, $transfer_from, $transfer_to, $from_witness, 
                        $to_witness, $prepared_by);
$summarySql->execute();
$conn->rollback();

$reference = "Transfer";
$itemNo = 1;

$transferFromSql = $conn->prepare("INSERT INTO inventory(inventory_reference, document_number, customer_id, 
                                    item_no, grade_id, qty_out) VALUES (?, ?, ?, ?, ?, ?)");
for ($x=0; $x<count($itemIdList); $x++){
    $itmId = $_POST[$itemIdList[$x]];
    $itmQty = $_POST[$itemQtyList[$x]];
    $transferFromSql->bind_param("sisisd", $reference, $transfer_no, $transfer_from, $itemNo, $itmId, $itmQty);
    $transferFromSql->execute();
    $conn->rollback();
    $itemNo += 1;
}

//Capturing qty out
$transferToSql = $conn->prepare("INSERT INTO inventory(inventory_reference, document_number, customer_id, 
                                    item_no, grade_id, qty_in) VALUES (?, ?, ?, ?, ?, ?)");
for ($x=0; $x<count($itemIdList); $x++){
    $itmId = $_POST[$itemIdList[$x]];
    $itmQty = $_POST[$itemQtyList[$x]];
    $transferToSql->bind_param("sisisd", $reference, $transfer_no, $transfer_to, $itemNo, $itmId, $itmQty);
    $transferToSql->execute();
    $conn->rollback();
    $itemNo += 1;
}







header("location: ../inventory/transfer");
?>