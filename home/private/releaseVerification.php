<?php session_start();
  $verifiedBy = $_SESSION["fullName"];
  include ("database.php");
  include ("verAndApprFunctions.php");
    //getting access rights of user
  $stmt=$pdo->prepare("SELECT Access FROM members WHERE FullName=?");
  $stmt->bindParam(1,$verifiedBy,PDO::PARAM_STR);
  $stmt->execute();
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $access=$row["Access"];

  //limiting access
  if($access==2){
    $no = $_POST["releaseNo"];
    // approveActivity("grn", "grn_no", $no, $approvedBy);
    $verifySql = $conn->prepare("UPDATE release_request SET verified_by=?, ver_date=NOW() WHERE (release_no=?)");
    $verifySql->bind_param("ss", $verifiedBy, $no);
    $verifySql->execute();
    header("location: ../verification/releaseList?release=success&relno=$no");
    exit();
  }else{
    header("location: ../verification/releaseList?release=fail");
    exit();
  }

?>