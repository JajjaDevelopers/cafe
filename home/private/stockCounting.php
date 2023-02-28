<?php session_start(); ?>
<?php $prepared_by = $_SESSION["fullName"]; ?>
<?php
include "../private/functions.php";
include ("../private/connlogin.php");
if($conn->connect_error) {
  exit('Could not connect');
}
?>
<?php
$rows = $_POST['grdNo'];
$itmIdList = array();
$availList = array();
$varList = array();
$deficit = 0;
$excess = 0;
for ($x=1;$x<=$rows;$x++){
    $itmId = $_POST['itm'.$x.'Id'];
    $itmAvail = intval($_POST['itm'.$x.'Available']);
    $itmCount = intval($_POST['itm'.$x.'Count']);
    $itmVar = $itmCount - $itmAvail;
    if ($itmVar != 0){
        array_push($itmIdList, $itmId);
        array_push($availList, $itmAvail);
        array_push($varList, $itmVar);
        if ($itmVar<0){
            $deficit -= $itmVar;
        }elseif($itmVar>0){
            $excess += $itmVar;
        }
    }
}

$countNo = documentNumber("stock_counting", "count_no");
$countDate = $_POST['stkCountDate'];
$cltId = $_POST['customerId'];
$comment = $_POST['comment'];
$ref = "Stock Counting";
$itmNo = 1;

//stock summary
$summSql = $conn->prepare("INSERT INTO stock_counting (count_no, count_date, customer_id, deficit, 
                            excess, comment, prepared_by, prep_time) VALUES (?,?,?,?,?,?,?,Now())");
$summSql->bind_param("issddss", $countNo, $countDate, $cltId, $deficit, $excess, $comment, $prepared_by);
$summSql->execute();
$summSql->close();

//stock changes Stock Counting
$balanceSql = $conn->prepare("INSERT INTO temp_inventory (inventory_reference, document_number, trans_date, customer_id, item_no, 
                            grade_id, qty) VALUES(?, ?, ?, ?, ?, ?, ?)");
$countAddSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, 
                            item_no, grade_id, qty_in, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
$countLessSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, customer_id, 
                            item_no, grade_id, qty_out, trans_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
for ($x=0;$x<count($varList);$x++){
    $var = $varList[$x];
    $balanceSql->bind_param("sissisd", $ref, $countNo, $countDate, $cltId, $itmNo, $itmIdList[$x], $availList[$x]);
    $balanceSql->execute();
    if ($var<0){
        $var = $var * -1;
        $countLessSql->bind_param("sisisds", $ref, $countNo, $cltId, $itmNo, $itmIdList[$x], $var, $countDate);
        $countLessSql->execute();
    }else{
        $countAddSql->bind_param("sisisds", $ref, $countNo, $cltId, $itmNo, $itmIdList[$x], $varList[$x], $countDate);
        $countAddSql->execute();
    }
    $itmNo += 1;
}





header("location: ../inventory/stkCountCustomer");
?>