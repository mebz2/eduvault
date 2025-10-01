<div class="text-box-container">
    <p class="label"><?php echo $label; ?></p>
    <input
        type="<?php echo $type; ?>"
        name="<?php echo $name; ?>"
        id="<?php echo $id; ?>"
        class="text-box"
        style="width: <?php
                        echo isset($width) ? $width : '400px';
                        ?>;
                height:<?php
                        echo isset($height) ? $height : '41px';
                        ?>;">
</div>