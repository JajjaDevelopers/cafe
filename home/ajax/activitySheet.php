<?php
include "../private/connlogin.php";
include "../private/functions.php";
$function = $_GET['fun'];

function itemUnit(){
    include "../private/connlogin.php";
    $id = $_GET['id'];
    $sql = $conn->prepare("SELECT unit_symbol FROM grades WHERE grade_id=?");
    $sql->bind_param("s", $id);
    $sql->execute();
    $sql->bind_result($unit);
    $sql->fetch();
    echo $unit;
}


function activitySheetList(){
    include "../private/connlogin.php";
    $frmDate = $_GET["startDate"]; 
    $toDate = $_GET["endDate"];
    $client = $_GET["custId"];

    if ($client == "all"){
        $sql = $conn->prepare("SELECT activity_sheet_no, activity_date, customer_name, grade_name, qty, 
                        (SELECT sum(qty*rate) FROM roastery_activity_details 
                        WHERE roastery_activity_summary.activity_sheet_no=roastery_activity_details.activity_sheet_no) AS value 
                        FROM roastery_activity_summary JOIN customer USING (customer_id) JOIN grades USING (grade_id)
                        WHERE activity_date BETWEEN ? AND ?");
        
        $sql->bind_param("ss", $frmDate, $toDate);
    }else{
        $sql = $conn->prepare("SELECT activity_sheet_no, activity_date, customer_name, grade_name, qty, 
                        (SELECT sum(qty*rate) FROM roastery_activity_details 
                        WHERE roastery_activity_summary.activity_sheet_no=roastery_activity_details.activity_sheet_no) AS value 
                        FROM roastery_activity_summary JOIN customer USING (customer_id) JOIN grades USING (grade_id)
                        WHERE (activity_date BETWEEN ? AND ? AND customer_id=?)");
                                
        $sql->bind_param("sss", $frmDate, $toDate, $client);
    }
    
    $sql->execute();
    $sql->bind_result($no, $date, $client, $grade, $qty, $value);
    ?>
    <table class="table table-striped table-hover table-condensed table-bordered">
        <thead style="background-color: green; color:white;">
            <tr>
                <th style="width: 100px;">Activity No</th>
                <th style="width: 100px;">Date</th>
                <th >Client Name</th>
                <th >Input Grade</th>
                <th style="width: 100px;">Input Qty (Kg)</th>
                <th style="width: 150px;">Activity Value</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($sql->fetch()){
        ?>
        <tr>
            <td><a href="../transactions/activitySheet?actNo=<?=$no?>"> <?=$no?> </a></td>
            <td><?=$date?></td>
            <td><?=$client?></td>
            <td><?=$grade?></td>
            <td style="text-align: right;"><?=num($qty)?></td>
            <td style="text-align: right;"><?=num($value)?></td>
        </tr>
        <?php
    }
    ?>
        </tbody>
    </table>
    <?php

    

}




if ($function=="list"){
    activitySheetList();
}elseif($function=="unit"){
    itemUnit();
}
?>
