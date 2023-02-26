<?php
include "../private/connlogin.php";
include "../private/functions.php";
$transNo = intval($_SESSION['transNo']);
$transferNo = "GTN-".$_SESSION['transNo'];
$summSql = $conn->prepare("SELECT transfer_date, 
            (SELECT customer_name FROM customer WHERE transfers.transfer_from=customer.customer_id) AS transfer_from, 
            (SELECT customer_name FROM customer WHERE transfers.transfer_to=customer.customer_id) AS transfer_to, from_witness, 
            to_witness, notes, prepared_by, prep_time, verified_by, ver_time, approved_by, appr_time 
            FROM transfers WHERE transfer_no=?");
$summSql->bind_param("i", $transNo);
$summSql->execute();
$summSql->bind_result($tranDate, $frmCltName, $toCltName, $fromWitness, $toWitness, $comment, $prepared_by, $prep_time, $verified_by, 
            $ver_time, $approved_by, $appr_time);
$frmCltId="";
$toCltId="";
$summSql->fetch();
$summSql->close();

//detSql
$detSql = $conn->prepare("SELECT grade_name, qty_out FROM inventory JOIN grades USING (grade_id) WHERE inventory_reference='Transfer'
                        AND document_number=? AND qty_out<>0");
$detSql->bind_param("i", $transNo);
$detSql->execute();
$detSql->bind_result($grdName, $grdQty);
?>
