<?php 
session_start();
$username = $_SESSION["userName"];
?>
<?php include("../private/database.php");?>

<?php
$daysList = array();
$currentDate = new DateTime();
$currentDateString = $currentDate->format('Y-m-d');
array_push($daysList, $currentDateString);

for ($x=1; $x<=30; $x++){
    $prevDay = $currentDate->sub(new DateInterval('P1D'));
    $prevDateString = $prevDay->format('Y-m-d');
    array_push($daysList, $prevDateString);
    $currentDate = $prevDay;
}

$dailyGradedList = array();
$dailyHulledList = array();
$dailyDriedList = array();
$dailycolorSorted = array();

//Getting daily graded
$gradedSql = $conn->prepare("SELECT sum(net_input) AS qty FROM batch_reports_summary WHERE batch_report_date=?");

for ($i=0; $i<count($daysList); $i++){
    $date = $daysList[$i];
    $gradedSql->bind_param("s", $date);
    $gradedSql->execute();
    $gradedSql->bind_result($dailyQty);
    $gradedSql->fetch();
    if ($dailyQty == ""){
        $dailyQty = 0;
    }
    array_push($dailyGradedList, $dailyQty);
}
$gradedSql->close();

//Getting daily colorsorted
$colorSortedSql = $conn->prepare("SELECT sum(color_sorted) AS qty FROM batch_reports_summary WHERE batch_report_date=?");

for ($i=0; $i<count($daysList); $i++){
    $date = $daysList[$i];
    $colorSortedSql->bind_param("s", $date);
    $colorSortedSql->execute();
    $colorSortedSql->bind_result($dailyQty);
    $colorSortedSql->fetch();
    if ($dailyQty == ""){
        $dailyQty = 0;
    }
    array_push($dailycolorSorted, $dailyQty);
}
$colorSortedSql->close();

//Getting daily hulled
$hulledSql = $conn->prepare("SELECT sum(output_qty) AS qty FROM hulling WHERE hulling_date=?");

for ($i=0; $i<count($daysList); $i++){
    $date = $daysList[$i];
    $hulledSql->bind_param("s", $date);
    $hulledSql->execute();
    $hulledSql->bind_result($dailyQty);
    $hulledSql->fetch();
    if ($dailyQty == ""){
        $dailyQty = 0;
    }
    array_push($dailyHulledList, $dailyQty);
}
$hulledSql->close();

//Getting daily hulled
$driedSql = $conn->prepare("SELECT sum(input_qty) AS qty FROM drying WHERE drying_date=?");

for ($i=0; $i<count($daysList); $i++){
    $date = $daysList[$i];
    $driedSql->bind_param("s", $date);
    $driedSql->execute();
    $driedSql->bind_result($dailyQty);
    $driedSql->fetch();
    if ($dailyQty == ""){
        $dailyQty = 0;
    }
    array_push($dailyDriedList, $dailyQty);
}
$driedSql->close();


$data = json_encode(array($daysList, $dailyGradedList, $dailycolorSorted, $dailyHulledList, $dailyDriedList));
// echo 'daily data: days, grading, colorsorting, hulling, drying = '.$data;
echo $data;
// var_dump($data);

?>