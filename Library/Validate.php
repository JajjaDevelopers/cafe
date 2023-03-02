<?php 
class Validate{
  public static function emptyField($heis,$duo,$treis,$teraases){
    if(empty($heis)||empty($duo)||empty($treis)||empty($teraases)){
      return false;
    }else{
      return true;
    }

  }
  public static function passwordMatch($first,$second){
    if($first!==$second){
      return false;
    }else{
      return true;
    }
  }
  public static function passwordLength($pass){
    if(strlen($pass)>7){
      return true;
    }else{
      return false;
    }
  }


  public static function checkMobile($mobile){
    if(!is_numeric($mobile)){
      return false;
    }else{
      return true;
    }
  }
}