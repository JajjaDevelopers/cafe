<?php session_start(); ?>
<?php include "../connection/databaseConn.php"; ?>

<?php

$gradeSql = $conn->prepare("SELECT grade_id, grade_name FROM grn 
                            JOIN grades USING (grade_id)
                            WHERE (customer_id=? AND purpose='Processing' AND batch_order_no=0 )
                            GROUP BY grade_id");


$customer_id = ($_GET['q']);

$gradeSql->bind_param("s", $customer_id);
$gradeSql->execute();
$allGrns = $gradeSql -> get_result();
$rows = $conn -> affected_rows;

echo '<option></option>';
for ($gradeNo=1; $gradeNo <= $rows; $gradeNo++){
    $gradeRow = $allGrns -> fetch_assoc();
    $id = $gradeRow['grade_id'];
    $name = $gradeRow['grade_name']
    // $gradeName = $gradeRow['grade_name'];
?>

    <option value="<?= $id ?>"><?= $name ?></option>;
   <?php
}




?>