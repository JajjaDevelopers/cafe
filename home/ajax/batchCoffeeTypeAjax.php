<?php include "../private/database.php"; ?>
<?php
if($conn->connect_error) {
  exit('Could not connect');
}
?>
<?php
//Get Coffee Type
$typeSql = $conn->prepare("SELECT coffee_type, grade_id, batch_order_input_qty, batch_order_mc, batch_order_date, grade_name
                          FROM grades
                          JOIN grn USING (grade_id)
                          JOIN batch_processing_order USING (batch_order_no)
                          WHERE batch_order_no=?");
$batch_order_no = $_GET['q'];
$typeSql->bind_param("i", $batch_order_no);
$typeSql->execute();
$typeSql->bind_result($type, $grade_id, $batch_order_input_qty, $batch_order_mc, $batch_order_date, $grade_name);
$typeSql->fetch();
$typeSql->close();
$typ1 = $type;
$gradeId = $grade_id;
$inputQty = $batch_order_input_qty;
$inputMc = $batch_order_mc;
$orderDate = $batch_order_date;
$gradeName = $grade_name;
$batchData = json_encode([$typ1, $gradeId, $inputQty, $inputMc, $orderDate, $gradeName]);
echo $batchData;


//Generate grades
//Batch returns based on coffee type
//Generate grades

?>