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
    $sql = $conn->prepare("SELECT drying_no, drying_date, customer_name, grade_name, input_qty, input_mc, output_qty, output_mc 
                            FROM drying JOIN customer USING (customer_id) JOIN grades USING (grade_id)
                            WHERE (drying_date BETWEEN ? AND ?)");
    
    $sql->bind_param("ss", $frmDate, $toDate);
}else{
    $sql = $conn->prepare("SELECT drying_no, drying_date, customer_name, grade_name, input_qty, input_mc, output_qty, output_mc 
                            FROM drying JOIN customer USING (customer_id)  JOIN grades USING (grade_id)
                            WHERE (drying_date BETWEEN ? AND ? AND customer_id=?)");
                            
    $sql->bind_param("sss", $frmDate, $toDate, $client);
}

$sql->execute();
$sql->bind_result($no, $dryDate, $client, $grdName, $inQty, $inMc, $outQty, $outMc);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 100px;">Dry No</th>
            <th style="width: 100px;">Date</th>
            <th >Client Name</th>
            <th >Grade</th>
            <th style="width: 100px;">Input (Kg)</th>
            <th style="width: 70px;">MC In (%)</th>
            <th style="width: 100px;">Output (Kg)</th>
            <th style="width: 70px;">MC Out (%)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dryList = array(["Dry No", "Date", "Client Name", "Grade", "Input (Kg)", "MC In (%)", "Output (Kg)", "MC Out (%)"]);
        while ($sql->fetch()){
            $dryRow = [$no, $dryDate, $client, $grdName, $inQty, $inMc, $outQty, $outMc];
            array_push($dryList, $dryRow);
           ?>
           <tr>
                <td><a href="../transactions/drying?dryNo=<?=$no?>"> <?=$no?> </a></td>
                <td><?=$dryDate?></td>
                <td><?=$client?></td>
                <td><?=$grdName?></td>
                <td style="text-align: center;"><?=$inQty?></td>
                <td style="text-align: right;"><?=$inMc?></td>
                <td style="text-align: center;"><?=$outQty?></td>
                <td style="text-align: right;"><?=$outMc?></td>
           </tr>
           <?php
        }
        
        ?>
    </tbody>
</table>
<?php
$dryListResult = json_encode($dryList);
// echo $grnListResult;
// echo $grnListResult;
// var_dump($grnList);
$_SESSION["goodsreceivedData"] = $dryListResult;
// echo $_SESSION["goodsreceivedData"];
$sql->close();
?>
