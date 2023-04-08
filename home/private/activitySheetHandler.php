<?php session_start(); ?>
<?php $preparedBy = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php
//create item ids
$itmCodeList = [];
$itmNameList = [];
$itmSelectList = [];
$itmQtyList = [];
$itmRateList = [];
$itmAmountList = [];

for ($x=1; $x<=10; $x++){ 
    array_push($itmCodeList, "itm".$x."Code");
    array_push($itmNameList, "itm".$x."Name");
    array_push($itmQtyList, "itm".$x."Qty");
    array_push($itmRateList, "itm".$x."Rate");
    array_push($itmAmountList, "itm".$x."Amount");
}

//create service ids
$svcCodeList = [];
$svcNameList = [];
$svcSelectList = [];
$svcQtyList = [];
$svcRateList = [];
$svcAmountList = [];

for ($x=1; $x<=10; $x++){ 
    array_push($svcCodeList, "svc".$x."Code");
    array_push($svcNameList, "svc".$x."Name");
    array_push($svcSelectList, "svc".$x."Select");
    array_push($svcQtyList, "svc".$x."Qty");
    array_push($svcRateList, "svc".$x."Rate");
    array_push($svcAmountList, "svc".$x."Amount");
}

//capturing summary
$actNo = documentNumber("roastery_activity_summary", "activity_sheet_no");
$actDate = $_POST["rostingDate"];
$customer = sanitize_table($_POST["customerId"]);
$inputGrade = sanitize_table(substr($_POST["inputGrade"],0,6));
$inputQty = sanitize_table($_POST["inputQty"]);
$profile = sanitize_table($_POST["roastProfile"]);
$specRequest = sanitize_table($_POST["specialRequest"]);

$summarySql = $conn->prepare("INSERT INTO roastery_activity_summary (activity_sheet_no, activity_date, customer_id, 
                            grade_id, qty, roast_profile, special_request, prepared_by, prep_date) VALUES (?,?,?,?,?,?,?,?, NOW())");
$summarySql->bind_param("isssdsss", $actNo, $actDate, $customer, $inputGrade, $inputQty, $profile, $specRequest,
                        $preparedBy);
$summarySql->execute();
$conn->rollback();

$actvitiesSql = $conn->prepare("INSERT INTO roastery_activity_details (item_no, activity_sheet_no, grade_id, qty, 
                            rate) VALUES (?,?,?,?,?)");
$svcNo = 1;
for ($i=0; $i<count($svcCodeList); $i++){
    
    $grade_id = $_POST[$svcCodeList[$i]];
    $qty = $_POST[$svcQtyList[$i]];
    $rate = $_POST[$svcRateList[$i]];
    if ($qty > 0){
        $actvitiesSql->bind_param("iisdd", $svcNo, $actNo, $grade_id, $qty, $rate);
        $actvitiesSql->execute();
        $conn->rollback();
        $svcNo += 1;
    }
}

//Capturing stock balances
$itmSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                        grade_id, qty_in, block_id, section, trans_date) VALUES (?,?,?,?,?,?,?,?,?)");
$ref = "Roasting";
$itmNo = 1;
for ($i=0; $i<count($itmCodeList); $i++){
    $grade_id = sanitize_table($_POST[$itmCodeList[$i]]);
    $qty_in = sanitize_table($_POST[$itmQtyList[$i]]);
    $block_id = "";
    $section = "";
    if ($qty_in != 0){
        $itmSql->bind_param("sisisdsss", $ref, $actNo, $customer, $itmNo, $grade_id, $qty_in, $block_id, $section, $actDate);
        $itmSql->execute();
        $conn->rollback();
        $itmNo += 1;
    }
}

//adjusting stock out
$itmOutSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, item_no, 
                        grade_id, qty_out, block_id, section, trans_date) VALUES (?,?,?,?,?,?,?,?,?)");
// $itmOutNo = 1;
$block_id = "";
$section = "";
$itmOutSql->bind_param("sisisdsss", $ref, $actNo, $customer, $itmNo, $inputGrade, $inputQty, $block_id, 
                        $section, $actDate);
$itmOutSql->execute();
$conn->rollback();








header("location:../roastery/activtySheet");
exit();
?>