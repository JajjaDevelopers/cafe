<?php
// 
//Getting regions
function getRegion(){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT region FROM districts GROUP BY region");
    $sql->execute();
    $sql->bind_result($region);
    ?><option>Regions</option><?php
    while ($sql->fetch()){
        ?><option value="<?=$region?>"><?=$region?></option><?php
    }
}

//Getting district as per the region
function getDistrict($region){
    include "connlogin.php";
    $sql = $conn->prepare("SELECT district_id, district_name FROM districts WHERE region=?");
    $sql->bind_param("s", $region);
    $sql->execute();
    $sql->bind_result($distId, $distName);
    ?><option>District</option><?php
    while ($sql->fetch()){
        ?><option value="<?=$distId?>"><?=$distName?></option><?php
    }
}

$function = $_GET["filter"];
$regn = $_GET["key"];

if ($function == "region"){
    getRegion();
}elseif($function == "district"){
    getDistrict($regn);
}

?>