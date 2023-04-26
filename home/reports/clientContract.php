<?php 
$pageTitle="Client Contract Offer";
include_once ("../forms/header.php");
$contNo=$_GET['contNo'];
include "../private/contractOfferVariables.php";
$offerItems=$_SESSION['offerItems'];

?>
<form id="mainForm" class="regularForm" method="post" action="../connection/contractOffer.php" style="width: 794px; height:fit-content; background-color:white">
    <div style="height:907px;">
        <br>
        <img id="printPageHeader" src="../assets/img/nucafeHeader.jpg" style="width: 780px; height: 120px">
        <br><br>
        <p style="text-align: right; margin-right: 40px;"><?=$month.' '.$day.', '.$year?></p>
        <div class="container">
            <div class="row">
                <div class="col-2" style="width:fit-content">
                    <label>Our Ref:</label><br>
                    <label >To:</label><br><br>
                </div>
                <div class="col-10" style="grid-column: 2; grid-row: 1;">
                    <label ><?=$contRef?></label><br>
                    <input value="<?=$cltName?>" style="border: none;" readonly><br>
                    <input value="<?=$cltCity.', '.$cusCountry?>" placeholder="physical address" style="width:500px; border:none">
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-12" style="width:fit-content">
                    <label>Dear</label><input value="<?=' '.'Sir/Madam'?>" style="border: none;">
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-12" style="width:fit-content">
                    <label>RE:<input value="<?=' '.'SHIPMENT'?>" style="border: none; width:500px"></label>
                </div>
            </div>
        </div>
        <input type="text" id="port" name="port" class="longInputField" value="<?=$port?>" style="display: none;" readonly>
        <input type="text" id="incoterms" name="incoterms" readonly value="<?=$terms?>" class="shortInput" style="display: none;">
        <?php
        contractsOfferTable();
        terms();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <input value="<?='Yours Sincerely;'?>" style="border: none;" readonly><br>
                    <img src="../assets/img/DavidSignature.jpg" style="width: 90px; height:70px;"><br>
                    <input value="<?='Muwonge David'?>" style="border: none;" readonly><br>
                    <label>Chief Commercial Officer</label>
                </div>
                <div class="col-6">
                    <img src="../assets/img/nucafeStamp.png" style="width: 200px; height:130px;">
                </div>
            </div>
        </div>
    </div>
    <div id="printPageFooter" style="height:100px; ">
        <p style="text-align: center; margin:0px">Plot 35, Jinja Road, Coffee House, 2nd Floor, Suite 2.7 P. O Box 34967, Kampala</p>
        <p style="text-align: center; margin:0px">Tel: &#43;256 &#45; 414 &#45; 236199, Fax: &#43;256 &#45; 414 &#45; 236199</p>
        <p style="text-align: center; margin:0px">Email: nucafe@nucafe.org, Website: www.nucafe.org</p>
        <p style="text-align: center; margin:0px"><b>Hope for Rural Wealth Creation</b></p>
    </div>
    <div class=" mt-3 me-5 d-flex flex-row justify-content-between">
        <a href="../reports/salesContracts.php" class="btn btn-link" id="btnback" style="color:green">Back</a>
        <i class="bi bi-printer-fill" style="color:green; font-size:30px" id="print">
        </i>
    </div>
    
</form>
<?php include "../forms/footer.php" ?>
<script>
    //print
    document.getElementById("print").addEventListener("click",()=>{
        //an array to collect ids of elements
        const idsArray=['footer','divheader','sidebar','btnback','print'];
        idsArray.forEach(id => {
        document.getElementById(id).style.display="none";
        });

    document.getElementById("mainForm").style.border="none";
    document.getElementById("printPageHeader").style.position="fixed";
    document.getElementById("printPageHeader").style.top="0";

    document.getElementById("printPageFooter").style.position="fixed";
    document.getElementById("printPageFooter").style.bottom="0";
    document.getElementById("printPageFooter").style.width="100%";
  
    // position:fixed; bottom:0
    window.print();
    idsArray.forEach(id => {
        document.getElementById(id).style.display="block";
        });

    document.getElementById("print").style.display="block";
    document.getElementById("mainForm").style.border="1px solid brown";
    document.getElementById("printPageFooter").style.display="block";
    document.getElementById("printPageFooter").style.position="";
    document.getElementById("printPageHeader").style.display="block";
    document.getElementById("printPageHeader").style.position="";
})

</script>
<script>
    var totalGi = 0;
    var totalSoc = 0;
    var totalQlt =0;
    const offerItems=Number(<?=$offerItems?>);
    
    for (var x=1;x<=offerItems;x++){
        var gi=Number(document.getElementById('item'+x+'GiPrem').value);
        totalGi+=gi;
        var social=Number(document.getElementById('item'+x+'SocialPrem').value);
        totalSoc+=social;
        // var quality=Number(document.getElementById('item'+x+'QualityPrem').innerHTML);
        // totalQlt+=quality;

    }
    if (totalGi<=0){
        document.getElementById("giHeader").style.display="none";
        for (var x=1;x<=offerItems;x++){
            document.getElementById('item'+x+'giCol').style.display="none";
        }
        
    }
    if (totalSoc<=0){
        document.getElementById("socialHeader").style.display="none";
        for (var x=1;x<=offerItems;x++){
            document.getElementById('item'+x+'socCol').style.display="none";
        }
        
    }


    var noDispHeaders = ["itmDescCol", "noCol", "totalPriceHeader", "currencyHeader", "qualityHeader"];
    for (var x=0;x<noDispHeaders.length;x++){
        document.getElementById(noDispHeaders[x]).style.display="none";
    }
    
    for (var x=1;x<=offerItems;x++){
        document.getElementById('item'+x+'NameCol').style.display="none";
        document.getElementById('item'+x+'No').style.display="none";
        document.getElementById('item'+x+'amtCol').style.display="none";
        document.getElementById('item'+x+'priceCol').style.display="none";
        document.getElementById('item'+x+'qltCol').style.display="none";
    }
    document.getElementById("totalsRow").style.display="";
</script>
<script src="../assets/js/contractOfferTemp.js"></script>