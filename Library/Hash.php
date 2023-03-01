<?php
 class Hash {
  public static function hash($password){
    return password_hash($password,PASSWORD_DEFAULT);
  }
  public static function verify($enteredPaswword,$dbPassword){
    if(password_verify($enteredPaswword,$dbPassword)){
      return true;
    }else{
      return false;
    }
  }
 }