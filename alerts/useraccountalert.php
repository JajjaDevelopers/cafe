<?php
if(isset($_SESSION["updateMessage"])){
  if($_SESSION["updateMessage"]=="empty"){
    echo "Please fill all fields";
  }
  if($_SESSION["updateMessage"]=="less"){
    echo "Password must be at least eight characters ";
  }
  if($_SESSION["updateMessage"]=="mismatch"){
    echo "Passwords do not much";
  }
  if($_SESSION["updateMessage"]=="invalidmobile"){
    echo "Please enter a valid mobile number";
  }

}