<?php
if(isset($_GET["message"]))
{
  $_SESSION["message"]=$_GET["message"];

  if($_SESSION["message"]==="wrongdetails")
  {
    echo "The account does not exist! Please check your login details or contact the system administrator!";
  }

  if($_SESSION["message"]==="incorrectpassword")
  {
    echo "Password is incorrect!";
  }
}
?>