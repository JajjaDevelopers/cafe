<?php
include "../private/connlogin.php";
include "../private/functions.php";
$releaseNo = intval($_SESSION["relNo"]);
$relSummSql = $conn->prepare("SELECT request_date, dispatch_time, customer_id, total_qty, prep_by, prep_date, verified_by, ver_date, 
                        appr_by, appr_date, comment, destination, initiated_by, customer_name, contact_person, telephone
                        FROM release_request JOIN customer USING (customer_id) 
                        WHERE release_no=?");
$relSummSql->bind_param("s", $releaseNo);
$relSummSql->execute();
$relSummSql->bind_result($relsDate, $dispDate, $custId, $qty, $prepBy, $prep_time, $verBy, $ver_time, $apprBy, $appr_time, $comt,
                    $destn, $initiator, $custName, $ctctPersn, $tel);
$relSummSql->fetch();
$relSummSql->close();

//getting release details
$relDetSql = $conn->prepare("SELECT grade_id, grade_name, qty FROM temp_inventory JOIN grades USING (grade_id)
                            WHERE (inventory_reference='Release Request' AND document_number=?) ");
$relDetSql->bind_param("i", $releaseNo);
$relDetSql->execute();
$relDetSql->bind_result($grdId, $grdName, $qty);

$relsNo =  "RLS".$_SESSION["relNo"];
$dispNo = nextDocNumber("dispatch", "dispatch_no", "DLN");

?>