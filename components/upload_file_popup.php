<!-- <div id="file-popup" class="file-popup" style="display: <?= ($fileError) ? 'block' : 'none'; ?>;"> -->
<div id="file-popup" class="file-popup" style="display: none;">
    <div class="popup-content">
        <form action="index.php" method="post" id="file-upload-form">
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
            <div>
                <input type="submit" value="Upload File" name="upload-btn">
            </div>
        </form>
    </div>
</div>