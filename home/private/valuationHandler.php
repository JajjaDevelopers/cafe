<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php");

$allGradeName = array();
$allGradeQty = array();
$allGradePriceUgx = array();

for ($p=1; $p<=10; $p++){
    array_push($allGradeName, "highGrade".$p."Code");
    array_push($allGradeQty, "highGrade".$p."Qty");
    array_push($allGradePriceUgx, "highGrade".$p."PriceUgx");
}

$nextNoSql = "SELECT max(valuation_no) AS numbers FROM valuation_report_summary";
$nextNoQuery = $conn->query($nextNoSql);
$nextNoResult = mysqli_fetch_array($nextNoQuery);
$number = $nextNoResult['numbers'];

function sanitize_table($tabledata)
{
    $tabledata=stripslashes($tabledata);
    $tabledata=strip_tags($tabledata);
    $tabledata=htmlentities($tabledata);
    return $tabledata;
}

$summarySql = $conn->prepare("INSERT INTO valuation_report_summary (valuation_no, valuation_date, batch_report_no, customer_id, 
                            input_qty, exchange_rate, costs, prepared_by, prep_date) VALUES (?,?,?,?,?,?,?,?,?)");
$valuationNo = intval($number) +1;
$valuationDate = $_POST['valuationDate'];
$batchReportNo = $_POST['batchNo'];
$customerId = $_POST['customerId'];
$exchangeRate = $_POST['exchangeRate'];
$costs = $_POST['subTotalCostsUgx'];
$preparedBy = $username;
$time = new DateTime();
$prepDate = $time->format('Y-m-d H:i:s');
$inputQty = $_POST['FAQQty'];
$valQty = $_POST["totalQty"];
$valAmt = $_POST["grandTotaltUgx"];
$allocation = $_POST["contractAllocation"];

if ($customerId!="" && $inputQty>0 && $valQty>0 && $valAmt>0){
    $summarySql->bind_param("ssssdddss", $valuationNo, $valuationDate, $batchReportNo, $customerId, $inputQty, $exchangeRate, $costs, 
    $preparedBy, $prepDate);
    $summarySql->execute();
    $summarySql->close();

    //valuation table update
    // $valDetSql = $conn->prepare("INSERT INTO valuations (valuation_no, item_no, grade_id, qty, price_ugx) VALUES (?,?,?,?,?)");

    // Posting valuations items into invetory
    $quantityInSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, 
                trans_date, customer_id, item_no, grade_id, qty_in, price_ugx, contract_allocation) VALUES (?,?,?,?,?,?,?,?,?)");
    $quantityOutSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, 
                trans_date, customer_id, item_no, grade_id, qty_out, price_ugx, contract_allocation) VALUES (?,?,?,?,?,?,?,?,?)");

    $docType = "Valuation Report";
    $itmNo = 1;
    $valItmNo = 1;
    $self = "SELF01";
    for ($x=0; $x < count($allGradeQty); $x++ ) {
        $gradeQty = sanitize_table($_POST[$allGradeQty[$x]]);
        if ($gradeQty > 0){
            $gradePrice = sanitize_table($_POST[$allGradePriceUgx[$x]]);
            $gradeName = $_POST[$allGradeName[$x]];
            //valuation details
            // $valDetSql->bind_param("iisddd", $valuationNo, $valItmNo, $gradeName, $gradeQty, $gradePrice);
            // $valDetSql->execute();
            // $valItmNo += 1;
            //qty in
            $quantityInSql->bind_param("sissisdds", $docType, $valuationNo, $valuationDate, $self, $itmNo, 
                                        $gradeName, $gradeQty, $gradePrice, $allocation);
            $quantityInSql->execute();
            //qty out
            $itmNo += 1;
            $quantityOutSql->bind_param("sissisdds", $docType, $valuationNo, $valuationDate, $customerId, $itmNo, 
                                        $gradeName, $gradeQty, $gradePrice, $allocation);
            $quantityOutSql->execute();
            $itmNo += 1;
        }
    }
    $quantityInSql->close();
    $quantityOutSql->close();

    if(isset($_POST["btnsubmit"]))
    {
    header("location:../marketing/valuation?formmsg=success");
    }
}else{
    if(isset($_POST["btnsubmit"]))
    {
    header("location:../marketing/valuation?formmsg=fail");
    }
}



?>