<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

//getting access rights
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==2){
  $salNum = intval($_POST["salNo"]);
  $numb=formatDocNo($salNum,"SAL-");
  $sql = $conn->prepare("UPDATE sales_reports_summary SET verified_by=?, ver_time=Now() WHERE sales_report_no=?");
  $sql->bind_param("si", $username, $salNum);
  $sql->execute();
  $sql->close();
  header("location:../verification/salesReportList?sales=success&salNo=$numb");
}else{
  header("location:../verification/salesReportList?sales=fail");
}

?>