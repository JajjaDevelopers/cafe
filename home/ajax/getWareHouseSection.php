<?php include "../private/database.php"; ?>
<?php
$block = $_GET['q'];
$query = "SELECT section FROM warehouse WHERE (block_id=? AND active_status=1)";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $block); 
    $stmt->execute();
    $stmt->bind_result($section);
    echo '<option>Section</option>';
    while ($stmt->fetch()) {
        ?>
        <option value="<?= $section?>"><?= $section?></option>
        <?php
    }
    $stmt->close();
}


?>