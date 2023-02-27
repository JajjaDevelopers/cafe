<?php
$grn = $_SESSION["grn"];
$grnNo = "GRN-" . $_SESSION["grn"];
$grnSql = $conn->prepare("SELECT grn_no, grn_date, grn_time_in, customer_id, grade_id, grn_mc, no_of_bags, 
                        grn_qty, grn_status, batch_order_no, purpose, grn.district_id, delivery_person, truck_no,
                        driver, quality_remarks, prepared_by, verified_by, approved_by, grade_name, 
                        customer_name, coffee_type, contact_person, telephone, district_name, region, type_category, 
                        prep_time, ver_time, appr_time FROM grn 
                        JOIN districts USING (district_id) JOIN grades USING (grade_id) 
                        JOIN customer USING (customer_id) WHERE grn_no=?");
$grnSql->bind_param("s", $grn);
$grnSql->execute();
$grnSql->bind_result($grn_no, $grn_date, $grn_time_in, $cltId, $grade_id, $grn_mc, $no_of_bags, $grn_qty, 
                    $grn_status, $batch_order_no, $purpose, $origin, $delivery_person, $truck_no, $driver, 
                    $quality_remarks, $prepared_by, $verified_by, $approved_by, $grade_name, $cltName, 
                    $coffee_type, $cltContact , $cltTel , $distName, $regName, $type_category, $prep_time, 
                    $ver_time, $appr_time);
$grnSql->fetch();
$grnSql->close();

//getting users names

$prepBy = userFullName($prepared_by);
$verpBy = userFullName($verified_by);
$apprpBy = userFullName($approved_by);

?>