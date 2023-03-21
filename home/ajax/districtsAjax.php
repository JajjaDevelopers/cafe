<?php session_start(); ?>
<?php include "../connection/databaseConn.php"; ?>

<?php

$districtSql = $conn->prepare("SELECT district_id, district_name FROM districts
                            WHERE region=?");


$regionSeected = ($_GET['q']);
if(isset($_GET['req'])){
    $continent=$_GET['q'];
    $ctrySql=$conn->prepare("SELECT country_id, country_name FROM countries WHERE continent=? ORDER BY country_rank");
    $ctrySql->bind_param("s", $continent);
    $ctrySql->execute();
    $ctrySql->bind_result($cId, $cName);
    while($ctrySql->fetch()){
        ?>
        <option value="<?=$cId?>"><?=$cName?></option>
        <?php
    }
    $ctrySql->close();
}else{
    $districtSql->bind_param("s", $regionSeected);
    $districtSql->execute();
    $allDistricts = $districtSql -> get_result();
    $rows = $conn -> affected_rows;
    
    echo '<option>Districts from '.$regionSeected.'</option>';
    for ($distNo=1; $distNo <= $rows; $distNo++){
        $distRow = $allDistricts -> fetch_assoc();
        $id = $distRow['district_id'];
        $name = $distRow['district_name'];
        // $gradeName = $gradeRow['grade_name'];
    ?>
        <option value="<?= $id ?>"><?= $name ?></option>;
       <?php
    }
}



?>