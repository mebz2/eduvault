<div class="file">
    <div class="left-side">
        <img src="../../../assets/icons/document.png">
        <h3><?= (isset($file_name)) ? $file_name : 'FILE NAME' ?></h3>
        <p><?= " ." . $file_type . " | " . $file_size . " " . $size_type ?></p>
    </div>
    <div class="right-side">
        <a href="<?= "/eduvault/uploads/" . basename($file_path) ?>" download="<?= $file_name ?>">
            <button id="download-file-btn">Download</button>
        </a>
    </div>
</div>