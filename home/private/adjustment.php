<?php session_start(); ?>
<?php $prepBy = $_SESSION["fullName"]; ?>
<?php 
include ("connlogin.php");
include ("functions.php");
?>
<?php
//creating items
$totalAdd = 0;
$totalLess = 0;
$affNo = 0;
$grdList = array();
$qtyList = array();
for ($x=1; $x<=5; $x++){
    $grdId = $_POST["item".$x."Id"];
    $grdQty = intval($_POST["item".$x."Qty"]);
    if ($grdQty !=0 ){
        if ($grdQty<0){
            $totalLess -= $grdQty;
        }else{
            $totalAdd += $grdQty;
        }
        $affNo += 1;
        array_push($grdList, $grdId);
        array_push($qtyList, $grdQty);
    }
    
}

$adjNo = documentNumber("adjustment", "adj_no");
$adjDate = $_POST["adjDate"];
$custId = $_POST["customerId"];
$comment = $_POST["comment"];
$ref = "Stock Adjsutment";
$itmNo = 1;

$summSql = $conn->prepare("INSERT INTO adjustment (adj_no, adj_date, customer_id, items_no, qty_add, qty_less, 
                            prepared_by, prep_time, comment) VALUES (?,?,?,?,?,?,?,Now(),?)");
$summSql->bind_param("issiddss", $adjNo, $adjDate, $custId, $affNo, $totalAdd, $totalLess, $prepBy, $comment);
$summSql->execute();
$summSql->close();

//Addition
$addSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, trans_date, 
                            customer_id, item_no, grade_id, qty_in) VALUES (?,?,?,?,?,?,?)");
//Reduction                           
$lessSql = $conn->prepare("INSERT INTO inventory (inventory_reference, document_number, trans_date, 
                        customer_id, item_no, grade_id, qty_out) VALUES (?,?,?,?,?,?,?)");

for ($x=0;$x<count($qtyList);$x++){
    $grd = $grdList[$x];
    $qty = $qtyList[$x];
    if ($qty<0){
        $qty *= -1;
        $lessSql->bind_param("sissisd", $ref, $adjNo, $adjDate, $custId, $itmNo, $grd, $qty);
        $lessSql->execute();
        $itmNo += 1;
    }elseif($qty>0){
        $addSql->bind_param("sissisd", $ref, $adjNo, $adjDate, $custId, $itmNo, $grd, $qty);
        $addSql->execute();
        $itmNo += 1;
    }
}


header("location:../inventory/adjustment");
?>