<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$hullNum = intval($_POST["hullNo"]);
$sql = $conn->prepare("UPDATE hulling SET verified_by=?, ver_date=Now() WHERE hulling_no=?");
$sql->bind_param("si", $username, $hullNum);
$sql->execute();
$sql->close();





header("location:../verification/hullingList");
?>