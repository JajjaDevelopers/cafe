<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"];
include ("connlogin.php");
include "functions.php";

$hulling_no = documentNumber("hulling", "hulling_no");
$orderNo = intval($_POST['orderNo']);
$hulling_date = $_POST["hullingDate"];
$customer_id = $_POST["customerId"];
$input_grade_id = $_POST["inputGrd"];
$input_qty = $_POST["inputQty"];
$mc_in = $_POST["inputMc"];
$output_grade_id = $_POST["outputGrd"];
$output_qty = $_POST["outputQty"];
$mc_out = $_POST["outputMc"];
$notes = $_POST["comment"];

if ($hulling_date != " " && $customer_id != " " && $input_grade_id !=" " && $output_qty>0 && $input_qty>0){
    //Capturing summary
    $hullingSummary = $conn->prepare("INSERT INTO hulling (hulling_no, batch_order_no, hulling_date, customer_id, input_grade_id, 
    input_qty, mc_in, output_grade_id, output_qty, mc_out, notes, prepared_by, prep_date)
    VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $hullingSummary->bind_param("iisssddsddss", $hulling_no, $orderNo, $hulling_date, $customer_id, $input_grade_id, $input_qty,
    $mc_in, $output_grade_id, $output_qty, $mc_out, $notes, $prepared_by);
    $hullingSummary->execute();

    //Capturing hulling details
    $inventory_reference = "Hulling";
    $item_no = 1;
    $inputSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
    grade_id, qty_out, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $inputSql->bind_param("sisisds", $inventory_reference, $hulling_no, $customer_id, $item_no, $input_grade_id, 
    $input_qty, $hulling_date);
    $inputSql->execute();
    // $conn->rollback();

    $outputSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
    grade_id, qty_in, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $outpuIdtList = array("outputGrd", "husksGrd", "otherLossGrd");
    $outputQtyList = array("outputQty", "husksQty", "otherLossQty");
    for ($x=0; $x<count($outpuIdtList); $x++){
        $item_no += 1;
        $grade_id = $_POST[$outpuIdtList[$x]];
        $qty_in = $_POST[$outputQtyList[$x]];
        $outputSql->bind_param("sisisds", $inventory_reference, $hulling_no, $customer_id, $item_no, $grade_id, $qty_in, $hulling_date);
        $outputSql->execute();

    }

    //update order
    $orderSql=$conn->prepare("UPDATE batch_processing_order SET status='Completed Hulling' WHERE batch_order_no=?");
    $orderSql->bind_param("i", $orderNo);
    $orderSql->execute();

    if(isset($_POST["btnsubmit"]))
    {
        header("location:../processing/selectBatchOrder?act=Hulling&formmsg=success");
    }
} else{
    if(isset($_POST["btnsubmit"]))
        {
            header("location:../processing/selectBatchOrder?act=Hulling&formmsg=fail");
        }

}

?>