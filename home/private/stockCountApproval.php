<?php 
session_start();
$username = $_SESSION["fullName"];
$bulkNo = $_SESSION["countNo"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$sql = $conn->prepare("UPDATE stock_counting SET approved_by=?, appr_time=Now() WHERE count_no=?");
$sql->bind_param("si", $username, $bulkNo);
$sql->execute();
$sql->close();





header("location:../approval/stockCountList");
?>