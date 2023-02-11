<?php session_start(); ?>
<?php $prepBy = $_SESSION["fullName"]; ?>
<?php 
include ("connlogin.php");
include ("functions.php");
?>
<?php
//creating items
$grdList = array();
$qtyList = array();
for ($x=1; $x<=5; $x++){
    array_push($grdList, "item".$x."Id");
    array_push($qtyList, "item".$x."Qty");
}
$totalAdd = 0;
$totalLess = 0;
$affNo = 0;
for ($x=0;$x<count($qtyList);$x++){
    $qty = $_POST[$qtyList[$x]];
    if ($qty != ""){
        if ($qty<0){
            $totalLess += $qty;
        }else{
            $totalAdd += $qty;
        }
        $affNo += 1;
    }
}

$adjNo = documentNumber("adjustment", "adj_no");
$adjDate = $_POST["adjDate"];
$custId = $_POST["customerId"];
$comment = $_POST["comment"];
$ref = "Stock Adjsutment";
$itmNo = 1;

$summSql = $conn->prepare("INSERT INTO adjustment (adj_no, adj_date, customer_id, items_no, qty_add, qty_less, 
                            prep_by, comment) VALUES (?,?,?,?,?,?,?,?)");
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
    $grd = $_POST[$grdList[$x]];
    $qty = $_POST[$qtyList[$x]];
    if ($qty != ""){
        if ($qty<0){
            $lessSql->bind_param("sissisd", $ref, $adjNo, $adjDate, $custId, $itmNo, $grd, $qty);
            $lessSql->execute();
            $itmNo += 1;
        }elseif($qty>0){
            $addSql->bind_param("sissisd", $ref, $adjNo, $adjDate, $custId, $itmNo, $grd, $qty);
            $addSql->execute();
            $itmNo += 1;
        }
        
    }
}









header("location:../inventory/adjustment");
?>