<?php
 include_once("../private/connlogin.php");
 if(isset($_POST["changebtn"]))
 {
  session_start();
  $newPass=$_POST["newPassword"];
  $confPass=$_POST["newPasswordConf"];
  //generating errors
  if(strlen($newPass)<8){
    header("location:../forms/settings.php?error=short");
    exit();
  }
   if(passLength($newPass)!==false){
    header("location:../forms/settings.php?error=short");
    exit();
   }
  if(empty($newPass) || empty($confPass) )
  {
    header("location:../forms/settings.php?error=empty");
    exit();
  } elseif($newPass!==$confPass)
  {
    header("location:../forms/settings.php?error=passwordmismatch");
    exit();
  } else
  {
    $query="UPDATE members SET UserPassword=? WHERE UserName=?;";
    $stmt=$pdo->prepare($query);
    if(!$stmt)
    {
      echo "There was an error";
    }else{
      $user=$_SESSION["userName"];
      $newPassHashed=password_hash($newPass,PASSWORD_DEFAULT);
      $stmt->bindParam(1,$newPassHashed,PDO::PARAM_STR);//binding parameters
      $stmt->bindParam(2,$user,PDO::PARAM_STR);
      $stmt->execute();
      header("location:../forms/settings.php?error=none");
       exit();
    }
  }
  
 }
?>