<?php
session_start();
if(isset($_SESSION["stockCountNo"])){
  include "./getstockcountinfo.php";
}else{
  echo "Failed to print pdf, please try again later";
}
?>