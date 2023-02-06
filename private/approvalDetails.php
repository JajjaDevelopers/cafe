<div id="activityApprovalDIv" style="margin-top: 10px; width:auto ">
        <div id="activityPrepareDiv">
            <input type="submit" id="activityConfirmButton" value="Cancel" class="controlButtons">
            <input type="submit" id="activityCancelButton" value="Submit" class="controlButtons">
        </div>
    </div>
    <div style="display: grid;">
        <div style="margin-top: 50px; grid-column:1 ">
            <label for="preparedBy">Prepared By:</label><br>
            <?php
                echo'<input type="text" id="preparedBy" name="preparedBy" class="shortInput" value="'.$_SESSION["username"].
                    '"style="width: 100px; text-align: center;"><br>'
            ?>
        </div>
        <div style="margin-top: 50px; grid-column:2">
            <label for="preparedBy">Verified By:</label><br>
            <input type="text" id="preparedBy" name="preparedBy" class="shortInput" style="width: 100px; text-align: center;"><br>
        </div>
        <div style="margin-top: 50px; grid-column:3">
            <label class="approvalLabel" for="preparedBy">Approved By:</label><br>
            <input type="text" id="preparedBy" name="preparedBy" class="shortInput" style="width: 100px; text-align: center;"><br>
        </div>
    </div>
</div>