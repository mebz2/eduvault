<div id="edit-popup" class="edit-popup" style="display: none;">
    <div class="popup-content" id="popup-content">
        <form action="index.php" method="post" id="edit-group-form">
            <div>
                <h2>Edit Group</h2>
                <p class="tagline">Edit your groups information<br>(leave empty if you don't wanna update)</p>
                <div class="close-button" id="close-edit-button">
                    <img src="../../../assets/icons/close.png" alt="" class="close-image">
                </div>
            </div>

            <?php
            $label = "Group Name";
            $type = "text";
            $name = "group-name";
            include '../../../components/textfield.php';
            ?>
            <div class="error-text">
                <!-- <?php echo ($memberError) ? $error : '' ?> -->
            </div>
            <div>
                <label name="group-description">Group Description</label>
                <textarea name="group-description" class="group-description" rows="5"></textarea>
                <!-- if there is an error display the error message -->
                <div class="error-text">
                    <!-- <?php echo ($create_group_error && $error['err']['id'] == "group_description") ? $error['err']['message'] : '' ?> -->
                </div>
            </div>
            <div>
                <input type="submit" value="Edit Group" name="edit-btn">
            </div>
        </form>
    </div>
</div>