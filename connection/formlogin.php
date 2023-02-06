<?php
if(isset($_POST["submit"]))
{ 
  session_start();

  $username=$_POST["username"];
  $password=$_POST["password"];

  $_SESSION["loginName"]=$username;
  $_SESSION["lastLoginTimestamp"]=time();
  include ("../private/database.php");

  if(loginInputEmpty($username,$password)!==false){
    header("location:../index.php?message=emptyinput");
    exit();
  }

  loginUser($username,$password);
} else{
  header("location:../index.php?");
  exit();
}
?>