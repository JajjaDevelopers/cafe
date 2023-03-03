<?php 
session_start();
$username = $_SESSION["fullName"];
$adjustNo = $_SESSION["adjustNo"];
include ("connlogin.php"); 
include ("verAndApprFunctions.php");

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$num=formatDocNo($adjustNo,"ADJ-");
$sql = $conn->prepare("UPDATE adjustment SET approved_by=?, appr_time=Now() WHERE adj_no=?");
$sql->bind_param("si", $username, $adjustNo);
$sql->execute();
$sql->close();
header("location:../approval/adjustmentList?adjustap=success&adjustNo=$num");
exit();
}else{
header("location:../approval/adjustmentList?adjustap=fail");
exit();
}
?>