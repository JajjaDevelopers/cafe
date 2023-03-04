<?php 
session_start();
$username = $_SESSION["fullName"];
$bulkNo = $_SESSION["bulkNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");
$bulkNova=formatDocNo($bulkNo,"BLK-");
//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==2){
$sql = $conn->prepare("UPDATE bulking SET verified_by=?, ver_time=Now() WHERE bulk_no=?");
$sql->bind_param("si", $username, $bulkNo);
$sql->execute();
$sql->close();
header("location:../verification/bulkingList?bulk=success&bulkNo=$bulkNova");
exit();
}else{
header("location:../verification/bulkingList?bulk=fail");
exit();
}
?>