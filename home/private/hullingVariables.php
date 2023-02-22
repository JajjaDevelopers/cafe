<?php
include "connlogin.php";
include "functions.php";
$hullNo = intval($_GET['hullNo']);
$hullingNo = formatDocNo($hullNo, "HUL-");

//summary
$sql = $conn->prepare("SELECT hulling_date, customer_id, customer_name, contact_person, telephone, mc_in, mc_out,
                        (SELECT grade_name FROM grades WHERE hulling.input_grade_id=grades.grade_id) AS input, input_qty,  
                        (SELECT grade_name FROM grades WHERE hulling.output_grade_id=grades.grade_id) AS output, output_qty,
                        notes, prepared_by, prep_date, verified_by, ver_date, approved_by, appr_date
                        FROM hulling JOIN customer USING (customer_id) WHERE hulling_no=?");
$sql->bind_param("i", $hullNo);
$sql->execute();
$sql->bind_result($hulDate, $cltId, $cltName, $cltContact, $cltTel, $mcIn, $mcOut, $grdIn, $qtyIn, $grdOut, $qtyOut, $comment, $prepared_by, 
                    $prep_time, $verified_by, $ver_time, $approved_by, $appr_time);
$sql->fetch();
$sql->close();

//output
$outSql = $conn->prepare("SELECT grade_name, qty_in FROM inventory JOIN grades USING (grade_id)
                        WHERE inventory_reference='Hulling' AND document_number=? AND qty_in<>0");
$outSql->bind_param("i", $hullNo);
$outSql->execute();
$outSql->bind_result($outGrdName, $outGrdQty);
$outSql->close();

?>