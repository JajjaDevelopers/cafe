<?php 
session_start();
$username = $_SESSION["fullName"];
$bulkNo = $_SESSION["countNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$num=formatDocNo($bulkNo,"STC-");
$sql = $conn->prepare("UPDATE stock_counting SET approved_by=?, appr_time=Now() WHERE count_no=?");
$sql->bind_param("si", $username, $bulkNo);
$sql->execute();
$sql->close();
header("location:../approval/stockCountList?countap=success&countNo=$num");
exit();
}else{
header("location:../approval/stockCountList?countap=fail");
exit();
}
?>