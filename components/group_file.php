<div class="file">
    <div class="left-side">
        <img src="../../../assets/icons/document.png">
        <h3><?= (isset($file_name)) ? $file_name : 'FILE NAME' ?></h3>
        <!-- <p><?= $file_size . " " . $size_type . " | " . $file_type ?></p> -->
        <p><?= " ." . $file_type . " | " . $file_size . " " . $size_type ?></p>
    </div>
    <div class="right-side">
        <button id="download-file-btn">Download</button>
    </div>
</div>