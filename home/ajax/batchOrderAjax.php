<?php session_start(); ?>
<?php include "../connection/databaseConn.php"; ?>

<?php

$gradeSql = $conn->prepare("SELECT grn_no FROM grn WHERE (customer_id=? AND grade_id=? AND purpose='Processing' AND batch_order_no=0 )");

$gradeAndCustomer = str_split($_GET['q'], 6);
$grade_id = $gradeAndCustomer[0];
$customer_id = $gradeAndCustomer[1];

$gradeSql->bind_param("ss", $customer_id, $grade_id);
$gradeSql->execute();
$allGrns = $gradeSql -> get_result();
$rows = $conn -> affected_rows;

echo '<option></option>';
for ($gradeNo=1; $gradeNo <= $rows; $gradeNo++){
    $gradeRow = $allGrns -> fetch_assoc();
    $id = $gradeRow['grn_no'];
    // $gradeName = $gradeRow['grade_name'];
?>

    <option value="<?= $id ?>"><?= $id ?></option>;
   <?php
}




?>