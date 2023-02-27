<?php
include "../private/connlogin.php";
include "../private/functions.php";
$bulkNo = intval($_SESSION['bulkNo']);
$bulkingNo = "BLK-" . $_SESSION['bulkNo'];

$summSql = $conn->prepare("SELECT bulk_date, customer_name, grade_name, qty, comment, prepared_by, prep_time, verified_by, 
                        ver_time, approved_by, appr_time, customer_id, contact_person, telephone 
                        FROM bulking JOIN grades USING (grade_id) JOIN customer USING (customer_id)
                        WHERE bulk_no=?");
$summSql->bind_param("i", $bulkNo);
$summSql->execute();
$summSql->bind_result($bulkDate, $cltName, $bulkOutGrd, $ttQty, $comment, $prepared_by, $prep_time, $verified_by, $ver_time,
                        $approved_by, $appr_time, $cltId, $cltContact, $cltTel);
$summSql->fetch();
$summSql->close();

//input details
$detSql = $conn->prepare("SELECT grade_name, qty_out FROM inventory JOIN grades USING(grade_id)
                        WHERE inventory_reference='Bulking' AND document_number=? AND qty_out>0");
$detSql->bind_param("i", $bulkNo);
$detSql->execute();
$detSql->bind_result($grdName, $grdQty);



?>