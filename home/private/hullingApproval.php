<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php");
include ("verAndApprFunctions.php");

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$hullNum = intval($_POST["hullNo"]);
$num=formatDocNo($hullNum,"HULL-");
$sql = $conn->prepare("UPDATE hulling SET approved_by=?, appr_date=Now() WHERE hulling_no=?");
$sql->bind_param("si", $username, $hullNum);
$sql->execute();
$sql->close();
header("location:../approval/hullingList?hullap=success&hullNo=$num");
exit();
}else{
header("location:../approval/hullingList?hullap=fail");
exit();
}
?>