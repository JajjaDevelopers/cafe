<?php
include "../private/database.php";
$currentMonthQtyInSql = $conn->prepare("SELECT sum(grn_qty) AS grnQty FROM grn WHERE (MONTH(grn_date)=MONTH(now()) 
                                        AND YEAR(grn_date)=YEAR(now()))");
$currentMonthQtyInSql->execute();
$currentMonthQtyInSql->bind_result($currentMonthQtyIn);
$currentMonthQtyInSql->fetch();
$currentMonthQtyInSql->close();
if ($currentMonthQtyIn == ""){
    $currentMonthQtyIn = 0;
}

$currentMonthNameSql = $conn->prepare("SELECT monthname(now()), year(now())");
$currentMonthNameSql->execute();
$currentMonthNameSql->bind_result($currentMonthName, $currentYearValue);
$currentMonthNameSql->fetch();
$currentMonthNameSql->close();
?>

<?php
// Getting previous month qty in
// Need to check January results! May return December of current year of of the last year

$year = $currentYearValue;
if ($currentMonthName == 'January'){
    $year = $currentYearValue - 1;
}
$previousMonthQtyInSql = $conn->prepare("SELECT sum(grn_qty) AS grnQty FROM grn WHERE (MONTH(grn_date)=MONTH(now())-1 
                                        AND YEAR(grn_date)=?)");
$previousMonthQtyInSql->bind_param("i",$year);
$previousMonthQtyInSql->execute();
$previousMonthQtyInSql->bind_result($previousMonthQtyIn);
$previousMonthQtyInSql->fetch();
$previousMonthQtyInSql->close();

if ($previousMonthQtyIn == ""){
    $previousMonthQtyIn = 0;
}

$newCurrentDate = new DateTime();
$prevMonthDate = $newCurrentDate->sub(new DateInterval('P1M'));
$prevMonthDateString = $prevMonthDate->format('Y-m-d');
$previousMonthNameSql = $conn->prepare("SELECT monthname(?)");
$previousMonthNameSql->bind_param("s", $prevMonthDateString);
$previousMonthNameSql->execute();
$previousMonthNameSql->bind_result($previousMonthName);
$previousMonthNameSql->fetch();
$previousMonthNameSql->close();

if ($currentMonthName == 'January'){
    $previousMonthName = 'December';
}
?>

<?php
// Getting current month qty out
$currentMonthQtyOutSql = $conn->prepare("SELECT sum(total_qty) AS dispQty FROM release_request WHERE (MONTH(dispatch_time)=MONTH(now()) 
                                        AND YEAR(dispatch_time)=YEAR(now()) AND status=2)");
$currentMonthQtyOutSql->execute();
$currentMonthQtyOutSql->bind_result($currentMonthQtyOut);
$currentMonthQtyOutSql->fetch();
$currentMonthQtyOutSql->close();

?>

<?php
// Getting previous month qty out
$previousMonthQtyOutSql = $conn->prepare("SELECT sum(total_qty) AS dispQty FROM release_request WHERE (MONTH(dispatch_time)=MONTH(now())-1 
                                        AND YEAR(dispatch_time)=? AND status=2)");
$previousMonthQtyOutSql->bind_param("i",$year);
$previousMonthQtyOutSql->execute();
$previousMonthQtyOutSql->bind_result($previousMonthQtyOut);
$previousMonthQtyOutSql->fetch();
$previousMonthQtyOutSql->close();
if ($previousMonthQtyOut == ""){
    $previousMonthQtyOut = 0;
}

?>
<?php
$currentMonthLabel = substr($currentMonthName, 0, 3) .' '.$currentYearValue;
$previousMonthLabel = substr($previousMonthName, 0, 3).' '.$year;
$qtyReceivedVariance = $currentMonthQtyIn - $previousMonthQtyIn;
$qtyOutVariance = $currentMonthQtyOut - $previousMonthQtyOut;

$monthNames = array($currentMonthLabel, $previousMonthLabel);
$qtyInValues = array($currentMonthQtyIn, $previousMonthQtyIn);
$qtyOutValues = array($currentMonthQtyOut, $previousMonthQtyOut);
$qtyVaraiance = array($qtyReceivedVariance, $qtyOutVariance);

$monthData = json_encode(array($monthNames, $qtyInValues, $qtyOutValues, $qtyVaraiance));
// var_dump($monthData);
echo $monthData;
?>

