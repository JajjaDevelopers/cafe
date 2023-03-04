<?php 
session_start();
$verifiedBy = $_SESSION["fullName"];
include ("database.php");
include ("verAndApprFunctions.php");

//getting access rights of user
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$verifiedBy,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

//limiting verification process to specified persons
if($access==2){
  $no = $_POST["grnKeyId"];
  verifyActivity("grn", "grn_no", $no, $verifiedBy);
  $verifySql = $conn->prepare("UPDATE grn SET verified_by=?, ver_time=NOW() WHERE (grn_no=?)");
  $verifySql->bind_param("ss", $verifiedBy, $no);
  $verifySql->execute();
  header("location: ../verification/grnVerifyList?grnote=success&grn=$no");
}else{
  header("location: ../verification/grnVerifyList?grnote=fail");
}

?>