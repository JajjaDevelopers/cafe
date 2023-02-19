<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$salNum = intval($_POST["salNo"]);
$sql = $conn->prepare("UPDATE sales_reports_summary SET varified_by=?, ver_time=Now() WHERE sales_report_no=?");
$sql->bind_param("si", $username, $salNum);
$sql->execute();
$sql->close();





header("location:../verification/salesReportList");
?>