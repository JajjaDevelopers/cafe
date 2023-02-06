<?php
include "../private/database.php";
// Getting current Quarter qty in
$qtCurrentDate = new DateTime();
$quarterValuesList = array(1, 2, 3, 4);
$quarterNamesList = array('Quarter-2', 'Quarter-3', 'Quarter-4', 'Quarter-1');

$currentQuarterQtyInSql = $conn->prepare("SELECT sum(grn_qty) AS grnQty FROM grn WHERE (QUARTER(grn_date)=QUARTER(now()) 
                                        AND YEAR(grn_date)=YEAR(now()))");
$currentQuarterQtyInSql->execute();
$currentQuarterQtyInSql->bind_result($currentQuarterQtyIn);
$currentQuarterQtyInSql->fetch();
$currentQuarterQtyInSql->close();
if ($currentQuarterQtyIn == ""){
    $currentQuarterQtyIn = 0;
}

$getQtrSql = $conn->prepare("SELECT quarter(now()), year(now())");
$getQtrSql->execute();
$getQtrSql->bind_result($currentQtrValue, $currentYearValue);
$getQtrSql->fetch();
$getQtrSql->close();
$currentQtr = array_search($currentQtrValue, $quarterValuesList);
$quarterString = $quarterNamesList[$currentQtr];


?>

<?php
//Getting previous Quarter qty in
$qtrYear = $currentYearValue;
if ($currentQtrValue == 2){
    $qtrYear = $currentYearValue - 1;
}
$previousQuarterQtyInSql = $conn->prepare("SELECT sum(grn_qty) AS grnQty FROM grn WHERE (QUARTER(grn_date)=QUARTER(now())-1 
                                        AND YEAR(grn_date)=?)");
$previousQuarterQtyInSql->bind_param("i", $qtrYear);
$previousQuarterQtyInSql->execute();
$previousQuarterQtyInSql->bind_result($previousQuarterQtyIn);
$previousQuarterQtyInSql->fetch();
$previousQuarterQtyInSql->close();
if ($previousQuarterQtyIn == ""){
    $previousQuarterQtyIn = 0;
}

$previousQtrValue = $currentQtrValue - 1;
$previousQtr = array_search($previousQtrValue, $quarterValuesList);
$previousQtrString = $quarterNamesList[$previousQtr];
?>

<?php
//Getting current quarter qty out
$currentQuarterQtyOutSql = $conn->prepare("SELECT sum(total_qty) AS dispQty FROM release_request WHERE (QUARTER(dispatch_time)=QUARTER(now()) 
                                        AND YEAR(dispatch_time)=YEAR(now()) AND status=2)");
$currentQuarterQtyOutSql->execute();
$currentQuarterQtyOutSql->bind_result($currentQuarterQtyOut);
$currentQuarterQtyOutSql->fetch();
$currentQuarterQtyOutSql->close();
if ($currentQuarterQtyOut == ""){
    $currentQuarterQtyOut = 0;
}

?>

<?php
//Getting previous quarter qty out
$previousQuarterQtyOutSql = $conn->prepare("SELECT sum(total_qty) AS dispQty FROM release_request WHERE (QUARTER(dispatch_time)=QUARTER(now())-1 
                                        AND YEAR(dispatch_time)=? AND status=2)");
$previousQuarterQtyOutSql->bind_param("i", $year);
$previousQuarterQtyOutSql->execute();
$previousQuarterQtyOutSql->bind_result($previousQuarterQtyOut);
$previousQuarterQtyOutSql->fetch();
$previousQuarterQtyOutSql->close();
if ($previousQuarterQtyOut == ""){
$previousQuarterQtyOut = 0;
}


?>

<?php
$currentQuarterLabel = $quarterString;
$previousQuarterLabel = $previousQtrString;
$quarterQtyReceivedVariance = $currentQuarterQtyIn - $previousQuarterQtyIn;
$quarterQtyOutVariance = $currentQuarterQtyOut - $previousQuarterQtyOut;

$quarterNames = array($quarterString, $previousQuarterLabel);
$quarterlyQtyInValues = array($currentQuarterQtyIn, $previousQuarterQtyIn);
$quarterlyQtyOutValues = array($currentQuarterQtyOut, $previousQuarterQtyOut);
$quarterQtyVaraiance = array($quarterQtyReceivedVariance, $quarterQtyOutVariance);

$quarterData = json_encode(array($quarterNames, $quarterlyQtyInValues, $quarterlyQtyOutValues, $quarterQtyVaraiance));
// var_dump($quarterData);
echo $quarterData;
?>