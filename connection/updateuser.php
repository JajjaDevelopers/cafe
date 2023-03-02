<?php
session_start();
 include "../Library/Hash.php";
 include "../Library/Validate.php";
 
if(isset($_POST["register"])){
  $username=$_POST["username"];
  $password=$_POST["password"];
  $confpassword=$_POST["confpwd"];
  $tel=$_POST["telcontact"];
  $status="active";
  $identifier= $_SESSION["userId"];

  if(!(Validate::emptyField($confpassword,$password,$tel,$username))){
    echo "Some fields are missing";
    header("location:../updateaccount.php?user=$identifier&message=empty");
    exit();
  }

  if(!(Validate::passwordLength($password))){
    // echo "Password must be at least  8 characters";
    header("location:../updateaccount.php?user=$identifier&message=less");
    exit();
  }

  if(!(Validate::passwordMatch($password,$confpassword))){
    // echo "Passwords do not match";
    header("location:../updateaccount.php?user=$identifier&message=mismatch");
    exit();
  }
  if(!(Validate::checkMobile($tel))){
    // echo "Mobile must be valid number";
    header("location:../updateaccount.php?user=$identifier&message=invalidmobile");
    exit();
  }

  include("../private/connlogin.php");
  $sql="SELECT * FROM members WHERE uniId=?";
  $stmt=$pdo->prepare($sql);
  $stmt->bindParam(1,$identifier,PDO::PARAM_STR);
  $stmt->execute();
  $row=$stmt->fetch(PDO::FETCH_ASSOC);


  $passwordHash=Hash::hash($password);
  $stmt=$pdo->prepare("UPDATE members SET UserName=?,Telephone=?,UserPassword=?,status=? WHERE uniId=?");
  $stmt->bindParam(1,$username,PDO::PARAM_STR);
  $stmt->bindParam(2,$tel,PDO::PARAM_INT);
  $stmt->bindParam(3,$passwordHash,PDO::PARAM_STR);
  $stmt->bindParam(4,$status,PDO::PARAM_STR);
  $stmt->bindParam(5,$identifier,PDO::PARAM_STR);
  if($stmt->execute()){
    header("location:../index.php?complete=success");
  }else{
    echo "We are sorry, account creation Failed! Please contact system administrators.";
  }
}
?>