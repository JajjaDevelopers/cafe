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

$summarySql = $conn->prepare("INSERT INTO valuation_report_summary (valuation_no, valuation_date, batch_report_no, customer_id, exchange_rate, 
                            costs, prepared_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
$valuationNo = intval($number) +1;
$valuationDate = $_POST['valuationDate'];
$batchReportNo = $_POST['batchNo'];
$customerId = $_POST['customerId'];
$exchangeRate = $_POST['exchangeRate'];
$costs = $_POST['subTotalCostsUgx'];
$preparedBy = $username;
$summarySql->bind_param("ssssdds", $valuationNo, $valuationDate, $batchReportNo, $customerId, $exchangeRate, $costs, $preparedBy);
$summarySql->execute();
$conn->rollback();


// Posting valuations items into nucafe invetory
$quantityInSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, 
                                trans_date, customer_id, item_no, grade_id, qty_in) VALUES (?,?,?,?,?,?,?)");
$quantityOutSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, 
                                trans_date, customer_id, item_no, grade_id, qty_out) VALUES (?,?,?,?,?,?,?)");

$docType = "Valuation Report";
$itmNo = 1;
$self = "SELF01";
for ($x=0; $x < count($allGradeQty); $x++ ) {
    $gradeQty = sanitize_table($_POST[$allGradeQty[$x]]);
    if ($gradeQty > 0){
        
        $gradePrice = sanitize_table($_POST[$allGradePriceUgx[$x]]);
        $gradeName = $_POST[$allGradeName[$x]];
        $quantityInSql->bind_param("sissisd", $docType, $valuationNo, $valuationDate, $self, $itmNo, 
                                                $gradeName, $gradeQty);
        $quantityInSql->execute();
        $itmNo += 1;
        $quantityOutSql->bind_param("sissisd", $docType, $valuationNo, $valuationDate, $customerId, $itmNo, 
                                                $gradeName, $gradeQty);
        $quantityOutSql->execute();
        $itmNo += 1;
    }
    
}

if(isset($_POST["confirm"]))
{
    header("location:../marketing/valuation?formmsg=success");
}

?>