<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php
$dryingNo = documentNumber("drying", "drying_no");
$drying_date = $_POST["dryingDate"];
$customer = $_POST["customerId"];
$gradeId = $_POST["itemCode"];
$inputQty = $_POST["inputQty"];
$inputMc = $_POST["inputMc"];
$outputQty = $_POST["outputQty"];
$outputMc = $_POST["outputMc"];
$dryLoss = $_POST["dryLoss"];
$comment = $_POST["notes"];

//Capturing summary
$summarySql = $conn->prepare("INSERT INTO drying (drying_no, drying_date, customer_id, grade_id, input_qty, 
                            input_mc, output_qty, output_mc, drying_loss, prepared_by, prep_time, comment) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, Now(), ?)");
$summarySql->bind_param("isssdddddss", $dryingNo, $drying_date, $customer, $gradeId, $inputQty, $inputMc, $outputQty, 
                                    $outputMc, $dryLoss, $prepared_by, $comment);
$summarySql->execute();
$conn->rollback();

//Capturing details
$reference = "Drying";
$itmNo = 1;

$detialsSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                            grade_id, qty_out) VALUES (?, ?, ?, ?, ?, ?)");
$detialsSql->bind_param("sisisd", $reference, $dryingNo, $customer, $itmNo, $gradeId, $inputQty);
$detialsSql->execute();
$conn->rollback();

$itmNo += 1;
$detialsSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                            grade_id, qty_in) VALUES (?, ?, ?, ?, ?, ?)");
$detialsSql->bind_param("sisisd", $reference, $dryingNo, $customer, $itmNo, $gradeId, $outputQty);
$detialsSql->execute();
$conn->rollback();

$itmNo += 1;
$gradeId = "DRYLSS";
$detialsSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                            grade_id, qty_in) VALUES (?, ?, ?, ?, ?, ?)");
$detialsSql->bind_param("sisisd", $reference, $dryingNo, $customer, $itmNo, $gradeId, $dryLoss);
$detialsSql->execute();
$conn->rollback();









header("location: ../processing/drying");
?>