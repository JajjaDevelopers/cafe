<?php 
session_start();
$username = $_SESSION["fullName"];
$transNum = $_SESSION["transNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
  $num=formatDocNo($transNum,"GTN-");
$sql = $conn->prepare("UPDATE transfers SET approved_by=?, appr_time=Now() WHERE transfer_no=?");
$sql->bind_param("si", $username, $transNum);
$sql->execute();
$sql->close();
header("location:../approval/transferList?transap=success&transNo=$num");
exit();
}else{
header("location:../approval/transferList?transap=fail");
exit();
}
?>