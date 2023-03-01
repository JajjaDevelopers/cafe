<?php
session_start();
include_once("../private/database.php");//database connection details

if(isset($_POST["submit"]))//checking whether user has submited info
{ 
  //gathering user information
  $fullname=$_POST["fullname"];
  $username=$_POST["username"];
  $email=$_POST["email"];
  $tel=$_POST["tel"];
  $password=$_POST["pwd"];
  $passwordRepeat=$_POST["confpwd"];
  $dateupload=date("Y-m-d H:i:s");
  $access=$_POST["access"];
  $uniId=md5(str_shuffle("abcdefghijklmnopqrstuvwxyz"));
  $status="active";
  
  //sessionvariables
  $_SESSION["name"] = $fullname;
  $_SESSION["username"] = $username;
  $_SESSION["email2"] = $email;
  $_SESSION["tel2"] = $tel;

  // function sessionData($field){
  //   if(isset($_SESSION[$field])){
  //     echo $_SESSION[$field];
  //   }
  // }

  //error handling
  $error="";
  //empty fields
  if(emptyFieldSignUp($fullname,$username,$email,$tel,$password,$passwordRepeat,$access)!==false)
  {
    header("location:../signup.php?error=emptyfield");
    exit();
  }

  //invalidusername
  if( validUsername($username)!==false)
  {
    header("location:../signup.php?error=invalidname");
    exit();
  }
  //password mismatch
  if(pwdMatch($password,$passwordRepeat)!==false)
  {
    header("location:../signup.php?error=passwordsdontmatch");
    exit();
  }
  //check length
  if(strlen($password)<8){
    header("location:../signup.php?error=lessthaneight");
    exit();
  }
 //invalid phone number
 if(validMobile($tel)!==false)
 {
  header("location:../signup.php?error=incorrectnumber");
  exit();
 }
 //user and email aready in database
 if(validUsernameEmail($username,$email)!==false)
 {
  header("location:../signup.php?error=userexists");
  exit();
 }
 //invalid email
 if( validEmail($email)!==false)
 {
  header("location:../signup.php?error=invalidemail");
  exit();
 }
  signUpUser($fullname,$username,$email,$tel,$password,$access,$uniId,$status);
}
?>