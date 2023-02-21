<?php
session_start();
if(isset($_SESSION["salNo"])){
  include "./getsalesinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>