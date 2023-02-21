<?php
session_start();
if(isset($_SESSION["hullNo"])){
  include "./gethullinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>