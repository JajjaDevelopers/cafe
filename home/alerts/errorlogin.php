<?php
if(isset($_GET["message"]))
{
  $_SESSION["message"]=$_GET["message"];

  if($_SESSION["message"]==="wrongdetails")
  {
    echo "You do not exist in the database. Please sign up!";
  }

  if($_SESSION["message"]==="incorrectpassword")
  {
    echo "Password is incorrect!";
  }
}
?>