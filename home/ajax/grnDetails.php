<?php include "../connection/databaseConn.php"; ?>

<?php

$grnSql = $conn->prepare("SELECT grn_date, grade_id, grade_name, grn_qty, grn_mc FROM grn 
                        JOIN grades USING(grade_id)
                        WHERE grn_no=?");

$grnNo = ($_GET['q']);

$grnSql->bind_param("s", $grnNo);
$grnSql->execute();
$allGrades = $grnSql -> get_result();

$gradeRow = $allGrades -> fetch_assoc();
$grn_date = $gradeRow['grn_date'];
$grade_id = $gradeRow['grade_id'];
$grade_name = $gradeRow['grade_name'];
$grn_qty = $gradeRow['grn_qty'];
$grn_mc = $gradeRow['grn_mc'];
?>

<input id="grnDate" value="<?= $grn_date?>"></input>;
<input id="grnGrade" value="<?= $grade_name?>"></input>;
<input id="grnQty" value="<?= $grn_qty?>"></input>;
<input id="grnMc" value="<?= $grn_mc?>"></input>;










