<?php
include ("../private/database.php");
if($mysqli->connect_error) {
  exit('Could not connect');
}
?>
<?php


// $sql = "SELECT customer_id, customer_name, contact_person, telephone, grn_no, grade_name, batch_order_input_qty 
// FROM batch_reports_summary 
// JOIN batch_processing_order USING (batch_order_no) 
// JOIN grn USING (batch_order_no) 
// JOIN customer USING (customer_id) 
// WHERE (batch_report_no=?";

$sql = "SELECT customer_id, customer_name, contact_person, telephone, grn_no, grade_name, batch_order_input_qty
FROM batch_reports_summary
JOIN batch_processing_order USING (batch_order_no)
JOIN grn USING (batch_order_no)
JOIN customer USING (customer_id)
WHERE (batch_report_no=?)";

$stmt = $mysqli->prepare($sql);

$supplierSummary = ($_GET['q']);
$batchNo = substr($supplierSummary, 0, 6);

$stmt->bind_param("i", $batchNo);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($cid, $name, $contactPerson, $tel, $grnNo, $gradeName, $inputQty);
$stmt->fetch();
$stmt->close();

echo '<input id="cid" value="'.$cid.'">';
echo '<input id="name" value="'.$name.'">';
echo '<input id="contactPerson" value="'.$contactPerson.'">';
echo '<input id="tel" value="+256'.$tel.'">';
echo '<input id="grnNo" value="'.$grnNo.'">';
echo '<input id="gradeName" value="'.$gradeName.'">';
echo '<input id="inputQty" value="'.$inputQty.'">';





// if ($stmt = $con->prepare($query)) {
//     $stmt->execute();
//     $stmt->bind_result($customer_id, $customer_name, $contact_person, $telephone, $grn_no, $grade_name, $batch_order_input_qty);
//     while ($stmt->fetch()) {
//         //printf("%s, %s, %s, %s, %s, %s, %s\n", $customer_id, $customer_name, $contact_person, $telephone, $grn_no, $grade_name, $batch_order_input_qty);
//     }
//     $stmt->close();
// }
?>