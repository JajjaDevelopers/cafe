<?php include_once('header.php'); ?>
<?php $pageTitle = "Valuation Report"; ?>
<input type="submit" id="valuationNumber" name="valuationNumber" class="shortInput" form="previousValuations"
            style="width: 40px; text-align: center;" value="<<<" >
<input type="submit" id="valuationNumber" name="valuationNumber" class="shortInput" form="nextValuations"
style="width: 40px; text-align: center;" value=">>>"><br>


<?php include_once("../connection/previousValuation.php"); ?>
    

<form id="previousValuations" class="" method="POST" action="previousValuation.php" style="display: none;">
    <input type="number" id="valuationNumber" name="valuationNumber" class="shortInput" value="<?php echo $previousValuationNo; ?>" 
    style="width: 100px; text-align: center; display:none;">
            
</form>
<form id="nextValuations" class="" method="POST" action="previousValuation.php" style="display: none;">
    <input type="number" id="valuationNumber" name="valuationNumber" class="shortInput" value="<?php echo $nextValuationNo; ?>" 
    style="width: 100px; text-align: center; display:none;">
            
</form>
<script src="../assets/js/valuationJavaScript.js"></script>

<?php include_once('footer.php');?>