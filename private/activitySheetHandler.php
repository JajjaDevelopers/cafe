<?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "factory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize_table($tabledata)
{
    $tabledata=stripslashes($tabledata);
    $tabledata=strip_tags($tabledata);
    $tabledata=htmlentities($tabledata);
    return $tabledata;
}


function activitySummary(){
    global $conn, $username;
    
    $summarySql = $conn->prepare("INSERT INTO roastery_activity_summary (activity_sheet_no, customer_id, activity_date, roast_profile,
                                special_request, prepared_by) VALUES (?, ?, ?, ?, ?, ?)");
    

    $activityNo = $_POST['activityNumber'];
    $customerId = $_POST['activityCustomer'];
    $activityDate = $_POST['activityDate'];
    $roastProfile = $_POST['roastProfile'];
    $specialRequest = $_POST['specialRequest'];
    $preparedBy = $username;
    $summarySql->bind_param("ssssss", $activityNo, $customerId, $activityDate, $roastProfile, $specialRequest, $preparedBy);
    $summarySql->execute();
    $conn->rollback();

    $serviceCodes = array('roastingCode', 'grindingCode', 'sortingCode', 'packaging250Code', 'packaging500Code', 'packaging1KgCode', 'packagingOtherCode');
    $serviceQtys = array('roastingQty', 'grindingQty', 'sortingQty', 'packaging250Qty', 'packaging500Qty', 'packaging1KgQty', 'packagingOtherQty');
    $serviceNames = array('roastingName', 'grindingName', 'sortingName', 'packaging250Name', 'packaging500Name', 'packaging1KgName', 'packagingOtherName');
    $serviceRates = array('roastingRate', 'grindingRate', 'sortingRate', 'packaging250Rate', 'packaging500Rate', 'packaging1KgRate', 'packagingOtherRate');

    $detailsSql = $conn->prepare("INSERT INTO roastery_activity_details (activity_sheet_no, service_id, service_name, service_qty,
                                service_price) VALUES (?, ?, ?, ?, ?)");
    $activityNo = $_POST['activityNumber'];
    for ($i=0; $i < count($serviceQtys); $i++){
        $serviceCode = $_POST[$serviceCodes[$i]];
        $serviceName = $_POST[$serviceNames[$i]];
        $serviceQty = $_POST[$serviceQtys[$i]];
        $serviceRate = $_POST[$serviceRates[$i]];
        if ($serviceQty > 0){
            $detailsSql->bind_param("sssdd", $activityNo, $serviceCode, $serviceName, $serviceQty, $serviceRate);
            $detailsSql->execute();
        }
        
        $conn->rollback();
    }
      
}
activitySummary();



header("location:activtySheet.php");
exit();
?>