<?php session_start(); ?>
<?php $approvedBy = $_SESSION["userName"]; ?>
<?php include ("database.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$no = $_POST["releaseNo"];
// approveActivity("grn", "grn_no", $no, $approvedBy);
$verifySql = $conn->prepare("UPDATE release_request SET appr_by=?, appr_date=NOW() WHERE (release_no=?)");
$verifySql->bind_param("ss", $approvedBy, $no);
$verifySql->execute();






header("location: ../approval/releaseList");
?>