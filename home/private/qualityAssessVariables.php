<?php
include "connlogin.php";
$grnNo =intval($_GET['grnNo']) ;
$sql = $conn->prepare("SELECT customer_id, customer_name, contact_person, telephone, grade_name, grn_qty, no_of_bags, 
                        purpose, grn_mc, coffee_type FROM grn JOIN customer USING (customer_id) JOIN grades USING (grade_id)
                        WHERE grn_no=?");
$sql->bind_param("i", $grnNo);
$sql->execute();
$sql->bind_result($clientId, $clientName, $contact, $tel, $grade, $qty, $bags, $purpose, $mc, $grdType);
$sql->fetch();
$sql->close();


//table data
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

$summList = array("Kibooko-Parchment", "Green", "Parchment Out turn", "", "", "Total Defects", "", "OUT TURN");
$summListIds = array("kibParch", "green", "kibParchOut", "", "", "ttDefects", "", "outTurn");

?>