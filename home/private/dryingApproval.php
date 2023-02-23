<?php 
session_start();
$username = $_SESSION["fullName"];
$dryNo = $_SESSION["dryNo"];
include ("connlogin.php"); ?>
<?php include ("verAndApprFunctions.php"); ?>
<?php
$sql = $conn->prepare("UPDATE drying SET approved_by=?, appr_time=Now() WHERE drying_no=?");
$sql->bind_param("si", $username, $dryNo);
$sql->execute();
$sql->close();





header("location:../approval/dryingList");
$_SESSION["dryNo"]="";
exit();
?>