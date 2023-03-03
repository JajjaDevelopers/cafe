<?php 
session_start();
$username = $_SESSION["fullName"];
$dryNo = $_SESSION["dryNo"];
include ("connlogin.php");
include ("verAndApprFunctions.php");
//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$num=formatDocNo($dryNo,"DRY-");
$sql = $conn->prepare("UPDATE drying SET approved_by=?, appr_time=Now() WHERE drying_no=?");
$sql->bind_param("si", $username, $dryNo);
$sql->execute();
$sql->close();
header("location:../approval/dryingList?dryap=success&dryNo=$num");
$_SESSION["dryNo"]="";
exit();
}else{
header("location:../approval/dryingList?dryap=fail");
exit();
}
?>