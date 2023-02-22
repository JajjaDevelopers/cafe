<?php
include "../private/connlogin.php";
include "../private/functions.php";
$salNo = intval($_SESSION['salNo']);
$salesNo ="SAL-".$_SESSION['salNo'];

$summSql = $conn->prepare("SELECT customer_id, customer_name, sales_report_date, sale_category, sales_report_value, foreign_currency,
                        exchange_rate, preparing_staff, verified_by, approved_by, sales_notes, contact_person, telephone, prep_time,
                        ver_time, appr_time
                        FROM sales_reports_summary JOIN customer USING (customer_id) WHERE sales_report_no=?");
$summSql->bind_param("i", $salNo);
$summSql->execute();
$summSql->bind_result($cltId, $cltName, $salDate, $salCat, $salVal, $currency, $salFx, $prepared_by, $verified_by, $approved_by, 
                        $salNotes, $cltContact, $cltTel, $prep_time, $ver_time, $appr_time);
$summSql->fetch();
$summSql->close();

//details
$detSql = $conn->prepare("SELECT grade_name, qty_out, price_ugx FROM inventory JOIN grades USING (grade_id)
                        WHERE (inventory_reference='Sales Report' AND document_number=? AND qty_out>0) GROUP BY item_no");
$ref = "Sales Report";
$detSql->bind_param("i", $salNo);
$detSql->execute();
$detSql->bind_result($grade, $qty, $ugPx);
?>