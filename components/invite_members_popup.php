<div id="member-popup" class="member-popup" style="display: <?= ($memberError == true) ? 'block' : 'none'; ?>;">
    <div class="popup-content" id="popup-content">
        <form action="index.php" method="post" id="invite-member-form">
            <div>
                <h2>Invite Members</h2>
                <p class="tagline">Send invitation to join "<?= $group_name ?>" study group</p>
                <div class="close-button" id="close-member-button">
                    <img src="../../../assets/icons/close.png" alt="" class="close-image">
                </div>
            </div>

            <?php
            $label = "Email Address";
            $type = "email";
            $name = "email";
            include '../../../components/textfield.php';
            ?>
            <div class="error-text">
                <?php echo ($memberError) ? $error : '' ?>
            </div>
            <div>
                <input type="submit" value="Invite Member" name="invite-btn">
            </div>
        </form>
    </div>
</div>