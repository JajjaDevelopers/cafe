<?php
include "../private/database.php";
$qtCurrentDate = new DateTime();
$quarterValuesList = array(1, 2, 3, 4);
$quarterNamesList = array('Quarter-2', 'Quarter-3', 'Quarter-4', 'Quarter-1');

//Getting quarterly coffee types
function getQuarterlyKgs($typeCategory, $Quarter){
    include "../private/connlogin.php";

    $getSql = $conn->prepare("SELECT sum(grn_qty) AS qty FROM grn JOIN grades USING (grade_id)
                            WHERE (type_category=? AND QUARTER(grn_date)=?)");
    $getSql->bind_param("si", $typeCategory, $Quarter);
    $getSql->execute();
    $getSql->bind_result($qtrQty);
    $getSql->fetch();
    if ($qtrQty == null){
        $qtrQty = 0;
    }
    $qty = $qtrQty;
    return $qty;
}


//Natural robusta
$natural1 = getQuarterlyKgs("Natural", 4);
$natural2 = getQuarterlyKgs("Natural", 1);
$natural3 = getQuarterlyKgs("Natural", 2);
$natural4 = getQuarterlyKgs("Natural", 3);

//Washed robusta
$washed1 = getQuarterlyKgs("Washed Robusta", 4);
$washed2 = getQuarterlyKgs("Washed Robusta", 1);
$washed3 = getQuarterlyKgs("Washed Robusta", 2);
$washed4 = getQuarterlyKgs("Washed Robusta", 3);

//WUGAR
$wugar1 = getQuarterlyKgs("Wugar", 4);
$wugar2 = getQuarterlyKgs("Wugar", 1);
$wugar3 = getQuarterlyKgs("Wugar", 2);
$wugar4 = getQuarterlyKgs("Wugar", 3);

//DRUGAR
$drugar1 = getQuarterlyKgs("Drugar", 4);
$drugar2 = getQuarterlyKgs("Drugar", 1);
$drugar3 = getQuarterlyKgs("Drugar", 2);
$drugar4 = getQuarterlyKgs("Drugar", 3);

//Quarter summary
$guide = array("Quarter-Code", "Natural-Kg", "Wugar-Kg", "Drugar-Kg", "Washed Robusta-Kg");
$q1 = array("Q1", $natural1, $wugar1, $drugar1, $washed1);
$q2 = array("Q2", $natural2, $wugar2, $drugar2, $washed2);
$q3 = array("Q3", $natural3, $wugar3, $drugar3, $washed3);
$q4 = array("Q4", $natural4, $wugar4, $drugar4, $washed4);

$data = json_encode(array($guide, $q1, $q2, $q3, $q4));
echo $data;


?>