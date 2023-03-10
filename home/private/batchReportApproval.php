<?php 
session_start();
$username = $_SESSION["fullName"];
$batchNo = $_SESSION["batchNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$sql = $conn->prepare("UPDATE batch_reports_summary SET approved_by=?, appr_time=Now() WHERE batch_report_no=?");
$sql->bind_param("si", $username, $batchNo);
$sql->execute();
$sql->close();
header("location:../approval/batchReportList?batchap=success&batchNo=$batchNo");
exit();
}else{
header("location:../approval/batchReportList?batchap=fail");
exit();
}
?>