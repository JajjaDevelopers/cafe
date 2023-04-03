<?php

include ("../private/connlogin.php");
include "../private/functions.php";
$contNo = $_GET["contNo"];
// $stt = $_GET["stt"];
// if ($stt=='1'){
//     $status="Pending Stock Allocation";
// }elseif($stt=='2'){
//     $status="Pending Shipment";
// }

$newBatchNo = "COF-".$contNo;
$no = intval($contNo);
$_SESSION['offerNum']=$no;
$offerNum = $_SESSION['offerNum'];

$summSql = $conn->prepare("SELECT customer_id, customer_name, country_name, continent, reference_no, contract_date, 
                incoterms, sourcing_actions, financing_source, remarks, prepared_by, contact_person, 
                telephone, (SELECT currency FROM contract_offers WHERE contract_no=? LIMIT 1) AS currecnty, cotract_type, 
                container_size, contracts_summary.category, city,
                (SELECT country_name FROM countries WHERE customer.country_id=countries.country_id) As cusCountry
                FROM contracts_summary
                JOIN countries USING (country_id) JOIN customer USING (customer_id)  WHERE contract_no=?");
$summSql->bind_param("ii", $offerNum, $offerNum);
$summSql->execute();
$summSql->bind_result($cltId, $cltName, $countryName, $continent, $contRef, $contDate, $terms, $sourcing, 
                    $financing, $remarks, $prepared_by, $cltTel, $cltContact, $currency, $contType, $contSize, $category, 
                    $cltCity, $cusCountry);
$summSql->fetch();
$summSql->close();

$dtSql = $conn->prepare("SELECT MONTHNAME(NOW()), DAY(NOW()), YEAR(NOW())");
$dtSql->execute();
$dtSql->bind_result($month, $day, $year);
$dtSql->fetch();
$dtSql->close();


//items

function contractsOfferTable(){
    include ("../private/connlogin.php");
    global $no, $contSize;
    global $ttQty, $ttValue;
    $currSql = $conn->prepare("SELECT currency FROM contract_offers WHERE contract_no=? LIMIT 1");
    $currSql->bind_param("i",$no);
    $currSql->execute();
    $currSql->bind_result($currency);
    $currSql->fetch();
    $currSql->close();

    $detSql = $conn->prepare("SELECT item_no, grade_id, grade_name, grade_description, containers, bags, qty, price_ref, currency,
                    avg_price, quality_premium, social_premium, gi_premium, shipment_date FROM contract_offers 
                    JOIN grades USING (grade_id)
                    WHERE contract_no=?");
    $detSql->bind_param("i", $no);
    $detSql->execute();
    $detSql->bind_result($itmNo, $grdId, $grdName, $grdDesc, $containers, $bags, $qty, $pxRef, $currency, $price, $qltPrem, $socPrem, $giPrem, 
                            $shipDate);

    $x=1;
    $ttContainers=0;
    $ttbags=0;
    $ttQty=0;
    $ttValue=0;
    ?>
    <table>
        <thead>
            <tr>
                <th style="width: 20px;" id="noCol">#</th>
                <th style="width: 80px; display:none">Item Code</th>
                <th style="width: 150px;" id="itmDescCol">Item Description</th>
                <th style="width: 200px;">Particulars</th>
                <th style="width: 50px;"><label id="containerSize"><?="Number of ".$contSize." Containers"?></label></th>
                <th style="width: 50px;">Bags</th>
                <th style="width: 100px;">Qty (Kg)</th>
                <th style="width: 200px;"><label>Price USD per MT FOT Kampala</label></th>
                <th style="width: 70px;" id="currencyHeader"><?="Base Price ".$currency."/Kg"?></th>
                <th style="width: 70px;" id="giHeader"><?="GI Premium ".$currency."/Kg"?></th>
                <th style="width: 70px;" id="socialHeader"><?="Social Premium ".$currency."/Kg"?></th>
                <th style="width: 70px;" id="qualityHeader"><?="Quality Premium ".$currency."/Kg"?></th>
                <th style="width: 80px;" id="totalPriceHeader"><?="Price ".$currency."/Kg"?></th>
                <th style="width: 90px;" id="shipmentHeader">Shipment Date</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while ($detSql->fetch()){ //check the length of pick item function
        $amount = $price+$giPrem+$socPrem+$qltPrem;
        $ttContainers+=$containers;
        $ttbags+=$bags;
        $ttQty+=$qty;
        $ttValue+=$qty*$price;
        ?>
        <tr>
            <td id="<?='item'.$x.'No'?>"><?=$x?></td>
            <td style="display: none;" ><input type="text" value="" id="<?='item'.$x.'Code'?>" readonly name="<?='item'.$x.'Code'?>" class="tableInput" style="width: 70px"></td>
            <td id="<?='item'.$x.'NameCol'?>" name="<?='item'.$x.'Name'?>"><?=$grdName?></td>
            <td id="<?='item'.$x.'QualitySpecs'?>" name="<?='item'.$x.'QualitySpecs'?>"><?=$grdDesc?></td>
            <td><input type="text" value="<?=$containers?>" id="<?='item'.$x.'Containers'?>" readonly name="<?='item'.$x.'Containers'?>" class="tblNum" step="0.01" ></td>
            <td><input type="text" value="<?=$bags?>" id="<?='item'.$x.'Bags'?>" readonly name="<?='item'.$x.'Bags'?>" class="tblNum" step="0.01" ></td>
            <td><input type="text" value="<?=num($qty)?>" id="<?='item'.$x.'Qty'?>" readonly name="<?='item'.$x.'Qty'?>" class="tblNum" step="0.01" onblur="updateInput()"></td>
            <td id="<?='item'.$x.'pxRef'?>"  name="<?='item'.$x.'pxRef'?>"><?=$pxRef?></td>
            <td id="<?='item'.$x.'priceCol'?>"><input type="text" value="<?=num($price)?>" id="<?='item'.$x.'Price'?>" readonly name="<?='item'.$x.'Price'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td id="<?='item'.$x.'giCol'?>"><input type="text" value="<?=num($giPrem)?>" id="<?='item'.$x.'GiPrem'?>" readonly name="<?='item'.$x.'GiPrem'?>" class="tblNum"></td>
            <td id="<?='item'.$x.'socCol'?>"><input type="text" value="<?=num($socPrem)?>" id="<?='item'.$x.'SocialPrem'?>" readonly name="<?='item'.$x.'SocialPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td id="<?='item'.$x.'qltCol'?>"><input type="text" value="<?=num($qltPrem)?>" id="<?='item'.$x.'QualityPrem'?>" readonly name="<?='item'.$x.'QualityPrem'?>" class="tblNum" step="0.0001" onblur="updateInput()"></td>
            <td id="<?='item'.$x.'amtCol'?>"><input type="text" value="<?=num($amount)?>" id="<?='item'.$x.'AMount'?>" readonly name="<?='item'.$x.'AMount'?>" step="0.001" class="tblNum"></td>
            <td><input type="text" value="<?=$shipDate?>" id="<?='item'.$x.'ShipDate'?>" readonly name="<?='item'.$x.'ShipDate'?>" class="tableInput" style="width: 90px;"></td>

        </tr>
        <script>
        document.getElementById("<?='item'.$x.'Select'?>").style.display="none";
        </script>
        <?php
        $x+=1;
    }
    $_SESSION['offerItems']=$x-1;
    ?>
        <tr id="totalsRow" style="display: none;">
                <td >Total</td>
                <td><input type="text" value="<?=round($ttContainers,0)?>" id="totalContainer" readonly class="tblNum"></td>
                <td ><input type="text" value="<?=round($ttbags,0)?>" id="totalBags" readonly class="tblNum"></td>
                <td><input type="text" value="<?=num($ttQty)?>" id="totalQty" readonly  class="tblNum"></td>
                <td><input type="number" value="" id="total" readonly class="tblNum"></td>
                <td><input type="number" value="" id="total" readonly class="tblNum"></td>
            </tr>
        </tbody>
    </table>
    <?php
}

//terms
function terms(){
    include ("../private/connlogin.php");
    global $no;
    $sql = $conn->prepare("SELECT no, term FROM offer_terms WHERE contract_no=?");
    $sql->bind_param("i", $no);
    $sql->execute();
    $sql->bind_result($tNo, $term);
    ?>
    <br>
    <div class="container" style="margin-bottom: 0px;">
        <div class="row">
            <div class="col-sm-12">
                <label for="offerTerms">Terms</label>
            </div>
        </div>
    </div>
    <table style="border:0px solid; margin-left:30px;">
        <tbody>
            <?php
            while($sql->fetch()){
            ?>
            <tr style="border:0px solid">
                <td style="border:0px solid; "><?=$tNo.'.'?></td>
                <td style="width: 800px; border:0px solid"><?=$term?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    
    <?php
}
?>
