<?php $pageTitle="Contract Offer";
include_once ("../forms/header.php");
include "../private/contractOfferVariables.php";
?>
<form class="regularForm" method="post" action="../reports/clientContract.php?contNo=<?=$contNo?>" style="width: 1200px; height:fit-content">
    <h3 class="formHeading">Contract Offer</h3>
    <?php include "../templates/contractOffer.php" ?>
    <?php submitButton("Generate Client's Copy", "submit", "btnsubmit") ?>
</form>

<?php include "../forms/footer.php" ?>