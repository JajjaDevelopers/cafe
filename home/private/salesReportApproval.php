<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

//checking for access rights
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$approvedBy,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$salNum = intval($_POST["salNo"]);
$num=formatDocNo($salNum,"SAL-");
$sql = $conn->prepare("UPDATE sales_reports_summary SET approved_by=?, appr_time=Now() WHERE sales_report_no=?");
$sql->bind_param("si", $username, $salNum);
$sql->execute();
$sql->close();
header("location:../approval/salesReportList?salap=success&salNo=$num");
exit();
}else{
header("location:../approval/salesReportList?salap=fail");
exit();
}
?>