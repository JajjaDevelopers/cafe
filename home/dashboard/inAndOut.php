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

$dailyReceivedList = array();
$dailyDispatchedList = array();

$receivedQuery = $conn->prepare("SELECT sum(grn_qty) AS qty FROM grn WHERE grn_date=?");
function getDailyQty(){ 
    include("../private/database.php");
    global $daysList, $dailyReceivedList, $receivedQuery;
    
    for ($i=0; $i<count($daysList); $i++){
        $date = $daysList[$i];
        $receivedQuery->bind_param("s", $date);
        $receivedQuery->execute();
        $receivedQuery->bind_result($dailyQty);
        $receivedQuery->fetch();
        if ($dailyQty == ""){
            $dailyQty = 0;
        }
        array_push($dailyReceivedList, $dailyQty);
    }
    $receivedQuery->close();
}
getDailyQty();


$dispatchedQuery = $conn->prepare("SELECT sum(total_qty) AS qty1 FROM release_request WHERE dispatch_time=? AND status=2");
function getDailyOut(){
    include("../private/database.php");
    global $daysList, $dailyDispatchedList, $dispatchedQuery;
    
    for ($i=0; $i<count($daysList); $i++){
        $date1 = $daysList[$i]; //'2022-11-09'; //$daysList[$i];
        $dispatchedQuery->bind_param("s", $date1);
        $dispatchedQuery->execute();
        $dispatchedQuery->bind_result($dailyQty);
        $dispatchedQuery->fetch();
        if ($dailyQty == ""){
            $dailyQty = 0;
        }
        array_push($dailyDispatchedList, $dailyQty);
    }
    $dispatchedQuery->close();
}
getDailyOut();

// $dates = json_encode($daysList);
// $dailyReceived = json_encode($dailyReceivedList);
// $dailyDispatched = json_encode($dailyDispatchedList);
$data=json_encode(array($daysList,$dailyReceivedList,$dailyDispatchedList));
echo $data;
?>


