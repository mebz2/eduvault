<div id="file-popup" class="file-popup" style="display: <?= ($fileError == true) ? 'block' : 'none'; ?>;">
    <div class="popup-content">
        <!-- enctype is so that the FILES global variable is set for the file name -->
        <form action="index.php" method="post" id="file-upload-form" enctype="multipart/form-data">
            <div>
                <h2>Upload File</h2>
                <p class="tagline">Share study material with your group</p>
                <div class="close-button" id="close-file-button">
                    <img src="../../../assets/icons/close.png" alt="" class="close-image">
                </div>
            </div>
            <div>
                <label for="choose-file" class="choose-file">
                    Choose File
                </label>
                <input type="file" id="choose-file" name="choose-file">
                <p id="filename">No file selected</p>
            </div>
            <div class="error-text">
                <?php
                echo ($fileError == true) ? $ferror : '';
                ?>
            </div>
            <div>
                <input type="submit" value="Upload File" name="upload-btn">
            </div>
        </form>
    </div>
</div>