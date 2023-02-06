<?php
if(isset($_GET["error"]))
{ 
  if($_GET["error"]=="empty")
  {
    echo "You cannot submit empty fields!";
  }elseif($_GET["error"]=="passwordmismatch")
  {
    echo "New password did not match, Try again!";
  }elseif($_GET["error"]=="none")
  {
    echo "Password changed successfully!";
  }elseif($_GET["error"]=="nonealphanumericcharacters")
  {
    echo "User name is invalid! Only letters and numbers are allowed";
  }elseif($_GET["error"]=="nameexists")
  {
    echo "Username already exists";
  }elseif($_GET["error"]=="wrongpassword")
  {
    echo "Wrong password, Please try again";
  }elseif($_GET["error"]=="changenamesuccess")
  {
    echo "Username successfully updated";
  }
}
?>