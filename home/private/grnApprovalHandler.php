<?php session_start(); ?>
<?php $approvedBy = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$no = $_POST["grnKeyId"];
// approveActivity("grn", "grn_no", $no, $approvedBy);
$verifySql = $conn->prepare("UPDATE grn SET approved_by=?, appr_time=NOW() WHERE (grn_no=?)");
$verifySql->bind_param("ss", $approvedBy, $no);
$verifySql->execute();






header("location: ../approval/grnApprovalList");
?>