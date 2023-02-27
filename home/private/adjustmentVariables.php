<?php
include "connlogin.php";
include "functions.php";
$adjustNo = intval($_GET['adjustNo']);
$adjNo = formatDocNo($adjustNo, "ADJ-");
$summSql = $conn->prepare("SELECT adj_date, customer_id, qty_add, qty_less, comment, prepared_by, prep_time, 
                        verified_by, ver_time, approved_by, appr_time, customer_name, contact_person, telephone 
                        FROM adjustment JOIN customer USING (customer_id)
                        WHERE adj_no=?");
$summSql->bind_param("i", $adjustNo);
$summSql->execute();
$summSql->bind_result($fmDate, $cltId, $qtyAdd, $qtyLess, $comment, $prepared_by, $prep_time, $verified_by, $ver_time,
                        $approved_by, $appr_time, $cltName, $cltContact, $cltTel);
$summSql->fetch();
$summSql->close();
$ttQty = $qtyAdd-$qtyLess;

//input details
$detSql = $conn->prepare("SELECT grade_name, qty_in, qty_out FROM inventory JOIN grades USING(grade_id)
                        WHERE inventory_reference='Stock Adjsutment' AND document_number=?");
$detSql->bind_param("i", $adjustNo);
$detSql->execute();
$detSql->bind_result($grdName, $qtyIn, $qtyOut);

?>