<?php 
session_start();
$username = $_SESSION["fullName"];
$batchNo = $_SESSION["batchNo"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$sql = $conn->prepare("UPDATE batch_reports_summary SET verified_by=?, ver_time=Now() WHERE batch_report_no=?");
$sql->bind_param("si", $username, $batchNo);
$sql->execute();
$sql->close();





header("location:../verification/batchReportList");
?>