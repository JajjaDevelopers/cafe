<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$valNum = intval($_POST["valNum"]);
$sql = $conn->prepare("UPDATE valuation_report_summary SET approved_by=?, appr_date=Now() WHERE valuation_no=?");
$sql->bind_param("si", $username, $valNum);
$sql->execute();
$sql->close();





header("location:../approval/valuationList");
?>