<?php
session_start();
if(isset($_SESSION["grn"])){
  include "../connection/databaseConn.php";
  include "./grnvariables.php";
  include "./getgrninfo.php";
}else{
  echo "Failed to download pdf, please try again later";
}
?>