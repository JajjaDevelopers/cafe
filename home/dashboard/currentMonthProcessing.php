<?php 
session_start();
$username = $_SESSION["userName"];
?>
<?php include("../private/database.php");?>

<?php
$currentMonthNameSql = $conn->prepare("SELECT monthname(now()), year(now())");
$currentMonthNameSql->execute();
$currentMonthNameSql->bind_result($currentMonthName, $currentYearValue);
$currentMonthNameSql->fetch();
$currentMonthNameSql->close();
$month = $currentMonthName;
$year = $currentYearValue;

//Graded
$gradingSql = $conn->prepare("SELECT sum(net_input) AS qty FROM batch_reports_summary 
                            WHERE (MONTH(batch_report_date)=MONTH(now()) AND YEAR(batch_report_date)=YEAR(now()))");
$gradingSql->execute();
$gradingSql->bind_result($grdedQty);
$gradingSql->fetch();
$gradingSql->close();
if ($grdedQty == ""){
    $grdedQty = 0;
}                           

//Color Sorted
$colorSortingSql = $conn->prepare("SELECT sum(color_sorted) AS qty FROM batch_reports_summary 
                            WHERE (MONTH(batch_report_date)=MONTH(now()) AND YEAR(batch_report_date)=YEAR(now()))");
$colorSortingSql->execute();
$colorSortingSql->bind_result($colorSortedQty);
$colorSortingSql->fetch();
$colorSortingSql->close();
if ($colorSortedQty == ""){
    $colorSortedQty = 0;
}

//Hulling
$HullingSql = $conn->prepare("SELECT sum(output_qty) AS qty FROM hulling 
                            WHERE (MONTH(hulling_date)=MONTH(now()) AND YEAR(hulling_date)=YEAR(now()))");
$HullingSql->execute();
$HullingSql->bind_result($HullingQty);
$HullingSql->fetch();
$HullingSql->close();
if ($HullingQty == ""){
    $HullingQty = 0;
}

//Drying
$dryingSql = $conn->prepare("SELECT sum(input_qty) AS qty FROM drying 
                            WHERE (MONTH(drying_date)=MONTH(now()) AND YEAR(drying_date)=YEAR(now()))");
$dryingSql->execute();
$dryingSql->bind_result($dryingQty);
$dryingSql->fetch();
$dryingSql->close();
if ($dryingQty == ""){
    $dryingQty = 0;
}

$currentMonth = $month." ".$year;


$data = json_encode(array($currentMonth, $grdedQty, $colorSortedQty, $HullingQty, $dryingQty));
echo $data;

?>