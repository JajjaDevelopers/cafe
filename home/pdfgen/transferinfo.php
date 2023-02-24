<?php
session_start();
if(isset($_SESSION["transNo"])){
  include "./gettransferinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>