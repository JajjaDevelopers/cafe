<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
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
$ttQty = intval($_POST["totalQty"]);
$comment = $_POST["notes"];
if ($ttQty>0){
    $summarySql = $conn->prepare("INSERT INTO transfers (transfer_no, transfer_date, transfer_from, transfer_to, 
    from_witness, to_witness, prepared_by, prep_time, notes)
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $summarySql->bind_param("isssssss", $transfer_no, $transfer_date, $transfer_from, $transfer_to, $from_witness, 
    $to_witness, $prepared_by, $comment);
    $summarySql->execute();
    $summarySql->close();

    $reference = "Transfer";
    $itemNo = 1;
    //qty out 
    $transferFromSql = $conn->prepare("INSERT INTO inventory(inventory_reference, document_number, trans_date, customer_id, 
                item_no, grade_id, qty_out) VALUES (?,?,?,?,?,?,?)");

    //Capturing qty out
    $transferToSql = $conn->prepare("INSERT INTO inventory(inventory_reference, document_number, trans_date, customer_id, 
                item_no, grade_id, qty_in) VALUES (?,?,?,?,?,?,?)");

    for ($x=0; $x<count($itemIdList); $x++){
        $itmId = $_POST[$itemIdList[$x]];
        $itmQty = $_POST[$itemQtyList[$x]];
        if ($itmQty>0){
            $transferFromSql->bind_param("sissisd", $reference, $transfer_no, $transfer_date, $transfer_from, $itemNo, $itmId, $itmQty);
            $transferFromSql->execute();//out
            $itemNo += 1;
            $transferToSql->bind_param("sissisd", $reference, $transfer_no, $transfer_date, $transfer_to, $itemNo, $itmId, $itmQty);
            $transferToSql->execute();//in
            $itemNo += 1;
        }

    }
    if(isset($_POST["btnsubmit"]))
    {
        header("location:../inventory/transfer?formmsg=success");
    }
}else{
    if(isset($_POST["btnsubmit"]))
        {
            header("location:../inventory/transfer?formmsg=fail");
        }
}
?>