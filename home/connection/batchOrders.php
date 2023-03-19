<?php
session_start();
//include("../private/functions.php");
include ("../private/connlogin.php");

$action = $_GET["act"];
$status = "Pending ".$action;
if ($action=="Grading"){
    $link = "batchReport";
}elseif($action=="Hulling"){
    $link = "hulling";
}elseif($action=="Drying"){
    $link = "drying";
}

$sql = $conn->prepare("SELECT batch_order_no, customer_name, activity, grade_name, batch_order_input_qty, start_date, 
                    end_date, status, prepared_by
                    FROM batch_processing_order JOIN grades USING (grade_id) JOIN customer USING (customer_id)
                    WHERE (activity=? AND status=?)");
$sql->bind_param("ss", $action, $status);
$sql->execute();
$sql->bind_result($no, $client, $activity, $grade, $qty, $start, $end, $status, $prepBy);

?>
<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white;">
            <th style="width: 30px;">#</th>
            <th style="width: 50px;">Order N0.</th>
            <th>Client</th>
            <th >Item</th>
            <th style="width: 100px;">Start Date</th>
            <th style="width: 100px;">End Date</th>
            <th style="width: 100px;">Qty (Kg)</th>
            <th>Initiated By</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $x=1;
        while ($sql->fetch()){
           ?>
           <tr>
                <td><?=$x?></td>
                <td><a href="../processing/<?=$link?>?transNo=<?=$no?>"> <?=$no?></a></td>
                <td><?=$client?> </td>
                <td><?=$grade?></td>
                <td><?=$start?></td>
                <td><?=$end?></td>
                <td style="text-align: right;"><?=num($qty)?></td>
                <td><?=$prepBy?></td>
           </tr>
           <?php
           $x+=1;
        }
        ?>
    </tbody>
</table>