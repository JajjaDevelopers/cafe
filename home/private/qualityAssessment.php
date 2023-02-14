<?php
session_start();
include "connlogin.php";
$preparedBy = $_SESSION["fullName"];
include "qualityAssessVariables.php";
include "functions.php";
$grnNo =intval($_POST['grnNo']) ;
$no = documentNumber("gen_quality", "assess_no");
$date = $_POST['sampDate'];
$highGrdTotal = $_POST['highGrdTotal'];
$defectsTotal = $_POST['ttDefects'];
$inputQty = $_POST['kibParch'];
$outputQty = $_POST['green'];
$doneBy = $_POST['doneBy'];

$summSql = $conn->prepare("INSERT INTO gen_quality (assess_no, grn_no, high_grades, total_defects, input_qty, 
                            output_qty, done_by, prepared_by) VALUES (?,?,?,?,?,?,?,?)");
$summSql->bind_param("iisdddss", $no, $grnNo, $highGrdTotal, $defectsTotal, $inputQty, $outputQty, $doneBy, $preparedBy);
$summSql->execute();
$summSql->close();








header("location:../quality/assessmentGrns");
?>