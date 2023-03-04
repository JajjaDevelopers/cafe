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

if($access==2){
  $valNum = intval($_POST["valNum"]);
  $num=formatDocNo($valNum,"VAL-");
  $sql = $conn->prepare("UPDATE valuation_report_summary SET verified_by=?, ver_date=Now() WHERE valuation_no=?");
  $sql->bind_param("si", $username, $valNum);
  $sql->execute();
  $sql->close();
  header("location:../verification/valuationList?valuation=success&valNo=$num");
  exit();
}else{
  header("location:../verification/valuationList?valuation=fail");
  exit();
}

?>