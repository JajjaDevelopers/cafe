<?php 
session_start();
$username = $_SESSION["fullName"];
$adjustNo = $_SESSION["adjustNo"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$sql = $conn->prepare("UPDATE adjustment SET approved_by=?, appr_time=Now() WHERE adj_no=?");
$sql->bind_param("si", $username, $adjustNo);
$sql->execute();
$sql->close();





header("location:../approval/adjustmentList");
?>