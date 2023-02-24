<?php
session_start();
if(isset($_SESSION["dryNo"])){
  include "./getdryinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>