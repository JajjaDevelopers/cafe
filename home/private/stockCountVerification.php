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

if($access==2){
$sql = $conn->prepare("UPDATE stock_counting SET verified_by=?, ver_time=Now() WHERE count_no=?");
$sql->bind_param("si", $username, $bulkNo);
$sql->execute();
$sql->close();
header("location:../verification/stockCountList?count=success&countNo=$bulkNo");
exit();
}else{
  header("location:../verification/stockCountList?count=fail");
}
?>