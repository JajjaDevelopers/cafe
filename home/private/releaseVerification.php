<?php session_start(); ?>
<?php $verifiedBy = $_SESSION["fullName"]; ?>
<?php include ("database.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$no = $_POST["releaseNo"];
// approveActivity("grn", "grn_no", $no, $approvedBy);
$verifySql = $conn->prepare("UPDATE release_request SET verified_by=?, ver_date=NOW() WHERE (release_no=?)");
$verifySql->bind_param("ss", $verifiedBy, $no);
$verifySql->execute();






header("location: ../verification/releaseList");
?>