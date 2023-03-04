<?php session_start();
$approvedBy = $_SESSION["fullName"];
include ("database.php");
include ("verAndApprFunctions.php");
$no = $_POST["releaseNo"];
// approveActivity("grn", "grn_no", $no, $approvedBy);

//checking for access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$approvedBy,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==1){
$verifySql = $conn->prepare("UPDATE release_request SET appr_by=?, appr_date=NOW() WHERE (release_no=?)");
$verifySql->bind_param("ss", $approvedBy, $no);
$verifySql->execute();
header("location: ../approval/releaseList?releaseap=success&relNo=$no");
exit();
}else{
header("location: ../approval/releaseList?releaseap=fail");
exit();
}
?>