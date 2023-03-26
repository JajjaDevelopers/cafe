<?php
include ("../private/connlogin.php");
include "../private/functions.php";
$contNo = $_GET["contNo"];
$newBatchNo = "CRT-".$contNo;
$no = intval($contNo);

$summSql = $conn->prepare("SELECT customer_id, customer_name, country_name, continent, reference_no, contract_date, 
                offer_status, shipment_date, incoterms, sourcing_actions, financing_source, remarks, prepared_by, contact_person, 
                telephone, (SELECT currency FROM contract_offers WHERE contract_no=? LIMIT 1) AS currecnty
                FROM contracts_summary
                JOIN countries USING (country_id) JOIN customer USING (customer_id)  WHERE contract_no=?");
$summSql->bind_param("ii", $no, $no);
$summSql->execute();
$summSql->bind_result($cltId, $cltName, $countryName, $continent, $contRef, $contDate, $status, $shipDate, $terms, $sourcing, 
                    $financing, $remarks, $prepared_by, $cltTel, $cltContact, $currency);
$summSql->fetch();
$summSql->close();


//items

function contractsOfferTable(){
    include ("../private/connlogin.php");
    global $no;
    global $ttQty, $ttValue;
    $detSql = $conn->prepare("SELECT grade_id, grade_description, qty, avg_price FROM contract_offers
                            WHERE contract_no=?");
    $detSql->bind_param("i", $no);
    $detSql->execute();
    $detSql->bind_result($grdId, $grdDesc, $qty, $price);

    $x=1;
    $ttQty=0;
    $ttValue=0;
    while ($detSql->fetch()){ //check the length of pick item function
        $ttQty+=$qty;
        $ttValue+=$qty*$price;
        ?>
        <tr>
            <td><?=$x?></td>
            <td><input type="text" value="<?=$grdId?>" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="tableInput" style="width: 70px;"></td>
            <td>
                <div id="<?='item'.$x.'Field'?>" style="display: grid;">
                    <input type="text" value="<?=$grdDesc?>" id="<?='item'.$x.'Name'?>" readonly name="<?='item'.$x.'Name'?>" class="itmNameInput" style="grid-column: 1; width: 270px">
                    <select id="<?='item'.$x.'Select'?>" style="margin: 0px; width: 20px; grid-column: 2;" class="itemSelect" onchange="pickItem()">
                        <?php CoffeeGrades();?>
                    </select>
                </div>
            </td>
            <td><input type="text" value="<?=num($qty)?>" id="<?='item'.$x.'Qty'?>"  name="<?='item'.$x.'Qty'?>" class="tblNum" step="0.01" onblur="updateInput()"></td>
            <td><input type="text" value="<?=num($price)?>" id="<?='item'.$x.'Price'?>"  name="<?='item'.$x.'Price'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td><input type="text" value="<?=num($qty*$price)?>" id="<?='item'.$x.'AMount'?>" readonly name="<?='item'.$x.'AMount'?>" step="0.001" class="tblNum"></td>
        </tr>
        <script>document.getElementById("<?='item'.$x.'Select'?>").style.display="none"; </script>
        <?php
        $x+=1;
    }
}

?>