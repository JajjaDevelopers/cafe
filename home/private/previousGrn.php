grn_no, grn_date, grn_time_in, customer_id, grade_id, grn_mc, no_of_bags, grn_qty, grn_status,
 batch_order_no, purpose, origin, delivery_person, truck_no, driver, quality_remarks, prepared_by, 
 verified_by, approved_by
 <?php include ("../connection/databaseConn.php"); ?>
<?php
$grnDetailsSql = $conn->prepare("SELECT * FROM grn WHERE grn_no=?");
$grnDetailsSql->bind_param("i", $grnNo); //get grn to execute

$grnDetailsSql->execute();
$result = $grnDetailsSql->get_result();
$row = $result -> fetch_assoc();

$grn_no = $row["grn_no"];
$grn_date = $row["grn_date"];
$grn_time_in = $row["grn_time_in"];
$customer_id = $row["customer_id"];
$grn_mc = $row["grn_mc"];
$no_of_bags = $row["no_of_bags"];
$grn_qty = $row["grn_qty"];
$purpose = $row["purpose"];
$origin = $row["origin"];
$delivery_person = $row["delivery_person"];
$truck_no = $row["truck_no"];
$driver = $row["driver"];
$quality_remarks = $row["quality_remarks"];
$prepared_by = $row["prepared_by"];
$verified_by = $row["verified_by"];
$approved_by = $row["approved_by"];






















 ?>