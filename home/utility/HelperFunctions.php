<?php
class Helper{
  public static function formatDocNo($docNo, $prefix){
    $docNumber = "";
  if ($docNo === 0){
    $docNumber = $prefix."-0001";
  }else{
    if ($docNo<10){
        $docNumber = $prefix."000".$docNo;
    }
    elseif ($docNo<100){
        $docNumber = $prefix."00".$docNo;
    }elseif ($docNo<1000){
        $docNumber = $prefix."0".$docNo;
    }else{
      $docNumber = $prefix."".$docNo;}
    }
  return $docNumber;

}
}
?>