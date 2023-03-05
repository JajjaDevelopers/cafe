<?php
session_start();
include "connlogin.php";
$preparedBy = $_SESSION["fullName"];
include "qualityAssessVariables.php";
include "functions.php";
$grnNo =intval($_POST['grnNo']) ;
$no = documentNumber("gen_quality", "assess_no");
$date = $_POST['sampDate'];
$highGrdTotal = $_POST['highGrdTotal'];
$defectsTotal = $_POST['ttDefects'];
$inputQty = $_POST['kibParch'];
$outputQty = $_POST['green'];
$doneBy = $_POST['doneBy'];

$summSql = $conn->prepare("INSERT INTO gen_quality (assess_no, high_grades, total_defects, input_qty, 
                            output_qty, done_by, prepared_by) VALUES (?,?,?,?,?,?,?,?)");
$summSql->bind_param("iisdddss", $no, $highGrdTotal, $defectsTotal, $inputQty, $outputQty, $doneBy, $preparedBy);
$summSql->execute();
$summSql->close();

$grnSql = $conn->prepare("UPDATE grn SET assess_no=? WHERE grn=?");
$grnSql->bind_param("ii", $no, $grnNo);
$grnSql->execute();
$grnSql->close();

//table data (check lists in js and handler to match php arrays)
$cat1List = array("Full Blacks", "Full Sour", "Pods", "Fungus", "Extraneous Matter", "Severe Insect Damage");
$cat1InputIds = array("fullBlaks", "fullSour", "pods", "fungus", "extraMat", "insDamage");

$cat2List = array("Partial Black", "Partial Sour", "Parchment", "Floater-Chalky Whites", "Immature", "Withered", 
                    "Shell", "Broken-Chipped-Cut", "Husks", "Pinhole");
$cat2InputIds = array("partBlak", "partSour", "parchment", "floater", "immature", "withered", 
                    "shell", "broken", "husks", "pinhole");

$soundBeansArabica = array("AA", "A", "B", "C", "Triage"); //later generate from the database - list
$arabicaInputIds = array("aa", "a", "b", "c", "triage");

$soundBeansRobusta = array("Screen 1800", "Screen 1700", "Screen 1500", "Screen 1200", "Screen 1199");
$robustaInputIds = array("sc18", "sc17", "sc15", "sc12", "sc1199");

$summList = array("Kibooko-Parchment", "Green", "Parchment Out turn", "None1", "None2", "Total Defects", "", "OUT TURN");
$summListIds = array("kibParch", "green", "kibPercOut", "none1", "none2", "ttDefects", "", "outTurn");

$allIdlists = array($cat1InputIds, $cat2InputIds, $arabicaInputIds, $robustaInputIds);

$detSql = $conn->prepare("INSERT INTO gen_quality_details (assess_no, item_no, item, qty, gen_quality_detailscol) 
                        VALUES (?,?,?,?,?,?,?)");

header("location:../quality/assessmentGrns");
?>