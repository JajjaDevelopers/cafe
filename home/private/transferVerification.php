<?php 
session_start();
$username = $_SESSION["fullName"];
$transNum = $_SESSION["transNo"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$sql = $conn->prepare("UPDATE transfers SET verified_by=?, ver_time=Now() WHERE transfer_no=?");
$sql->bind_param("si", $username, $transNum);
$sql->execute();
$sql->close();





header("location:../verification/transferList");
?>