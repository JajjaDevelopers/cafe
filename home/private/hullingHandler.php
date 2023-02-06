<?php session_start(); ?>
<?php $prepared_by = $_SESSION["userName"]; ?>
<?php include ("database.php"); ?>
<?php
$hulling_no = documentNumber("hulling", "hulling_no");
$hulling_date = $_POST["hullingDate"];
$customer_id = $_POST["customerId"];
$input_grade_id = $_POST["inputCode"];
$input_qty = $_POST["inputQty"];
$mc_in = $_POST["inputMc"];
$output_grade_id = $_POST["outputCode"];
$output_qty = $_POST["outputQty"];
$mc_out = $_POST["outputMc"];
$notes = $_POST["notes"];

//Capturing summary
$hullingSummary = $conn->prepare("INSERT INTO hulling (hulling_no, hulling_date, customer_id, input_grade_id, 
                                input_qty, mc_in, output_grade_id, output_qty, mc_out, notes, prepared_by)
                                VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$hullingSummary->bind_param("isssddsddss", $hulling_no, $hulling_date, $customer_id, $input_grade_id, $input_qty,
                            $mc_in, $output_grade_id, $output_qty, $mc_out, $notes, $prepared_by);
$hullingSummary->execute();
$conn->rollback();

//Capturing hulling details
$inventory_reference = "Hulling";
$item_no = 1;
$inputSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                            grade_id, qty_out, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
$inputSql->bind_param("sisisds", $inventory_reference, $hulling_no, $customer_id, $item_no, $input_grade_id, 
                        $input_qty, $hulling_date);
$inputSql->execute();
$conn->rollback();

$outputSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                            grade_id, qty_in) VALUES (?, ?, ?, ?, ?, ?)");

$outpuIdtList = array("outputCode", "husksCode", "otherLossCode");
$outputQtyList = array("outputQty", "husksQty", "otherLossQty");
for ($x=0; $x<count($outpuIdtList); $x++){
    $item_no += 1;
    $grade_id = $_POST[$outpuIdtList[$x]];
    $qty_in = $_POST[$outputQtyList[$x]];
    $outputSql->bind_param("sisisd", $inventory_reference, $hulling_no, $customer_id, $item_no, $grade_id, $qty_in);
    $outputSql->execute();
    $conn->rollback();

}
// $outputSql->bind_param("sisisd", $inventory_reference, $hulling_no, $customer_id, $item_no, $input_grade_id, $input_qty);
// $outputSql->execute();







header("location: ../processing/hulling")
?>