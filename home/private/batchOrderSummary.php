<?php
include "../private/connlogin.php";
$orderNo=$_GET['transNo'];
$sql = $conn->prepare("SELECT customer_id, customer_name, contact_person, telephone, activity, grade_id, batch_order_input_qty, 
            batch_order_mc, grade_name, coffee_type FROM batch_processing_order JOIN customer USING (customer_id) JOIN grades USING (grade_id)
            WHERE batch_order_no=?");
$sql->bind_param("i", $orderNo);
$sql->execute();
$sql->bind_result($cltId, $cltName, $cltContact, $cltTel, $activity, $grdId, $inQty, $inMc, $grdName, $coffeeType);
$sql->fetch();
$sql->close();

$batchOrderNumber = $orderNo;
$batchRepNo = formatDocNo(Intval($batchNo), "BRN-") ;
$categorySql = $conn->prepare("SELECT type_category FROM grades WHERE grade_id=?");
$categorySql->bind_param("s", $grdId);
$categorySql->execute();
$categorySql->bind_result($typeCategory);
$categorySql->fetch();
$categorySql->close();




?>