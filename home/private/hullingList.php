<?php
session_start();
include("../private/functions.php");
include ("../private/connlogin.php");
?>

<?php
$frmDate = $_GET["startDate"]; 
$toDate = $_GET["endDate"];
$client = $_GET["custId"];

//criteria
if ($client == "all"){
    $sql = $conn->prepare("SELECT hulling_no, hulling_date, customer_name, 
                            (SELECT grade_name FROM grades WHERE hulling.input_grade_id=grades.grade_id) AS input, input_qty,
                            (SELECT grade_name FROM grades WHERE hulling.output_grade_id=grades.grade_id) AS output, output_qty 
                            FROM hulling JOIN customer USING (customer_id)
                            WHERE (hulling_date BETWEEN ? AND ?)");
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT hulling_no, hulling_date, customer_name, 
                            (SELECT grade_name FROM grades WHERE hulling.input_grade_id=grades.grade_id) AS input, input_qty,
                            (SELECT grade_name FROM grades WHERE hulling.output_grade_id=grades.grade_id) AS output, output_qty 
                            FROM hulling JOIN customer USING (customer_id)
                            WHERE (hulling_date BETWEEN ? AND ? AND customer_id=?)");
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}

$sql->execute();
$sql->bind_result($hullNo, $hullDate, $hullClt, $inGrd, $inQty, $outGrd, $outQty);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 60px;">Hulling No</th>
            <th style="width: 80px;">Date</th>
            <th >Client Name</th>
            <th style="width: 200px;">Input Grade</th>
            <th style="width: 80px;">Input Qty (Kg)</th>
            <th style="width: 200px;">Output Grade</th>
            <th style="width: 80px;">Output Qty (Kg)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hullList = array(["Hulling No", "Date", "Client Name", "Input Grade", "Input Qty (Kg)", "Output Grade", "Output Qty (Kg)"]);
        while ($sql->fetch()){
            $hullRow = [$hullNo, $hullDate, $hullClt, $inGrd, $inQty, $outGrd, $outQty];
            array_push($hullList, $hullRow);
           ?>
           <tr>
                <td><a href="../transactions/hulling?hullNo=<?=$hullNo?>"> <?=$hullNo?> </a></td>
                <td><?=$hullDate?></td>
                <td><?=$hullClt?></td>
                <td><?=$inGrd?></td>
                <td style="text-align: right;"><?=$inQty?></td>
                <td style="text-align: left;"><?=$outGrd?></td>
                <td style="text-align: right;"><?=$outQty?></td>
           </tr>
           <?php
        }
        $hullListResult = json_encode($hullList);
        // echo $hullListResult;
        $_SESSION["hullData"] = $hullListResult;
        // echo $_SESSION["hullData"];
        ?>
    </tbody>
</table>
