<?php session_start(); ?>
<?php $verifiedBy = $_SESSION["userName"]; ?>
<?php include ("database.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$no = $_POST["grnKeyId"];
verifyActivity("grn", "grn_no", $no, $verifiedBy);
$verifySql = $conn->prepare("UPDATE grn SET verified_by=?, ver_time=NOW() WHERE (grn_no=?)");
$verifySql->bind_param("ss", $verifiedBy, $no);
$verifySql->execute();






header("location: ../verification/grnVerifyList");
?>