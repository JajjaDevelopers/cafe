<?php 
session_start();
include ("connlogin.php"); 
// include ("verAndApprFunctions.php");
$username = $_SESSION["fullName"];
// $docNo = $_SESSION["docNo"];
// $docName = $_SESSION["docName"];

//getting access right
$stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
$stmt->bindParam(1,$username,PDO::PARAM_STR);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$access=$row["Access"];

if($access==2){
    approveDocument("roastery_activity_summary", "activitySheetList", "RST-", "activity_sheet_no");
// $num=formatDocNo($adjustNo,"ADJ-");
// $sql = $conn->prepare("UPDATE adjustment SET approved_by=?, appr_time=Now() WHERE adj_no=?");
// $sql->bind_param("si", $username, $adjustNo);
// $sql->execute();
// $sql->close();
// header("location:../approval/adjustmentList?adjustap=success&adjustNo=$num");
// exit();
// }else{
// header("location:../approval/adjustmentList?adjustap=fail");
// exit();
}

function approveDocument($table, $headerPage, $docNoPrefix, $idColumn){
    include ("connlogin.php"); 
    global $access;
    // include ("verAndApprFunctions.php");
    $docNo = $_SESSION["docNo"];$docNoPrefix.
    $docName = $_SESSION["docName"];
    $msg = $docName." ".$docNoPrefix.$docNo." Approved Successfully";
    if($access==2){
        $sql = $conn->prepare("UPDATE $table SET approved_by=?, appr_date=Now() WHERE $idColumn=?");
        $sql->bind_param("si", $username, $docNo);
        $sql->execute();
        $sql->close();
        header("location:../approval/$headerPage?apprStatus=success&msg=$msg");
        // header("location:../approval/$headerPage?adjustap=success&adjustNo=$num");
        exit();
    }else{
        header("location:../approval/$headerPage?apprStatus=fail");
        // header("location:../approval/$headerPage?adjustap=fail");
        exit();
    }
}

?>