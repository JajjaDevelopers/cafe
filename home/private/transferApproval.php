<?php 
session_start();
$username = $_SESSION["fullName"];
$transNum = $_SESSION["transNo"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$sql = $conn->prepare("UPDATE transfers SET approved_by=?, appr_time=Now() WHERE transfer_no=?");
$sql->bind_param("si", $username, $transNum);
$sql->execute();
$sql->close();





header("location:../approval/transferList");
?>