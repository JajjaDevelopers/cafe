<?php
if(isset($_SESSION["updateMessage"])){
  if($_SESSION["updateMessage"]=="empty"){
    echo "Please fill all fields";
  }
  if($_SESSION["updateMessage"]=="less"){
    echo "Password must be at least eight characters ";
  }
  if($_SESSION["updateMessage"]=="mismatch"){
    echo "Passwords do not match";
  }
  if($_SESSION["updateMessage"]=="invalidmobile"){
    echo "Please enter a valid mobile number";
  }
  if($_SESSION["updateMessage"]=="exist"){
    echo "You already have an active working account. Just sign in";
  }

}