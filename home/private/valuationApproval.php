<?php 
session_start();
$username = $_SESSION["fullName"];
include ("connlogin.php");
include ("verAndApprFunctions.php"); 

//checking for access rights
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$valNum = intval($_POST["valNum"]);
$val= formatDocNo($valNum,"VAL-");
$sql = $conn->prepare("UPDATE valuation_report_summary SET approved_by=?, appr_date=Now() WHERE valuation_no=?");
$sql->bind_param("si", $username, $valNum);
$sql->execute();
$sql->close();
header("location:../approval/valuationList?valap=success&valNo=$val");
exit();
}else{
header("location:../approval/valuationList?valap=fail");
exit();
}
?>