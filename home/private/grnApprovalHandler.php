<?php session_start();
$approvedBy = $_SESSION["fullName"];
include ("database.php"); 
include ("verAndApprFunctions.php");
//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$approvedBy,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$no = $_POST["grnKeyId"];
// approveActivity("grn", "grn_no", $no, $approvedBy);
$verifySql = $conn->prepare("UPDATE grn SET approved_by=?, appr_time=NOW() WHERE (grn_no=?)");
$verifySql->bind_param("ss", $approvedBy, $no);
$verifySql->execute();
header("location: ../approval/grnApprovalList?grnap=success&grnNo=$no");
exit();
}else{
header("location: ../approval/grnApprovalList?grnap=fail");
exit();
}
?>