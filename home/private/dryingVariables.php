<?php
include "connlogin.php";
include "functions.php";
$dryNo = intval($_GET['dryNo']);
$dryingNo = formatDocNo($dryNo, "DRY-");

$sql = $conn->prepare("SELECT drying_date, customer_id, customer_name, grade_id, grade_name, input_qty, input_mc, output_qty, output_mc, 
                    drying_loss, comment, prepared_by, prep_time, verified_by, ver_time, approved_by, appr_time, contact_person, telephone
                    FROM drying JOIN customer USING (customer_id) JOIN grades USING (grade_id) WHERE drying_no=?");
$sql->bind_param("i", $dryNo);
$sql->execute();
$sql->bind_result($dryDate, $cltId, $cltName, $gradeId, $gradeName, $inQty, $inMc, $outQty, $outMc, $dryLoss, $comment, $prepared_by, 
                $prep_time, $verified_by, $ver_time, $approved_by, $appr_time, $cltContact, $cltTel);
$sql->fetch();
$sql->close();

?>