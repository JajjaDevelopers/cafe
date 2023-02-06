<?php include_once ('header.php'); ?>
<body>
    <form class="regularForm" method="POST" action="addNewCustomer.php">
        <label for="customerId">Customer ID</label>
        <input type="number" name="customerId" class="shortInput" readonly><br>
        <label for="customerName">Customer Name</label>
        <input type="text" name="customerName" class="longInputField"><br>
        <label for="customerCity">City</label>
        <input type="text" name="customerCity" class="longInputField"><br>
        <label for="customerTel">Telephone</label>
        <input type="number" name="customerTel" class="longInputField"><br>
        <label for="customerEmail">Email</label>
        <input type="email" name="customerEmail" class="longInputField"><br>
        <input type="submit" class="controlButtons">
    </form>
<?php include_once ('footer.php'); ?>
