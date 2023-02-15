<?php
include "connlogin.php";
include "functions.php";
$valNo = intval($_GET['valNo']);
$valuationNumber = formatDocNo($valNo, "VAL-");

//summary
$summSql = $conn->prepare("SELECT valuation_date, batch_report_no, customer_id, exchange_rate, costs, prepared_by, prep_date,
                        verified_by, ver_date, approved_by, appr_date, customer_name, contact_person, telephone
                        FROM valuation_report_summary JOIN customer USING (customer_id)
                            WHERE valuation_no=?");
$summSql->bind_param("i", $valNo);
$summSql->execute();
$summSql->bind_result($valDate, $batcNo, $clientId, $fxRate, $valCosts, $prepared_by, $prep_time, $verified_by, $ver_time, 
                    $approved_by, $appr_time, $clientName, $contact, $tel);
$summSql->fetch();
$summSql->close();






?>