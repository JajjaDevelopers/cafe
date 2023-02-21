<?php
include "../private/connlogin.php";
include "../private/functions.php";
$valNo = intval($_SESSION["valNo"]);
$valuationNumber =  "VAL-".$_SESSION["valNo"];

//summary
$summSql = $conn->prepare("SELECT valuation_date, batch_report_no, customer_id, input_qty, exchange_rate, costs, prepared_by, prep_date,
                        verified_by, ver_date, approved_by, appr_date, customer_name, contact_person, telephone
                        FROM valuation_report_summary JOIN customer USING (customer_id)
                            WHERE valuation_no=?");
$summSql->bind_param("i", $valNo);
$summSql->execute();
$summSql->bind_result($valDate, $batcNo, $clientId, $inputQty, $fxRate, $valCosts, $prepared_by, $prep_time, $verified_by, $ver_time, 
                    $approved_by, $appr_time, $clientName, $contact, $tel);
$summSql->fetch();
$summSql->close();

//details
$valDetSql = $conn->prepare("SELECT grade_name, qty, price_ugx FROM valuations JOIN grades USING (grade_id) 
                            WHERE valuation_no=? ORDER BY item_no");
$valDetSql->bind_param("i", $valNo);
$valDetSql->execute();
$valDetSql->bind_result($grdName, $grdQty, $ugxPx);

?>