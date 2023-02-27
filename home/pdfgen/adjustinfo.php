<?php
session_start();
if(isset($_SESSION["adjustNo"])){
  include "./getadjustinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>