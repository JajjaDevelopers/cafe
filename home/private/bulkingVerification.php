<?php 
session_start();
$username = $_SESSION["fullName"];
$bulkNo = $_SESSION["bulkNo"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$sql = $conn->prepare("UPDATE bulking SET verified_by=?, ver_time=Now() WHERE bulk_no=?");
$sql->bind_param("si", $username, $bulkNo);
$sql->execute();
$sql->close();





header("location:../verification/bulkingList");
?>