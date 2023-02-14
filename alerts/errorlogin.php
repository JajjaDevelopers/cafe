<?php
if(isset($_GET["message"]))
{
  $_SESSION["message"]=$_GET["message"];

  if($_SESSION["message"]==="wrongdetails")
  {
    echo "You are not authorised to use this system!";
  }

  if($_SESSION["message"]==="incorrectpassword")
  {
    echo "Password is incorrect!";
  }else if($_SESSION["message"]==="emptyinput")
  {
    echo "Password Field is empty!";
  }
}
?>