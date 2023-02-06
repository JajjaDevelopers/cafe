<?php
if(isset($_POST["submit"]))
{
  $username=$_POST["username"];
  $password=$_POST["password"];

  include ("../private/database.php");

  if(loginInputEmpty($username,$password)!==false){
    header("location:../login.php?message=emptyinput");
    exit();
  }

  loginUser($username,$password);
} else{
  header("location:../index.php?");
  exit();
}
?>