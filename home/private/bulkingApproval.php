<?php 
session_start();
$username = $_SESSION["fullName"];
$bulkNo = $_SESSION["bulkNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$num=formatDocNo($bulkNo,"BLK-");
$sql = $conn->prepare("UPDATE bulking SET approved_by=?, ver_time=Now() WHERE bulk_no=?");
$sql->bind_param("si", $username, $bulkNo);
$sql->execute();
$sql->close();
header("location:../approval/bulkingList?bulkap=success&bulkNo=$num");
exit();
}else{
header("location:../approval/bulkingList?bulkap=fail");
exit();
}
?>