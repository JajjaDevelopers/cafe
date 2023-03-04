<?php 
session_start();
$username = $_SESSION["fullName"];
$batchNo = $_SESSION["batchNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

$batchNova=formatDocNo($batchNo,"BRN-");

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==2){
  $sql = $conn->prepare("UPDATE batch_reports_summary SET verified_by=?, ver_time=Now() WHERE batch_report_no=?");
  $sql->bind_param("si", $username, $batchNo);
  $sql->execute();
  $sql->close();
  header("location:../verification/batchReportList?batch=success&batchNo=$batchNova");
  exit();
}else{
  header("location:../verification/batchReportList?batch=fail");
}

?>