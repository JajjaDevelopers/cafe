<?php 
session_start();
$username = $_SESSION["fullName"];
$transNum = $_SESSION["transNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");
$transNumva=formatDocNo($transNum,"GTN-");
//getting access rights
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==2){
  $sql = $conn->prepare("UPDATE transfers SET verified_by=?, ver_time=Now() WHERE transfer_no=?");
  $sql->bind_param("si", $username, $transNum);
  $sql->execute();
  $sql->close();
  header("location:../verification/transferList?transfer=success&transNo=$transNumva");
  exit();
}else{
  header("location:../verification/transferList?transfer=fail");
  exit();
}


?>