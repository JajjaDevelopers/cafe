<?php
session_start();
include "../private/database.php";
$type = $_GET["type"];
$category = $_GET["category"];
$grade = $_GET["grade"];
$date = $_GET["date"];
$client = $_GET["client"];
if ($client == "all"){
    $clientName = "all customers";
}else{
    $clientName = getName("customer", "customer_name", "customer_id", $client);
}

$expResults = array(["ID", "Item", "Qty In", "Qty Out", "Balance"]);

//customer filter
if ($client == "all"){
    if ($type == "all"){
        $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) WHERE trans_date<=?  GROUP BY grade_id");
        $balSql->bind_param("s", $date);
    }else {
        if ($category == "all"){
            $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) WHERE (coffee_type=? AND trans_date<=?)
                            GROUP BY grade_id");
            $balSql->bind_param("ss", $type, $date);
        }else{
            if ($grade == "all"){
                $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) 
                            WHERE (coffee_type=? AND type_category=? AND trans_date<=?) GROUP BY grade_id");
                $balSql->bind_param("sss", $type, $category, $date);
            }else{
                $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) 
                            WHERE (coffee_type=? AND type_category=? AND grade_id=? AND trans_date<=?)
                            GROUP BY grade_id");
                $balSql->bind_param("ssss", $type, $category, $grade, $date);
    
            }
        }
    }
}else{
    if ($type == "all"){
        $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) WHERE (trans_date<=? AND customer_id=?)  GROUP BY grade_id");
        $balSql->bind_param("ss", $date, $client);
    }else {
        if ($category == "all"){
            $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) WHERE (coffee_type=? AND trans_date<=? AND customer_id=?)
                            GROUP BY grade_id");
            $balSql->bind_param("sss", $type, $date, $client);
        }else{
            if ($grade == "all"){
                $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) 
                            WHERE (coffee_type=? AND type_category=? AND trans_date<=? AND customer_id=?) GROUP BY grade_id");
                $balSql->bind_param("ssss", $type, $category, $date, $client);
            }else{
                $balSql = $conn->prepare("SELECT grade_id, grade_name, sum(qty_in) AS qty_in, sum(qty_out) AS qty_out, 
                            (sum(qty_in) - sum(qty_out)) AS balance FROM inventory
                            JOIN grades USING (grade_id) 
                            WHERE (coffee_type=? AND type_category=? AND grade_id=? AND trans_date<=? AND customer_id=?)
                            GROUP BY grade_id");
                $balSql->bind_param("sssss", $type, $category, $grade, $date, $client);
    
            }
        }
    }
}


//Coffee Type filter sql


$balSql->execute();
$balSql->bind_result($grade_id, $grade_name, $qty_in, $qty_out, $balance);
?>
Stock Balances for <?= $clientName ?> as at <?= $date ?>

<table class="table table-striped table-hover table-condensed table-bordered">
    <thead>
        <tr style="background-color: green; color:white">
            <th>ID</th>
            <th>Item</th>
            <th>Qty In</th>
            <th>Qty Out</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($balSql->fetch()){
            $row = array();
            ?>
        <tr>
            <td><?= $grade_id ?></td>
            <td><?= $grade_name ?></td>
            <td style="text-align: right;"><?= $qty_in ?></td>
            <td style="text-align: right;"><?= $qty_out ?></td>
            <td style="text-align: right;"><?= $balance ?></td>
        </tr>
        <?php
        array_push($row, $grade_id, $grade_name, $qty_in, $qty_out, $balance);
        array_push($expResults, $row);
    }
        $stockBalanceData = json_encode($expResults);
        $_SESSION["stockBalanceData"] = $stockBalanceData;
        
       
    ?>
    </tbody>
</table>


