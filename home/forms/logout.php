<?php
session_start();
include("../connection/databaseConn.php");
$logOuttime=date("Y-m-d H:i:s");
$query="UPDATE members SET loggedOut=? WHERE FullName=?;";
$stmt=$pdo->prepare($query);
if(!$stmt){
  echo "there was an error";
}else{
  $stmt->bindParam(1,$logOuttime,PDO::PARAM_STR);
  $stmt->bindParam(2, $_SESSION["fullName"],PDO::PARAM_STR);
  $stmt->execute();
}
session_unset();
session_destroy();

include "redirect.php";//takes back user to the home page
?>