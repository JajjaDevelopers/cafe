<?php include "../connection/databaseConn.php"; ?>

<?php

$gradeSql = $conn->prepare("SELECT grade_id, grade_name FROM grades WHERE coffee_type=?");

$coffeeType = ($_GET['q']);

$gradeSql->bind_param("s", $coffeeType);
$gradeSql->execute();
$allGrades = $gradeSql -> get_result();
$rows = $conn -> affected_rows;

echo '<option></option>';
for ($gradeNo=1; $gradeNo <= $rows; $gradeNo++){
    $gradeRow = $allGrades -> fetch_assoc();
    $id = $gradeRow['grade_id'];
    $gradeName = $gradeRow['grade_name'];

    echo '<option value="'.$id.'">'.$gradeName.'</option>';
   
}











?>