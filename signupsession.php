<?php
function sessionData($field){
  if(isset($_SESSION[$field])){
    echo $_SESSION[$field];
  }
}
?>