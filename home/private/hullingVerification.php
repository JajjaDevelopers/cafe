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
$hullNum = intval($_POST["hullNo"]);
$num=formatDocNo($hullNum,"HULL-");
$sql = $conn->prepare("UPDATE hulling SET verified_by=?, ver_date=Now() WHERE hulling_no=?");
$sql->bind_param("si", $username, $hullNum);
$sql->execute();
$sql->close();
header("location:../verification/hullingList?hull=success&hullNo=$num");
}else{
header("location:../verification/hullingList?hull=fail");
exit();
}

?>